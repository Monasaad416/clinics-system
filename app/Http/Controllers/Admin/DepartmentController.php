<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Branch;
use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartmentRequest;

class DepartmentController extends Controller
{
        /**
     * Display a listing of the resource.
     */
      public function index(Request $request,Branch $branch)
    {
        if($request->user()->roles_name == ["superadmin"]) {
            $departments = Department::latest()->paginate(20);
            return view('admin.pages.departments.index',compact('departments'));
        }
        else{
            $departments = Department::where('branch_id',$request->user()->branch_id)->latest()->paginate(20);
            return view('admin.pages.departments.index',compact('departments'));
        }
        
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartmentRequest $request)
    {
        try{
            Department::create([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'slug' => Str::slug($request->name_en),
                'branch_id' => $request->branch_id,
            ]);
            return redirect()->route('admin.departments.index')->with('success' ,'تم إضافة قسم جديد بنجاح.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editDepartment(Branch $branch, Department $department, Request $request , $slug ,)
    {
         $department = department::where('slug',$slug)->first();
        if ($request->user()->cannot('update', $department)) {
            abort(403);
        }
       
        return view('admin.pages.departments.edit',compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateDepartment(Request $request)
    {
        try{
            $department = Department::where('slug',$request->slug)->first();

       
        if ($request->user()->cannot('update', $department)) {
            abort(403);
        }
            $department->update([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'slug' =>Str::slug($request->name_en),
                'branch_id' => $request->branch_id,
            ]);

            return redirect()->route('admin.departments.index')->with('update' ,'تم تحديث بيانات القسم بنجاح.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $department = department::where('id',$request->id)->first();
        if ($request->user()->cannot('delete', $department)) {
            abort(403);
        }
        $department->delete();
        return redirect()->route('admin.departments.index')->with('delete' ,'تم حذف القسم بنجاح.');
    }
}
