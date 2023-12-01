{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
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
</head>

<body class="register">
    <div class="form-container">
        @php
        //Access the authenticated user's id
$userRole = Illuminate\Support\Facades\AUTH::user()->role->role_name;

$userProgram = Illuminate\Support\Facades\AUTH::user()->program->id;


//Access the specific row data of the user's id
        //when using a model in blade.php, indicate the direct path of the model
        // $userProfileData = App\Models\User::find($id);
    @endphp

        @if ($userRole === 'itstaff')
            <form class="row g-3 registration-form" method="POST" action="{{ route('register') }}">
                @csrf
                <h3> Albay Provincial Agricultural Office </h3>
                <div class="side-image">
                    <img src="/images/APAO logo.png">
                </div>
                <div class="col-md-4">
                    <label for="inputFirstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="inputFirstName" name="first_name"
                        placeholder="John Sammi" required>
                    @error('first_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="inputMiddleName" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" id="inputMiddleName" name="middle_name"
                        placeholder="Diwally">
                    @error('middle_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="inputLastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="inputLastName" name="last_name" placeholder="Beatosai"
                        required>
                    @error('last_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputEmail" name="inputEmail"
                        placeholder="example@gmail.com" required>
                    @error('inputEmail')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <input type="hidden" name="password" value="ApaoAlbay2023">
                </div>
                <div class="col-md-6">
                    <label for="inputNumber" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="inputNumber" name="phone_number"
                        placeholder="+63 9** *** ***9" required>
                    @error('phone_number')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="inputRole" class="form-label">Role</label>
                    <select id="inputRole" class="form-select" name="inputRole">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ ucwords($role->role_name) }}</option>
                        @endforeach
                    </select>
                    @error('inputRole')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>
                <div class="col-md-6">
                    <label for="inputPrimaryAddress" class="form-label">Barangay</label>
                    <input type="text" class="form-control" id="inputPrimaryAddress" name="primaryAddress"
                        placeholder="Barangay" required>
                    @error('primaryAddress')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="inputProgram" class="form-label">Program</label>
                    <select id="inputProgram" class="form-select" name="inputProgram">
                        @foreach ($programs as $program)
                            <option value="{{ $program->id }}">{{ ucwords($program->program_name) }}</option>
                        @endforeach
                    </select>
                    @error('inputProgram')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>

                <div class="col-md-4">
                    <label for="inputCity" class="form-label">City</label>
                    <select id="inputCity" class="form-select" name="inputCity">
                    <option value=""selected></option>
                        <option value="Camalig">Camalig</option>
                        <option value="Daraga">Daraga</option>
                        <option value="Guinobatan">Guinobatan</option>
                        <option value="Jovellar">Jovellar</option>
                        <option value="Legazpi City">Legazpi City</option>
                        <option value="Libon">Libon</option>
                        <option value="Ligao">Ligao</option>
                        <option value="Malilipot">Malilipot</option>
                        <option value="Malinao">Malinao</option>
                        <option value="Manito">Manito</option>
                        <option value="Oas">Oas</option>
                        <option value="Pioduran">Pioduran</option>
                        <option value="Sto.Domingo">Sto. Domingo</option>
                        <option value="Tabaco City">Tabaco City</option>
                        <option value="Tiwi">Tiwi</option>
                        <option value="Bacacay">Bacacay</option>
                    </select>
                    @error('inputCity')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="inputProvince" class="form-label">Province</label>
                    <input type="text" class="form-control" id="inputProvince" name="inputProvince" value="Albay" readonly>
                    @error('inputProvince')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-2">
                    <label for="inputZip" class="form-label">Zip</label>
                    <input type="text" class="form-control" id="inputZip" name="inputZip" placeholder="4500"
                        required readonly>
                    @error('inputZip')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="inputStatus" class="form-label">Status</label>
                    <select id="inputStatus" class="form-select" name="inputStatus">
                        @foreach ($statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->status_name }}</option>
                        @endforeach
                    </select>
                    @error('inputStatus')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 register-button">
                    <button type="submit" class="button">Register</button>
                </div>
                <div class="col-lg-12 col-md-10" style="text-align: center;">
                    <h1 class="display-2"></h1>
                    <a href="{{ route('itstaff.home') }}" class="btn btn-info ">Back to Home</a>
                </div>
            </form>
        @else
            <form class="row g-3 registration-form" method="POST" action="{{ route('register') }}">
                @csrf
                <h3> Albay Provincial Agricultural Office </h3>
                <div class="side-image">
                    <img src="/images/APAO logo.png">
                </div>
                <div class="col-md-4">
                    <label for="inputFirstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="inputFirstName" name="first_name"
                        placeholder="John Sammi" required>
                    @error('first_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="inputMiddleName" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" id="inputMiddleName" name="middle_name"
                        placeholder="Diwally">
                    @error('middle_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="inputLastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="inputLastName" name="last_name" placeholder="Beatosai"
                        required>
                    @error('last_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputEmail" name="inputEmail"
                        placeholder="example@gmail.com" required>
                    @error('inputEmail')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <input type="hidden" name="password" value="ApaoAlbay2023">
                </div>
                <div class="col-md-6">
                    <label for="inputNumber" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="inputNumber" name="phone_number"
                        placeholder="+63 9** *** ***9" required>
                    @error('phone_number')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="inputRole" class="form-label">Role</label>
                    <select id="inputRole" class="form-select" name="inputRole" readonly>
                        @foreach ($roles as $role)
                            @if ($role->role_name === 'beneficiary')
                                <option value="{{ $role->id }}" selected>{{ ucwords($role->role_name) }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('inputRole')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>
                <div class="col-md-6">
                    <label for="inputPrimaryAddress" class="form-label">Barangay</label>
                    <input type="text" class="form-control" id="inputPrimaryAddress" name="primaryAddress"
                        placeholder="Barangay" required>
                    @error('primaryAddress')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="inputProgram" class="form-label">Program</label>
                    <select id="inputProgram" class="form-select" name="inputProgram" readonly>
                        @foreach ($programs as $program)
                            @if ($program->id === $userProgram)
                                <option value="{{ $program->id }}" selected>{{ ucwords($program->program_name) }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('inputProgram')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>

                <div class="col-md-4">
                    <label for="inputCity" class="form-label">City</label>
                    <select id="inputCity" class="form-select" name="inputCity">
                        <option value=""selected></option>
                        <option value="Camalig">Camalig</option>
                        <option value="Daraga">Daraga</option>
                        <option value="Guinobatan">Guinobatan</option>
                        <option value="Jovellar">Jovellar</option>
                        <option value="Legazpi City">Legazpi City</option>
                        <option value="Libon">Libon</option>
                        <option value="Ligao">Ligao</option>
                        <option value="Malilipot">Malilipot</option>
                        <option value="Malinao">Malinao</option>
                        <option value="Manito">Manito</option>
                        <option value="Oas">Oas</option>
                        <option value="Pioduran">Pioduran</option>
                        <option value="Sto.Domingo">Sto. Domingo</option>
                        <option value="Tabaco City">Tabaco City</option>
                        <option value="Tiwi">Tiwi</option>
                        <option value="Bacacay">Bacacay</option>
                    </select>
                    @error('inputCity')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="inputProvince" class="form-label">Province</label>
                    <input type="text" class="form-control" id="inputProvince" name="inputProvince" value="Albay" readonly>
                    @error('inputProvince')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-2">
                    <label for="inputZip" class="form-label">Zip</label>
                    <input type="text" class="form-control" id="inputZip" name="inputZip" placeholder="4500"
                        required value="4500" readonly>
                    @error('inputZip')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="inputStatus" class="form-label">Status</label>
                    <select id="inputStatus" class="form-select" name="inputStatus">
                        @foreach ($statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->status_name }}</option>
                        @endforeach
                    </select>
                    @error('inputStatus')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 register-button">
                    <button type="submit" class="button">Register</button>
                </div>
                <div class="col-lg-12 col-md-10" style="text-align: center;">
                    <h1 class="display-2"></h1>
                    @if ($userRole === 'binhiprojectcoordinator')
                        <a href="{{ route('binhiprojectcoordinator.beneficiary') }}" class="btn btn-info ">Back to Home</a>
                    @elseif ($userRole === 'abakaprojectcoordinator')
                        <a href="{{ route('abakaprojectcoordinator.beneficiaries') }}" class="btn btn-info ">Back to Home</a>
                    @elseif ($userRole === 'agripinayprojectcoordinator')
                        <a href="{{ route('agripinayprojectcoordinator.beneficiaries') }}" class="btn btn-info ">Back to Home</a>
                    @elseif ($userRole === 'akbayprojectcoordinator')
                        <a href="{{ route('akbayprojectcoordinator.beneficiaries') }}" class="btn btn-info ">Back to Home</a>
                    @elseif ($userRole === 'leadprojectcoordinator')
                        <a href="{{ route('leadprojectcoordinator.beneficiaries') }}" class="btn btn-info ">Back to Home</a>
                    @endif
                    
                </div>
            </form>
        @endif
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>
