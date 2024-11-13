const signupFormInput = document.getElementById("signup-form");

const passwordInput = document.getElementById("password-id");
const passwordConfirmInput = document.getElementById("password-confirm-id");

console.log(passwordInput, passwordConfirmInput);

passwordInput.addEventListener('input', validatePasswords);
passwordConfirmInput.addEventListener('input', validatePasswords);

function validatePasswords(e) {
    const password = passwordInput.value;
    const passwordConfirm = passwordConfirmInput.value;

    if (! password ) {
        passwordConfirmInput.classList.remove("border-success");
        passwordConfirmInput.classList.remove("border-danger");

        return;
    }

    if (password !== passwordConfirm) {
        if (passwordConfirmInput.classList.contains("border-success")) {
            passwordConfirmInput.classList.replace("border-success", "border-danger");
        } else {
            passwordConfirmInput.classList.add("border-danger");
        }

    } else {
        if (passwordConfirmInput.classList.contains("border-danger")) {
            passwordConfirmInput.classList.replace("border-danger", "border-success");
        } else {
            passwordConfirmInput.classList.add("border-success");
        }        
    }
}

signupFormInput.addEventListener('submit', function() {
    const password = passwordInput.value;
    const passwordConfirm = passwordConfirmInput.value;

    return password === passwordConfirm;
});

