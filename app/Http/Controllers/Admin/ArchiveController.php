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
     * viewData
     *
     * @param  mixed $reqBid
     * @param  mixed $reqSub
     * @return void
     */
    private function viewData($reqBid, $reqSub)
    {
        if ($reqBid && $reqSub) {
            return view('admin.archives.arc', [
                'name' => $this->name,
                'bidang' => \App\Models\Bidang::where('bid_id', $reqBid)->first(),
                'sub' => \App\Models\SubBidang::where('sub_id', $reqSub)->first(),
                'surat' => \App\Models\SuratKeluar::where('bid_id', $reqBid)->where('sub_id', $reqSub)->whereNotNull('sk_no')->get(),
                'pages' => $this->get_access($this->name, auth()->user()->group_id)
            ]);
        } else {
            if ($reqBid) {
                return view('admin.archives.archive', [
                    'name' => $this->name,
                    'bidang' => \App\Models\Bidang::where('bid_id', $reqBid)->first(),
                    'sub' => \App\Models\SubBidang::where('bid_id', $reqBid)->get()
                ]);
            } else {
                return view('admin.archives.archives', [
                    'name' => $this->name,
                    'bidang' => \App\Models\Bidang::all()
                ]);
            }
        }
    }

    /**
     * viewByBid
     *
     * @param  mixed $reqBid
     * @return void
     */
    private function viewByBid($reqBid)
    {
        if ($reqBid && request()->input('sub_id')) {
            return view('admin.archives.arc', [
                'name' => $this->name,
                'bidang' => \App\Models\Bidang::where('bid_id', $reqBid)->first(),
                'sub' => \App\Models\SubBidang::where('sub_id', request()->input('sub_id'))->first(),
                'surat' => \App\Models\SuratKeluar::where('bid_id', $reqBid)->where('sub_id', request()->input('sub_id'))->whereNotNull('sk_status')->get(),
                'pages' => $this->get_access($this->name, auth()->user()->group_id)
            ]);
        } else {
            if ($reqBid) {
                return view('admin.archives.archive', [
                    'name' => $this->name,
                    'bidang' => \App\Models\Bidang::where('bid_id', $reqBid)->first(),
                    'sub' => \App\Models\SubBidang::where('bid_id', $reqBid)->get()
                ]);
            } else {
                return view('admin.archives.archives', [
                    'name' => $this->name,
                    'bidang' => \App\Models\Bidang::all()
                ]);
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
                if(auth()->user()->bid_id == null && auth()->user()->sub_id){
                    $this->viewData($request->input('bidang_id'),$request->input('sub_id'));
                } else {
                    if(auth()->user()->sub_id == null){
                        $this->viewByBid(auth()->user()->bid_id);
                    } else {
                        $this->viewData(auth()->user()->bid_id, auth()->user()->sub_id);
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
