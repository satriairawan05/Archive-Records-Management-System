<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bidang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BidangController extends Controller
{
    /**
     * Constructor for Controller.
     */
    public function __construct(private $name = 'Bidang', public $create = 0, public $read = 0, public $update = 0, public $delete = 0)
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
                return view('admin.setting.bidang.index',[
                    'name' => $this->name,
                    'bidang' => Bidang::leftJoin('companies','bidangs.com_id','=','companies.com_id')->get(),
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
                return view('admin.setting.bidang.create',[
                    'name' => $this->name,
                    'companies' => \App\Models\Company::all()
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
                    'com_id' => ['required', 'string'],
                    'bid_name' => ['required', 'string', 'max:255'],
                    'bid_alias' => ['required', 'string', 'max:255'],
                ]);

                if (!$validated->fails()) {

                    return redirect()->to(route('bidang.index'))->with('success', 'Successfully Saved!');
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
    public function show(Bidang $bidang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bidang $bidang)
    {
        $this->get_access_page();
        if ($this->update == 1) {
            try {
                return view('admin.setting.bidang.edit',[
                    'name' => $this->name,
                    'companies' => \App\Models\Company::all(),
                    'bidang' => $bidang->find(request()->segment(2))
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
    public function update(Request $request, Bidang $bidang)
    {
        $this->get_access_page();
        if ($this->update == 1) {
            try {
                $validated = \Illuminate\Support\Facades\Validator::make($request->all(), [
                    'com_id' => ['required', 'string'],
                    'bid_name' => ['required', 'string', 'max:255'],
                    'bid_alias' => ['required', 'string', 'max:255'],
                ]);

                if (!$validated->fails()) {

                    return redirect()->to(route('bidang.index'))->with('success', 'Successfully Updated!');
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
    public function destroy(Bidang $bidang)
    {
        $this->get_access_page();
        if ($this->delete == 1) {
            try {
                $data = $bidang->find(request()->segment(2));
                Bidang::destroy($data->bid_id);

                return redirect()->back()->with('success', 'Successfully Deleted!');
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', 'You not Have Authority!');
        }
    }
}
