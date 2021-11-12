<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    //履歴実装のためHistory　modelを設定する
    protected $guarded = array('id');
    
    public static $rules = array(
        'news_id' => 'required' ,
        'edited_at' => 'required' ,
        'profile_id' => 'required' ,
        'edited_at2' => 'required' ,
        );
}
