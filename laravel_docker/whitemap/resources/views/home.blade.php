<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Document</title>
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
            const testElement = document.getElementById('test');
            testElement.addEventListener('click', async function(){
                var test = await axios.get('/api/hoge');
                console.log(test)
            });
            testElement.style.display="block";
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
        
    </head>
    <body>
        こんにちは！ 
@if(Auth::check())
        {{\Auth::user()->name}} さん 
        <button id="test" style="display:none">test</button>
@else 
  ゲストさん <br />
  <a href="/login">ログイン</a>
@endif
        
    </body>
</html>
