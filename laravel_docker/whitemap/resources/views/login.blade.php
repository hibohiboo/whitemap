<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="ログインテストページ" />
    <meta name="keywords" content="TRPG,開発,ツール" />
    <meta name="robots" content="index" />

    <title>ログインテストページ</title>
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"
    />
    <link
      href="https://www.gstatic.com/firebasejs/ui/4.2.0/firebase-ui-auth.css"
      rel="stylesheet"
    />
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
                    await axios.post('/api/auth', { idToken, twitter_screen_name, twitter_profile_image_url_https })
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
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-PBSJTDV');</script>
    <!-- End Google Tag Manager -->
  </head>
  <body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PBSJTDV" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <h1>ログイン</h1>
    <div id="firebaseui-auth-container"></div>
  </body>
</html>
