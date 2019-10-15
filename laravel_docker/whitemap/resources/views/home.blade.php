@extends('layouts.app') 

@section('title') マイページ @endsection

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
    <h1>マイページ</h1>
    @if(Auth::check())
    @else 
    こんにちは！  ゲストさん <br />
    <a href="/login">ログイン</a>
    @endif
</div></main>
@endsection