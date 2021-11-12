@extends('layouts.profile')

{{-- profile.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', 'マイプロフィール')
        
{{-- profile.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>わたしのプロフィール</h2>
                <form action="{{ action('Admin\ProfileController@create') }}" method="post" enctype="multipart/form-data">
                          
@if (count($errors) > 0)
    <ul>
        @foreach($errors->all() as $e)
        <li>{{ $e }}</li>
        @endforeach
    </ul>
@endif
<div class="form-group row">
    <label class="col-md-2">氏名</label>
    <div class="col-md-5">
        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-2">性別</label>
    <label class="col-md-2" >
        <input type="radio" name="gender" value="男性" >男性
    </label>
    <label class="col-md-2">
        <input type="radio" name="gender" value="女性">女性
    </label>
</div>
<div class="form-group row">
    <label class="col-md-2">趣味</label>
    <div class="col-md-10">
        <textarea class="form-control" name="hobby" rows="2">{{ old('hobby') }}</textarea>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-2">自己紹介欄</label>
    <div class="col-md-10">
        <textarea class="form-control" name="introduction" rows="15">{{ old('introduction') }}</textarea>
    </div>
</div>
{{ csrf_field() }}
<input type="submit" class="btn btn-primary" value="送信">
                </form>
            </div>
        </div>
    </div>  
@endsection