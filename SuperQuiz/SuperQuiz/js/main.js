        function VerSenha() {
            let SenhaInput = document.getElementById("Password");
            let MudarIcon = document.querySelector(".VerSenha");

            if (SenhaInput.type === "password") {
                SenhaInput.type = "text";
                MudarIcon.textContent = "🐵";
            } else {
                SenhaInput.type = "password";
                MudarIcon.textContent = "🙈";
            }
        }