function validatePasswords() {
    console.log("La fonction validatePasswords() a été appelée.");
    var password = document.getElementsByName("mdp")[0].value;
    var confirmPassword = document.getElementsByName("confirm_mdp")[0].value;

    if (password != confirmPassword) {
        console.log("Les mots de passe ne correspondent pas");
        console.log(password, confirmPassword);
        alert("Les mots de passe ne correspondent pas");
        console.log("false")
        return false;
    }
    console.log("true")
    return true ;
    
}
