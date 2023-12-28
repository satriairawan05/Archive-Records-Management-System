<?php

namespace App\Http\Controllers\Admin;

use App\Models\Approval;
use App\Models\JenisSurat;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use App\Models\PrintSuratKeluar;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SuratKeluarController extends Controller
{
    /**
     * Constructor for Controller.
     */
    public function __construct(private $name = 'Surat Keluar', public $create = 0, public $read = 0, public $update = 0, public $delete = 0, public $approval = 0, public $close = 0)
    {
        //
    }

    /**
     * Generate Access for Controller.
     */
    public function get_access_page()
    {
        $userRole = $this->get_access($this->name, auth()->user()->group_id);

        foreach ($userRole as $r) {
            if ($r->page_name == $this->name) {
                if ($r->action == 'Create') {
                    $this->create = $r->access;
                }

                if ($r->action == 'Read') {
                    $this->read = $r->access;
                }

                if ($r->action == 'Approval') {
                    $this->read = $r->access;
                }

                if ($r->action == 'Update') {
                    $this->update = $r->access;
                }

                if ($r->action == 'Delete') {
                    $this->delete = $r->access;
                }

                if ($r->action == 'Close') {
                    $this->close = $r->access;
                }
            }
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->get_access_page();
        if ($this->read == 1) {
            try {
                if (auth()->user()->group_id == 1) {
                    $surat = SuratKeluar::latest('created_at')->get();
                } else {
                    if (auth()->user()->sub_id == null) {
                        $surat = SuratKeluar::where('bid_id', auth()->user()->bid_id)->latest('created_at')->get();
                    } else {
                        $surat = SuratKeluar::where('bid_id', auth()->user()->bid_id)->where('sub_id', auth()->user()->sub_id)->latest('created_at')->get();
                    }
                }
                return view('admin.surat_keluar.index', [
                    'name' => $this->name,
                    'surat' => $surat,
                    'pages' => $this->get_access($this->name, auth()->user()->group_id)
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', 'You not Have Authority!');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->get_access_page();
        if ($this->create == 1) {
            try {
                return view('admin.surat_keluar.create', [
                    'name' => $this->name,
                    'surat' => \App\Models\JenisSurat::all(),
                    'bidang' => \App\Models\Bidang::all(),
                    'sub' => \App\Models\SubBidang::all(),
                    'com' => \App\Models\Company::where('com_id', 1)->first()
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', 'You not Have Authority!');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->get_access_page();
        if ($this->create == 1) {
            try {
                $validated = Validator::make($request->all(), [
                    'sk_asal' => ['required', 'string'],
                    'sk_asal' => ['required', 'string'],
                    'sk_sifat' => ['required', 'string'],
                    'sk_perihal' => ['required', 'string'],
                    'sk_tujuan' => ['required', 'string'],
                    'sk_deskripsi' => ['required'],
                ]);

                if (!$validated->fails()) {
                    SuratKeluar::create([
                        'js_id' => $request->input('js_id'),
                        'bid_id' => $request->input('bid_id'),
                        'sub_id' => $request->input('sub_id'),
                        'sk_asal' => $request->input('sk_asal'),
                        'sk_sifat' => $request->input('sk_sifat'),
                        'sk_no' => $request->input('sk_no'),
                        'sk_no_old' => $request->input('sk_no'),
                        'sk_perihal' => $request->input('sk_perihal'),
                        'sk_tempat_tujuan' => $request->input('sk_tempat_tujuan'),
                        'sk_tujuan' => $request->input('sk_tujuan'),
                        'sk_deskripsi' => $request->input('sk_deskripsi'),
                        'sk_table' => $request->input('sk_table'),
                        'sk_lampiran' => $request->input('sk_lampiran'),
                        'sk_created' => auth()->user()->name,
                        'sk_tgl' => \Carbon\Carbon::now(),
                        'sk_tgl_old' => \Carbon\Carbon::now(),
                        'sk_step' => 1
                    ]);

                    // JenisSurat::where('sk_id', $data->sk_id)->increment('js_count');

                    // PrintSuratKeluar::create([
                    //     'sk_id' => $sk->sk_id
                    // ]);

                    return redirect()->to(route('surat_keluar.index'))->with('success', 'Successfully Saved!');
                } else {
                    return redirect()->back()->with('failed', $validated->getMessageBag());
                }
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', 'You not Have Authority!');
        }
    }

    /**
     * Display the specified resource for print.
     */
    public function print(SuratKeluar $suratKeluar)
    {
        // dd($suratKeluar);
        try {
            // Increment 'ps_count' in PrintSuratKeluar
            PrintSuratKeluar::where('sk_id', $suratKeluar->sk_id)->update([
                'ps_count' => \Illuminate\Support\Facades\DB::raw('ps_count + 1')
            ]);

            // Find surat keluar based on the segment
            $surat = $suratKeluar->find(request()->segment(2));

            // Retrieve approval information
            $approval = Approval::leftJoin('users', 'approvals.user_id', '=', 'users.id')
                ->where('approvals.sk_id', $surat->sk_id)
                ->latest('approvals.app_id')
                ->first();

            // Check if approval exists
            if ($approval) {
                return view('admin.surat_keluar.document', [
                    'name' => $this->name,
                    'surat' => $surat,
                    'approval' => $approval
                ]);
            } else {
                // If approval does not exist, you might want to handle this case accordingly
                return view('admin.surat_keluar.document', [
                    'name' => $this->name,
                    'surat' => $surat,
                    'approval' => null
                ]);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
        $this->get_access_page();
        if ($this->read == 1) {
        } else {
            return redirect()->back()->with('failed', 'You not Have Authority!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratKeluar $suratKeluar)
    {
        $this->get_access_page();
        if ($this->read == 1) {
            try {
                PrintSuratKeluar::where('sk_id', $suratKeluar->sk_id)->update([
                    'ps_count' => \Illuminate\Support\Facades\DB::raw('ps_count + 1')
                ]);

                return view('admin.surat_keluar.document', [
                    'name' => $this->name,
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', 'You not Have Authority!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratKeluar $suratKeluar)
    {
        $this->get_access_page();
        if ($this->update == 1) {
            try {
                return view('admin.surat_keluar.edit', [
                    'name' => $this->name,
                    'surat' => \App\Models\JenisSurat::all(),
                    'bidang' => \App\Models\Bidang::all(),
                    'sub' => \App\Models\SubBidang::all(),
                    'com' => \App\Models\Company::where('com_id', 1)->first(),
                    'keluar' => $suratKeluar->find(request()->segment(2))
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', 'You not Have Authority!');
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SuratKeluar $suratKeluar)
    {
        $this->get_access_page();
        if ($this->update == 1 && $suratKeluar->sk_created == auth()->user()->name) {
            try {
                $validated = Validator::make($request->all(), [
                    'sk_asal' => ['required', 'string'],
                    'sk_asal' => ['required', 'string'],
                    'sk_sifat' => ['required', 'string'],
                    'sk_perihal' => ['required', 'string'],
                    'sk_tujuan' => ['required', 'string'],
                    'sk_deskripsi' => ['required'],
                ]);

                if (!$validated->fails()) {
                    SuratKeluar::where('sk_id', $suratKeluar->sk_id)->update([
                        'js_id' => $request->input('js_id'),
                        'bid_id' => $request->input('bid_id'),
                        'sub_id' => $request->input('sub_id'),
                        'sk_asal' => $request->input('sk_asal'),
                        'sk_sifat' => $request->input('sk_sifat'),
                        'sk_no' => $request->input('sk_no'),
                        'sk_perihal' => $request->input('sk_perihal'),
                        'sk_tempat_tujuan' => $request->input('sk_tempat_tujuan'),
                        'sk_tujuan' => $request->input('sk_tujuan'),
                        'sk_deskripsi' => $request->input('sk_deskripsi'),
                        'sk_table' => $request->input('sk_table'),
                        'sk_lampiran' => $request->input('sk_lampiran'),
                        'sk_updated' => auth()->user()->name,
                        'sk_tgl' => \Carbon\Carbon::now(),
                        'sk_step' => 1
                    ]);

                    PrintSuratKeluar::where('sk_id', $suratKeluar->sk_id)->update([
                        'ps_count' => 0
                    ]);

                    return redirect()->to(route('surat_keluar.index'))->with('success', 'Successfully Updated!');
                } else {
                    return redirect()->back()->with('failed', $validated->getMessageBag());
                }
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', 'You not Have Authority!');
        }
    }

    /**
     * Update the Approval & Surat Keluar resource in storage.
     */
    public function updateApprovalStep(Request $request, SuratKeluar $suratKeluar)
    {
        try {
            $surat = $suratKeluar->find(request()->segment(2));
            $pic = \App\Models\User::where('name', $surat->sk_created)->select('name')->first();
            $stepData = null;

            $updateData = [
                'app_disposisi' => $request->input('sk_disposisi'),
                'app_date' => \Carbon\Carbon::now(),
            ];

            $latestApproval = \App\Models\Approval::where('sk_id', $surat->sk_id)->latest('app_ordinal')->first();
            // dd((int) $latestApproval->app_ordinal, (int) $surat->sk_step);
            if ($request->input('sk_dipsosisi') == 'Accepted') {
                \App\Models\Approval::where('sk_id', $surat->sk_id)->where('user_id', auth()->user()->id)->update($updateData);

                if($surat->sk_step != $latestApproval->app_ordinal){
                    $newStep = $surat->sk_step + 1;
                    SuratKeluar::where('sk_id', $surat->sk_id)->update([
                        'sk_remark' => $request->input('sk_remark'),
                        'sk_step' => $newStep
                    ]);
                } else {
                    SuratKeluar::where('sk_id', $surat->sk_id)->update([
                        'sk_remark' => $request->input('sk_remark'),
                        'sk_step' => $surat->sk_step
                    ]);
                }
                if ($this->close == 1) {
                    $dataStatus = $request->input('sk_status') == "on" ? 'Closing' : '';
                    SuratKeluar::where('sk_id', $surat->sk_id)->update([
                        'sk_remark' => $request->input('sk_remark'),
                        'sk_status' => $dataStatus,
                    ]);
                }
            } else {
                \App\Models\Approval::where('sk_id', $surat->sk_id)->where('user_id', auth()->user()->id)->update($updateData);
                $stepData = 1;

                SuratKeluar::where('sk_id', $surat->sk_id)->update([
                    'sk_remark' => $request->input('sk_remark'),
                    'sk_step' => $stepData
                ]);
            }

            return redirect()->back()->with('success', 'Surat Keluar ' . $pic->name . ' telah anda ' . $surat->sk_disposisi . '!');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
        // $this->get_access_page();
        // if ($this->approval == 1 && \App\Models\Approval::where('sk_id', $suratKeluar->sk_id)->where('app_ordinal', (int) $suratKeluar->sk_step)->first()) {
        // } else {
        //     return redirect()->back()->with('failed', 'You not Have Authority!');
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratKeluar $suratKeluar)
    {
        $this->get_access_page();
        if ($this->delete == 1 && $suratKeluar->sk_created == auth()->user()->name) {
            try {
                $data = $suratKeluar->find(request()->segment(2));

                SuratKeluar::destroy($data->sk_id);

                PrintSuratKeluar::where('sk_id', $data->sk_id)->delete();

                JenisSurat::where('js_id', $data->js_id)->update([
                    'js_count' => \Illuminate\Support\Facades\DB::raw('js_count - 1')
                ]);

                return redirect()->back()->with('success', 'Successfully Deleted!');
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', 'You not Have Authority!');
        }
    }
}
