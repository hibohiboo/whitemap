@extends('layouts.app') 
@section('title') ログイン @endsection
@section('css')
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
<link href="https://www.gstatic.com/firebasejs/ui/4.2.0/firebase-ui-auth.css" rel="stylesheet"/>
@endsection

@section('head-scripts')
    <script src="https://www.gstatic.com/firebasejs/7.2.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.2.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/ui/4.2.0/firebase-ui-auth__ja.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ mix('js/login/index.js') }}"></script>
@endsection

@section('content')
<main class="container">
    <div class="starter-template">
        <h1>ログイン</h1>
        <div id="firebaseui-auth-container"></div>
        <form id="loginform" action="/login" method="post" style="display:none">
            {{ csrf_field() }}
            <input id="token" name="token">
            <input id="twitter_screen_name" name="twitter_screen_name">
            <input id="twitter_profile_image_url_https" name="twitter_profile_image_url_https">
        </form>
    </div>
</main>
@endsection

