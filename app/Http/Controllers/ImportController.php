<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    // public function import(Request $request)
    // {
    //     // Validate the request
    //     $request->validate([
    //         'file' => 'required|mimes:xlsx,xls,csv'
    //     ]);

    //     // Get the uploaded file
    //     $file = $request->file('file');

    //     // Load the data from the file
    //     Excel::load($file, function($reader) {
    //         // Get the data and iterate over each row
    //         $results = $reader->get();
    //         foreach ($results as $row) {
    //             // Insert each row into the database
    //             User::create([
    //                 'column1' => $row->column1, // Adjust according to your column names
    //                 'column2' => $row->column2,
    //                 // Map additional columns as necessary
    //             ]);
    //         }
    //     });

    //     return response()->json(['success' => 'Data imported successfully']);
    // }
}
