<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\Branch;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreEmployeeRequest;

class EmployeeController extends Controller
{
    protected $branchModel;
    public function __construct(Branch $branch){
        $this->branchModel = $branch;

    }
    public function index(Request $request,Branch $branch)
    {
        if(Auth::user()->roles_name == ["superadmin"]){
            $employees = User::withTrashed()->latest()->paginate(20);
            return view('admin.pages.employees.index',compact('employees'));
        }
        else {
                $employees = User::where('branch_id', Auth::user()->branch_id)->paginate(20);
            return view('admin.pages.employees.index',compact('employees'));
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('admin.pages.employees.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {

        try{
            DB::beginTransaction();
            //return dd($request->input('roles_name'));
           // return dd($request->all());
            if($request->hasFile('image')) {
                $fileExtension = $request->image->getClientOriginalExtension();
                $fileName = time().'.'.$fileExtension;
                $path = 'uploads/employees';
                $request->image->move($path, $fileName);

                $user = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'password' => Hash::make($request->password),
                        'image' => $fileName,
                        'department_id' => $request->department_id,
                        'branch_id' => $request->branch_id,
                        'roles_name' => $request->roles_name,
                        // 'salary' => $request->amount ? $request->amount : 0,
                ]);

                $user->assignRole($request->input('roles_name'));
            } else {
               $user= User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'password' => Hash::make($request->password),
                        'department_id' => $request->department_id,
                        'branch_id' => $request->branch_id,
                        'roles_name' => $request->roles_name,
                        // 'salary' => $request->amount ? $request->amount : 0,
                ]);
                $user->assignRole($request->input('roles_name'));
            }

            // $user = User::latest()->first();
            // $user->salary()->create([
            //     'salariable_type' => 'App\Models\User',
            //     'amount' => $request->salary ? $request->salary : 0 ,
            //     'branch_id' =>$user->branch_id,
            //     'details' => 'الراتب'
            // ]);

            DB::commit();
            return redirect()->route('admin.employees.index')->with('success' ,'تم إضافة موظف جديد بنجاح.');
        } catch (Exception $e) {
            DB::rollback();
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
    public function edit(Request $request ,User $user ,Branch $branch,$id)
    {
        $emp = User::findOrFail($id);
        if ($request->user()->cannot('update', $emp)) {
            abort(403);
        }
        $roles_name = Role::pluck('name','name')->all();

        return view('admin.pages.employees.edit',compact('emp','roles_name'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try{
            $request->validate([
                'name' => 'nullable|string|max:255',
                'email' => "unique:users,email,$request->id,id",
                'phone' => 'nullable|string',

                'image' => 'nullable|image|max:2048|mimes:png,jpg,jpeg,gif,webp',
                'department_id' => 'nullable|exists:departments,id',
                'salary' => 'nullable|numeric|min:0',
                'roles_name' => 'nullable',
                'salary' => 'nullable|nullable',
            ]);


             $employee = User::findOrFail($request->id);
            // return dd($employee);
            if ($request->user()->cannot('update', $employee)) {
                abort(403);
            }
            if($request->hasFile('image')) {

                ///////////remove old image
                if($employee->image){
                    unlink(public_path('uploads/employees/'. $employee->image));
                }


                $fileExtension = $request->image->getClientOriginalExtension();
                $fileName = time().'.'.$fileExtension;
                $path = 'uploads/employees';
                $request->image->move($path, $fileName);

                $employee->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'image' => $fileName,
                        'department_id' => $request->department_id,
                        'branch_id' => $request->branch_id,
                        'roles_name' => $request->roles_name,
                        'salary' => $request->amount ? $request->amount : 0,

                ]);
            } else {
               $employee->update($request->all());
            }

            // $employee->salary()->update([
            //     'amount' => $request->salary
            // ]);


            return redirect()->route('admin.employees.index')->with('update' ,'تم تحديث بيانات الموظف  بنجاح.');



        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $employee = User::where('id',$request->id)->first();
        //return dd($employee);
        //remove image from storage


        // Salary::where('salariable_type','App\Models\User')->where('salariable_id', $employee->id)->first()->delete();



        $employee->delete();
        return redirect()->route('admin.employees.index')->with('delete' ,'تم حذف بيانات الموظف مؤقتا بنجاح.');
    }


     public function restore(Request $request)
    {
        $deletedEmployee = User::onlyTrashed()->where('id',$request->id)->restore();

        return redirect()->route('admin.employees.index')->with('success' ,'تم  إستعادة الموظف  بنجاح.');
    }


     public function parmenentDelete(Request $request)
    {
        $deletedEmployee = User::onlyTrashed()->where('id',$request->id)->first();

        // if($deletedEmployee->image != null ){
        //     unlink(public_path('uploads/employees/'. $deletedEmployee->image));
        // }






        $deletedEmployee->forceDelete();
        return redirect()->route('admin.employees.index')->with('delete' ,'تم حذف بيانات الموظف نهائيا  بنجاح.');
    }


    public function getAllNotifications(Request $request)
    {
        $notifications = $request->user()->notifications()->paginate(15);
        return view('admin.pages.notifications.index',compact('notifications'));
    }
}
