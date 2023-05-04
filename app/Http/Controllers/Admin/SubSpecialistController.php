<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Specialist;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SubSpecialist;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubSpecialistRequest;

class SubSpecialistController extends Controller
{
    public function index()
    {
        $supSpecialists = SubSpecialist::latest()->paginate(20);
        return view('admin.pages.sub_specialists.index',compact('supSpecialists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specialists = SubSpecialist::all();
        return view('admin.pages.sub_specialists.create',compact('specialists'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubSpecialistRequest $request)
    {
        try{
               if($request->hasFile('image')) {
                $fileExtension = $request->image->getClientOriginalExtension();
                $fileName = time().'.'.$fileExtension;
                $path = 'uploads/subspecialists';
                $request->image->move($path, $fileName);
                SubSpecialist::create([
                    'name_en' => $request->name_en,
                    'name_ar' => $request->name_ar,
                    'slug' => Str::slug($request->name_en),
                    'specialist_id' => $request->specialist_id,
                    'image' => $fileName,
                ]);
            } else {
                SubSpecialist::create([
                    'name_en' => $request->name_en,
                    'name_ar' => $request->name_ar,
                    'slug' => Str::slug($request->name_en),
                    'specialist_id' => $request->specialist_id,
                ]);

            }



            return redirect()->route('admin.sub_specialists.index')->with('success' ,'تم إضافة تخصص فرعي جديد بنجاح.');
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
    public function editSubSpecialist($slug)
    {
        $subSpecialist = SubSpecialist::where('slug',$slug)->first();
        return view('admin.pages.sub_specialists.edit',compact('subSpecialist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateSubSpecialist(Request $request, $slug)
    {
        try{
            $subSpecialist = SubSpecialist::where('slug',$slug)->first();


                if($request->hasFile('image')) {

                ///////////remove old image
                unlink(public_path('uploads/subSpecialists/'. $subSpecialist->image));

                $fileExtension = $request->image->getClientOriginalExtension();
                $fileName = time().'.'.$fileExtension;
                $path = 'uploads/subSpecialists';
                $request->image->move($path, $fileName);

               $subSpecialist->update([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'slug' =>Str::slug($request->name_en),
                'image' => $fileName,
            ]);
            } else {
                $subSpecialist->update([
                    'name_en' => $request->name_en,
                    'name_ar' => $request->name_ar,
                    'slug' =>Str::slug($request->name_en),
                ]);
            }

       


            return redirect()->route('admin.sub_specialists.index')->with('update' ,'تم تحديث بيانات التخصص الفرعي بنجاح.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $subSpecialist = SubSpecialist::where('id',$id)->first()->delete();
        return redirect()->route('admin.sub_specialists.index')->with('delete' ,'تم حذف التخصص الفرعي بنجاح.');
    }
}
