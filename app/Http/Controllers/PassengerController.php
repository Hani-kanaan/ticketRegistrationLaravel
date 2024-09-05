<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Passenger;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Drivers\Gd\Driver;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;

class PassengerController extends Controller
{

    public function index(Flight $flight)
    {

        $passengers = $flight->passengers;
        return response()->json($passengers);
    }
    public function storeImage(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //local save for thumbnail and image
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $imagePath = public_path('images');
        $image->move($imagePath, $imageName);
        $thumbnailPath = public_path('images/thumbnails/' . $imageName);
        $imagine = new Imagine();
        $thumbnail = $imagine->open($imagePath . '/' . $imageName);
        $thumbnail->resize(new Box(100, 100))->save($thumbnailPath);
        Storage::disk('s3')->put($thumbnailPath, $thumbnail, 'public');


        //testing s3 :
        $fileContent = 'This is a test file content.';
        $result = Storage::disk('s3')->put('test.txt', $fileContent);

        if ($result) {
            echo 'File uploaded successfully!';
        } else {
            echo 'Failed to upload file.';
        }

        //save to db
        $passenger = new Passenger();
        $passenger->first_name = $request->first_name;
        $passenger->last_name = $request->last_name;
        $passenger->email = $request->email;
        $passenger->password = $request->password;
        $passenger->image = 'images/' . $imageName;
        $passenger->thumbnail = 'images/thumbnails/' . $imageName;
        $passenger->save();

        return response('Image saved', 200);
    }
}
