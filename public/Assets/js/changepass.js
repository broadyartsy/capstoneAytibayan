function togglePasswordVisibility(inputId, eyeIconId) {
    var passwordInput = document.getElementById(inputId);
    var eyeIcon = document.getElementById(eyeIconId);

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.innerHTML = '<i class="fas fa-eye" style="color: #7BB701;"></i>';
    } else {
        passwordInput.type = 'password';
        eyeIcon.innerHTML = '<i class="fas fa-eye-slash" style="color: #808080;"></i>';
    }
}

// Attach input event listeners for each password field
var oldPasswordInput = document.getElementById('inputOldPassword');
var eyeIconOld = document.getElementById('eyeIconOld');
oldPasswordInput.addEventListener('input', function () {
    eyeIconOld.style.display = oldPasswordInput.value.length > 0 ? 'inline-block' : 'none';
});

var newPasswordInput = document.getElementById('inputNewPassword');
var eyeIconNew = document.getElementById('eyeIconNew');
newPasswordInput.addEventListener('input', function () {
    eyeIconNew.style.display = newPasswordInput.value.length > 0 ? 'inline-block' : 'none';
});

var confirmNewPasswordInput = document.getElementById('inputConfirmNewPassword');
var eyeIconConfirmNew = document.getElementById('eyeIconConfirmNew');
confirmNewPasswordInput.addEventListener('input', function () {
    eyeIconConfirmNew.style.display = confirmNewPasswordInput.value.length > 0 ? 'inline-block' : 'none';
});

