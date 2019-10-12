<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="チャットツールを試すことができます。" />
    <meta name="keywords" content="TRPG,開発,ツール" />
    <meta name="robots" content="index" />
    <meta name="og:sitename" content="チャットロビー" />
    <meta name="og:locale" content="ja_JP" />
    <meta name="og:title" content="チャットロビー" />
    <meta
      name="og:description"
      content="チャットツールを試すことができます。"
    />
    <meta
      name="og:url"
      content="https://wasureta-d6b34.firebaseapp.com/lobby/"
    />
    <meta name="twitter:site" content="@hibohiboo" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:creator" content="@hibohiboo" />
    <meta name="twitter:title" content="チャットロビー" />
    <meta
      name="twitter:description"
      content="チャットツールを試すことができます。"
    />
    <meta name="twitter:image" content="" />
    <title>チャットロビー</title>
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"
    />
    <link
      href="https://www.gstatic.com/firebasejs/ui/4.2.0/firebase-ui-auth.css"
      rel="stylesheet"
    />
    <script src="https://www.gstatic.com/firebasejs/6.3.5/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.3.5/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.3.5/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.3.5/firebase-storage.js"></script>
    <script src="https://www.gstatic.com/firebasejs/ui/4.2.0/firebase-ui-auth__ja.js"></script>
    <script type="text/javascript">
      firebase.initializeApp({
  "apiKey": "AIzaSyBAAwwnSsbI0HOyHtZLUsd2JPRVFyvgKrs",
  "projectId": "whitemaptools",
  "authDomain": "whitemaptools.firebaseapp.com"
});
      // FirebaseUI config.
      var uiConfig = {
        signInSuccessUrl: '/',
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
    <link href="/lobby/main-a705a478f556a51df83f.css" rel="stylesheet" />
  </head>
  <body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PBSJTDV" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <h1>ログイン</h1>
    <div id="firebaseui-auth-container"></div>
  </body>
</html>
