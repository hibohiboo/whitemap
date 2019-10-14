@extends('layouts.app') 

@section('title') マイページ @endsection

@section('head-scripts')

@if(Auth::check())
<script src="https://www.gstatic.com/firebasejs/6.3.5/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/6.3.5/firebase-auth.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
firebase.initializeApp({
    "apiKey": "AIzaSyBAAwwnSsbI0HOyHtZLUsd2JPRVFyvgKrs",
    "projectId": "whitemaptools",
    "authDomain": "whitemaptools.firebaseapp.com"
});
initApp = function() {
    firebase.auth().onAuthStateChanged(async function(user) {
        console.log(user);
        if (user) {
            const idToken = await user.getIdToken(true)
            const { data } = await axios.post('/api/auth', { idToken })
            axios.defaults.headers.common['Authorization'] = `Bearer ${data.token}`;
            // const testElement = document.getElementById('test');
            // testElement.addEventListener('click', async function(){
            //     var test = await axios.get('/api/hoge');
            //     console.log(test)
            // });
            // testElement.style.display="block";
        } else {
            console.log('signed out');
        }
    }, function(error) {
        console.log(error);
    });
};
window.addEventListener('load', function() {
    initApp();
});
</script>
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