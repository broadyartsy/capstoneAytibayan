<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Albay Provincial Agricultural Office - Region V</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('Assets/css/authentication.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" />

    {{-- toastr CSS --}}
    {{-- <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css> --}}
</head>

<body class="login">
    <div class="form-container">

        @if(session()->has('message'))
            <p class="alert alert-info">
                {{ session()->get('message') }}
            </p>
        @endif

        <form class="row g-3 login-form" method="POST" action="{{ route('verify.store') }}">
            @csrf
            <div class="col-md-4 side-image">
                <img id="image" src="/images/APAO logo.png">
            </div>
            <div class="col-md-8 form">
                <div class="input-form">
                    <h3> Two Factor Verification </h3>
                    <div class="col-md-12 input">
                        <p class="text-muted">
                            You have received an email which contains two factor login code.
                            If you haven't received it, press <a href="{{ route('verify.resend') }}">here</a>.
                        </p>
                        <label for="two_factor_code" class="form-label">Two Factor Code:</label>
                        <input type="text" class="form-control{{ $errors->has('two_factor_code') ? ' is-invalid' : '' }}" id="two_factor_code" name="two_factor_code"
                            placeholder="Two Factor Code" required autofocus placeholder="Two Factor Code">
                        @error('two_factor_code')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="login-buttons">
                        <div class="login-button1">
                            <a href="{{ route('itstaff.logout') }}" class="back-to-home-button">Back to Home</a>
                        </div>
                    </div>
                    <button type="submit" class="button login-button-item">Verify</button>

                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>

    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var showPasswordBtn = document.getElementById("showPasswordBtn");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                showPasswordBtn.textContent = "Hide Password";
            } else {
                passwordInput.type = "password";
                showPasswordBtn.textContent = "Show Password";
            }
        }
    </script>

</body>

</html>