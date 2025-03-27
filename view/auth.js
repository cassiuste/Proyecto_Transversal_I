const goToSignUp = document.getElementById("goToSignUp");
const goToSignIn = document.getElementById("goToSignIn");

const signInForm = document.getElementById("signInForm");
const signUpForm = document.getElementById("signUpForm");


goToSignIn.addEventListener("click",function(){
    signInForm.style.visibility = "visible";
    signUpForm.style.visibility = "hidden";
});
goToSignUp.addEventListener("click",function(){
    signUpForm.style.visibility = "visible";
    signInForm.style.visibility = "hidden";
})