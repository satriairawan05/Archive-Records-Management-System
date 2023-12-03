<?php

namespace App\Http\Controllers\Admin;

use App\Models\Approval;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApprovalController extends Controller
{
    /**
     * Constructor for Controller.
     */
    public function __construct(private $name = 'Approval', public $create = 0, public $read = 0, public $update = 0, public $delete = 0)
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
                if (request()->input('bidang_id') && request()->input('sub_id')) {
                    return view('admin.setting.approval.index3', [
                        'name' => $this->name,
                        'bidang' => \App\Models\Bidang::where('bid_id', request()->input('bidang_id'))->first(),
                        'sub' => \App\Models\SubBidang::where('sub_id', request()->input('sub_id'))->first(),
                        'pages' => $this->get_access($this->name, auth()->user()->group_id),
                        'user' => \App\Models\User::all(),
                        'surat' => \App\Models\SuratKeluar::where('bid_id', request()->input('bidang_id'))->where('sub_id', request()->input('sub_id'))->get(),
                        'approval' => Approval::where('bid_id', request()->input('bidang_id'))->where('sub_id', request()->input('sub_id'))->get()
                    ]);
                } else {
                    if (request()->input('bidang_id')) {
                        return view('admin.setting.approval.index2', [
                            'name' => $this->name,
                            'name' => $this->name,
                            'bidang' => \App\Models\Bidang::where('bid_id', request()->input('bidang_id'))->first(),
                            'sub' => \App\Models\SubBidang::where('bid_id', request()->input('bidang_id'))->get()
                        ]);
                    } else {
                        return view('admin.setting.approval.index', [
                            'name' => $this->name,
                            'bidang' => \App\Models\Bidang::all()
                        ]);
                    }
                }
                return view('admin.setting.approval.index', [
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->get_access_page();
        if ($this->create == 1) {
            try {
                Approval::create([
                    'user_id' => $request->input('user_id'),
                    'bid_id' => $request->input('bid_id'),
                    'sub_id' => $request->input('sub_id'),
                    'app_ordinal' => $request->input('app_ordinal'),
                    'app_created' => auth()->user()->name
                ]);

                return redirect()->back()->with('success', 'Data Saved!');
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
    public function show(Approval $approval)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Approval $approval)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Approval $approval)
    {
        $this->get_access_page();
        if ($this->update == 1) {
            try {
                Approval::where('app_id', $approval->app_id)->update([
                    'user_id' => $request->input('user_id'),
                    'bid_id' => $request->input('bid_id'),
                    'sub_id' => $request->input('sub_id'),
                    'app_ordinal' => $request->input('app_ordinal'),
                    'app_updated' => auth()->user()->name
                ]);

                return redirect()->back()->with('success', 'Data Updated!');
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
    public function destroy(Approval $approval)
    {
        $this->get_access_page();
        if ($this->delete == 1) {
            try {
                $data = $approval->find(request()->segment(2));
                Approval::destroy('app_id',$data->app_id);

                return redirect()->back()->with('success', 'Data Deleted!');
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', 'You not Have Authority!');
        }
    }
}
