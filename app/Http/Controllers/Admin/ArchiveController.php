<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArchiveController extends Controller
{
    /**
     * Constructor for Controller.
     */
    public function __construct(private $name = 'Archive', public $read = 0)
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
                if ($r->action == 'Read') {
                    $this->read = $r->access;
                }
            }
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->get_access_page();
        if ($this->read == 1) {
            try {
                if ($request->bidang_id && $request->sub_id) {
                    return view('admin.archives.arc', [
                        'name' => $this->name,
                        'bidang' => \App\Models\Bidang::where('bid_id', $request->bidang_id)->first(),
                        'sub' => \App\Models\SubBidang::where('sub_id', $request->sub_id)->first(),
                        'surat' => \App\Models\SuratKeluar::where('bid_id', $request->bidang_id)->where('sub_id', $request->sub_id)->latest('sk_step')->get(),
                        'pages' => $this->get_access($this->name, auth()->user()->group_id)
                    ]);
                } else {
                    if ($request->bidang_id) {
                        return view('admin.archives.archive', [
                            'name' => $this->name,
                            'bidang' => \App\Models\Bidang::where('bid_id', $request->bidang_id)->first(),
                            'sub' => \App\Models\SubBidang::where('bid_id', $request->bidang_id)->get()
                        ]);
                    } else {
                        return view('admin.archives.archives', [
                            'name' => $this->name,
                            'bidang' => \App\Models\Bidang::all()
                        ]);
                    }
                }
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', 'You not Have Authority!');
        }
    }
}
