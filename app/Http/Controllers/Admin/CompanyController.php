<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyRequest;

class CompanyController extends Controller
{
    public function index()
    {

        $companies= Company::latest()->paginate(20);
        return view('admin.pages.companies.index',compact('companies'));
    }

    public function create()
    {
        return view('admin.pages.companies.create');
    }


    public function store(StoreCompanyRequest $request)
    {
        try{
            Company::create([
                'name' => $request->name,
                'notes' => $request->notes,
                'status' => 'active',
            ]);
            return redirect()->route('admin.companies.index')->with('success' ,'تم إضافة شركة جديدة بنجاح.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function show($id)
    {
        $company = Company::findOrFail($id);
        return view('admin.pages.companies.show',compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $company = Company::where('id',$id)->first();
        return view('admin.pages.companies.edit',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $company = Company::where('id',$request->id)->first();
         try{
            $company->update([
                'name' => $request->name,
                'notes' => $request->notes,
            ]);
            return redirect()->route('admin.companies.index')->with('update' ,'تم تحديث بيانات الشركة بنجاح.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy(Request $request)
    {
        $company = Company::where('id',$request->id)->first();
        if ($request->user()->cannot('delete', $company)) {
            abort(403);
        }
        $company->delete();
        return redirect()->route('admin.companies.index')->with('delete' ,'تم حذف الشركة بنجاح.');
    }

    public function toggleStataus(Request $request)
    {
        try{
            $company = Company::findOrFail($request->id);
            if( $company->status == 'active' ){
                $company->status = 'inactive';
                $company->save();

            }else {
                $company->status = 'active';
                $company->save();
            }
            return redirect()->route('admin.companies.index')->with('success' ,'تم تحديث حالة الشركة بنجاح.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
