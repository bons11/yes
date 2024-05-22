const container = document.querySelector(".container"),
    pwShowHide = document.querySelectorAll(".showHidePw"),
    pwFields = document.querySelectorAll(".password"),
    signUp = document.querySelector(".signup-link"),
    login = document.querySelector(".login-link"),
    rememberCheckbox = document.getElementById("logCheck");

// Remember Me functionality
rememberCheckbox.addEventListener("change", () => {
    if (rememberCheckbox.checked) {
        // Save email and password in localStorage
        localStorage.setItem("rememberEmail", document.querySelector("input[name='email']").value);
        localStorage.setItem("rememberPassword", document.querySelector("input[name='password']").value);
    } else {
        // Clear saved email and password from localStorage
        localStorage.removeItem("rememberEmail");
        localStorage.removeItem("rememberPassword");
    }
});

// Check if there's a saved email and password in localStorage
const savedEmail = localStorage.getItem("rememberEmail");
const savedPassword = localStorage.getItem("rememberPassword");
if (savedEmail && savedPassword) {
    document.querySelector("input[name='email']").value = savedEmail;
    document.querySelector("input[name='password']").value = savedPassword;
    rememberCheckbox.checked = true;
}

// js code to show/hide password and change icon
pwShowHide.forEach(eyeIcon => {
    eyeIcon.addEventListener("click", () => {
        pwFields.forEach(pwField => {
            if (pwField.type === "password") {
                pwField.type = "text";

                pwShowHide.forEach(icon => {
                    icon.classList.replace("uil-eye-slash", "uil-eye");
                })
            } else {
                pwField.type = "password";

                pwShowHide.forEach(icon => {
                    icon.classList.replace("uil-eye", "uil-eye-slash");
                })
            }
        })
    })
})

// js code to appear signup and login form
signUp.addEventListener("click", () => {
    container.classList.add("active");
});
login.addEventListener("click", () => {
    container.classList.remove("active");
});
