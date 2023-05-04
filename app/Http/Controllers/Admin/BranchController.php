<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Branch;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBranchRequest;

class BranchController extends Controller
{
        /**
     * Display a listing of the resource.
     */
      public function index()
    {

        $branches = Branch::latest()->paginate(20);
        return view('admin.pages.branches.index',compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('admin.pages.branches.create');
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(StoreBranchRequest $request)
    // {
    //     try{
    //         Branch::create([
    //             'name_en' => $request->name_en,
    //             'name_ar' => $request->name_ar,
    //             'address_en' => $request->address_en,
    //             'address_ar' => $request->address_ar,
    //             'slug' => Str::slug($request->name_en),
    //             'description_en' => $request->description_en,
    //             'description_ar' => $request->description_ar,
    //             'lattitude' => $request->lattitude,
    //             'longitude' => $request->longitude,
    //             'phones' => $request->phones,

    //         ]);
    //         return redirect()->route('admin.branches.index')->with('success' ,'تم إضافة فرع جديد بنجاح.');
    //     } catch (Exception $e) {
    //         return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    //     }
    // }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $branch = Branch::findOrFail($id);
         return view('admin.pages.branches.show',compact('branch'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $branch = branch::where('id',$id)->first();
        return view('admin.pages.branches.edit',compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $branch = branch::where('id',$request->id)->first();
         try{
            $branch->update([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'address_en' => $request->address_en,
                'address_ar' => $request->address_ar,
                'slug' => Str::slug($request->name_en),
                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar,
                'lattitude' => $request->lattitude,
                'longitude' => $request->longitude,
                'phones' => $request->phones,

            ]);
            return redirect()->route('admin.branches.index')->with('update' ,'تم تحديث بيانات الفرع بنجاح.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy($id)
    // {
    //     $branch = Branch::where('id',$id)->first()->delete();
    //     return redirect()->route('admin.branches.index')->with('delete' ,'تم حذف الفرع بنجاح.');
    // }


      public function toggleStataus(Request $request)
    {
        try{
            $branch = Branch::findOrFail($request->id);
            if( $branch->status == 'active' ){
                $branch->status = 'inactive';
                $branch->save();

            }else {
                $branch->status = 'active';
                $branch->save();
            }
            return redirect()->route('admin.branches.index')->with('success' ,'تم تحديث حالة الفرع بنجاح.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
