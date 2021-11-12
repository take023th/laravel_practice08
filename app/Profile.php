<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = array('id');
    //ProfileのModelを作成し、Validationする
    public static $rules =array(
        'name' => 'required',
        'gender' => 'required',
        'hobby' => 'required',
        'introduction' => 'required',
    );
    //Profile ModelにHistory Modelとの関連付けを行う
    public function histories()
    {
        return $this->hasMany('App\Profilehistories');
    }
}
