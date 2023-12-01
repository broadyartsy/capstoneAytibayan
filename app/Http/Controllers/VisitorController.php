<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\announcement;
use App\Models\events;
use App\Models\Program;
use App\Models\Role;
use App\Models\Status;
use App\Models\User;
use App\Models\Projects;
use Illuminate\Support\Facades\DB;
use App\Models\inquiries;
use App\Mail\ReplyMailable;
use Illuminate\Support\Facades\Mail;

class VisitorController extends Controller
{
    public function VisitorHome()
    {
        $programs = Program::all();

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

        //get all users with role beneficiary on each program
        $programs = Program::with(['user' => function ($query) {
            $query->whereHas('role', function ($subQuery) {
                $subQuery->where('role_name', 'beneficiary');
            });
        }])->get();

        $beneficiaryCount = [];
        $cities = [];

        foreach ($programs as $program) {
            if ($program->user->isNotEmpty()) {
                $city = $program->user->first()->city; // Assuming each program has at least one user
                
                if (!in_array($city, $cities)) {
                    $cities[] = $city;
                }

                if (!isset($beneficiaryCount[$program->program_name])) {
                    $beneficiaryCount[$program->program_name] = [];
                }

                $beneficiaryCount[$program->program_name][$city] = $program->user->where('role.role_name', 'beneficiary')->count();
            }
        }
        $public = "PUBLIC";
        $announcement = announcement::where(function ($query) use ($public) {
            $query->where('to', $public);})->get();
        $events = events::where(function ($query) use ($public) {
             $query->where('to', $public);})->get();

        $coordinators = User::whereHas('role', function ($query) {
        $query->whereIn('role_name', ['binhiprojectcoordinator', 'abakaprojectcoordinator', 'agripinayprojectcoordinator', 'akbayprojectcoordinator', 'leadprojectcoordinator']);
        })
        ->with('program')
        ->get();

        return view('Visitor.visitor_index', compact('programs', 'programNames', 'beneficiaryCounts', 'dataLineChart', 'months', 'monthCount', 'beneficiaryCount', 'cities', 'announcement', 'events', 'coordinators'));
    } // End Method

    public function visitorProgramsView($id)
    {


        $programName = trim(implode(' ', Program::where('id', $id)->pluck('program_name')->toArray()));
        //get all coordinators associated with a specific program
        $program = Program::with('coordinators')->findOrFail($id);

        if (!$program) {
            abort(404); // Program not found
        }
    
        $beneficiaries = User::where('program_id', $id)
            ->whereHas('role', function ($query) {
                $query->where('role_name', 'beneficiary');
            })
            ->select('city', DB::raw('count(*) as count'))
            ->groupBy('city')
            ->get();
            $public = 'Public';
            $project = Projects::where(function ($query) use ($public, $programName) {
                $query->where('recipient', $public)->where('from', $programName);})->get();

        // dd($program->coordinators);

        return view('Visitor.category_page', compact('program', 'beneficiaries', 'project'));
    } // End Method

    public function VisitorInquiryStore(Request $request)
    {
        // 
        // Validate the request
        $validatedData = $request->validate([
            'fullname' => 'required|string',
            'from'=> 'string',
            'to' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
            'contact' => 'required|string',
        ]);

        $programName = $validatedData['to'];

        $programEmail = trim(implode(' ', Program::where('program_name', $programName)->pluck('email')->toArray()));

        $recipientEmail = $programEmail;

        $recipientName = $validatedData['to'];

        $subject = $validatedData['from'];

        $body = $validatedData['message'];

        $senderName = $validatedData['fullname'];
        // Check if validation passes
        if ($validatedData) 
        {
            // Insert data into the database
            $inquiry = inquiries::create([
                'fullname' => $validatedData['fullname'],
                'from'=> $validatedData['from'],
                'to' => $validatedData['to'],
                'programEmail'=> $programEmail,
                'email' => $validatedData['email'],
                'contacts' => $validatedData['contact'],
                'message' => $validatedData['message'],
            ]);
            Mail::to($recipientEmail)->send(new ReplyMailable($subject, $body, $senderName, $recipientName));
            $inquiry->save();

            return redirect()->back()->with('success', 'Inquiry Submitted!');
        } else {
            return redirect()->back()->with('error', 'Validation failed. Please check your input.');
    }
    } // End Method//End Method
}
