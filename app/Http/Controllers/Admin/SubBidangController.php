<?php

namespace App\Http\Controllers\Admin;

use App\Models\SubBidang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubBidangController extends Controller
{
    /**
     * Constructor for Controller.
     */
    public function __construct(private $name = 'Sub Bidang', public $create = 0, public $read = 0, public $update = 0, public $delete = 0)
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
                return view('admin.setting.bidang.sub.index',[
                    'name' => $this->name,
                    'subBidang' => SubBidang::leftJoin('bidangs','sub_bidangs.bid_id','=','bidangs.bid_id')->get(),
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
                return view('admin.setting.bidang.sub.create',[
                    'name' => $this->name,
                    'bidang' => \App\Models\Bidang::all()
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
                SubBidang::create([
                    'bid_id' => $request->input('bid_id'),
                    'sub_name' => $request->input('sub_name'),
                    'sub_alias' => $request->input('sub_alias'),
                ]);

                return redirect()->to(route('sub_bidang.index'))->with('success', 'Data Saved!');
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
    public function show(SubBidang $subBidang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubBidang $subBidang)
    {
        $this->get_access_page();
        if ($this->update == 1) {
            try {
                return view('admin.setting.bidang.sub.edit',[
                    'name' => $this->name,
                    'bidang' => \App\Models\Bidang::all(),
                    'sub' => $subBidang->find(request()->segment(2))
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
    public function update(Request $request, SubBidang $subBidang)
    {
        $this->get_access_page();
        if ($this->update == 1) {
            try {
                SubBidang::wehere('sub_id',$subBidang->sub_id)->update([
                    'bid_id' => $request->input('bid_id'),
                    'sub_name' => $request->input('sub_name'),
                    'sub_alias' => $request->input('sub_alias'),
                ]);

                return redirect()->to(route('sub_bidang.index'))->with('success', 'Data Updated!');
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
    public function destroy(SubBidang $subBidang)
    {
        $this->get_access_page();
        if ($this->delete == 1) {
            try {
                $data = $subBidang->find(request()->segment(2));
                SubBidang::destroy($data->sub_id);

                return redirect()->back()->with('success', 'Data Deleted!');
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', 'You not Have Authority!');
        }
    }
}
