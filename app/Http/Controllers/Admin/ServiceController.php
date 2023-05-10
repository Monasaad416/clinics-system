<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Branch;
use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceRequest;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        if($request->user()->roles_name == ["superadmin"]) {
            $services = Service::latest()->paginate(20);
            return view('admin.pages.services.index',compact('services'));
        }
        else{
            $services = Service::where('specialist_id',$request->user()->specialist_id)->latest()->paginate(20);
            return view('admin.pages.services.index',compact('services'));
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        try{
            //    if($request->hasFile('image')) {
            //         $fileExtension = $request->image->getClientOriginalExtension();
            //         $fileName = time().'.'.$fileExtension;
            //         $path = 'uploads/Services';
            //         $request->image->move($path, $fileName);
            //     }

            Service::create([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'slug' => Str::slug($request->name_en),
                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar,
                'specialist_id' => $request->specialist_id,
                 // 'image' => $fileName,
                // 'price' => $request->price,
            ]);
  
            return redirect()->route('admin.services.index')->with('success' ,'تم إضافة خدمة جديدة بنجاح.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request , $id)
    {
        $service = Service::where('id', $id)->first();
        if ($request->user()->cannot('viewAny', $service)) {
            abort(403);
        }
        return view('admin.pages.services.show',compact('service'));

    }

    public function edit(Request $request,$id)
    {
        $service = Service::where('id',$id)->first();
               if ($request->user()->cannot('update', $service)) {
                abort(403);
            }
        return view('admin.pages.services.edit',compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,)
    {
        //return dd($request->all());
        try{
            $service = Service::where('id',$request->id)->first();
            //return dd($service);
            $service->update([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'slug' => Str::slug($request->name_en),
                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar,
                'specialist_id' => $request->specialist_id,
            ]);

        //     if($request->hasFile('image')) {

        //         if($service->image){
        //             unlink(public_path('uploads/services/'. $service->image));
        //         }

        //     $fileExtension = $request->image->getClientOriginalExtension();
        //     $fileName = time().'.'.$fileExtension;
        //     $path = 'uploads/Services';
        //     $request->image->move($path, $fileName);
        //     $service->update([
        //         'name_en' => $request->name_en,
        //         'name_ar' => $request->name_ar,
        //         'slug' => Str::slug($request->name_en),
        //         'description_en' => $request->description_en,
        //         'description_ar' => $request->description_ar,
        //         'image' => $fileName,
        //         'price' => $request->price,
        //         'specialist_id' => $request->specialist_id,
        //     ]);
        // } else {


            return redirect()->route('admin.services.index')->with('update' ,'تم تحديث بيانات الخدمة بنجاح.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $service = Service::where('id',$request->id)->first();
        // if($service->image) {
        //     unlink(public_path('uploads/services/'. $service->image));
        // }
        if ($request->user()->cannot('delete', $service)) {
            abort(403);
        }

        $service->delete();
        return redirect()->route('admin.services.index')->with('delete' ,'تم حذف الخدمة  بنجاح.');
    }
}
