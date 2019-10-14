import firebase from "../utils/firebase";
import axios from "axios";
{
    const initApp = function() {
        firebase.auth().onAuthStateChanged(
            async function(user) {
                console.log(user);
                if (user) {
                    const idToken = await user.getIdToken(true);
                    const { data } = await axios.post("/api/auth", { idToken });
                    axios.defaults.headers.common[
                        "Authorization"
                    ] = `Bearer ${data.token}`;
                    // const testElement = document.getElementById('test');
                    // testElement.addEventListener('click', async function(){
                    //     var test = await axios.get('/api/hoge');
                    //     console.log(test)
                    // });
                    // testElement.style.display="block";
                } else {
                    console.log("signed out");
                }
            },
            function(error) {
                console.log(error);
            }
        );
    };
    window.addEventListener("load", function() {
        initApp();
    });
}
