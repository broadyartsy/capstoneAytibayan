<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\BeneficiaryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ItStaffController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BINHIProjectCoordinatorController;
use App\Http\Controllers\ABAKAProjectCoordinatorController;
use App\Http\Controllers\AGRIPINAYProjectCoordinatorController;
use App\Http\Controllers\AKBAYProjectCoordinatorController;
use App\Http\Controllers\LEADProjectCoordinatorController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\Auth\TwoFactorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\SmsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Route::get('/', function () {
//     return view('Visitor.visitor_index');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


//IT Staff Group Middleware
Route::middleware(['auth', 'twofactor', 'userroleprotection:itstaff'])->group(function(){
    // middleware named userroleprotection will protect routes to be only accessible by the right user role
    Route::get('/ITStaff/home', [ItStaffController::class, 'ItStaffHome'])->name('itstaff.home');

    //ITStaff Logout
    Route::get('/ITStaff/logout', [ItStaffController::class, 'ItStaffLogout'])->name('itstaff.logout');

    //add program view
    Route::get('/ITStaff/addprogramview', [ItStaffController::class, 'ItStaffAddProgramView'])->name('itstaff.addProgramView');

    //add new program
    Route::post('/ITStaff/addnewprogram', [ItStaffController::class, 'ItStaffAddNewProgram'])->name('itstaff.addNewProgram');

    //edit program view
    Route::get('/ITStaff/editprogramview/{id}', [ItStaffController::class, 'ItStaffEditProgramView'])->name('itstaff.editProgramView');

    //edit existing program 
    Route::post('/ITStaff/updateProgram', [ItStaffController::class, 'ItStaffUpdateProgram'])->name('itstaff.updateProgram');

    //transactions
    Route::get('/ITStaff/transactions', [ItStaffController::class, 'ItStaffTransactionsView'])->name('itstaff.TransactionsView');
    //financial assistance transactions
    Route::get('/ITStaff/financialAssistanceTransactions', [ItStaffController::class, 'ItStaffAssistanceTransactionsView'])->name('itstaff.financialAssistanceTransactionsView');
    //loan transactions
    Route::get('/ITStaff/loanTransactions', [ItStaffController::class, 'ItStaffLoanTransactionsView'])->name('itstaff.loanTransactionsView');

    //blacklist view
    Route::get('/ITStaff/blacklist', [ItStaffController::class, 'ItStaffBlacklistView'])->name('itstaff.BlacklistView');

    //blacklist a user
    Route::get('/ITStaff/blacklist/{id}', [ItStaffController::class, 'ItStaffBlacklistUser'])->name('itstaff.BlacklistUser');

    //restore a user
    Route::get('/ITStaff/restore/{id}', [ItStaffController::class, 'ItStaffRestoreUser'])->name('itstaff.RestoreUser');

    Route::get('/ITStaff/announcement', [ItStaffController::class, 'ITStaffAnnouncement'])->name('itstaff.announcement');

    Route::post('/ITStaff/announcement', [ItStaffController::class, 'ITStaffAnnouncementStore'])->name('store.announcement');

    Route::get('/ITStaff/announcement/{id}', [ItStaffController::class, 'ITStaffAnnouncementEdit'])->name('edit.announcement');

    Route::patch('/ITStaff/announcement', [ItStaffController::class, 'ITStaffAnnouncementUpdate'])->name('update.announcement');

    Route::delete('/ITStaff/announcement', [ItStaffController::class, 'ITStaffAnnouncementDelete'])->name('delete.announcement');
    
    
    Route::get('/ITStaff/event', [ItStaffController::class, 'ITStaffEvent'])->name('itstaff.event');

    Route::post('/ITStaff/event', [ItStaffController::class, 'ITStaffEventStore'])->name('store.event');

    Route::get('/ITStaff/event/{id}', [ItStaffController::class, 'ITStaffEventEdit'])->name('edit.event');
    
    Route::patch('/ITStaff/event', [ItStaffController::class, 'ITStaffEventUpdate'])->name('update.event');
    Route::delete('/ITStaff/event', [ItStaffController::class, 'ITStaffEventDelete'])->name('delete.event');

    //IT Staff View Profile
    Route::get('/ITStaff/viewprofile', [ItStaffController::class, 'ITStaffViewProfile'])->name('itstaff.viewprofile');

    //IT Staff Edit Profile Data
    Route::post('/ITStaff/editprofile', [ItStaffController::class, 'ITStaffEditProfile'])->name('itstaff.editprofile');

    //IT Staff View Change Password
    Route::get('/ITStaff/viewchangepassword', [ItStaffController::class, 'ITStaffViewChangePassword'])->name('itstaff.viewchangepassword');

    //IT Staff Edit Change Password
    Route::post('/ITStaff/editchangepassword', [ItStaffController::class, 'ITStaffEditChangePassword'])->name('itstaff.editchangepassword');

    //IT Staff Register View
    Route::get('/ITStaff/registerview', [ItStaffController::class, 'ITStaffRegisterView'])->name('itstaff.registerView');

    //IT Staff Edit user status and role
    Route::post('/ITStaff/registeredituser', [ItStaffController::class, 'ITStaffRegisterEditUser'])->name('itstaff.registerEditUser');
    
}); //End group itstaff middleware

//Project Coordinator BINHI Group Middleware
Route::middleware(['auth', 'checkuserstatus', 'twofactor', 'userroleprotection:binhiprojectcoordinator'])->group(function(){
    // middleware named userroleprotection will protect routes to be only accessible by the right user role

    //Coordinator Home Page
    Route::get('/BINHI_ProjectCoordinator/home', [BINHIProjectCoordinatorController::class, 'ProjectCoordinatorHome'])->name('BINHI_Project_Coordinator.beneficiary');

    //Coordinator Logout
    Route::get('/BINHI_ProjectCoordinator/logout', [BINHIProjectCoordinatorController::class, 'ProjectCoordinatorLogout'])->name('binhiprojectCoordinator.logout');

   // Route::get('/BINHI_ProjectCoordinator/inquiry/check-read-status/{inquiryId}', [BINHIProjectCoordinatorController::class, 'checkReadStatus'])
    //->name('BINHI_Project_Coordinator.inquiry.checkReadStatus');

    //Coordinator Announcements
    Route::get('/BINHI_ProjectCoordinator/Announcements', [BINHIProjectCoordinatorController::class, 'ProjCoordinatorAnnouncement'])->name('binhiprojectcoordinator.announcement');
    Route::post('/BINHI_ProjectCoordinator/Announcements', [BINHIProjectCoordinatorController::class, 'ProjCoordinatorAnnouncementStore'])->name('store.announcementcoordinatorbinhi');
    Route::get('/BINHI_ProjectCoordinator/Announcements/{id}', [BINHIProjectCoordinatorController::class, 'ProjectCoordinatorAnnouncementEdit'])->name('edit.announcementcoordinatorbinhi');
    Route::patch('/BINHI_ProjectCoordinator/Announcements', [BINHIProjectCoordinatorController::class, 'ProjCoordinatorAnnouncementUpdate'])->name('update.announcementcoordinatorbinhi');
    Route::delete('/BINHI_ProjectCoordinator/Announcements', [BINHIProjectCoordinatorController::class, 'ProjCoordinatorAnnouncementDelete'])->name('delete.announcementcoordinatorbinhi');

    //blacklist view
    Route::get('/BINHI_ProjectCoordinator/blacklist', [BINHIProjectCoordinatorController::class, 'CoordinatorBlacklistView'])->name('binhiprojectcoordinator.BlacklistView');

    //blacklist a user
    Route::get('/BINHI_ProjectCoordinator/blacklist/{id}', [BINHIProjectCoordinatorController::class, 'CoordinatorBlacklistUser'])->name('binhiprojectcoordinator.BlacklistUser');

    //restore a user
    Route::get('/BINHI_ProjectCoordinator/restore/{id}', [BINHIProjectCoordinatorController::class, 'CoordinatorRestoreUser'])->name('binhiprojectcoordinator.RestoreUser');

    //Coordinator Events
    Route::get('/BINHI_ProjectCoordinator/Events', [BINHIProjectCoordinatorController::class, 'ProjCoordinatorEvent'])->name('binhiprojectcoordinator.event');
    Route::post('/BINHI_ProjectCoordinator/Events', [BINHIProjectCoordinatorController::class, 'ProjCoordinatorEventStore'])->name('store.eventcoordinatorbinhi');
    Route::get('/BINHI_ProjectCoordinator/Events/{id}', [BINHIProjectCoordinatorController::class, 'ProjectCoordinatorEventEdit'])->name('edit.eventcoordinatorbinhi');
    Route::patch('/BINHI_ProjectCoordinator/Events', [BINHIProjectCoordinatorController::class, 'ProjCoordinatorEventUpdate'])->name('update.eventcoordinatorbinhi');
    Route::delete('/BINHI_ProjectCoordinator/Events', [BINHIProjectCoordinatorController::class, 'ProjCoordinatorEventDelete'])->name('delete.eventcoordinatorbinhi');

    //Coordinator Inquiry
    Route::get('/BINHI_ProjectCoordinator/Inquriy', [BINHIProjectCoordinatorController::class, 'ProjCoordinatorInquiry'])->name('binhiprojectcoordinator.inquiry');
    Route::post('/BINHI_ProjectCoordinator/Inquriy/reply', [BINHIProjectCoordinatorController::class, 'ProjectCoordinatorInquiryReply'])->name('reply.inquirycoordinatorbinhi');
    Route::delete('/BINHI_ProjectCoordinator/Inquriy/delete', [BINHIProjectCoordinatorController::class, 'ProjCoordinatorInquiryDelete'])->name('delete.inquirycoordinatorbinhi');
    Route::post('/BINHI_ProjectCoordinator/Inquriy/show', [BINHIProjectCoordinatorController::class, 'markAsRead'])->name('binhimark.AsRead');
    


    Route::post('/BINHI_ProjectCoordinator/Add Schedule', [BINHIProjectCoordinatorController::class, 'ProjCoordinatorAddSchedule'])->name('binhiadd.schedule');
    Route::patch('/BINHI_ProjectCoordinator/Edit Schedule', [BINHIProjectCoordinatorController::class, 'ProjCoordinatorScheduleUpdate'])->name('binhiedit.schedule');
    Route::delete('/BINHI_ProjectCoordinator/Delete Schedule', [BINHIProjectCoordinatorController::class, 'ProjCoordinatorScheduleDelete'])->name('binhidelete.schedule');

    //Coordinator Progress
    Route::get('/BINHI_ProjectCoordinator/Progress', [BINHIProjectCoordinatorController::class, 'ProjCoordinatorProgress'])->name('binhiprojectcoordinator.progress');
    Route::post('/Project_Coordinator/Project_Page/Add', [BINHIProjectCoordinatorController::class, 'ProjCoordinatorAddProject'])->name('binhiadd.project');
    Route::patch('/BINHI_ProjectCoordinator/Projects', [BINHIProjectCoordinatorController::class, 'ProjCoordinatorUpdateProject'])->name('binhiedit.project');
    Route::delete('/BINHI_ProjectCoordinator/Projects', [BINHIProjectCoordinatorController::class, 'ProjCoordinatorDeleteProject'])->name('binhidelete.project');

    Route::post('/BINHI_ProjectCoordinator/ProgressAdd', [BINHIProjectCoordinatorController::class, 'ProjCoordinatorProgressAdd'])->name('binhiprojectcoordinator.progressAdd');

    Route::post('/BINHI_ProjectCoordinator/ProgressUpdate', [BINHIProjectCoordinatorController::class, 'ProjCoordinatorProgressUpdate'])->name('binhiprojectcoordinator.progressUpdate');

    //Abaka Coordinator View Profile
    Route::get('/BINHI_ProjectCoordinator/viewprofile', [BINHIProjectCoordinatorController::class, 'ProjCoordinatorViewProfile'])->name('binhiprojectcoordinator.viewprofile');

    //Abaka Coordinator Edit Profile Data
    Route::post('/BINHI_ProjectCoordinator/editprofile', [BINHIProjectCoordinatorController::class, 'ProjCoordinatorEditProfile'])->name('binhiprojectcoordinator.editprofile');

    //Abaka Coordinator View Change Password
    Route::get('/BINHI_ProjectCoordinator/viewchangepassword', [BINHIProjectCoordinatorController::class, 'ProjCoordinatorViewChangePassword'])->name('binhiprojectcoordinator.viewchangepassword');

    //Abaka Coordinator Edit Change Password
    Route::post('/BINHI_ProjectCoordinator/editchangepassword', [BINHIProjectCoordinatorController::class, 'ProjCoordinatorEditChangePassword'])->name('binhiprojectcoordinator.editchangepassword');

    //Abaka Coordinator Register View
    Route::get('/BINHI_ProjectCoordinator/registerview', [BINHIProjectCoordinatorController::class, 'ProjCoordinatorRegisterView'])->name('binhiprojectcoordinator.registerView');

    //Abaka Coordinator Edit user status and role
    Route::post('/BINHI_ProjectCoordinator/registeredituser', [BINHIProjectCoordinatorController::class, 'ProjCoordinatorRegisterEditUser'])->name('binhiprojectcoordinator.registerEditUser');

    //Notify all beneficiaries with status
    Route::post('/BINHI_ProjectCoordinator/notify-beneficiaries', [BINHIProjectCoordinatorController::class, 'notifyBeneficiaries']);

    // more routes here for Project Coordinator

}); //End group Project Coordinator middleware

//Project Coordinator AGRIPINAY Group Middleware
Route::middleware(['auth', 'checkuserstatus', 'twofactor', 'userroleprotection:agripinayprojectcoordinator'])->group(function(){
    // middleware named userroleprotection will protect routes to be only accessible by the right user role

    //home
    Route::get('/AGRIPINAY_ProjectCoordinator/home', [AGRIPINAYProjectCoordinatorController::class, 'ProjectCoordinatorHome'])->name('agripinayprojectcoordinator.beneficiaries');

    //ITStaff Logout
    Route::get('/AGRIPINAY_ProjectCoordinator/logout', [AGRIPINAYProjectCoordinatorController::class, 'ProjectCoordinatorLogout'])->name('agripinayprojectCoordinator.logout');

    //blacklist view
    Route::get('/AGRIPINAY_ProjectCoordinator/blacklist', [AGRIPINAYProjectCoordinatorController::class, 'CoordinatorBlacklistView'])->name('agripinayprojectCoordinator.BlacklistView');

    //blacklist a user
    Route::get('/AGRIPINAY_ProjectCoordinator/blacklist/{id}', [AGRIPINAYProjectCoordinatorController::class, 'CoordinatorBlacklistUser'])->name('agripinayprojectCoordinator.BlacklistUser');

    //restore a user
    Route::get('/AGRIPINAY_ProjectCoordinator/restore/{id}', [AGRIPINAYProjectCoordinatorController::class, 'CoordinatorRestoreUser'])->name('agripinayprojectCoordinator.RestoreUser');

    Route::get('/AGRIPINAY_ProjectCoordinator/inquiry', [AGRIPINAYProjectCoordinatorController::class, 'ProjectCoordinatorDashboard'])->name('AGRIPINAY_Project_Coordinator.inquiry');

    //Coordinator Announcements
    Route::get('/AGRIPINAY_ProjectCoordinator/Announcements', [AGRIPINAYProjectCoordinatorController::class, 'ProjCoordinatorAnnouncement'])->name('agripinayprojectcoordinator.announcement');
    Route::post('/AGRIPINAY_ProjectCoordinator/Announcements', [AGRIPINAYProjectCoordinatorController::class, 'ProjCoordinatorAnnouncementStore'])->name('store.announcementcoordinatoragripinay');
    Route::get('/AGRIPINAY_ProjectCoordinator/Announcements/{id}', [AGRIPINAYProjectCoordinatorController::class, 'ProjectCoordinatorAnnouncementEdit'])->name('edit.announcementcoordinatoragripinay');
    Route::patch('/AGRIPINAY_ProjectCoordinator/Announcements', [AGRIPINAYProjectCoordinatorController::class, 'ProjCoordinatorAnnouncementUpdate'])->name('update.announcementcoordinatoragripinay');
    Route::delete('/AGRIPINAY_ProjectCoordinator/Announcements', [AGRIPINAYProjectCoordinatorController::class, 'ProjCoordinatorAnnouncementDelete'])->name('delete.announcementcoordinatoragripinay');

    //Coordinator Events
    Route::get('/AGRIPINAY_ProjectCoordinator/Events', [AGRIPINAYProjectCoordinatorController::class, 'ProjCoordinatorEvent'])->name('agripinayprojectcoordinator.event');
    Route::post('/AGRIPINAY_ProjectCoordinator/Events', [AGRIPINAYProjectCoordinatorController::class, 'ProjCoordinatorEventStore'])->name('store.eventcoordinatoragripinay');
    Route::get('/AGRIPINAY_ProjectCoordinator/Events/{id}', [AGRIPINAYProjectCoordinatorController::class, 'ProjectCoordinatorEventEdit'])->name('edit.eventcoordinatoragripinay');
    Route::patch('/AGRIPINAY_ProjectCoordinator/Events', [AGRIPINAYProjectCoordinatorController::class, 'ProjCoordinatorEventUpdate'])->name('update.eventcoordinatoragripinay');
    Route::delete('/AGRIPINAY_ProjectCoordinator/Events', [AGRIPINAYProjectCoordinatorController::class, 'ProjCoordinatorEventDelete'])->name('delete.eventcoordinatoragripinay');

    //Coordinator Inquiry
    Route::get('/AGRIPINAY_ProjectCoordinator/Inquriy', [AGRIPINAYProjectCoordinatorController::class, 'ProjCoordinatorInquiry'])->name('agripinayprojectcoordinator.inquiry');
    Route::post('/AGRIPINAY_ProjectCoordinator/Inquriy/reply', [AGRIPINAYProjectCoordinatorController::class, 'ProjectCoordinatorInquiryReply'])->name('reply.inquirycoordinatoragripinay');
    Route::delete('/AGRIPINAY_ProjectCoordinator/Inquriy/delete', [AGRIPINAYProjectCoordinatorController::class, 'ProjCoordinatorInquiryDelete'])->name('delete.inquirycoordinatoragripinay');
    Route::post('/AGRIPINAY_ProjectCoordinator/Inquriy/show', [AGRIPINAYProjectCoordinatorController::class, 'markAsRead'])->name('agripinaymark.AsRead');
    


    Route::post('/AGRIPINAY_ProjectCoordinator/Add Schedule', [AGRIPINAYProjectCoordinatorController::class, 'ProjCoordinatorAddSchedule'])->name('agripinayadd.schedule');
    Route::patch('/AGRIPINAY_ProjectCoordinator/Edit Schedule', [AGRIPINAYProjectCoordinatorController::class, 'ProjCoordinatorScheduleUpdate'])->name('agripinayedit.schedule');
    Route::delete('/AGRIPINAY_ProjectCoordinator/Delete Schedule', [AGRIPINAYProjectCoordinatorController::class, 'ProjCoordinatorScheduleDelete'])->name('agripinaydelete.schedule');

    Route::post('/AGRIPINAY_Project_Coordinator/Project_Page/Add', [AGRIPINAYProjectCoordinatorController::class, 'ProjCoordinatorAddProject'])->name('agripinayadd.project');
    Route::patch('/AGRIPINAY_ProjectCoordinator/Projects', [AGRIPINAYProjectCoordinatorController::class, 'ProjCoordinatorUpdateProject'])->name('agripinayedit.project');
    Route::delete('/AGRIPINAY_ProjectCoordinator/Projects', [AGRIPINAYProjectCoordinatorController::class, 'ProjCoordinatorDeleteProject'])->name('agripinaydelete.project');


    //Coordinator Progress
    Route::get('/AGRIPINAY_ProjectCoordinator/Progress', [AGRIPINAYProjectCoordinatorController::class, 'ProjCoordinatorProgress'])->name('agripinayprojectcoordinator.progress');

    Route::post('/AGRIPINAY_ProjectCoordinator/ProgressAdd', [AGRIPINAYProjectCoordinatorController::class, 'ProjCoordinatorProgressAdd'])->name('agripinayprojectcoordinator.progressAdd');

    Route::post('/AGRIPINAY_ProjectCoordinator/ProgressUpdate', [AGRIPINAYProjectCoordinatorController::class, 'ProjCoordinatorProgressUpdate'])->name('agripinayprojectcoordinator.progressUpdate');

    Route::post('/AGRIPINAY_ProjectCoordinator/CurrentLoanUpdate', [AGRIPINAYProjectCoordinatorController::class, 'ProjCoordinatorCurrentLoanUpdate'])->name('agripinayprojectcoordinator.currentLoanUpdate');

    //Repayment
    Route::post('/AGRIPINAY_ProjectCoordinator/ProgressUpdateRepayment', [AGRIPINAYProjectCoordinatorController::class, 'ProjCoordinatorProgressUpdateRepayment'])->name('agripinayprojectcoordinator.progressUpdateRepayment');

    //Repayment Schedule Reminder
    Route::post('/AGRIPINAY_ProjectCoordinator/ProgressLoanReminder/{userId}', [AGRIPINAYProjectCoordinatorController::class, 'ProjCoordinatorProgressLoanReminder'])->name('agripinayprojectcoordinator.progressLoanReminder');

    //Agripinay Coordinator View Profile
    Route::get('/AGRIPINAY_ProjectCoordinator/viewprofile', [AGRIPINAYProjectCoordinatorController::class, 'ProjCoordinatorViewProfile'])->name('agripinayprojectcoordinator.viewprofile');

    //Agripinay Coordinator Edit Profile Data
    Route::post('/AGRIPINAY_ProjectCoordinator/editprofile', [AGRIPINAYProjectCoordinatorController::class, 'ProjCoordinatorEditProfile'])->name('agripinayprojectcoordinator.editprofile');

    //Agripinay Coordinator View Change Password
    Route::get('/AGRIPINAY_ProjectCoordinator/viewchangepassword', [AGRIPINAYProjectCoordinatorController::class, 'ProjCoordinatorViewChangePassword'])->name('agripinayprojectcoordinator.viewchangepassword');

    //Agripinay Coordinator Edit Change Password
    Route::post('/AGRIPINAY_ProjectCoordinator/editchangepassword', [AGRIPINAYProjectCoordinatorController::class, 'ProjCoordinatorEditChangePassword'])->name('agripinayprojectcoordinator.editchangepassword');

    //Agripinay Coordinator Register View
    Route::get('/AGRIPINAY_ProjectCoordinator/registerview', [AGRIPINAYProjectCoordinatorController::class, 'ProjCoordinatorRegisterView'])->name('agripinayprojectcoordinator.registerView');

    //Agripinay Coordinator Edit user status and role
    Route::post('/AGRIPINAY_ProjectCoordinator/registeredituser', [AGRIPINAYProjectCoordinatorController::class, 'ProjCoordinatorRegisterEditUser'])->name('agripinayprojectcoordinator.registerEditUser');

    //Notify all beneficiaries with status
    Route::post('/AGRIPINAY_ProjectCoordinator/notify-beneficiaries', [AGRIPINAYProjectCoordinatorController::class, 'notifyBeneficiaries']);

    // more routes here for Project Coordinator

}); //End group Project Coordinator middleware

//Project Coordinator AKBAY Group Middleware
Route::middleware(['auth', 'checkuserstatus', 'twofactor', 'userroleprotection:akbayprojectcoordinator'])->group(function(){
    // middleware named userroleprotection will protect routes to be only accessible by the right user role

    //home
    Route::get('/AKBAY_ProjectCoordinator/home', [AKBAYProjectCoordinatorController::class, 'ProjectCoordinatorHome'])->name('akbayprojectcoordinator.beneficiaries');

    //Coordinator Logout
    Route::get('/AKBAY_ProjectCoordinator/logout', [AKBAYProjectCoordinatorController::class, 'ProjectCoordinatorLogout'])->name('akbayprojectCoordinator.logout');

    //blacklist view
    Route::get('/AKBAY_ProjectCoordinator/blacklist', [AKBAYProjectCoordinatorController::class, 'CoordinatorBlacklistView'])->name('akbayprojectCoordinator.BlacklistView');

    //blacklist a user
    Route::get('/AKBAY_ProjectCoordinator/blacklist/{id}', [AKBAYProjectCoordinatorController::class, 'CoordinatorBlacklistUser'])->name('akbayprojectCoordinator.BlacklistUser');

    //restore a user
    Route::get('/AKBAY_ProjectCoordinator/restore/{id}', [AKBAYProjectCoordinatorController::class, 'CoordinatorRestoreUser'])->name('akbayprojectCoordinator.RestoreUser');

    Route::get('/AKBAY_ProjectCoordinator/inquiry', [AKBAYProjectCoordinatorController::class, 'ProjectCoordinatorDashboard'])->name('AKBAY_Project_Coordinator.inquiry');

    //Coordinator Announcements
    Route::get('/AKBAY_ProjectCoordinator/Announcements', [AKBAYProjectCoordinatorController::class, 'ProjCoordinatorAnnouncement'])->name('akbayprojectcoordinator.announcement');
    Route::post('/AKBAY_ProjectCoordinator/Announcements', [AKBAYProjectCoordinatorController::class, 'ProjCoordinatorAnnouncementStore'])->name('store.announcementcoordinatorakbay');
    Route::get('/AKBAY_ProjectCoordinator/Announcements/{id}', [AKBAYProjectCoordinatorController::class, 'ProjectCoordinatorAnnouncementEdit'])->name('edit.announcementcoordinatorakbay');
    Route::patch('/AKBAY_ProjectCoordinator/Announcements', [AKBAYProjectCoordinatorController::class, 'ProjCoordinatorAnnouncementUpdate'])->name('update.announcementcoordinatorakbay');
    Route::delete('/AKBAY_ProjectCoordinator/Announcements', [AKBAYProjectCoordinatorController::class, 'ProjCoordinatorAnnouncementDelete'])->name('delete.announcementcoordinatorakbay');

    //Coordinator Events
    Route::get('/AKBAY_ProjectCoordinator/Events', [AKBAYProjectCoordinatorController::class, 'ProjCoordinatorEvent'])->name('akbayprojectcoordinator.event');
    Route::post('/AKBAY_ProjectCoordinator/Events', [AKBAYProjectCoordinatorController::class, 'ProjCoordinatorEventStore'])->name('store.eventcoordinatorakbay');
    Route::get('/AKBAY_ProjectCoordinator/Events/{id}', [AKBAYProjectCoordinatorController::class, 'ProjectCoordinatorEventEdit'])->name('edit.eventcoordinatorakbay');
    Route::patch('/AKBAY_ProjectCoordinator/Events', [AKBAYProjectCoordinatorController::class, 'ProjCoordinatorEventUpdate'])->name('update.eventcoordinatorakbay');
    Route::delete('/AKBAY_ProjectCoordinator/Events', [AKBAYProjectCoordinatorController::class, 'ProjCoordinatorEventDelete'])->name('delete.eventcoordinatorakbay');

    //Coordinator Inquiry
    Route::get('/AKBAY_ProjectCoordinator/Inquriy', [AKBAYProjectCoordinatorController::class, 'ProjCoordinatorInquiry'])->name('akbayprojectcoordinator.inquiry');
    Route::post('/AKBAY_ProjectCoordinator/Inquriy/reply', [AKBAYProjectCoordinatorController::class, 'ProjectCoordinatorInquiryReply'])->name('reply.inquirycoordinatorakbay');
    Route::delete('/AKBAY_ProjectCoordinator/Inquriy/delete', [AKBAYProjectCoordinatorController::class, 'ProjCoordinatorInquiryDelete'])->name('delete.inquirycoordinatorakbay');
    Route::post('/AKBAY_ProjectCoordinator/Inquriy/show', [AKBAYProjectCoordinatorController::class, 'markAsRead'])->name('akbaymark.AsRead');
    


    Route::post('/AKBAY_ProjectCoordinator/Add Schedule', [AKBAYProjectCoordinatorController::class, 'ProjCoordinatorAddSchedule'])->name('akbayadd.schedule');
    Route::patch('/AKBAY_ProjectCoordinator/Edit Schedule', [AKBAYProjectCoordinatorController::class, 'ProjCoordinatorScheduleUpdate'])->name('akbayedit.schedule');
    Route::delete('/AKBAY_ProjectCoordinator/Delete Schedule', [AKBAYProjectCoordinatorController::class, 'ProjCoordinatorScheduleDelete'])->name('akbaydelete.schedule');

    Route::post('/AKBAY_Project_Coordinator/Project_Page/Add', [AKBAYProjectCoordinatorController::class, 'ProjCoordinatorAddProject'])->name('akbayadd.project');
    Route::patch('/AKBAY_ProjectCoordinator/Projects', [AKBAYProjectCoordinatorController::class, 'ProjCoordinatorUpdateProject'])->name('akbayedit.project');
    Route::delete('/AKBAY_ProjectCoordinator/Projects', [AKBAYProjectCoordinatorController::class, 'ProjCoordinatorDeleteProject'])->name('akbaydelete.project');


    //Coordinator Progress
    Route::get('/AKBAY_ProjectCoordinator/Progress', [AKBAYProjectCoordinatorController::class, 'ProjCoordinatorProgress'])->name('akbayprojectcoordinator.progress');

    Route::post('/AKBAY_ProjectCoordinator/ProgressAdd', [AKBAYProjectCoordinatorController::class, 'ProjCoordinatorProgressAdd'])->name('akbayprojectcoordinator.progressAdd');

    Route::post('/AKBAY_ProjectCoordinator/ProgressUpdate', [AKBAYProjectCoordinatorController::class, 'ProjCoordinatorProgressUpdate'])->name('akbayprojectcoordinator.progressUpdate');

    Route::post('/AKBAY_ProjectCoordinator/CurrentLoanUpdate', [AKBAYProjectCoordinatorController::class, 'ProjCoordinatorCurrentLoanUpdate'])->name('akbayprojectcoordinator.currentLoanUpdate');

    //Repayment
    Route::post('/AKBAY_ProjectCoordinator/ProgressUpdateRepayment', [AKBAYProjectCoordinatorController::class, 'ProjCoordinatorProgressUpdateRepayment'])->name('akbayprojectcoordinator.progressUpdateRepayment');

    //Repayment Schedule Reminder
    Route::post('/AKBAY_ProjectCoordinator/ProgressLoanReminder/{userId}', [AKBAYProjectCoordinatorController::class, 'ProjCoordinatorProgressLoanReminder'])->name('akbayprojectcoordinator.progressLoanReminder');

    //Akbay Coordinator View Profile
    Route::get('/AKBAY_ProjectCoordinator/viewprofile', [AKBAYProjectCoordinatorController::class, 'ProjCoordinatorViewProfile'])->name('akbayprojectcoordinator.viewprofile');

    //Akbay Coordinator Edit Profile Data
    Route::post('/AKBAY_ProjectCoordinator/editprofile', [AKBAYProjectCoordinatorController::class, 'ProjCoordinatorEditProfile'])->name('akbayprojectcoordinator.editprofile');

    //Akbay Coordinator View Change Password
    Route::get('/AKBAY_ProjectCoordinator/viewchangepassword', [AKBAYProjectCoordinatorController::class, 'ProjCoordinatorViewChangePassword'])->name('akbayprojectcoordinator.viewchangepassword');

    //Akbay Coordinator Edit Change Password
    Route::post('/AKBAY_ProjectCoordinator/editchangepassword', [AKBAYProjectCoordinatorController::class, 'ProjCoordinatorEditChangePassword'])->name('akbayprojectcoordinator.editchangepassword');

    //Akbay Coordinator Register View
    Route::get('/AKBAY_ProjectCoordinator/registerview', [AKBAYProjectCoordinatorController::class, 'ProjCoordinatorRegisterView'])->name('akbayprojectcoordinator.registerView');

    //Akbay Coordinator Edit user status and role
    Route::post('/AKBAY_ProjectCoordinator/registeredituser', [AKBAYProjectCoordinatorController::class, 'ProjCoordinatorRegisterEditUser'])->name('akbayprojectcoordinator.registerEditUser');

    //Notify all beneficiaries with status
    Route::post('/AKBAY_ProjectCoordinator/notify-beneficiaries', [AKBAYProjectCoordinatorController::class, 'notifyBeneficiaries']);

    // more routes here for Project Coordinator

}); //End group Project Coordinator middleware

//Project Coordinator LEAD Group Middleware
Route::middleware(['auth', 'checkuserstatus', 'twofactor', 'userroleprotection:leadprojectcoordinator'])->group(function(){
    // middleware named userroleprotection will protect routes to be only accessible by the right user role

    //home
    Route::get('/LEAD_ProjectCoordinator/home', [LEADProjectCoordinatorController::class, 'ProjectCoordinatorHome'])->name('leadprojectcoordinator.beneficiaries');

    //ITStaff Logout
    Route::get('/LEAD_ProjectCoordinator/logout', [LEADProjectCoordinatorController::class, 'ProjectCoordinatorLogout'])->name('leadprojectCoordinator.logout');

    //blacklist view
    Route::get('/LEAD_ProjectCoordinator/blacklist', [LEADProjectCoordinatorController::class, 'CoordinatorBlacklistView'])->name('leadprojectCoordinator.BlacklistView');

    //blacklist a user
    Route::get('/LEAD_ProjectCoordinator/blacklist/{id}', [LEADProjectCoordinatorController::class, 'CoordinatorBlacklistUser'])->name('leadprojectCoordinator.BlacklistUser');

    //restore a user
    Route::get('/LEAD_ProjectCoordinator/restore/{id}', [LEADProjectCoordinatorController::class, 'CoordinatorRestoreUser'])->name('leadprojectCoordinator.RestoreUser');

    Route::get('/LEAD_ProjectCoordinator/inquiry', [LEADProjectCoordinatorController::class, 'ProjectCoordinatorDashboard'])->name('LEAD_Project_Coordinator.inquiry');

    //Coordinator Announcements
    Route::get('/LEAD_ProjectCoordinator/Announcements', [LEADProjectCoordinatorController::class, 'ProjCoordinatorAnnouncement'])->name('leadprojectcoordinator.announcement');
    Route::post('/LEAD_ProjectCoordinator/Announcements', [LEADProjectCoordinatorController::class, 'ProjCoordinatorAnnouncementStore'])->name('store.announcementcoordinatorlead');
    Route::get('/LEAD_ProjectCoordinator/Announcements/{id}', [LEADProjectCoordinatorController::class, 'ProjectCoordinatorAnnouncementEdit'])->name('edit.announcementcoordinatorlead');
    Route::patch('/LEAD_ProjectCoordinator/Announcements', [LEADProjectCoordinatorController::class, 'ProjCoordinatorAnnouncementUpdate'])->name('update.announcementcoordinatorlead');
    Route::delete('/LEAD_ProjectCoordinator/Announcements', [LEADProjectCoordinatorController::class, 'ProjCoordinatorAnnouncementDelete'])->name('delete.announcementcoordinatorlead');

    //Coordinator Events
    Route::get('/LEAD_ProjectCoordinator/Events', [LEADProjectCoordinatorController::class, 'ProjCoordinatorEvent'])->name('leadprojectcoordinator.event');
    Route::post('/LEAD_ProjectCoordinator/Events', [LEADProjectCoordinatorController::class, 'ProjCoordinatorEventStore'])->name('store.eventcoordinatorlead');
    Route::get('/LEAD_ProjectCoordinator/Events/{id}', [LEADProjectCoordinatorController::class, 'ProjectCoordinatorEventEdit'])->name('edit.eventcoordinatorlead');
    Route::patch('/LEAD_ProjectCoordinator/Events', [LEADProjectCoordinatorController::class, 'ProjCoordinatorEventUpdate'])->name('update.eventcoordinatorlead');
    Route::delete('/LEAD_ProjectCoordinator/Events', [LEADProjectCoordinatorController::class, 'ProjCoordinatorEventDelete'])->name('delete.eventcoordinatorlead');

    //Coordinator Inquiry
    Route::get('/LEAD_ProjectCoordinator/Inquriy', [LEADProjectCoordinatorController::class, 'ProjCoordinatorInquiry'])->name('leadprojectcoordinator.inquiry');
    Route::post('/LEAD_ProjectCoordinator/Inquriy/reply', [LEADProjectCoordinatorController::class, 'ProjectCoordinatorInquiryReply'])->name('reply.inquirycoordinatorlead');
    Route::delete('/LEAD_ProjectCoordinator/Inquriy/delete', [LEADProjectCoordinatorController::class, 'ProjCoordinatorInquiryDelete'])->name('delete.inquirycoordinatorlead');
    Route::post('/LEAD_ProjectCoordinator/Inquriy/show', [LEADProjectCoordinatorController::class, 'markAsRead'])->name('leadmark.AsRead');
    


    Route::post('/LEAD_ProjectCoordinator/Add Schedule', [LEADProjectCoordinatorController::class, 'ProjCoordinatorAddSchedule'])->name('leadadd.schedule');
    Route::patch('/LEAD_ProjectCoordinator/Edit Schedule', [LEADProjectCoordinatorController::class, 'ProjCoordinatorScheduleUpdate'])->name('leadedit.schedule');
    Route::delete('/LEAD_ProjectCoordinator/Delete Schedule', [LEADProjectCoordinatorController::class, 'ProjCoordinatorScheduleDelete'])->name('leaddelete.schedule');

    Route::post('/LEAD_Project_Coordinator/Project_Page/Add', [LEADProjectCoordinatorController::class, 'ProjCoordinatorAddProject'])->name('leadadd.project');
    Route::patch('/LEAD_ProjectCoordinator/Projects', [LEADProjectCoordinatorController::class, 'ProjCoordinatorUpdateProject'])->name('leadedit.project');
    Route::delete('/LEAD_ProjectCoordinator/Projects', [LEADProjectCoordinatorController::class, 'ProjCoordinatorDeleteProject'])->name('leaddelete.project');


    //Coordinator Progress
    Route::get('/LEAD_ProjectCoordinator/Progress', [LEADProjectCoordinatorController::class, 'ProjCoordinatorProgress'])->name('leadprojectcoordinator.progress');

    Route::post('/LEAD_ProjectCoordinator/ProgressAdd', [LEADProjectCoordinatorController::class, 'ProjCoordinatorProgressAdd'])->name('leadprojectcoordinator.progressAdd');

    Route::post('/LEAD_ProjectCoordinator/ProgressUpdate', [LEADProjectCoordinatorController::class, 'ProjCoordinatorProgressUpdate'])->name('leadprojectcoordinator.progressUpdate');

    Route::post('/LEAD_ProjectCoordinator/CurrentLoanUpdate', [LEADProjectCoordinatorController::class, 'ProjCoordinatorCurrentLoanUpdate'])->name('leadprojectcoordinator.currentLoanUpdate');

    //Repayment
    Route::post('/LEAD_ProjectCoordinator/ProgressUpdateRepayment', [LEADProjectCoordinatorController::class, 'ProjCoordinatorProgressUpdateRepayment'])->name('leadprojectcoordinator.progressUpdateRepayment');

    //Repayment Schedule Reminder
    Route::post('/LEAD_ProjectCoordinator/ProgressLoanReminder/{userId}', [LEADProjectCoordinatorController::class, 'ProjCoordinatorProgressLoanReminder'])->name('leadprojectcoordinator.progressLoanReminder');

    //Agripinay Coordinator View Profile
    Route::get('/LEAD_ProjectCoordinator/viewprofile', [LEADProjectCoordinatorController::class, 'ProjCoordinatorViewProfile'])->name('leadprojectcoordinator.viewprofile');

    //Agripinay Coordinator Edit Profile Data
    Route::post('/LEAD_ProjectCoordinator/editprofile', [LEADProjectCoordinatorController::class, 'ProjCoordinatorEditProfile'])->name('leadprojectcoordinator.editprofile');

    //Agripinay Coordinator View Change Password
    Route::get('/LEAD_ProjectCoordinator/viewchangepassword', [LEADProjectCoordinatorController::class, 'ProjCoordinatorViewChangePassword'])->name('leadprojectcoordinator.viewchangepassword');

    //Agripinay Coordinator Edit Change Password
    Route::post('/LEAD_ProjectCoordinator/editchangepassword', [LEADProjectCoordinatorController::class, 'ProjCoordinatorEditChangePassword'])->name('leadprojectcoordinator.editchangepassword');

    //Agripinay Coordinator Register View
    Route::get('/LEAD_ProjectCoordinator/registerview', [LEADProjectCoordinatorController::class, 'ProjCoordinatorRegisterView'])->name('leadprojectcoordinator.registerView');

    //Agripinay Coordinator Edit user status and role
    Route::post('/LEAD_ProjectCoordinator/registeredituser', [LEADProjectCoordinatorController::class, 'ProjCoordinatorRegisterEditUser'])->name('leadprojectcoordinator.registerEditUser');

    //Notify all beneficiaries with status
    Route::post('/LEAD_ProjectCoordinator/notify-beneficiaries', [LEADProjectCoordinatorController::class, 'notifyBeneficiaries']);

    // more routes here for Project Coordinator

}); //End group Project Coordinator middleware

//Project Coordinator ABAKA Group Middleware
Route::middleware(['auth', 'checkuserstatus', 'twofactor', 'userroleprotection:abakaprojectcoordinator'])->group(function(){
    // middleware named userroleprotection will protect routes to be only accessible by the right user role

    //Coordinator Home Page
    Route::get('/ABAKA_ProjectCoordinator/home', [ABAKAProjectCoordinatorController::class, 'ProjectCoordinatorHome'])->name('abakaprojectcoordinator.beneficiaries');
    Route::post('/ABAKA_ProjectCoordinator/home', [ABAKAProjectCoordinatorController::class, 'ProjectCoordinatorHome'])->name('benef.email');

    //Coordinator Logout
    Route::get('/ABAKA_ProjectCoordinator/logout', [ABAKAProjectCoordinatorController::class, 'ProjectCoordinatorLogout'])->name('abakaprojectCoordinator.logout');

   // Route::get('/ABAKA_ProjectCoordinator/inquiry/check-read-status/{inquiryId}', [ABAKAProjectCoordinatorController::class, 'checkReadStatus'])
    //->name('ABAKA_Project_Coordinator.inquiry.checkReadStatus');

    //Coordinator Announcements
    Route::get('/ABAKA_ProjectCoordinator/Announcements', [ABAKAProjectCoordinatorController::class, 'ProjCoordinatorAnnouncement'])->name('abakaprojectcoordinator.announcement');
    Route::post('/ABAKA_ProjectCoordinator/Announcements', [ABAKAProjectCoordinatorController::class, 'ProjCoordinatorAnnouncementStore'])->name('store.announcementcoordinatorabaka');
    Route::get('/ABAKA_ProjectCoordinator/Announcements/{id}', [ABAKAProjectCoordinatorController::class, 'ProjectCoordinatorAnnouncementEdit'])->name('edit.announcementcoordinatorabaka');
    Route::patch('/ABAKA_ProjectCoordinator/Announcements', [ABAKAProjectCoordinatorController::class, 'ProjCoordinatorAnnouncementUpdate'])->name('update.announcementcoordinatorabaka');
    Route::delete('/ABAKA_ProjectCoordinator/Announcements', [ABAKAProjectCoordinatorController::class, 'ProjCoordinatorAnnouncementDelete'])->name('delete.announcementcoordinatorabaka');

    //blacklist view
    Route::get('/ABAKA_ProjectCoordinator/blacklist', [ABAKAProjectCoordinatorController::class, 'CoordinatorBlacklistView'])->name('abakaprojectcoordinator.BlacklistView');

    //blacklist a user
    Route::get('/ABAKA_ProjectCoordinator/blacklist/{id}', [ABAKAProjectCoordinatorController::class, 'CoordinatorBlacklistUser'])->name('abakaprojectcoordinator.BlacklistUser');

    //restore a user
    Route::get('/ABAKA_ProjectCoordinator/restore/{id}', [ABAKAProjectCoordinatorController::class, 'CoordinatorRestoreUser'])->name('abakaprojectcoordinator.RestoreUser');

    //Coordinator Events
    Route::get('/ABAKA_ProjectCoordinator/Events', [ABAKAProjectCoordinatorController::class, 'ProjCoordinatorEvent'])->name('abakaprojectcoordinator.event');
    Route::post('/ABAKA_ProjectCoordinator/Events', [ABAKAProjectCoordinatorController::class, 'ProjCoordinatorEventStore'])->name('store.eventcoordinatorabaka');
    Route::get('/ABAKA_ProjectCoordinator/Events/{id}', [ABAKAProjectCoordinatorController::class, 'ProjectCoordinatorEventEdit'])->name('edit.eventcoordinatorabaka');
    Route::patch('/ABAKA_ProjectCoordinator/Events', [ABAKAProjectCoordinatorController::class, 'ProjCoordinatorEventUpdate'])->name('update.eventcoordinatorabaka');
    Route::delete('/ABAKA_ProjectCoordinator/Events', [ABAKAProjectCoordinatorController::class, 'ProjCoordinatorEventDelete'])->name('delete.eventcoordinatorabaka');

    //Coordinator Inquiry
    Route::get('/ABAKA_ProjectCoordinator/Inquriy', [ABAKAProjectCoordinatorController::class, 'ProjCoordinatorInquiry'])->name('abakaprojectcoordinator.inquiry');
    Route::post('/ABAKA_ProjectCoordinator/Inquriy/reply', [ABAKAProjectCoordinatorController::class, 'ProjectCoordinatorInquiryReply'])->name('reply.inquirycoordinatorabaka');
    Route::delete('/ABAKA_ProjectCoordinator/Inquriy/delete', [ABAKAProjectCoordinatorController::class, 'ProjCoordinatorInquiryDelete'])->name('delete.inquirycoordinatorabaka');
    Route::post('/ABAKA_ProjectCoordinator/Inquriy/show', [ABAKAProjectCoordinatorController::class, 'markAsRead'])->name('mark.AsRead');
    


    Route::post('/ABAKA_ProjectCoordinator/Add Schedule', [ABAKAProjectCoordinatorController::class, 'ProjCoordinatorAddSchedule'])->name('add.schedule');
    Route::patch('/ABAKA_ProjectCoordinator/Edit Schedule', [ABAKAProjectCoordinatorController::class, 'ProjCoordinatorScheduleUpdate'])->name('edit.schedule');
    Route::delete('/ABAKA_ProjectCoordinator/Delete Schedule', [ABAKAProjectCoordinatorController::class, 'ProjCoordinatorScheduleDelete'])->name('delete.schedule');

    //Coordinator Progress
    Route::get('/ABAKA_ProjectCoordinator/Progress', [ABAKAProjectCoordinatorController::class, 'ProjCoordinatorProgress'])->name('abakaprojectcoordinator.progress');
    Route::post('/Project_Coordinator/Project_Page/Add', [ABAKAProjectCoordinatorController::class, 'ProjCoordinatorAddProject'])->name('add.project');
    Route::patch('/ABAKA_ProjectCoordinator/Projects', [ABAKAProjectCoordinatorController::class, 'ProjCoordinatorUpdateProject'])->name('edit.project');
    Route::delete('/ABAKA_ProjectCoordinator/Projects', [ABAKAProjectCoordinatorController::class, 'ProjCoordinatorDeleteProject'])->name('delete.project');

    Route::post('/ABAKA_ProjectCoordinator/ProgressAdd', [ABAKAProjectCoordinatorController::class, 'ProjCoordinatorProgressAdd'])->name('abakaprojectcoordinator.progressAdd');

    Route::post('/ABAKA_ProjectCoordinator/ProgressUpdate', [ABAKAProjectCoordinatorController::class, 'ProjCoordinatorProgressUpdate'])->name('abakaprojectcoordinator.progressUpdate');

    //Abaka Coordinator View Profile
    Route::get('/ABAKA_ProjectCoordinator/viewprofile', [ABAKAProjectCoordinatorController::class, 'ProjCoordinatorViewProfile'])->name('abakaprojectcoordinator.viewprofile');

    //Abaka Coordinator Edit Profile Data
    Route::post('/ABAKA_ProjectCoordinator/editprofile', [ABAKAProjectCoordinatorController::class, 'ProjCoordinatorEditProfile'])->name('abakaprojectcoordinator.editprofile');

    //Abaka Coordinator View Change Password
    Route::get('/ABAKA_ProjectCoordinator/viewchangepassword', [ABAKAProjectCoordinatorController::class, 'ProjCoordinatorViewChangePassword'])->name('abakaprojectcoordinator.viewchangepassword');

    //Abaka Coordinator Edit Change Password
    Route::post('/ABAKA_ProjectCoordinator/editchangepassword', [ABAKAProjectCoordinatorController::class, 'ProjCoordinatorEditChangePassword'])->name('abakaprojectcoordinator.editchangepassword');

    //Abaka Coordinator Register View
    Route::get('/ABAKA_ProjectCoordinator/registerview', [ABAKAProjectCoordinatorController::class, 'ProjCoordinatorRegisterView'])->name('abakaprojectcoordinator.registerView');

    //Abaka Coordinator Edit user status and role
    Route::post('/ABAKA_ProjectCoordinator/registeredituser', [ABAKAProjectCoordinatorController::class, 'ProjCoordinatorRegisterEditUser'])->name('abakaprojectcoordinator.registerEditUser');

    //Notify all beneficiaries with status
    Route::post('/ABAKA_ProjectCoordinator/notify-beneficiaries', [ABAKAProjectCoordinatorController::class, 'notifyBeneficiaries']);

    // more routes here for Project Coordinator

}); //End group Project Coordinator middleware

//Beneficiary Group Middleware
Route::middleware(['auth', 'checkuserstatus', 'twofactor', 'userroleprotection:beneficiary'])->group(function(){
    // middleware named userroleprotection will protect routes to be only accessible by the right user role

    //Benef Logout
    Route::get('/Beneficiary/logout', [BeneficiaryController::class, 'BeneficiaryLogout'])->name('beneficiary.logout');

    //Benef Home Page
    Route::get('/Beneficiary/home', [BeneficiaryController::class, 'BeneficiaryHome'])->name('beneficiary.home');
    Route::get('/Beneficiary/notifications', [BeneficiaryController::class, 'BenefNotif'])->name('markAsRead');
    
    //Benef Updates
    Route::get('/Beneficiary/updates', [BeneficiaryController::class, 'BeneficiaryUpdates'])->name('beneficiary.updates');
    Route::get('/Beneficiary/updates/details', [BeneficiaryController::class, 'BeneficiaryUpdatesDetails'])->name('updates.details');
    Route::post('/Beneficiary/updates', [BeneficiaryController::class, 'BeneficiaryUpdateStore'])->name('send.updates');
    Route::patch('/Beneficiary/updates/edit', [BeneficiaryController::class, 'BeneficiaryUpdateUpdate'])->name('edit.updates');

    //Benef Schedule
    Route::get('/Beneficiary/schedule', [BeneficiaryController::class, 'BeneficiarySchedule'])->name('beneficiary.schedule');
    Route::get('/Beneficiary/schedule/MarkAsRead', [BeneficiaryController::class, 'BeneficiarySchedule'])->name('schedule.benef');
    Route::get('/get-scheduled-dates', [BeneficiaryController::class, 'getScheduledDates']);
   
    //Benef Program Profile
    Route::get('/Beneficiary/programprofile', [BeneficiaryController::class, 'BeneficiaryProgramprofile'])->name('beneficiaryprogram.profile');

    //Benef Inquiry
    Route::get('/Beneficiary/Inquiry', [BeneficiaryController::class, 'BeneficiaryInquiry'])->name('beneficiary.inquiry');
    Route::post('/Beneficiary/Inquiry', [BeneficiaryController::class, 'BeneficiaryInquiryStore'])->name('beneficiary.inquiries');

    //Benef View Profile
    Route::get('/Beneficiary/viewprofile', [BeneficiaryController::class, 'BeneficiaryViewProfile'])->name('beneficiary.viewprofile');

    //Benef Edit Profile Data
    Route::post('/Beneficiary/editprofile', [BeneficiaryController::class, 'BeneficiaryEditProfile'])->name('beneficiary.editprofile');

    //Benef View Change Password
    Route::get('/Beneficiary/viewchangepassword', [BeneficiaryController::class, 'BeneficiaryViewChangePassword'])->name('beneficiary.viewchangepassword');

    //Benef Edit Change Password
    Route::post('/Beneficiary/editchangepassword', [BeneficiaryController::class, 'BeneficiaryEditChangePassword'])->name('beneficiary.editchangepassword');

    // more routes here for beneficiary

}); //End group beneficiary middleware

//Visitor Routes
Route::get('/', [VisitorController::class, 'VisitorHome'])->name('visitor.home');
Route::post('/Visitor/Inquiry', [VisitorController::class, 'VisitorInquiryStore'])->name('visitor.inquiry');
Route::post('/Visitor/Inquiry/ProgramPage', [VisitorController::class, 'VisitorInquiryStore'])->name('specificinquiry.send');

//resend two factor code route
Route::get('verify/resend', [TwoFactorController::class, 'resend'])->name('verify.resend');

Route::get('verify/index', [TwoFactorController::class, 'index'])->name('verify.index');

Route::post('verify/store', [TwoFactorController::class, 'store'])->name('verify.store');


Route::get('/Visitor/contacts', function () {
    return view('Visitor.contacts');
});

Route::get('/Visitor/programs', function () {
    return view('Visitor.programs');
});

Route::get('/Visitor/programs_view/{id}', [VisitorController::class, 'visitorProgramsView'])->name('visitor.programsView');


Route::get('/Visitor/about', function () {
    return view('Visitor.about');
});

Route::get('/Visitor/category_page/{category}', function ($category) {
    // You can pass the $category variable to the view or use it to fetch category information from the database
    return view('Visitor.category_page', compact('category'));
})->name('Visitor.category.page');

//send sms
Route::get('/sendsms', [SmsController::class, 'sendsms']);

//registerView
// route::post('/ITStaff/registerView', [RegisterViewController::class, 'store'])->name('store-registerView');

Route::get('/Project_Coordinator/inquiry', function () {
    return view('Project_Coordinator.inquiry');
});

Route::get('/Project_Coordinator/beneficiary', function () {
    return view('Project_Coordinator.beneficiary');
});

Route::get('/Project_Coordinator/announcement', function () {
    return view('Project_Coordinator.announcement');
});

Route::get('/Project_Coordinator/event', function () {
    return view('Project_Coordinator.event');
});

Route::get('/Project_Coordinator/registration', function () {
    return view('Project_Coordinator.registration');
});

Route::get('/Project_Coordinator/progress', function () {
    return view('Project_Coordinator.progress');
});

Route::get('/Project_Coordinator/profile', function () {
    return view('Project_Coordinator.profile');
});

Route::get('/Project_Coordinator/pass', function () {
    return view('Project_Coordinator.pass');
});



Route::get('/Beneficiary/benefprofile', function () {
    return view('Beneficiary.benefprofile');
});

Route::get('/Beneficiary/benefpass', function () {
    return view('Beneficiary.benefpass');
});



