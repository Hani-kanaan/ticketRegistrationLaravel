<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class UserController extends Controller
{
  public function index()
  {

    $users = QueryBuilder::for(User::class)
      ->allowedFilters(AllowedFilter::partial('name'))
      ->defaultSort('-name')
      ->paginate(10);
    return response()->json($users);
  }

  public function show(User $user)
  {
    return response()->json($user);
  }

  public function destroy(User $user)
  {
    $user->delete();
  }

  public function create(Request $req)
  {
    $user = new User;
    $user->name = $req->name;
    $user->email = $req->email;
    $user->password = $req->password;
    $user->save();
    return redirect()->back();
  }

  public function update(Request $request, User $user)
  {
    $validatedData = $request->validate([
      'name' => 'required',
      'email' => 'required',
      'password' => 'required',
      'password_confirmation' => 'required'
    ]);
    $user->update($validatedData);
    return response()->json($user);
  }
}
