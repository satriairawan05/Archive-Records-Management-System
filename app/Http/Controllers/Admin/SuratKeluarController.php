<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
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
    public function __construct(private $name = 'Surat Keluar', public $create = 0, public $read = 0, public $update = 0, public $delete = 0, public $approval = 0)
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
                    $this->approval = $r->access;
                }

                if ($r->action == 'Update') {
                    $this->update = $r->access;
                }

                if ($r->action == 'Delete') {
                    $this->delete = $r->access;
                }

                // if ($r->action == 'Close') {
                //     $this->close = $r->access;
                // }
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
                    $surat = SuratKeluar::leftJoin('jenis_surats', 'surat_keluars.js_id', '=', 'jenis_surats.js_id')
                        ->leftJoin('approvals', 'surat_keluars.sk_id', '=', 'approvals.sk_id')
                        ->where('approvals.user_id',auth()->user()->id)
                        ->whereNull('approvals.app_date')
                        ->latest('surat_keluars.created_at')
                        ->get();
                } else {
                    $query = SuratKeluar::leftJoin('jenis_surats', 'surat_keluars.js_id', '=', 'jenis_surats.js_id')
                        ->leftJoin('approvals', 'surat_keluars.sk_id', '=', 'approvals.sk_id')
                        ->where('approvals.user_id',auth()->user()->id)
                        ->whereNull('approvals.app_date');

                    if (auth()->user()->bid_id == null && auth()->user()->sub_id == null) {
                        $surat = $query->latest('surat_keluars.created_at')->get();
                    } else if (auth()->user()->sub_id == null) {
                        $surat = $query->where('surat_keluars.bid_id', auth()->user()->bid_id)->latest('surat_keluars.created_at')->get();
                    } else {
                        $surat = $query->where('surat_keluars.bid_id', auth()->user()->bid_id)
                            ->where('surat_keluars.sub_id', auth()->user()->sub_id)
                            ->latest('surat_keluars.created_at')
                            ->get();
                    }
                }

                if (request()->bidang_id && request()->sub_id) {
                    return view('admin.surat_keluar.index', [
                        'surat' => $surat,
                        'name' => $this->name,
                        'approval' => $this->approval,
                        'pages' => $this->get_access($this->name, auth()->user()->group_id),
                        'bidang' => \App\Models\Bidang::where('bid_id', request()->bidang_id)->first(),
                        'sub' => \App\Models\SubBidang::where('bid_id', request()->bidang_id)->where('sub_id',request()->sub_id)->first()
                    ]);
                } else {
                    if (request()->bidang_id) {
                        return view('admin.surat_keluar.index2', [
                            'name' => $this->name,
                            'sub' => \App\Models\SubBidang::all(),
                            'bidang' => \App\Models\Bidang::where('bid_id', request()->bidang_id)->first()
                        ]);
                    } else {
                        return view('admin.surat_keluar.index3', [
                            'name' => $this->name,
                            'bidang' => \App\Models\Bidang::all()
                        ]);
                    }
                }
                // return view('admin.surat_keluar.index', [
                //     'name' => $this->name,
                //     'surat' => $surat,
                //     'pages' => $this->get_access($this->name, auth()->user()->group_id)
                // ]);
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
                ]);

                if (!$validated->fails()) {
                    $sk = SuratKeluar::create([
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
                        'sk_tgl' => Carbon::now(),
                        'sk_tgl_old' => Carbon::now(),
                        'sk_step' => 1,
                        'sk_file' => $request->hasFile('sk_file') ? $request->file('sk_file')->store('surat_keluar') : null
                    ]);

                    $jenisSurat = JenisSurat::where('js_id', $sk->js_id)->first();

                    if ($jenisSurat) {
                        $jenisSurat->update([
                            'js_count' => $jenisSurat->js_count + 1
                        ]);
                    }

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
                // PrintSuratKeluar::where('sk_id', $suratKeluar->sk_id)->update([
                //     'ps_count' => \Illuminate\Support\Facades\DB::raw('ps_count + 1')
                // ]);

                return view('admin.surat_keluar.file', [
                    'name' => $this->name,
                    'surat' => $suratKeluar->find(request()->segment(2))
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
                ]);

                if (!$validated->fails()) {
                    if ($request->hasFile('sk_file')) {
                        if ($suratKeluar->sk_file != $request->file('sk_file')) {
                            \Illuminate\Support\Facades\Storage::delete($suratKeluar->sk_file);
                        }
                        $file = $request->file('sk_file');
                        $filePath = $file->store('surat_keluar');
                    } else {
                        $filePath = $suratKeluar->sk_file;
                    }

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
                        'sk_tgl' => Carbon::now(),
                        'sk_step' => 1,
                        'sk_file' => $filePath
                    ]);

                    // PrintSuratKeluar::where('sk_id', $suratKeluar->sk_id)->update([
                    //     'ps_count' => 0
                    // ]);

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
        $this->get_access_page();
        $surat = $suratKeluar->find(request()->segment(2));
        $app = \App\Models\Approval::where('bid_id', auth()->user()->bid_id)->where('sub_id',auth()->user()->sub_id)->where('user_id', auth()->user()->id)->first();
        try {
            if ($this->approval == 1 && $app && $surat->sk_step == $app->app_ordinal && $app->app_date == null) {
                $pic = \App\Models\User::where('name', $surat->sk_created)->select('name')->first();

                $latestApproval = \App\Models\Approval::where('sk_id', $surat->sk_id)
                    ->latest('app_ordinal')
                    ->first();

                \App\Models\Approval::where('sk_id', $surat->sk_id)->where('user_id', auth()->user()->id)->update([
                    'app_disposisi' => $request->input('sk_disposisi'),
                    'app_date' => \Carbon\Carbon::now(),
                ]);

                // Menentukan nilai skStep sesuai kondisi yang ada
                $skStep = $latestApproval && $latestApproval->app_ordinal != $surat->sk_step
                    ? $surat->sk_step + 1
                    : $surat->sk_step;

                // Membuat array update untuk SuratKeluar
                $updateSK = [
                    'sk_remark' => $request->input('sk_remark'),
                    'sk_step' => $skStep,
                ];

                // Memeriksa apakah kondisi close adalah 1 untuk mengupdate sk_status
                // if ($this->close == 1) {
                //     $updateSK['sk_status'] = $request->input('sk_status') == "on" ? 'Closing' : '';
                // }

                // Melakukan update pada SuratKeluar
                SuratKeluar::where('sk_id', $surat->sk_id)->update($updateSK);

                return redirect()->back()->with('success', 'Data ' . $pic->name . ' Updated!');
            } else {
                return redirect()->back()->with('failed', 'You Not Have Authority!');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    public function download(SuratKeluar $suratKeluar)
    {
        $file = $suratKeluar->sk_file;

        if (!\Illuminate\Support\Facades\Storage::exists($file)) {
            return redirect()->back()->with('error', 'File not found');
        }

        return response()->download(\Illuminate\Support\Facades\Storage::path($file));
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
