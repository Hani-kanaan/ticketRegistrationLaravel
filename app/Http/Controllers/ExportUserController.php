<?php

namespace App\Http\Controllers;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel; 

class ExportUserController extends Controller
{
    public function export()
    {
      return Excel::download(new UsersExport, 'users.xlsx');
    }
}
