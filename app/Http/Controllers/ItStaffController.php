<?php

namespace App\Http\Controllers;

use App\Models\announcement;
use App\Models\events;
use App\Models\Financialassistance;
use App\Models\Financialassistancehistory;
use App\Models\Loan;
use App\Models\Loanhistory;
use App\Models\Program;
use App\Models\Role;
use App\Models\Status;
use App\Models\User;
use App\Notifications\AccountUpdateNotif;
use App\Notifications\BlacklistNotification;
use App\Notifications\InactiveStatusNotif;
use App\Notifications\PasswordUpdateNotif;
use App\Notifications\RestoreNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Password;


class ItStaffController extends Controller
{
    public function ItStaffHome()
    {
        //Access the authenticated user's id
        $id = AUTH::user()->id;

        //Access the specific row data of the user's id
        $userProfileData = User::find($id);

        // Get the total number of users
        $totalUsers = User::count();

        // Get the number of users with the role "project_coordinator"
        $totalcoordinators = User::whereHas('role', function ($query) {
            $query->whereIn('role_name', ['binhiprojectcoordinator', 'abakaprojectcoordinator', 'agripinayprojectcoordinator', 'akbayprojectcoordinator', 'leadprojectcoordinator']);
        })->count();

        // Get the number of users with the role "beneficiary"
        $totalbeneficiaries = User::whereHas('role', function ($query) {
            $query->whereIn('role_name', ['beneficiary']);
        })->count();

        // Get the number of users that are active
        $activeBeneficiaries = User::whereHas('role', function ($query) {
            $query->whereIn('role_name', ['beneficiary']);
        })->whereHas('status', function ($query) {
            $query->whereIn('status_name', ['Active']);
        })->count();

        // Get the number of users that are inactive
        $inactiveBeneficiaries = User::whereHas('role', function ($query) {
            $query->whereIn('role_name', ['beneficiary']);
        })->whereHas('status', function ($query) {
            $query->whereIn('status_name', ['Inactive']);
        })->count();

        $totalActiveandInactiveBeneficiaries = [$activeBeneficiaries, $inactiveBeneficiaries];

        $coordinators = User::whereHas('role', function ($query) {
            $query->whereIn('role_name', ['binhiprojectcoordinator', 'abakaprojectcoordinator', 'agripinayprojectcoordinator', 'akbayprojectcoordinator', 'leadprojectcoordinator']);
        })
        ->with('program')
        ->get();
        
        // $userCountsByProgram = User::whereHas('role', function ($query) {
        //     $query->where('role_name', 'beneficiary');
        // })->with(['program', 'status'])->get();

        $programs = Program::with(['user' => function ($query) {
            $query->whereHas('role', function ($subQuery) {
                $subQuery->where('role_name', 'beneficiary');
            });
        }])->get();

        $programCharts = Program::with(['user' => function ($query) {
            $query->whereHas('role', function ($query) {
                $query->where('role_name', 'beneficiary');
            });
        }])->get();

        $programNames = $programCharts->pluck('program_name')->toArray();
        $beneficiaryCounts = $programCharts->map(function ($program) {
            return (int)count($program->user);
        })->toArray();

        $dataLineChart = User::whereHas('role', function ($query) {
            $query->where('role_name', 'beneficiary');
        })->selectRaw('DATE_FORMAT(created_at, "%M") as month, COUNT(*) as count')
        ->groupBy('month')
        ->get();

        $months = [];
        $monthCount = [];

        foreach ($dataLineChart as $entry) {
            $months[] = $entry->month;
            $monthCount[] = $entry->count;
        }

        //itstaff users count
        $itstaffs = User::whereHas('role', function ($query) {
            $query->whereIn('role_name', ['itstaff']);
        })->count();

        //coordinators user count
        $coordinaorsCount = User::whereHas('role', function ($query) {
            $query->whereIn('role_name', ['projectcoordinator', 'abakaprojectcoordinator', 'agripinayprojectcoordinator', 'akbayprojectcoordinator', 'leadprojectcoordinator']);
        })->count();

        //beneficiaries user count
        $beneficiariesCount = User::whereHas('role', function ($query) {
            $query->whereIn('role_name', ['beneficiary']);
        })->count();

        $totalUserAccountsCount = [$itstaffs, $coordinaorsCount, $beneficiariesCount];


        return view('ITStaff.home', compact('userProfileData', 'totalUsers', 'totalcoordinators', 'totalbeneficiaries', 'totalActiveandInactiveBeneficiaries', 'coordinators', 'programs', 'programNames', 'beneficiaryCounts', 'dataLineChart', 'months', 'monthCount', 'totalUserAccountsCount'));
    } // End Method

