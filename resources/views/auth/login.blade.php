{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    {{-- toastr CSS --}}
    {{-- <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css> --}}
</head>

<body class="login">
    <div class="form-container">

        <form class="row g-3 login-form" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="col-md-4 side-image">
                <img id="image" src="/images/APAO logo.png">
            </div>
            <div class="col-md-8 form">
                <div class="input-form">
                    <h3> Albay Provincial Agricultural Office </h3>
                    <div class="col-md-12 input">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" :value="old('email')"
                            placeholder="example@gmail.com" required>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12 input">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" autocomplete="current-password">
                            <div class="input-group-append">
                                <button type="button" class="btn eyeicon" style="display: none;" id="eyeIcon" onclick="togglePasswordVisibility()">
                                    <i class="fa-solid fa-eye-slash" style="color: #808080;"></i>
                                </button>
                            </div>
                        </div>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>





                        <!-- kinomment ko muna old code sa password baka kasi masira code delete mo na lang mathias pag goods na

                    <div class="col-md-12 input">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password"
                                autocomplete="current-password">
                            <button type="button" id="showPasswordBtn" class="btn btn-secondary"
                                onclick="togglePasswordVisibility()">
                                Show Password
                            </button>
                        </div>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    -->
                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>
                    {{-- <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck">
                            <label class="form-check-label" for="gridCheck">
                                Check me out
                            </label>
                        </div>
                        </div> --}}
                    <div class="login-buttons">
                        <div class="login-button1">
                            <a href="{{ route('visitor.home') }}" class="back-to-home-button">Back to Home</a>
                        </div>
                        <div class="login-button2">
                            <div class="login-button2-centered">
                                @if (Route::has('password.request'))
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 login-button-item"
                                        href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="button login-button-item">Login</button>

                    {{-- <div class="col-12 login-button">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div> --}}

                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>

<script>
    var passwordInput = document.getElementById('password');
    var eyeIcon = document.getElementById('eyeIcon');

    // Attach an input event listener to the password field
    passwordInput.addEventListener('input', function () {
        // Display the eye icon when there is input in the password field
        eyeIcon.style.display = passwordInput.value.length > 0 ? 'inline-block' : 'none';
    });

    // Function to toggle password visibility
    function togglePasswordVisibility() {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.innerHTML = '<i class="fa-solid fa-eye" style="color: black;"></i>';
        } else {
            passwordInput.type = 'password';
            eyeIcon.innerHTML = '<i class="fa-solid fa-eye-slash" style="color: #808080;"></i>';
        } 
    }

        /* pati to mathias
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
        */
    </script>


    {{-- toastr js --}}
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}

    {{-- <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}";
            toastr.options = {
                "progressBar": true,
                "closeButton": true,
            }
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ", 'Info!', {
                        timeOut: 12000
                    });
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ", 'Success!', {
                        timeOut: 12000
                    });
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ", 'Warning!', {
                        timeOut: 12000
                    });
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ", 'Error!', {
                        timeOut: 12000
                    });
                    break;
            }
        @endif
    </script> --}}
</body>

</html>
