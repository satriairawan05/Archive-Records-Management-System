<?php

namespace App\Http\Controllers\Admin;

use App\Models\Approval;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
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
                    $this->read = $r->access;
                }

                if ($r->action == 'Update') {
                    $this->update = $r->access;
                }

                if ($r->action == 'Delete') {
                    $this->delete = $r->access;
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
                return view('admin.surat_keluar.index', [
                    'name' => $this->name,
                    'surat' => SuratKeluar::all(),
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
        // dd($request->all());
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
                        'sk_perihal' => $request->input('sk_perihal'),
                        'sk_tujuan' => $request->input('sk_tujuan'),
                        'sk_deskripsi' => $request->input('sk_deskripsi'),
                        'sk_created' => auth()->user()->name,
                        'sk_tgl' => \Carbon\Carbon::now(),
                        'sk_tgl_old' => \Carbon\Carbon::now(),
                        'sk_step' => 1
                    ]);

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
     * Display the specified resource.
     */
    public function show(SuratKeluar $suratKeluar)
    {
        $this->get_access_page();
        if ($this->read == 1) {
            try {
                //
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
        if ($this->update == 1) {
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
                        'sk_perihal' => $request->input('sk_perihal'),
                        'sk_tujuan' => $request->input('sk_tujuan'),
                        'sk_deskripsi' => $request->input('sk_deskripsi'),
                        'sk_updated' => auth()->user()->name,
                        'sk_tgl' => \Carbon\Carbon::now(),
                        'sk_step' => 1
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
        $this->get_access_page();
        if ($this->approval == 1) {
            try {
                $pic = \App\Models\User::where('id', $suratKeluar->pic_id)->select('name')->first();
                $stepData = null;

                $latestApproval = \App\Models\Approval::where('sk_id', $suratKeluar->sk_id)->latest('app_ordinal')->first();
                if ($request->input('sk_dipsosisi') == 'Accepted') {
                    \App\Models\Approval::where('sk_id', $suratKeluar->sk_id)->where('user_id', auth()->user()->id)->update([
                        'app_status' => $request->input('sk_disposisi'),
                        'app_date' => \Carbon\Carbon::now()
                    ]);

                    if ($latestApproval->app_ordinal == $suratKeluar->sk_step) {
                        $stepData = $suratKeluar->sk_step;
                    } else {
                        $stepData = $suratKeluar->sk_step + 1;
                    }

                    SuratKeluar::where('sk_id', $suratKeluar->sk_id)->update([
                        'sk_disposisi' => $request->input('sk_disposisi'),
                        'sk_remark' => $request->input('sk_remark'),
                        'sk_approved_step' => $stepData
                    ]);
                } else {
                    \App\Models\Approval::where('sk_id', $suratKeluar->sk_id)->where('user_id', auth()->user()->id)->update([
                        'app_status' => $request->input('sk_disposisi'),
                        'app_date' => \Carbon\Carbon::now()
                    ]);

                    $stepData = 1;
                    SuratKeluar::where('sk_id', $suratKeluar->sk_id)->update([
                        'sk_disposisi' => $request->input('sk_disposisi'),
                        'sk_remark' => $request->input('sk_remark'),
                        'sk_approved_step' => $stepData
                    ]);
                }


                return redirect()->back()->with('success', 'Surat Cuti ' . $pic->name . ' telah anda ' . $suratKeluar->sk_disposisi . '!');
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', 'You not Have Authority!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratKeluar $suratKeluar)
    {
        $this->get_access_page();
        if ($this->delete == 1) {
            try {
                $data = $suratKeluar->find(request()->segment(2));

                SuratKeluar::destroy($data->sk_id);

                return redirect()->back()->with('success', 'Successfully Deleted!');
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', 'You not Have Authority!');
        }
    }
}
