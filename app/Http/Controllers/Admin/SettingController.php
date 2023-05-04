<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = Setting::firstOrCreate();
        //return dd($settings);
        return view('admin.pages.settings.edit',['settings'=>$settings]);
    }
    public function update(Request $request)
    {
        try{
               $request->validate([
                'title_ar'=> 'nullable|string',
                'title_en'=> 'nullable|string',
                'address_ar'=> 'nullable|string',
                'address_en'=> 'nullable|string',
                'phones' =>  'nullable|string',
                'email' => 'nullable|email',
                'facicon' =>  'nullable|image',
                'logo' => 'nullable|image',
                'facebook'=> 'nullable|url',
                'linkedin'=> 'nullable|url',
                'instagram'=> 'nullable|url',
                'twitter'=> 'nullable|url',

            ]);
            //return dd($request->all());
            $settings = Setting::first();

            if($request->hasFile('favicon')) {
                $faviconExtension = $request->favicon->getClientOriginalExtension();
                $faviconName = time().'.'.$faviconExtension;
                $path = 'uploads/settings';
                $request->favicon->move($path, $faviconName);

                $settings->update([
                    'favicon' => $faviconName,
                ]);
            }

            if($request->hasFile('logo')) {
                $logoExtension = $request->logo->getClientOriginalExtension();
                $logoName = time().'.'.$logoExtension;
                $path = 'uploads/settings';
                $request->logo->move($path, $logoName);


                $settings->update([
                    'logo' => $logoName,
                ]);
            }


              $settings->update([
                    'title_ar' => $request->title_ar,
                    'title_en'=> $request->title_en,
                    'address_ar' => $request->address_ar,
                    'address_en' => $request->address_en,
                    'phones' => $request->phones,
                    'email' => $request->email,
                    'facebook' => $request->facebook,
                    'linkedin' => $request->linkedin,
                    'twitter' => $request->twitter,
                    'instagram' => $request->instagram,
                ]);


                
          




             return redirect()->route('admin.settings.edit')->with('update' ,'تم تحديث الإعدادات  بنجاح.');

        }catch (Exception $e) {
            return redirect()->route('admin.settings.edit')->withErrors(['error' => $e->getMessage()]);
        }


    }
}
