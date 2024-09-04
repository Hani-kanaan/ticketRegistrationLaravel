<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel; 
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{

  public function index()
  {
    $users = QueryBuilder::for(User::class)
      ->allowedFilters('name')
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
    return response()->json('user deleted');
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'name' => 'required',
      'email' => 'required',
      'password' => 'required',
      'password_confirmation' => ['required', 'confirmed'],
    ]);
    $validatedData['password'] = bcrypt($validatedData['password']);
    $user = User::create($validatedData);
    return response('user created');
  }

  public function update(Request $request, User $user)
  {
    $validatedData = $request->validate([
      'name' => 'required',
      'email' => 'required',
      'password' => 'required',
      'password_confirmation' => ['required', 'confirmed'],
    ]);
    $user->update($validatedData);
    return response()->json($user);
  }

  public function export()
  {
    return Excel::download(new UsersExport, 'users.xlsx');
  }
}
