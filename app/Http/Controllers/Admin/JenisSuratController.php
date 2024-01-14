<?php

namespace App\Http\Controllers\Admin;

use App\Models\JenisSurat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JenisSuratController extends Controller
{
    /**
     * Constructor for Controller.
     */
    public function __construct(private $name = 'Jenis Surat', public $create = 0, public $read = 0, public $update = 0, public $delete = 0)
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
                return view('admin.setting.surat.index',[
                    'name' => $this->name,
                    'surat' => JenisSurat::all(),
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
                return view('admin.setting.surat.create',[
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
                $validated = \Illuminate\Support\Facades\Validator::make($request->all(), [
                    'js_jenis' => ['required', 'string', 'max:255', 'unique:jenis_surats,js_jenis'],
                ]);

                if (!$validated->fails()) {
                    JenisSurat::create([
                        'js_jenis' => $request->input('js_jenis'),
                        'js_count' => '0'
                    ]);

                    return redirect()->to(route('jenis_surat.index'))->with('success', 'Data Saved!');
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
    public function show(JenisSurat $jenisSurat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisSurat $jenisSurat)
    {
        $this->get_access_page();
        if ($this->update == 1) {
            try {
                return view('admin.setting.surat.edit',[
                    'name' => $this->name,
                    'surat' => $jenisSurat->find(request()->segment(2))
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
    public function update(Request $request, JenisSurat $jenisSurat)
    {
        $this->get_access_page();
        if ($this->update == 1) {
            try {
                $validated = \Illuminate\Support\Facades\Validator::make($request->all(), [
                    'js_jenis' => ['required', 'string', 'max:255'],
                ]);

                if (!$validated->fails()) {
                    JenisSurat::where('js_id', $jenisSurat->js_id)->update([
                        'js_jenis' => $request->input('js_jenis')
                    ]);

                    return redirect()->to(route('jenis_surat.index'))->with('success', 'Data Updated!');
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
     * Remove the specified resource from storage.
     */
    public function destroy(JenisSurat $jenisSurat)
    {
        try {
            $this->get_access_page();
            if ($this->delete == 1) {
            $data = $jenisSurat->find(request()->segment(2));
            JenisSurat::destroy($data->id);

            return redirect()->back()->with('success', 'Data Deleted!');
            } else {
                return redirect()->back()->with('failed', 'You not Have Authority!');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }
}
