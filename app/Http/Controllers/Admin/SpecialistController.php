<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Specialist;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSpecialistRequest;

class SpecialistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
      public function index()
    {
        $specialists = Specialist::latest()->paginate(20);
        return view('admin.pages.specialists.index',compact('specialists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.specialists.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSpecialistRequest $request)
    {
        try{
            Specialist::create([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'slug' =>Str::slug($request->name_en),
            ]);

            return redirect()->route('admin.specialists.index')->with('success' ,'تم إضافة تخصص رئيسي جديد بنجاح.');
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
    public function editSpecialist($slug)
    {
        $specialist = Specialist::where('slug',$slug)->first();
        return view('admin.pages.specialists.edit',compact('specialist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateSpecialist(Request $request, $slug)
    {
        try{
            $specialist = Specialist::where('slug',$slug)->first();
            $specialist->update([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'slug' =>Str::slug($request->name_en),
            ]);


            return redirect()->route('admin.specialists.index')->with('update' ,'تم تحديث بيانات التخصص الرئيسي بنجاح.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $specialist = Specialist::where('id',$id)->first()->delete();
        return redirect()->route('admin.specialists.index')->with('delete' ,'تم حذف التخصص الرئيسي بنجاح.');
    }
}
