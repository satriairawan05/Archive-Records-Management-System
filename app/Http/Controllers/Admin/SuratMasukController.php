<?php

namespace App\Http\Controllers\Admin;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SuratMasukController extends Controller
{
    /**
     * Constructor for Controller.
     */
    public function __construct(private $name = 'Surat Masuk', public $create = 0, public $read = 0, public $update = 0, public $delete = 0)
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
                return view('admin.surat_masuk.index', [
                    'name' => $this->name,
                    'surat' => SuratMasuk::latest('created_at')->get(),
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
                return view('admin.surat_masuk.create', [
                    'name' => $this->name
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
                    'sm_jenis' => ['required', 'string'],
                    'sm_asal' => ['required', 'string'],
                    // 'sm_no_surat' => ['required','string'],
                    // 'sm_tgl_surat' => ['required','string'],
                    'sm_tgl_diterima' => ['required', 'string'],
                    // 'sm_pengirim' => ['required','string'],
                    'sm_penerima' => ['required', 'string'],
                    'sm_perihal' => ['required', 'string'],
                ]);

                if (!$validated->fails()) {
                    SuratMasuk::create([
                        'sm_jenis' => $request->input('sm_jenis'),
                        'sm_asal' => $request->input('sm_asal'),
                        // 'sm_no_surat' => $request->input('sm_no_surat'),
                        // 'sm_tgl_surat' => $request->input('sm_tgl_surat'),
                        'sm_tgl_diterima' => $request->input('sm_tgl_diterima'),
                        // 'sm_pengirim' => $request->input('sm_pengirim'),
                        'sm_penerima' => $request->input('sm_penerima'),
                        'sm_perihal' => $request->input('sm_perihal'),
                        'sm_file' => $request->file('sm_file')->store('surat_masuk'),
                        'sm_created' => auth()->user()->name,
                    ]);

                    return redirect()->to(route('surat_masuk.index'))->with('success', 'Data Saved!');
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
    public function show(SuratMasuk $suratMasuk)
    {
        $this->get_access_page();
        if ($this->read == 1) {
            try {
                return view('admin.surat_masuk.document', [
                    'name' => $this->name,
                    'surat' => $suratMasuk->find(request()->segment(2))
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
    public function edit(SuratMasuk $suratMasuk)
    {
        $this->get_access_page();
        if ($this->update == 1) {
            try {
                return view('admin.surat_masuk.edit', [
                    'name' => $this->name,
                    'surat' => $suratMasuk->find(request()->segment(2))
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
    public function update(Request $request, SuratMasuk $suratMasuk)
    {
        $this->get_access_page();
        if ($this->update == 1) {
            try {
                $validated = Validator::make($request->all(), [
                    'sm_jenis' => ['required', 'string'],
                    'sm_asal' => ['required', 'string'],
                    // 'sm_no_surat' => ['required','string'],
                    // 'sm_tgl_surat' => ['required','string'],
                    'sm_tgl_diterima' => ['required', 'string'],
                    // 'sm_pengirim' => ['required','string'],
                    'sm_penerima' => ['required', 'string'],
                    'sm_perihal' => ['required', 'string'],
                ]);

                if (!$validated->fails()) {
                    if ($request->hasFile('sm_file')) {
                        if ($suratMasuk->sm_file != $request->file('sm_file')) {
                            \Illuminate\Support\Facades\Storage::delete($suratMasuk->sm_file);
                        }
                        $file = $request->file('sm_file');
                        $filePath = $file->store('surat_masuk');
                    } else {
                        $filePath = $suratMasuk->sm_file;
                    }

                    SuratMasuk::where('sm_id', $suratMasuk->sm_id)->update([
                        'sm_jenis' => $request->input('sm_jenis'),
                        'sm_asal' => $request->input('sm_asal'),
                        // 'sm_no_surat' => $request->input('sm_no_surat'),
                        // 'sm_tgl_surat' => $request->input('sm_tgl_surat'),
                        'sm_tgl_diterima' => $request->input('sm_tgl_diterima'),
                        // 'sm_pengirim' => $request->input('sm_pengirim'),
                        'sm_penerima' => $request->input('sm_penerima'),
                        'sm_perihal' => $request->input('sm_perihal'),
                        'sm_file' => $filePath,
                        'sm_updated' => auth()->user()->name,
                    ]);

                    return redirect()->to(route('surat_masuk.index'))->with('success', 'Data Updated!');
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

    public function download(SuratMasuk $suratMasuk)
    {
        $file = $suratMasuk->sm_file;

        if (!\Illuminate\Support\Facades\Storage::exists($file)) {
            return redirect()->back()->with('error', 'File not found');
        }

        return response()->download(\Illuminate\Support\Facades\Storage::path($file));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratMasuk $suratMasuk)
    {
        $this->get_access_page();
        if ($this->delete == 1) {
            try {
                $data = $suratMasuk->find(request()->segment(2));

                $filePath = $data->file_path;

                SuratMasuk::destroy($data->sm_id);

                if ($filePath && \Illuminate\Support\Facades\Storage::exists($filePath)) {
                    \Illuminate\Support\Facades\Storage::delete($filePath);
                }

                return redirect()->back()->with('success', 'Data Deleted!');
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', 'You not Have Authority!');
        }
    }
}
