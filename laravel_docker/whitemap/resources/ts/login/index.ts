import firebase from '../utils/firebase';
import * as firebaseui from 'firebaseui';

{
    // FirebaseUI config.
    var uiConfig = {
        signInSuccessUrl: '/callback',
        callbacks: {
            signInSuccessWithAuthResult: (authResult: any, callbackUrl: any) => {
                console.log('認証成功');
                const user = authResult.user;
                // const credential = authResult.credential;
                // const isNewUser = authResult.additionalUserInfo.isNewUser;
                // const providerId = authResult.additionalUserInfo.providerId;
                // const operationType = authResult.operationType;
                const twitterUser = authResult.additionalUserInfo;
                const twitter_screen_name = twitterUser.profile.screen_name;
                const twitter_profile_image_url_https = twitterUser.profile.profile_image_url_https;

                // // Do something with the returned AuthResult.
                // // Return type determines whether we continue the redirect automatically
                // // or whether we leave that to developer to handle.
                // console.log("firebaseAuthUser", user);
                // console.log(credential);
                // console.log("twitterUser", twitterUser);
                (async () => {
                    const idToken = await user.getIdToken(true);
                    console.log('ログイン処理開始');
                    $('#token').val(`${idToken}`);
                    $('#twitter_screen_name').val(`${twitter_screen_name}`);
                    $('#twitter_profile_image_url_https').val(`${twitter_profile_image_url_https}`);
                    $('#loginform').submit();
                    return;
                })();

                return false;
            }
        },
        signInOptions: [firebase.auth.TwitterAuthProvider.PROVIDER_ID],
        tosUrl: 'agreement',
        privacyPolicyUrl: function() {
            window.location.assign('privacy-policy');
        }
    };
    const ui = new firebaseui.auth.AuthUI(firebase.auth());
    ui.start('#firebaseui-auth-container', uiConfig);
}
