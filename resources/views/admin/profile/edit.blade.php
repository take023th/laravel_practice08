@extends('layouts.profile')

@section('title','プロフィール編集ページ')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>わたしの編集ページ</h2>
                <h3>プロフィールエディットページ</h3>
                <form action="{{action('Admin\ProfileController@update') }}" method="post" enctype="multinpart/form-data">
                    
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="name">氏名</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" value="{{$profiles_form->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">性別</label>
                            @if ($profiles_form->gender == "man" || $profiles_form->gender == "男性")
                                <label class="col-md-2">
                                    <input type="radio" name="gender" value="man" checked>男性
                                </label>
                                <label class="col-md-2">
                                    <input type="radio" name="gender" value="women" >女性
                                </label>
                            @else
                                <label class="col-md-2">
                                    <input type="radio" name="gender" value="man" >男性
                                </label>
                                <label class="col-md-2">
                                    <input type="radio" name="gender" value="women" checked>女性
                                </label>
                            @endif
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">趣味</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="hobby" rows="2">{{ $profiles_form->hobby }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="body">自己紹介欄</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="introduction" rows="20">{{ $profiles_form->introduction}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $profiles_form->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    </div>
                </form>
                {{-- 更新履歴を実装する　--}}
                <div class="row mt-5">
                    <div class="col-md-4 mx-auto">
                        <h2>更新履歴</h2>
                        <ul class="list-group">
                            @if ($profiles_form->histories !=Null)
                                @foreach ($profiles_form->histories as $histories)
                                    <li class="list-group-item">{{ $histories->edited_at }}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection