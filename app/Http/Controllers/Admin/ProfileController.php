<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//以下Profile Modelを使用できるようにする
use App\Profile;

class ProfileController extends Controller
{
    //
    public function add()
    {
        return view('admin.profile.create');
    }
    
    public function create(Request $request)
    {
        // Varidationを行う
      $this->validate($request, Profile::$rules);
      
      $profiles = new Profile;
      $form = $request->all();
      
      //フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      //データベースに保存する
      $profiles->fill($form);
      $profiles->save();
      
      return redirect('admin.profile.create');
    }
    
    public function index(Request $request)
    {
        $cond_name = $request->cond_name;
        if($cond_name !='') {
            $posts = Profile::where('name' , $cond_name)->get();
        } else {
            $posts = Profile::all();
        }
        return view('admin.profile.index' , ['posts ' => $posts, 'cond_name' => $cond_name]);
    }
    
    public function edit()
    {
        return view('admin.profile.edit');
    }
    
    public function update()
    {
        return redirect('admin/profile/edit');
    }
}