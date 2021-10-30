<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//以下を追記し、News Modelを使えるようにする
use App\News;

class NewsController extends Controller
{
    public function add()
    {
        return view('admin.news.create');
    }
    
     public function edit()
    {
        return view('admin.news.edit');
    }
    
    public function create(Request $request)
    {
        // Varidationを行う
      $this->validate($request, News::$rules);
      
      
      $news = new News;
      $form = $request->all();
      
      if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $news->image_path = basename($path);
      } else {
          $news->image_path = null;
      }
      //フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      //フォームから送信されてきたimegeを削除する
      unset($form['imege']);
      //データベースに保存する
      $news->fill($form);
      $news->save();
      
      return redirect('admin/news/create');
    }
    //以上を追記して保存
    //index Actionを追記
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if($cond_title != '') {
            //検索されたら検索結果を取得
            $posts = News::where('title', $cond_title)->get();
        } else {
            //条件以外はすべてのニュースを取得
            $posts = News::all();
        }
        return view('admin.news.index' , ['posts' => $posts, 'cond_title' =>$cond_title]);
        }
    }