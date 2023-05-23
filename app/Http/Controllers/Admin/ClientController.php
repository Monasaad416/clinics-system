<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Branch;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreClientRequest;

class ClientController extends Controller
{
    public function index(Request $request,Branch $branch)
    {
        //get active branch from service container
        if(Auth::user()->roles_name == ["superadmin"]){
            $clients = Client::latest()->paginate(20);
        }
        if($request->user()->roles_name == ["superadmin"]) {
            $clients = Client::latest()->paginate(20);
            return view('admin.pages.clients.index',compact('clients'));
        }
        else{
          $clients = Client::where('branch_id',$request->user()->branch_id)->latest()->paginate(20);
        return view('admin.pages.clients.index',compact('clients'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{

             $latesClient = Client::orderBy('created_at','DESC')->first();
             if(!$latesClient){
                $file_no = $request->branch_id.'#00000001';
             } else {
                  $file_no = $request->branch_id.'#'.str_pad($latesClient->id + 1, 8, "0", STR_PAD_LEFT);
             }
                $client = Client::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'date_of_birth' => $request->date_of_birth,
                'address' => $request->address,
                'how_know_us' => $request->how_know_us,
                'file_no' => $file_no,
                'branch_id' => $request->branch_id,
            ]);


            return redirect()->route('admin.clients.index')->with('success' ,'تم إضافة عميل جديد بنجاح.');
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
    public function edit(Request $request , $id)
    {

        $client = Client::findOrFail($id);
        if ($request->user()->cannot('update', $client)) {
            abort(403);
        }
       
    
        return view('admin.pages.clients.edit',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        try{
            $client = Client::findOrFail($request->id);
            if ($request->user()->cannot('update', $client)) {
                abort(403);
            }
            $client->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'date_of_birth' => $request->date_of_birth,
                'address' => $request->address,
                'how_know_us' => $request->how_know_us,
                // 'file_no' => $request->file_no,
            ]);


            return redirect()->route('admin.clients.index')->with('update' ,'تم تحديث بيانات العميل بنجاح.');
        } catch (Exception $e) {
            return redirect()->back()->
            withErrors(['error' => $e->getMessage()]);;
    }
}


    public function destroy(Request $request)
    {
        $client = Client::where('id', $request->id)->first();
        if ($request->user()->cannot('delete', $client)) {
            abort(403);
        }
        $client->delete();

        return redirect()->route('admin.clients.index')->with('delete', 'تم حذف العميل بنجاح.');

    }

}
