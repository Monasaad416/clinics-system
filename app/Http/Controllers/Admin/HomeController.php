<?php

namespace App\Http\Controllers\Admin;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}
    public function index()
    {
      if (Gate::allows('superadmin')) { 
        $branches = Branch::all();
        return view('admin.pages.home.index',compact('branches'));
    }
    elseif (Gate::allows('admin_1')) {
        $branch = Branch::where('id', '=',1 )->first();
        return view('admin.pages.home.branch_1',compact('branch'));
    } elseif (Gate::allows('admin_2')) { 
        $branch = Branch::where('id', '=',2 )->first();
         return view('admin.pages.home.branch_2',compact('branch'));
    } elseif (Gate::allows('admin_3')) {
        $branch = Branch::where('id', '=',3 )->first();
         return view('admin.pages.home.branch_3',compact('branch'));
    }
}
}
