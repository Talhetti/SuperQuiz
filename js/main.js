function VerSenha() {
    let Senhainput = document.getElementById("Password");
    let MudarIcon = document.querySelector(".VerSenha");

    if (Senhainput.type === "password") {
        Senhainput.type = "text";
        MudarIcon.textContent = "🐵";
    } else {
        Senhainput.type = "password";
        MudarIcon.textContent = "🙈";
    }
}
