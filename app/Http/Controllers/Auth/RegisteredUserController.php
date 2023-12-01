<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Program;
use App\Models\Role;
use App\Models\Status;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use App\Events\UserEvent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use App\Notifications\AccountRegistrationNotification;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create()
    {
        $programs = Program::all();
        $roles = Role::all();
        $statuses = Status::all();
        return view('auth.register', compact('programs', 'roles', 'statuses'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $userRole = AUTH::user()->role->role_name;

        // Validate form inputs
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'inputEmail' => ['required', 'email'],
            'phone_number' => ['required', 'string', 'max:10'],
            'inputRole' => ['required', Rule::in(Role::pluck('id')->all())],
            'inputProgram' => ['required', Rule::in(Program::pluck('id')->all())],
            'primaryAddress' => ['required', 'string', 'max:255'],
            'inputCity' => ['required', 'string', 'max:255'],
            'inputProvince' => ['string', 'max:255'],
            'inputZip' => ['string', 'max:255'],
            'inputStatus' => ['required', Rule::in(Status::pluck('id')->all())],
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->inputEmail,
            'password' => Hash::make($request->password),
            'phone' => '63'.$request->phone_number,
            'barangay' => $request->primaryAddress,
            'city' => $request->inputCity,
            'province' => $request->inputProvince,
            'zip' => $request->inputZip,
            'role_id' => $request->inputRole,
            'program_id' => $request->inputProgram,
            'status_id' => $request->inputStatus
            // 'password' => Hash::make($request->password),
        ]);

        $user->save();
        // event(new Registered($user));
        
        // event(new UserEvent($user));

        //notify on email
        $user->notify(new AccountRegistrationNotification());

        //send via sms
        // $basic  = new \Vonage\Client\Credentials\Basic("fd2194d6", "JlrdWbcttBX5OdVs");
        // $client = new \Vonage\Client($basic);

        // $response = $client->sms()->send(
        //     new \Vonage\SMS\Message\SMS($user->phone, "apao", "Your account for Albay Provincial Agriculture Office has been created. You may login with your credentials:\n Email: ". $user->email. "\n Password: ApaoAlbay2023 \n\n You may change your password anytime at the Albay Provincial Agriculture Office Web Application.")
        // );

        // $message = $response->current();

        // if ($message->getStatus() == 0) {
        //     toastr()->timeOut(7500)->addSuccess('The user\'s credentials has been sent via email and SMS!');
        // } else {
        //     toastr()->timeOut(7500)->addSuccess('The message failed with status: ' . $message->getStatus());
        // }


        // Auth::login($user);

        toastr()->timeOut(10000)->addSuccess('A new User has been successfully registered!');

        if ($userRole == 'itstaff') {
            return redirect()->route('itstaff.registerView');
        } elseif ($userRole == 'binhiprojectcoordinator'){
            return redirect()->route('BINHI_Project_Coordinator.registerView');
        } elseif ($userRole == 'abakaprojectcoordinator'){
            return redirect()->route('abakaprojectcoordinator.registerView');
        } elseif ($userRole == 'agripinayprojectcoordinator'){
            return redirect()->route('agripinayprojectcoordinator.registerView');
        } elseif ($userRole == 'akbayprojectcoordinator'){
            return redirect()->route('akbayprojectcoordinator.registerView');
        } elseif ($userRole == 'leadprojectcoordinator'){
            return redirect()->route('leadprojectcoordinator.registerView');
        }

    }
}
