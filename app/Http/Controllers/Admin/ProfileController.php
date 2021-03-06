<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

//以下Profile Modelを使用できるようにする
use App\Profile;
use App\Profilehistories;

use Carbon\Carbon;

class ProfileController extends Controller
{
    //
    public function add()
    {
        return view('admin/profile/create');
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
      
      return redirect('admin/profile/');
    }
    
    public function index(Request $request)
    {
        $cond_name = $request->cond_name;
        if($cond_name !='') {
            //部分一致を実装
            $posts = Profile::where('name', 'like' , "%{$cond_name}%")->get();
        } else {
            $posts = Profile::all();
        }
        return view('admin.profile.index' , ['posts' => $posts, 'cond_name' => $cond_name]);
    }
    
    public function edit(Request $request)
    {
        Log::debug("プロフィール編集画面アクセスします。プロフィールID：" . $request->id );
      // profiles Modelからデータを取得する
      $profiles = Profile::find($request->id);
      if (empty($profiles)) {
        Log::error("プロフィールが取得できませんでした");
        abort(404);    
      }
      Log::debug("プロフィールが取得できている". $profiles->name);
      return view('admin.profile.edit', ['profiles_form' => $profiles]);
    }
    
    public function update(Request $request)
    {
      // Validationをかける
      $this->validate($request, Profile::$rules);
      // profiles Modelからデータを取得する
      $profiles = Profile::find($request->id);
      // 送信されてきたフォームデータを格納する
      $profiles_form = $request->all();
      
      
      unset($profiles_form['_token']);
      // 該当するデータを上書きして保存する
      $profiles->fill($profiles_form)->save();
      
      $histories = new Profilehistories();
      $histories->profile_id = $profiles->id;
      $histories->edited_at = Carbon::now();
      $histories->save();
      
      return redirect('admin/profile/');
    }
    
    public function delete(Request $request)
    {
        //該当するNews Modelを取得する
        $profiles = Profile::find($request->id);
        //削除する
        $profiles->delete();
        return redirect('admin/profile/');
    }
}