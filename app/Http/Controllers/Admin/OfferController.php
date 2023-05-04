<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Offer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOfferRequest;


class OfferController extends Controller
{
    public function index(Request $request)
    {
        if($request->user()->roles_name == ["superadmin"]) {
            $offers = Offer::paginate(20);
            return view('admin.pages.offers.index',compact('offers'));
        }
        else{
            $offers = Offer::where('branch_id',$request->user()->branch_id)->latest()->paginate(20);
            return view('admin.pages.offers.index',compact('offers'));
        }
    }

    public function create()
    {
        return view('admin.pages.offers.create');
    }

 
    public function store(StoreOfferRequest $request)
    {
        try{
            //return dd($request->all());


            if($request->image) {
                $fileExtension = $request->image->getClientOriginalExtension();
                $fileName = time().'.'.$fileExtension;
                $path = 'uploads/offers';
                $request->image->move($path, $fileName);


                    
                Offer::create([
                    'title_en' => $request->title_en,
                    'title_ar' => $request->title_ar,
                    'description_en' => $request->description_en,
                    'description_ar' => $request->description_ar,
                    'slug' => Str::slug($request->name_en),
                    'from_date' => $request->from_date,
                    'to_date' => $request->to_date,
                    'price' => $request->price,
                    'discount_price' => $request->discount_price,
                    'discount_percentage' => $request->discount_percentage,
                    'branch_id' => $request->branch_id,
                    'image' => $fileName,
                ]);
            } else {
                Offer::create([
                    'title_en' => $request->title_en,
                    'title_ar' => $request->title_ar,
                    'description_en' => $request->description_en,
                    'description_ar' => $request->description_ar,
                    'slug' => Str::slug($request->name_en),
                    'from_date' => $request->from_date,
                    'to_date' => $request->to_date,
                    'price' => $request->price,
                    'discount_price' => $request->discount_price,
                    'discount_percentage' => $request->discount_percentage,
                    'branch_id' => $request->branch_id,
                ]);
            }

    


            return redirect()->route('admin.offers.index')->with('success' ,'تم إضافة عرض جديد بنجاح.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request ,$id)
    {
        $offer = offer::findOrFail($id);
        if ($request->user()->cannot('viewAny', $offer)) {
            abort(403);
        }
         return view('admin.pages.offers.show',compact('offer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
 
        $offer = offer::where('id',$id)->first();
        if ($request->user()->cannot('update', $offer)) {
            abort(403);
        }  
        return view('admin.pages.offers.edit',compact('offer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $offer = offer::where('id',$request->offer_id)->first();
        if ($request->user()->cannot('update', $offer)) {
            abort(403);
        }
         try{
            $offer = offer::where('id',$request->offer_id)->first();
            if($request->hasFile('image')) {

                if($offer->image){
                    unlink(public_path('uploads/offers/'. $offer->image));
                }

                $fileExtension = $request->image->getClientOriginalExtension();
                $fileName = time().'.'.$fileExtension;
                $path = 'uploads/offers';
                $request->image->move($path, $fileName);

                $offer->update([
                'title_en' => $request->title_en,
                'title_ar' => $request->title_ar,
                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar,
                'slug' => Str::slug($request->name_en),
                'from_date' => $request->from_date,
                'to_date' => $request->to_date,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
                'discount_percentage' => $request->discount_percentage,
                'branch_id' => $request->branch_id,
                'image' => $fileName,

            ]);
            } else { 
                $offer->update([
                'title_en' => $request->title_en,
                'title_ar' => $request->title_ar,
                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar,
                'slug' => Str::slug($request->name_en),
                'from_date' => $request->from_date,
                'to_date' => $request->to_date,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
                'discount_percentage' => $request->discount_percentage,
                'branch_id' => $request->branch_id,


            ]);
            }

                

            
  
            return redirect()->route('admin.offers.index')->with('update' ,'تم تحديث بيانات العرض بنجاح.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $offer = offer::where('id',$request->id)->first();
        if ($request->user()->cannot('update', $offer)) {
            abort(403);
        }
        $offer->delete();
        return redirect()->route('admin.offers.index')->with('delete' ,'تم حذف العرض بنجاح.');
    }
}
