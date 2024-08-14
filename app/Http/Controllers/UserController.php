<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class UserController extends Controller
{
  public function index(Request $request) {

    $users = QueryBuilder::for(User::class)
    ->allowedFilters(AllowedFilter::partial('name'))
    ->defaultSort('-name')
    ->paginate(10);

return response()->json($users);

}

  // public function index(Request $request) {

  //   $users = DB::table('users');
  //   //filtering      
  //   //  $users->havingBetween('name', [5, 15])->get();

   
  //   //sorting:
  //   $users = $users->orderBy('name', 'desc');
  //   //pagination:
  //   $users = $users->paginate(10);
  //   return response()->json($users);    



  //   }
  
}
