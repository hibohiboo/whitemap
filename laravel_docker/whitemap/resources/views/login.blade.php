@extends('layouts.app') 
@section('title') ログイン @endsection
@section('css')
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
<link href="https://www.gstatic.com/firebasejs/ui/4.2.0/firebase-ui-auth.css" rel="stylesheet"/>
@endsection

@section('head-scripts')
    <script src="https://www.gstatic.com/firebasejs/6.3.5/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.3.5/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/ui/4.2.0/firebase-ui-auth__ja.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script type="text/javascript">
      firebase.initializeApp({
  "apiKey": "AIzaSyBAAwwnSsbI0HOyHtZLUsd2JPRVFyvgKrs",
  "projectId": "whitemaptools",
  "authDomain": "whitemaptools.firebaseapp.com"
});
      // FirebaseUI config.
      var uiConfig = {
        signInSuccessUrl: '/callback',
        callbacks: {
            signInSuccessWithAuthResult : (authResult,callbackUrl)=>{
                var user = authResult.user;
                var credential = authResult.credential;
                var isNewUser = authResult.additionalUserInfo.isNewUser;
                var providerId = authResult.additionalUserInfo.providerId;
                var operationType = authResult.operationType;
                var twitterUser = authResult.additionalUserInfo;
                var twitter_screen_name = twitterUser.profile.screen_name;
                var twitter_profile_image_url_https = twitterUser.profile.profile_image_url_https;

                // Do something with the returned AuthResult.
                // Return type determines whether we continue the redirect automatically
                // or whether we leave that to developer to handle.
                console.log('firebaseAuthUser', user);
                console.log(credential);
                console.log('twitterUser', twitterUser);
                (async ()=>{
                    const idToken = await user.getIdToken(true);
                    console.log(idToken);
                    document.getElementById('token').value = `${idToken}`;
                    document.getElementById('twitter_screen_name').value = `${twitter_screen_name}`;
                    document.getElementById('twitter_profile_image_url_https').value = `${twitter_profile_image_url_https}`;
                    document.getElementById('loginform').submit();
                    return;
                   // await axios.post('/api/auth', { idToken, twitter_screen_name, twitter_profile_image_url_https })
                })();

                return false;
            },
        },

        signInOptions: [
          firebase.auth.TwitterAuthProvider.PROVIDER_ID,
        ],
        tosUrl: 'agreement',
        privacyPolicyUrl: function() {
          window.location.assign('privacy-policy');
        }
      };
      var ui = new firebaseui.auth.AuthUI(firebase.auth());
      ui.start('#firebaseui-auth-container', uiConfig);
    </script>
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

