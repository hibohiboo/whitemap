@extends('layouts.app') 

@section('title') 管理者ダッシュボード @endsection
@section('admin')
  <li class="nav-item active"><a class="nav-link" href="{{ url('/admin') }}">管理者ダッシュボード</span></a></li>
@endsection

@section('head-scripts')
  @if(Auth::check())
    <script src="https://www.gstatic.com/firebasejs/7.2.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.2.0/firebase-auth.js"></script>
    <script src="{{ mix('js/home/index.js') }}"></script>
  @endif
@endsection

@section('content')
<main role="main" class="container">
<div class="starter-template">
    <h1>管理者ダッシュボード</h1>
    <ul>
      <li><a href="/tag">タグ追加</a></li>
    </ul>
</div></main>
@endsection