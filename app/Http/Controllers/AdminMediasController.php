<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class AdminMediasController extends Controller
{
    
    public function index(){
        $photos = Photo::all();
        return view('admin.media.index', compact('photos'));
    }

    public function create(){

        return view('admin.media.create');
    }

    public function store(Request $request){
        $constants = Config::get('constants');
        $h = $constants['HEIGHT'];
        $w = $constants['WIDTH'];

        if($file = $request->file('file')) {
            $name = time() . $file->getClientOriginalName();

            $height = Image::make($file)->height();
            $width = Image::make($file)->width();

            if ($height / $h < $width / $w) {
                $image = Image::make($file->getRealPath())->resize($w, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            } else {

                $image = Image::make($file->getRealPath())->resize(null, $h, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }

            $image->save('images/' . $name);
            Photo::create(['name' => $name]);
            Session::flash('message', 'The photo has been created.');
        }
        else
        {
            Session::flash('message', 'The photo has not been created.');
        }



        return redirect('/admin/media');
    }


    public function destroy($id){

        $photo = Photo::findOrFail($id);

        if(!empty($photo->name))
        {
            unlink(public_path() . $photo->name);
            $photo->delete();
        }

        $photo->delete();
        Session::flash('message','The photo has been deleted.');
        return redirect('/admin/media');
    }
}
