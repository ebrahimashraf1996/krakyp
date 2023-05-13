<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class DropzoneController extends Controller
{
    public function store(Request $request) {
//        return $request;
//        return response()->json(['msg' => 'Uploaded', 'data' => $request->file('file')->getClientOriginalName()]);
        $request->validate([
            'file' => 'required|mimes:jpeg,jpg,png,gif,webp'
        ]);

        $image = $request->file('file');
        if ($image) {
            $imageName = time().rand(1,100).'.'.$image->extension();
            $original = $request->file('file')->getClientOriginalName();
            $image->move(public_path('images/dropped'), $imageName);

            list($width, $height, $type, $attr) = getimagesize('images/dropped/'.$imageName);

            $nesba = $height / $width;
            $new_width = 800;
            $new_height = $new_width * $nesba;
            $img = Image::make('images/dropped/'.$imageName)->resize($new_width, $new_height)->insert('assets/front/images/water-mark.png', 'center');
            $img->save('images/dropped/'.$imageName);

            return response()->json(['msg' => 'success', 'data' => ['name' => $imageName, 'origin' => $original]]);
        }
//        return response()->json(['success' => $imageName]);
    }
    public function deleteFileDrop(Request $request) {
        unlink(public_path('/images/dropped/' . $request->name));

//        File::delete(asset('images/dropped/' . $request->name));


        return response()->json(['status' => 1 ,'msg' => 'File Deleted','data' => $request->name]);

    }
}
