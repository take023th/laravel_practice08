@extends('layouts.profile')

{{-- profile.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', 'プロフィール')
        
{{-- profile.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
           <div class="container">
              <div class="row">
                  <div class="col-md-8 mx-auto">
                      <h2>わたしのプロフィール</h2>
                  </div>
              </div>
           </div>
@endsection
    </body>
</html>