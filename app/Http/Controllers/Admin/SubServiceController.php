<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\SubService;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubServiceRequest;

class SubServiceController extends Controller
{
    public function index()
    {
        $services = SubService::paginate(20);
        return view('admin.pages.subServices.index',compact('subServices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.subServices.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubServiceRequest $request)
    {
        try{
               if($request->hasFile('image')) {
                $fileExtension = $request->image->getClientOriginalExtension();
                $fileName = time().'.'.$fileExtension;
                $path = 'uploads/subServices';
                $request->image->move($path, $fileName);
                subService::create([
                    'name_en' => $request->name_en,
                    'name_ar' => $request->name_ar,
                    'slug' => Str::slug($request->name_en),
                    'description_en' => $request->description_en,
                    'description_ar' => $request->description_ar,
                    'image' => $fileName,
                ]);
            } else {
                subService::create([
                    'name_en' => $request->name_en,
                    'name_ar' => $request->name_ar,
                    'slug' => Str::slug($request->name_en),
                    'specialist_id' => $request->specialist_id,
                ]);

            }



            return redirect()->route('admin.subServices.index')->with('success' ,'تم إضافة خدمة رئيسية جديد بنجاح.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $subService = subService::where('id', $id)->first();
        return view('admin.pages.subServices.show',compact('subService'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $subService = subService::where('id',$id)->first();
        return view('admin.pages.subServices.edit',compact('subService'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{
            $subService = subService::where('id',$request->id)->first();

            $subService->update([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'slug' => Str::slug($request->name_en),
                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar,
                'price' => $request->price,
            ]);


            return redirect()->route('admin.subServices.index')->with('update' ,'تم تحديث بيانات الخدمة الرئيسية بنجاح.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $subService = subService::where('id',$id)->first();
        unlink(public_path('uploads/sub_services/'. $subService->image));
        $subService->delete();
       
        return redirect()->route('admin.subServices.index')->with('delete' ,'تم حذف الخدمة الرئيسية بنجاح.');
    }
}
