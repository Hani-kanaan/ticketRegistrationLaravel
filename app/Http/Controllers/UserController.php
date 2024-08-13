<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
  public function getUsersAPI(Request $request) {
   // $users = DB::table('users')->orderBy('name', 'asc')->get();
   // $users = DB::table('users')->paginate(15)->sortBy('name');

    $users = DB::table('users');
    //filtering      
    //  $users->havingBetween('name', [5, 15])->get();

   
    //sorting:
    $users = $users->orderBy('name', 'desc');
    //pagination:
    $users = $users->paginate(10);
    return response()->json($users);    



    }
  
}
