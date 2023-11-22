<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    /**
     * Constructor for Controller.
     */
    public function __construct(private $name = 'Perusahaan', public $create = 0, public $read = 0, public $update = 0, public $delete = 0)
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
                return view('admin.setting.company.index',[
                    'name' => $this->name,
                    'companies' => Company::all(),
                    'pages' => $this->get_access($this->name, auth()->user()->group_id),
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
                return view('admin.setting.company.create',[
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
                    'com_name' => ['required', 'string', 'max:255'],
                    'com_alias' => ['required', 'string', 'max:255'],
                    'com_address' => ['required', 'string', 'max:255'],
                    'com_phone' => ['required', 'string', 'max:255'],
                ]);

                if (!$validated->fails()) {
                    Company::create([
                        'com_name' => $request->input('com_name'),
                        'com_alias' => $request->input('com_alias'),
                        'com_address' => $request->input('com_address'),
                        'com_phone' => $request->input('com_phone'),
                    ]);

                    return redirect()->to(route('perusahaan.index'))->with('success', 'Successfully Saved!');
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
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        $this->get_access_page();
        if ($this->update == 1) {
            try {
                return view('admin.setting.company.edit',[
                    'name' => $this->name,
                    'com' => $company->find(request()->segment(2))
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
    public function update(Request $request, Company $company)
    {
        $this->get_access_page();
        if ($this->update == 1) {
            try {
                $validated = \Illuminate\Support\Facades\Validator::make($request->all(), [
                    'com_name' => ['required', 'string', 'max:255'],
                    'com_alias' => ['required', 'string', 'max:255'],
                    'com_address' => ['required', 'string', 'max:255'],
                    'com_phone' => ['required', 'string', 'max:255'],
                ]);

                if (!$validated->fails()) {
                    Company::where('com_id',$company->com_id)->update([
                        'com_name' => $request->input('com_name'),
                        'com_alias' => $request->input('com_alias'),
                        'com_address' => $request->input('com_address'),
                        'com_phone' => $request->input('com_phone'),
                    ]);

                    return redirect()->to(route('perusahaan.index'))->with('success', 'Successfully Updated!');
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
    public function destroy(Company $company)
    {
        $this->get_access_page();
        if ($this->delete == 1) {
            try {
                $data = $company->find(request()->segment(2));
                Company::destroy($data->com_id);

                return redirect()->to(route('perusahaan.index'))->with('success', 'Successfully Deleted!');
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', 'You not Have Authority!');
        }
    }
}
