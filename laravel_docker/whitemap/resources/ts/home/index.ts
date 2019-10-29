import firebase from '../utils/firebase';
import axios from 'axios';

const initApp = function() {
    const auth = firebase.auth();
    auth.onAuthStateChanged(
        async function(user) {
            console.log(user);
            if (user) {
                const idToken = await user.getIdToken(true);
                const { data } = await axios.post('/api/auth', { idToken });
                axios.defaults.headers.common['Authorization'] = `Bearer ${data.token}`;
                const logoutElement = document.getElementById('logout')!;
                logoutElement.addEventListener('click', function() {
                    // var hoge = await axios.get('/api/hoge');
                    auth.signOut()
                        .then(() => {
                            console.log('ログアウト');
                            location.href = '/logout';
                        })
                        .catch(error => {
                            console.log(`ログアウト時にエラー発生 (${error})`);
                        });
                });
                // testElement.style.display="block";
            } else {
                console.log('signed out');
            }
        },
        function(error) {
            console.log(error);
        }
    );
};
window.addEventListener('load', function() {
    initApp();
});