    public function ItStaffLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // toastr()->addSuccess('Your Account has been logged out!');
        toastr()->timeOut(10000)->addInfo('Your Account has been logged out!');
        // toastr()->addWarning('Your Account has been logged out!');
        // toastr()->addError('Your Account has been logged out!');

        return redirect('/login');
    } // End Method

    // public function ItStaffAddProgramView()
    // {
    //     // Get the number of project coordiantors
    //     $coordinators = User::whereHas('role', function ($query) {
    //         $query->whereIn('role_name', ['projectcoordinator']);
    //     })->get();

    //     return view('ITStaff.addprogram', compact('coordinators'));
    // } // End Method

    // public function ItStaffAddNewProgram(Request $request)
    // {
    //     // Validate form inputs
    //     $validatedData = $request->validate([
    //         'programnameInput' => ['required', 'string', 'max:30', 'unique:programs,program_name'],
    //         'password' => ['required', 'confirmed', Rules\Password::defaults()],
    //         'inputLocation' => ['required', 'string', 'max:50'],
    //         'inputEmail' => ['required', 'string', 'email', 'max:255', 'unique:programs,email'],
    //         'inputContact' => ['required', 'string', 'max:12'],
    //         'inputInfo' => ['required', 'string', 'max:500'],
    //         'inputApply' => ['required', 'string', 'max:500'],
    //         'inputReqs' => ['required', 'string', 'max:500'],
    //         'programPhoto' => ['required' , 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
    //         'programBackgroundPhoto' => ['required' , 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
    //     ]);

    //     if ($request->file('programPhoto'))
    //     {
    //         // $imagePath = $request->file('programPhoto')->store('public/Uploads/Program_images');
            
    //         // // Remove the 'public/' prefix from the path to store in the database
    //         // $validatedData['programPhoto'] = str_replace('public/', '', $imagePath);

    //         $file = $request->file('programPhoto');

    //         @unlink(public_path('Uploads/Program_images/'.$validatedData['programPhoto']));

    //         $fileName = date('YmdHi').$file->getClientOriginalName();
    //         $file->move(public_path('Uploads/Program_images'),$fileName);
    //         $validatedData['programPhoto'] = $fileName;
    //     }

    //     if ($request->file('programBackgroundPhoto'))
    //     {
    //         // $imagePath = $request->file('programPhoto')->store('public/Uploads/Program_images');
            
    //         // // Remove the 'public/' prefix from the path to store in the database
    //         // $validatedData['programPhoto'] = str_replace('public/', '', $imagePath);

    //         $file = $request->file('programBackgroundPhoto');

    //         @unlink(public_path('Uploads/Program_images/'.$validatedData['programBackgroundPhoto']));

    //         $fileName = date('YmdHi').$file->getClientOriginalName();
    //         $file->move(public_path('Uploads/Program_images'),$fileName);
    //         $validatedData['programBackgroundPhoto'] = $fileName;
    //     }


    //     if ($validatedData)
    //     {
    //         $hashed = Hash::make($validatedData['password']);
            
    //         // dd($hashed);

    //         Program::create([
    //             'program_name' => $validatedData['programnameInput'],
    //             'location' => $validatedData['inputLocation'],
    //             'email' => $validatedData['inputEmail'],
    //             'contact' => $validatedData['inputContact'],
    //             'description' => $validatedData['inputInfo'],
    //             'quiry' => $validatedData['inputApply'],
    //             'requirements' => $validatedData['inputReqs'],
    //             'image' => $validatedData['programPhoto'],
    //             'background_image' => $validatedData['programBackgroundPhoto'],
    //             'password' => $hashed,
    //         ]);

    //         toastr()->timeOut(10000)->addSuccess('A new Program has been successfully added!');

    //         return redirect()->route('itstaff.home');
    //     }
    //     else
    //     {
    //         toastr()->timeOut(10000)->addError('Validation failed. Please check your inputs and try again!');

    //         return redirect()->back();
    //     }
    //     // event(new Registered($user));

    //     // Auth::login($user);
    // } // End Method

    public function ItStaffEditProgramView($id)
    {
        //get all coordinators associated with a specific program
        $program = Program::with('coordinators')->findOrFail($id);

        $userProgramId = $id;

        $users = User::whereHas('role', function ($query) {
            $query->where('role_name', 'beneficiary');
        })->whereHas('program', function ($query) use ($userProgramId) {
            $query->where('id', $userProgramId);
        })->where('blacklisted', false)->get();

        // dd($program->coordinators);

        return view('ITStaff.edit_program', compact('program', 'users'));
    } // End Method

    public function ItStaffUpdateProgram(Request $request)
    {
        $programId = $request->id;

        $programData = Program::findOrFail($programId);

        $validatedData = $request->validate([
            'programnameInput' => ['string', 'max:40'],
            'inputLocation' => ['string', 'max:100'],
            'inputEmail' => ['string', 'email', 'max:255'],
            'inputContact' => ['string', 'max:10'],
            'inputInfo' => ['string'],
            'inputApply' => ['string'],
            'inputReqs' => ['string'],
            // 'programPhoto' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        if ($validatedData)
        {

            $programData->update([
                'program_name' => $validatedData['programnameInput'],
                'location' => $validatedData['inputLocation'],
                'email' => $validatedData['inputEmail'],
                'contact' => '63'.$validatedData['inputContact'],
                'description' => $validatedData['inputInfo'],
                'quiry' => $validatedData['inputApply'],
                'requirements' => $validatedData['inputReqs'],
            ]);

            if ($request->file('programPhoto'))
            {
                $file = $request->file('programPhoto');

                @unlink(public_path('Uploads/Program_images/'.$programData->image));

                $fileName = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('Uploads/Program_images'),$fileName);
                $programData['image'] = $fileName;
            }

            if ($request->file('programBackgroundPhoto'))
            {
                $file = $request->file('programBackgroundPhoto');

                @unlink(public_path('Uploads/Program_images/'.$programData->background_image));

                $fileName = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('Uploads/Program_images'),$fileName);
                $programData['background_image'] = $fileName;
            }
            $programData->save();

            toastr()->timeOut(10000)->addSuccess('Program has been updated successfully!');
            
            return redirect()->route('itstaff.home');
        }
        else
        {
            toastr()->timeOut(10000)->addError('Validation failed. Please check your inputs and try again!');

            return redirect()->back();
        }
    } // End Method

    public function ITStaffAnnouncement()
    {
        $programs = Program::all();
        $id = AUTH::user()->id;

        // Get the programId of the user table
        $programId = User::where('id', $id)->pluck('program_id');
        $roleId = User::where('id', $id)->pluck('role_id');
        $roleName = trim(implode(' ', Role::where('id', $roleId)->pluck('role_name')->toArray()));
        // Get the programname of the program table
        $programName = trim(implode(' ', Program::where('id', $programId)->pluck('program_name')->toArray()));
        $announcement = announcement::all();

        return view('ITStaff.announcement', compact('announcement','roleName','programName', 'programs'));
    } // End Method

    public function ITStaffAnnouncementEdit($id)
    {
        $announcement = announcement::findOrFail($id);

        return view('ITStaff.announcement', compact('announcement'));
    } // End Method

    public function ITStaffAnnouncementStore(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'from'=> 'string',
            'title' => 'required|string',
            'to' => 'required|string',
            'message' => 'required|string',
        ]);

        // Check if validation passes
        if ($validatedData) 
        {
            // Insert data into the database
            $announcement = announcement::create([
                'from'=> $validatedData['from'],
                'title' => $validatedData['title'],
                'to' => $validatedData['to'],
                'message' => $validatedData['message'],
            ]);
            $announcement->save();

            return redirect()->back()->with('success', 'New Announcement Added!');
        } else {
            return redirect()->back()->with('error', 'Validation failed. Please check your input.');
    }
    } // End Method

    public function ITStaffAnnouncementUpdate(Request $request)
    {
        $aid = $request->announcement_id;
        
        announcement::findOrFail($aid)->update([
            'title'=>$request->title,
            'to'=>$request->to,
            'message'=>$request->message,
        ]);

        return redirect()->back()->with('success', 'Announcement is Updated!');
    } // End Method

    public function ITStaffAnnouncementDelete(Request $request)
    {
        $id = $request->delete_id;
        // Find the record you want to delete by its primary key
        $recordToDelete = announcement::find($id);

        // Check if the record exists
        if ($recordToDelete) {
            // Delete the record
            $recordToDelete->delete();

            // Optionally, you can redirect back to a page or return a response
            return redirect()->back()->with('success', 'Announcement is Deleted!');
        } else {
            // Record not found
            // You can redirect back with an error message or handle it as needed
            return redirect()->back()->with('error', 'Record Not Found!');
        }
    }
    
    public function ITStaffEvent()
    {
        $programs = Program::all();
        $id = AUTH::user()->id;

        // Get the programId of the user table
        $programId = User::where('id', $id)->pluck('program_id');
        $roleId = User::where('id', $id)->pluck('role_id');
        $roleName = trim(implode(' ', Role::where('id', $roleId)->pluck('role_name')->toArray()));
        // Get the programname of the program table
        $programName = trim(implode(' ', Program::where('id', $programId)->pluck('program_name')->toArray()));

        $event = events::all();

        return view('ITStaff.event', compact('event','roleName','programName', 'programs'));
    } // End Method

    public function ITStaffEventEdit($id)
    {
        $events = events::findOrFail($id);

        return view('ITStaff.event', compact('events'));
    } // End Method

    
    public function ITStaffEventStore(Request $request)
    {
        // Validate the request
    $validatedData = $request->validate([
        'title' => 'required|string',
        'from'=> 'string',
        'date' => 'required|date',
        'to' => 'required|string',
        'message' => 'required|string',
    ]);

    //dd($validatedData);

    // Check if validation passes
    if ($validatedData) {
        // Insert data into the database
        $event = events::create([
            'from' => $validatedData['from'],
            'title' => $validatedData['title'],
            'date' => $validatedData['date'],
            'to' => $validatedData['to'],
            'message' => $validatedData['message'],
        ]);
        $event->save();

        // If the attachment file is not empty, store it in the database

        return redirect()->back()->with('success', 'New Event Added!');
    } else {
        return redirect()->back()->with('error', 'Validation failed. Please check your input.');
    }

    } // End Method

    public function ITStaffEventUpdate(Request $request)
    {
        $aid = $request->event_id;
        
        events::findOrFail($aid)->update([
            'title' => $request->title,
            'date' =>$request->date,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Event is Updated!');
    } // End Method

    public function ITStaffEventDelete(Request $request)
    {
        $id = $request->delete_id;
        // Find the record you want to delete by its primary key
        $recordToDelete = events::find($id);

        // Check if the record exists
        if ($recordToDelete) {
            // Delete the record
            $recordToDelete->delete();

            // Optionally, you can redirect back to a page or return a response
            return redirect()->back()->with('success', 'Event is Deleted!');
        } else {
            // Record not found
            // You can redirect back with an error message or handle it as needed
            return redirect()->back()->with('error', 'Record Not Found!');
        }
    }

    public function ITStaffRegisterView()
    {
        $users = User::orderBy('id', 'asc')->where('blacklisted', false)->get();
        $roles = Role::all();
        $statuses = Status::all();

        return view('ITStaff.registerView', compact('users', 'roles', 'statuses'));
    } // End Method

    public function ITStaffRegisterEditUser(Request $request)
    {
        $userId = $request->id;

        $userData = User::findOrFail($userId);

        $userData->update([
            'role_id' => $request->inputRole,
            'status_id' =>$request->inputStatus,
        ]);

        $userData->save();

        //notify on email
        $userData->notify(new InactiveStatusNotif());

        //send via sms
        // $basic  = new \Vonage\Client\Credentials\Basic("fd2194d6", "JlrdWbcttBX5OdVs");
        // $client = new \Vonage\Client($basic);

        // $response = $client->sms()->send(
        //     new \Vonage\SMS\Message\SMS($userData->phone, "apao", "Your account for Albay Provincial Agriculture Office has been set to INACTIVE.\n Logging in to the Web Application using your account is now forbidden. \n You may contact your program coordinator at the Albay Provincial Agriculture Office or send an Inquiry.")
        // );

        // $message = $response->current();

        // if ($message->getStatus() == 0) {
        //     toastr()->timeOut(7500)->addSuccess('Message has been sent via email and SMS!');
        // } else {
        //     toastr()->timeOut(7500)->addSuccess('The message failed with status: ' . $message->getStatus());
        // }

        



        toastr()->timeOut(10000)->addSuccess('User data has been updated successfully!');
        
        return redirect()->back();
    } // End Method

    public function ITStaffViewProfile()
    {
        //Access the authenticated user's id
        $id = AUTH::user()->id;

        //Access the specific row data of the user's id
        $userProfileData = User::find($id);

        return view('ITStaff.profile', compact('userProfileData'));
    } // End Method

    public function ITStaffEditProfile(Request $request)
    {
        //Access the authenticated user's id
        $id = AUTH::user()->id;

        //Access the specific row data of the user's id
        $userData = User::find($id);

        $userData->first_name = $request->first_name;
        $userData->middle_name = $request->middle_name;
        $userData->last_name = $request->last_name;
        $userData->phone = $request->phone;
        $userData->barangay = $request->primary_address;
        $userData->city = $request->city;
        $userData->province = $request->province;
        $userData->zip = $request->zip;

        if ($request->file('photo'))
        {
            $file = $request->file('photo');

            @unlink(public_path('Uploads/ITStaff_Images/'.$userData->photo));

            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('Uploads/ITStaff_Images'),$fileName);
            $userData['photo'] = $fileName;
        }
        $userData->save();

        //notify on email
        $userData->notify(new AccountUpdateNotif());

        //send via sms
        // $basic  = new \Vonage\Client\Credentials\Basic("fd2194d6", "JlrdWbcttBX5OdVs");
        // $client = new \Vonage\Client($basic);

        // $response = $client->sms()->send(
        //     new \Vonage\SMS\Message\SMS($userData->phone, "apao", "Your account for Albay Provincial Agriculture Office has been successfully updated!")
        // );

        // $message = $response->current();

        // if ($message->getStatus() == 0) {
        //     toastr()->timeOut(7500)->addSuccess('The user\'s credentials has been sent via email and SMS!');
        // } else {
        //     toastr()->timeOut(7500)->addSuccess('The message failed with status: ' . $message->getStatus());
        // }

        toastr()->timeOut(10000)->addSuccess('Your Profile has been Updated!');

        return redirect()->back();
    } // End Method
    
    public function ITStaffViewChangePassword()
    {
        //Access the authenticated user's id
        $id = AUTH::user()->id;

        //Access the specific row data of the user's id
        $userProfileData = User::find($id);

        return view('ITStaff.pass', compact('userProfileData'));
    } // End Method

    public function ITStaffEditChangePassword(Request $request)
    {

        //Access the authenticated user's id
        $id = AUTH::user()->id;

        //Access the specific row data of the user's id
        $userData = User::find($id);

        //Validation
        $request->validate([
            'inputOldPassword' => 'required',
            'inputNewPassword' => ['required', 'confirmed', Password::min(8)->letters()->numbers()->mixedCase()->symbols() ],
        ]);

        ///Match the old password
        if (!Hash::check($request->inputOldPassword, $userData->password))
        {
        //confirmation message
        toastr()->timeOut(10000)->addError('Old Password does not match!');

        return redirect()->back();
        }

        //Update the new password
        $userData->update([
            'password' => Hash::make($request->inputNewPassword) //inputNewPassword field name from name="inputNewPassword" in admin_change_password.blade.php
        ]);

        //notify on email
        $userData->notify(new PasswordUpdateNotif());

        //send via sms
        // $basic  = new \Vonage\Client\Credentials\Basic("fd2194d6", "JlrdWbcttBX5OdVs");
        // $client = new \Vonage\Client($basic);

        // $response = $client->sms()->send(
        //     new \Vonage\SMS\Message\SMS($userData->phone, "apao", "Your account password for Albay Provincial Agriculture Office has been successfully updated!")
        // );

        // $message = $response->current();

        // if ($message->getStatus() == 0) {
        //     toastr()->timeOut(7500)->addSuccess('The user\'s credentials has been sent via email and SMS!');
        // } else {
        //     toastr()->timeOut(7500)->addSuccess('The message failed with status: ' . $message->getStatus());
        // }

        toastr()->timeOut(10000)->addSuccess('Your Password has been Updated!');

        return redirect()->back();
    } // End Method

    public function ItStaffTransactionsView()
    {
        //Access the authenticated user's id
        $id = AUTH::user()->id;

        //Access the specific row data of the user's id
        $userProfileData = User::find($id);

        return view('ITStaff.transactions', compact('userProfileData'));
    } // End Method

    public function ItStaffAssistanceTransactionsView()
    {
        //Access the authenticated user's id
        $id = AUTH::user()->id;

        //Access the specific row data of the user's id
        $userProfileData = User::find($id);

        $assistanceTransactions = Financialassistancehistory::all();

        return view('ITStaff.financial_assistance_history', compact('userProfileData', 'assistanceTransactions'));
    } // End Method

    public function ItStaffLoanTransactionsView()
    {
        //Access the authenticated user's id
        $id = AUTH::user()->id;

        //Access the specific row data of the user's id
        $userProfileData = User::find($id);

        $loanTransactions = Loanhistory::all();

        return view('ITStaff.loan_transaction_histories', compact('userProfileData', 'loanTransactions'));
    } // End Method

    public function ItStaffBlacklistView()
    {
        //Access the authenticated user's id
        $id = AUTH::user()->id;

        //Access the specific row data of the user's id
        $userProfileData = User::find($id);

        $users = User::orderBy('id', 'asc')->where('blacklisted', true)->get();

        return view('ITStaff.blacklisted', compact('userProfileData', 'users'));
    } // End Method

    public function ItStaffBlacklistUser($id)
    {
        $userId = User::findOrFail($id);

        if ($userId->assistance) {
            $asstId = $userId->assistance->id;

            $userAsstId = Financialassistance::findOrFail($asstId);

            $userAsstId->delete();

            $userId->update([
                'blacklisted' => true,
            ]);

        }
        elseif ($userId->loan) {
            $loanId = $userId->loan->id;

            $userLoanId = Loan::findOrFail($loanId);

            $userLoanId->delete();

            $userId->update([
                'blacklisted' => true,
            ]);
        }

        else {
            $userId->update([
                'blacklisted' => true,
            ]);
        }
        

        //notify via email
        $userId->notify(new BlacklistNotification());

        //send via sms
        // $basic  = new \Vonage\Client\Credentials\Basic("fd2194d6", "JlrdWbcttBX5OdVs");
        // $client = new \Vonage\Client($basic);

        // $response = $client->sms()->send(
        //     new \Vonage\SMS\Message\SMS($userId->phone, "apao", "Your account for Albay Provincial Agriculture Office has been Blacklisted, please contact your Program Project Coordinator for inquiries.")
        // );

        // $message = $response->current();

        // if ($message->getStatus() == 0) {
        //     toastr()->timeOut(7500)->addSuccess('Notification has been sent via email and SMS!');
        // } else {
        //     toastr()->timeOut(7500)->addSuccess('The message failed with status: ' . $message->getStatus());
        // }

        toastr()->timeOut(10000)->addSuccess('User has been Blacklisted!');

        return redirect()->back();
    } // End Method

    public function ItStaffRestoreUser($id)
    {
        $userId = User::findOrFail($id);

        $userId->update([
            'blacklisted' => false,
        ]);

        //notify via email
        $userId->notify(new RestoreNotification());

        //send via sms
        // $basic  = new \Vonage\Client\Credentials\Basic("fd2194d6", "JlrdWbcttBX5OdVs");
        // $client = new \Vonage\Client($basic);

        // $response = $client->sms()->send(
        //     new \Vonage\SMS\Message\SMS($userId->phone, "apao", "Your account for Albay Provincial Agriculture Office has been Restored, you may login again!")
        // );

        // $message = $response->current();

        // if ($message->getStatus() == 0) {
        //     toastr()->timeOut(7500)->addSuccess('Notification has been sent via email and SMS!');
        // } else {
        //     toastr()->timeOut(7500)->addSuccess('The message failed with status: ' . $message->getStatus());
        // }

        toastr()->timeOut(10000)->addSuccess('User has been Restored!');

        return redirect()->back();
    } // End Method
}
