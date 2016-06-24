<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UsersEditRequest;

use App\Http\Requests;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::lists('name','id')->all();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        $constants = Config::get('constants');
        $h = $constants['HEIGHT'];
        $w = $constants['WIDTH'];

        if(trim($request->password) == '')
        {
            $input = $request->except('password');
        }
        else
        {
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }


        if($file = $request->file('photo_id')) {
            
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

        $image->save('images/'. $name);

        $photo = Photo::create(['name'=>$name]);

        $input['photo_id']  = $photo->id;
        }


        User::create($input);

        Session::flash('message','The user has been created.');

        return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::lists('name','id')->all();

        return view('admin.users.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {

        $constants = Config::get('constants');
        $h = $constants['HEIGHT'];
        $w = $constants['WIDTH'];

        $user = User::findOrFail($id);
        if($user['photo_id'])
        {
            $photo_id = $user['photo_id'];
            $photo = Photo::findOrFail($photo_id);
        }
 //if password -> encrypting, else not
        if(trim($request->password) == '')
        {
            $input = $request->except('password');
        }
        else
        {
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }
// if files['image'] ->delete ->update
        if($file = $request->file('photo_id'))
        {
            $name = time() . $file->getClientOriginalName();

            $height = Image::make($file)->height();
            $width = Image::make($file)->width();

            if($height/$h < $width/$w)
            {
                $image = Image::make($file->getRealPath())->resize($w, null, function($constraint)
                {
                    $constraint->aspectRatio();
                });
            }
            else
            {
                $image = Image::make($file->getRealPath())->resize(null, $h, function($constraint)
                {
                    $constraint->aspectRatio();
                });
            }

            $image->save('images/'. $name);

            //$file->move('images', $name);

            if($user->photo)
            {
                unlink(public_path() .  $user->photo->name);
                $photo->update(['name'=>$name]);
                $input['photo_id'] = $photo->id;
            }
            else
            {
                $new_photo = Photo::create(['name'=>$name]);
                $input['photo_id'] = $new_photo->id;
            }

        }
        Session::flash('message','The user has been updated.');

        $user->update($input);

        return redirect('/admin/users');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $photo = Photo::findOrfail($user->photo_id);

        if(!empty($user->photo->name))
        {
            unlink(public_path() . $user->photo->name);
            $photo->delete();
        }

        $user->delete();

        Session::flash('message','The user has been deleted.');
        
        return redirect('admin/users');
    }
}
