<?php
 
   
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\backend\InquiryController;
use App\Http\Controllers\backend\RegistrationController;
use App\Http\Controllers\backend\StudentRegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AddVehical;
use App\Http\Controllers\backend\FeesTypesMasterController;
use App\Http\Controllers\BusStaff;
use App\Http\Controllers\Challa;
use App\Http\Controllers\StudentMaster;
use App\Http\Controllers\partycontroller;
use App\Http\Controllers\RTOpaper;
use App\Http\Controllers\RtopaperController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\NatureofworkController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\BusFees;
use App\Http\Controllers\LateFeesLimit;
use App\Http\Controllers\LateFeesMasterController;
use App\Http\Controllers\CourseFees;
use App\Http\Controllers\RouteMaster;
use App\Http\Controllers\Refundvoucher;
use App\Http\Controllers\FeestypemasterController;
use App\Http\Controllers\BusfeesmasterController;
use App\Http\Controllers\backend\InquiryEntryController;
use App\Http\Controllers\backend\ResumeController;
use App\Http\Controllers\backend\BusstopController;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\backend\MasterRegistrationController;
use App\Http\Controllers\backend\MaintenanceController;
use App\Http\Controllers\backend\RouteController;
use App\Http\Controllers\backend\AreaController;
use App\Http\Controllers\backend\Course_fees_head_orders;
use App\Http\Controllers\backend\CourseFeesStructureMaster;
use App\Http\Controllers\feesregisterController;
use App\Http\Controllers\FeesMasterStudentController;
use App\Http\Controllers\ExamMasterController;
use App\Http\Controllers\MonthController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\AssignSubjectController;
use App\Http\Controllers\TeacherSubjectController;
use App\Http\Controllers\AttandenceController;
use App\Http\Controllers\AttandenceReportsController;
use App\Http\Controllers\StudentAttendReportController;
use App\Http\Controllers\DailyAttandanceController;
use App\Http\Controllers\PrimaryGrupController;
use App\Http\Controllers\GrupController;
use App\Http\Controllers\HeadController;
use App\Http\Controllers\SubHeadController;
use App\Http\Controllers\GreadingMasterController;
use App\Http\Controllers\StreamController;
// use App\Http\Controllers\PrimaryGrupController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\RemarksController;
use App\Http\Controllers\DefaultersListController;
use App\Http\Controllers\SubjectCombinationController;
use App\Http\Controllers\GradesController;

use App\Http\Controllers\EnquiryReciptController;

use App\Http\Controllers\TeacherBusAssignController;
use App\Http\Controllers\backend\ScholarbusassignController;
use App\Http\Controllers\backend\FeesDuechart;
use App\Http\Controllers\MobileController;
use App\Http\Controllers\backend\FeesreceiptchallanController;
use App\Http\Controllers\CSVController;
use App\Http\Controllers\StudentAttandanceController;
use App\Http\Controllers\ClassAssignTeacher;
use App\Http\Controllers\backend\BusdataController;
use App\Http\Controllers\backend\FeesPaymentController;
use App\Http\Controllers\backend\DownloadFileController;
use App\Http\Controllers\map\MapController;
use App\Http\Controllers\student\StudentPanelController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\backend\SessionController;
use App\Http\Controllers\Changepassword;
use App\Http\Controllers\ExamtypeController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\Fees_Onlyparents_Controller;
use App\Http\Controllers\MarksheetController;
use App\Http\Controllers\MarksController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\HolidaysController;
use App\Http\Controllers\SalariesController;
use App\Http\Controllers\LeaverequestsController;
use App\Http\Controllers\RazorpayPaymentController;
use App\Http\Controllers\UserPermissionController;
use App\Http\Controllers\EnquiryListdataController;
use App\Http\Controllers\backend\CollectionController;
use App\Http\Controllers\McqController;

use App\Http\Controllers\PublicController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// PublicController
// Route::get('/public-page', '@index')->name('public.page');
// Route::get('/public-page', 'PublicController@index')->name('public.page');
Route::get('/public-page', [PublicController::class,'index']);
Route::get('/get-student-details', [PublicController::class, 'getStudentDetails'])->name('getStudentDetails');
Route::post('save_feesreceipt_challan_public', [FeesreceiptchallanController::class, 'save_feesreceipt_challan_public']);
Route::get('/pay-page', [PublicController::class,'indexpay']);


Route::get('/scholer-payments', [Fees_Onlyparents_Controller::class, 'index']);
// Route::post('/search-scholer-payments', [Fees_Onlyparents_Controller::class, 'search_student_name'])->name('search-fees-master-student');
Route::post('/search-scholer-payments', [Fees_Onlyparents_Controller::class, 'get_student_info'])->name('search-fees-master-student');


Auth::routes();
Route::get('/', [LoginController::class, 'login']);

Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */
    // Route::get('/', 'HomeController@index')->name('home.index');

    Route::group(['middleware' => ['guest']], function() {

        /*Register Routes*/
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /*Login Routes*/
        Route::get('/', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {
        /*Logout Routes*/
        // Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
         Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });
});

Auth::routes();Route::get('/home', [HomeController::class, 'index'])->name('home');
  
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::get('permission', [UserPermissionController::class, 'index'])->name('permission');
    Route::post('save-permission', [UserPermissionController::class, 'save_permission'])->name('save-permission');
    Route::post('store-permission', [UserPermissionController::class, 'store_permission'])->name('store-permission');
    Route::get('view-permission/{id}', [UserPermissionController::class, 'view'])->name('view-permission');
    Route::get('delete-permission/{id}', [UserPermissionController::class, 'bs_soft_delete']);
    // Route::resource('products', ProductController::class);
    /*Admin Routes*/
    Route::get('admin-dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // resumeController
    Route::get('resume-list', [ResumeController::class,'resume_list'])->name('resume-list');
    Route::post('/update-candidate-status', [ResumeController::class, 'updateCandidateStatus'])->name('update-candidate-status');
    Route::get('candidate-onboarding', [ResumeController::class, 'candidate_onboarding'])->name('candidate-onboarding');
    Route::post('save_candidate_details', [ResumeController::class, 'save_candidate_details'])->name('save_candidate_details');
    Route::get('candidate-onboarding-list', [ResumeController::class, 'candidate_onboarding_list'])->name('candidate-onboarding-list');
    Route::get('onboarding-single-page/{id}', [ResumeController::class, 'onboarding_single_page'])->name('onboarding-single-page');

    Route::get('/Dashboard ',[RegistrationController::class, 'dashboard'])->name('dashboard');
    Route::get('/mcq ',[McqController::class, 'index'])->name('mcq');
    

    Route::resource('inquiry-data', InquiryController::class);
    Route::get('inquiry-data-show', [InquiryController::class,'show'])->name('inquiry-data');

    Route::resource('inquiry-data', InquiryController::class);
    /* Fees Master Student*/
    Route::get('fees-master-student', [FeesMasterStudentController::class,'student_feesmaster'])->name('fees-master-student');
    Route::get('advance-next-year-fees', [FeesMasterStudentController::class,'advance_nextyear'])->name('advance-next-year-fees');
    Route::post('next-year-amount-add',[FeesMasterStudentController::class, 'next_year_amount_add']);
    // view-next-year-amount
    Route::get('view-next-year-amount/{id}', [FeesMasterStudentController::class,'view_next_year_amount']);
    Route::get('delete-next-year-amount/{id}', [FeesMasterStudentController::class, 'delete_next_year_amount']);
    Route::post('fees-registration-filter',[FeesMasterStudentController::class, 'student_fees_filer']);
    Route::post('scholarbusassign-post-pickup-fees',[FeesMasterStudentController::class, 'scholarbusassign_post_pickup_fees']);
    

    /*Student registration data*/
    Route::get('student-registrations', [StudentRegistrationController::class,'student_registrations'])->name('student-registrations');
    Route::get('add-student-registrations',[StudentRegistrationController::class,'add_student_registrations'])->name('add-student-registrations');
    Route::get('curren-year-student-registrations',[StudentRegistrationController::class,'curren_year_student_registrations'])->name('curren-year-student-registrations');
    Route::post('save-student-registration', [StudentRegistrationController::class, 'save_student_registration']);
    Route::post('getDataByFormNumber', [StudentRegistrationController::class, 'getDataByFormNumber']);
    Route::post('getDataByFormNumberstudent_registration', [StudentRegistrationController::class, 'getDataByFormNumberstudent_registration']);
    /* csv export */
    Route::post('/export_registrations.csv', [CSVController::class, 'export_registrations'])->name('export_registrations.csv');
    Route::post('/export-csv', [CSVController::class, 'export'])->name('export.csv');
    Route::get('/enquiry-csv', [CSVController::class, 'exportenquiry'])->name('enquirycsv');
    Route::get('/filter-enquiry-csv', [CSVController::class, 'filterexportenquiry'])->name('filterenquirycsv');
    Route::post('/export-csv-defaulters-list', [CSVController::class, 'exportdefaulters'])->name('exportdefaulterslist'); 
    Route::get('export-csv-enquiry', [CSVController::class, 'exportCsvenquiry'])->name('exportcsvenquiry');
    Route::get('/dueamountstu-csv', [CSVController::class, 'exportdueamount'])->name('dueamountstucsv');
    Route::get('/filter-dueamount-csv', [CSVController::class, 'filterdueamountcsv'])->name('filterdueamountcsv');

    /* selecion process */
    Route::get('selection-process', [StudentRegistrationController::class,'selection_process'])->name('selection-process');
    Route::post('save-selection-process', [StudentRegistrationController::class,'save_selection_process'])->name('save-selection-process');
    Route::get('/getEmployees', [StudentRegistrationController::class, 'getEmployees'])->name('getEmployees');
    Route::post('filter-student-registration',[StudentRegistrationController::class, 'filter_student_registration']);
    Route::post('student-registration-filter',[StudentRegistrationController::class, 'student_registration_filer']);

    /*Student routes*/
    Route::get('student-inquiry', [HomeController::class, 'index'])->name('student-inquiry');
    Route::post('save-student-inquiry', [HomeController::class, 'save_student_inquiry']);
    Route::get('student-inquiry-out', [HomeController::class, 'student_inquiry_out'])->name('student-inquiry-out');
    Route::post('create', [HomeController::class, 'create' ]);


    Route::get('admin-enquiryform', [RegistrationController::class,'enquiryform'])->name('admin-enquiryform'); 


    // Route::get('admin-enquiryform', [RegistrationController::class,'enquiryform'])->name('admin-enquiryform');

    //dropdown
    Route::get('dependent-dropdown', [DropdownController::class, 'index']);
    Route::post('api/fetch-states', [DropdownController::class, 'fetchState']);
    Route::post('api/fetch-cities', [DropdownController::class, 'fetchCity']);




    // Transport-Module
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    /* calculate days */
    Route::get('month-wise-days', [MonthController::class, 'monthWiseDays'])->name('month-wise-days');

    
    /*Academics Module*/
    Route::get('exammaster',[ExamMasterController::class, 'index'])->name('exammaster'); 
    Route::get('student-attandence-report',[StudentAttendReportController::class, 'index'])->name('student-attandence-report'); 
    Route::post('classstudent-view/{id}', [StudentAttendReportController::class, 'class_student']);
    Route::post('filter-classattendence',[StudentAttendReportController::class, 'filter_class_attandence'])->name('filter-classattendence'); 


    Route::get('studentattandancereport',[StudentAttandanceController::class, 'index'])->name('studentattandancereport'); 
    Route::post('classwisestudent',[DailyAttandanceController::class, 'filter'])->name('classwisestudent'); 
    Route::post('filterdailyattandence',[AttandenceReportsController::class, 'classattandence'])->name('filterdailyattandence'); 
    Route::post('filterclassattandence',[AttandenceReportsController::class, 'classstrenght'])->name('filterclassattandence'); 
    Route::post('filterstatusattandence',[AttandenceReportsController::class, 'classstrenghtstatuswise'])->name('filterstatusattandence'); 
    Route::post('save-exammaster',[ExamMasterController::class, 'create']);
    Route::get('view-exammaster/{id}', [ExamMasterController::class, 'view']);
    Route::post('store-exammaster', [ExamMasterController::class, 'store']);
    Route::get('delete-exammaster/{id}', [ExamMasterController::class, 'exam_master_delete']);
    Route::get('calssese-assigne-to-teacher',[ClassAssignTeacher::class, 'index'])->name('calssese-assigne-to-teacher'); 
    Route::post('save-class-assign-teacher',[ClassAssignTeacher::class, 'saveclassdata'])->name('save-class-assign-teacher'); 
    Route::get('classteacher-view/{id}', [ClassAssignTeacher::class, 'view']);
    Route::post('store-update-classassignteacher', [ClassAssignTeacher::class, 'store']);
    Route::get('classteacher-delete/{id}', [ClassAssignTeacher::class, 'class_teacherdelete']);
    



    Route::post('/change-password',  [Changepassword::class, 'updatePassword'])->name('password.update');
    Route::get('/change-password', [Changepassword::class,'showChangePasswordForm'])->name('password.change.form');
Route::post('change_password', [Changepassword::class, 'create']);

// Route::middleware(['auth'])->group(function () {
    // Route::post('/change-password', [Changepassword::class,'updatePassword'])->middleware('auth');

    // Define routes that require authentication here
    Route::get('/change-password',  [Changepassword::class,'showChangePasswordForm'])->name('password.change.form');
    Route::get('/change-password',  [Changepassword::class,'updatePassword'])->name('password.update');
    // Route::match(['get', 'post'], '/change-password', [Changepassword::class, 'updatePassword'])->name('password.update');

// });

    Route::get('teachersubject',[TeacherSubjectController::class, 'index'])->name('teachersubject'); 
    Route::post('save-teachersubject',[TeacherSubjectController::class, 'create']);
    Route::get('view-teachersubject/{id}', [TeacherSubjectController::class, 'view']);
    Route::post('store-teachersubject', [TeacherSubjectController::class, 'store']);
    Route::post('delete-teachersubject', [TeacherSubjectController::class, 'teachersubject_delete']);
    Route::post('copy-teachersubject', [TeacherSubjectController::class, 'teachersubject_copy']);
    Route::post('getteachersclasses', [TeacherSubjectController::class, 'getteachersclasses']);
    // Route::post('getteacherssubject', [TeacherSubjectController::class, 'getteacherssubject']);
    Route::post('getteachersdata', [TeacherSubjectController::class, 'getteachersdata']);
    Route::post('getteachersandsubject', [TeacherSubjectController::class, 'getteachersandsubject']);

    Route::get('AssignSubject',[AssignSubjectController::class, 'index'])->name('AssignSubject'); 
    Route::post('save-AssignSubject',[AssignSubjectController::class, 'create']);
    Route::get('view-AssignSubject/{id}', [AssignSubjectController::class, 'view']);
    Route::post('store-AssignSubject', [AssignSubjectController::class, 'store']);
    Route::post('find-student_combination', [AssignSubjectController::class, 'student_combination_data']);
    Route::get('delete-AssignSubject/{id}', [AssignSubjectController::class, 'AssignSubject_delete']);
    
    Route::match(['get', 'post'], 'AssignSubject', [AssignSubjectController::class, 'index'])->name('AssignSubject');
    Route::post('fetch-student-data', [AssignSubjectController::class, 'fetchStudentData'])
    ->name('fetch-student-data');







    // nature-of-work
    Route::get('subjectmaster',[SubjectController::class, 'index'])->name('subjectmaster');
    Route::post('save-subject',[SubjectController::class, 'create']);
    Route::get('view-subject/{id}', [SubjectController::class, 'view']);
    Route::post('store-subject', [SubjectController::class, 'store']);
    Route::get('delete-subject/{id}', [SubjectController::class, 'subjects_delete']);
    
    // Route::get('teachersubject',[TeacherSubjectController::class, 'index'])->name('teachersubject'); 
    Route::get('Attandencelist',[AttandenceController::class, 'index'])->name('Attandencelist'); 
    Route::get('Attandencereports',[AttandenceReportsController::class, 'index'])->name('Attandencereports'); 
    Route::get('dailyattandence',[DailyAttandanceController::class, 'index'])->name('dailyattandence'); 
    Route::post('dailyattandence',[DailyAttandanceController::class, 'Attendance'])->name('dailyattandence'); 
    Route::get('primarygroup',[PrimaryGrupController::class, 'index'])->name('primarygroup'); 
    Route::get('groupmaster',[GrupController::class, 'index'])->name('groupmaster'); 
    Route::get('headmaster',[HeadController::class, 'index'])->name('headmaster'); 
    Route::get('subheadmaster',[subHeadController::class, 'index'])->name('subheadmaster');
    
    

    Route::get('greadingmaster',[GreadingMasterController::class, 'index'])->name('greadingmaster'); 
    
    Route::get('greadingmaster',[GreadingMasterController::class, 'index'])->name('greadingmaster'); 
    Route::post('save-greadingmaster',[GreadingMasterController::class, 'create']);
    Route::get('view-greadingmaster/{id}', [GreadingMasterController::class, 'view']);
    Route::post('store-greadingmaster', [GreadingMasterController::class, 'store']);
    Route::get('delete-greadingmaster/{id}', [GreadingMasterController::class, 'grade_master_delete']);
    // Route::get('greadingmaster',[GradesController::class, 'index'])->name('greadingmaster'); 
    


    Route::get('gread',[GradesController::class, 'index'])->name('gread'); 
    Route::post('save-gread',[GradesController::class, 'create']);
    Route::get('view-gread/{id}', [GradesController::class, 'view']);
    Route::post('store-gread', [GradesController::class, 'store']);
    Route::get('delete-gread/{id}', [GradesController::class, 'grade_delete']);




    Route::get('groupmaster',[GrupController::class, 'index'])->name('groupmaster');
    Route::post('save-groupmaster',[GrupController::class, 'create']);
    Route::get('view-groupmaster/{id}', [GrupController::class, 'view']);
    Route::post('store-groupmaster', [GrupController::class, 'store']);
    Route::get('delete-groupmaster/{id}', [GrupController::class, 'groupmaster_delete']);
    
    Route::get('headmaster',[HeadController::class, 'index'])->name('headmaster');
    Route::post('save-headmaster',[HeadController::class, 'create']);
    Route::get('view-headmaster/{id}', [HeadController::class, 'view']);
    Route::post('store-headmaster', [HeadController::class, 'store']);
    Route::get('delete-headmaster/{id}', [HeadController::class, 'headmaster_delete']);

    Route::get('subheadmaster',[SubHeadController::class, 'index'])->name('subheadmaster');
    Route::post('save-subheadmaster',[SubHeadController::class, 'create']);
    Route::get('view-subheadmaster/{id}', [SubHeadController::class, 'view']);
    Route::post('store-subheadmaster', [SubHeadController::class, 'store']);
    Route::get('delete-subheadmaster/{id}', [SubHeadController::class, 'subheadmaster_delete']);

    Route::get('remarkmaster',[RemarksController::class, 'index'])->name('remarkmaster');
    Route::post('save-remarksmaster',[RemarksController::class, 'create']);
    Route::get('view-remarkmaster/{id}', [RemarksController::class, 'view']);
    Route::post('store-remarksmaster', [RemarksController::class, 'store']);
    Route::get('delete-remarkmaster/{id}', [RemarksController::class, 'remarkmaster_delete']);
//Route::get('view-marks/{id}', [MarksController::class, 'view'])->where('id', '[0-9]+');

    Route::get('streammaster',[StreamController::class, 'index'])->name('streammaster'); 
    Route::post('save-streammaster',[StreamController::class, 'create']);
    Route::get('view-streammaster/{id}', [StreamController::class, 'view']);
    Route::post('store-streammaster', [StreamController::class, 'store']);
    Route::get('delete-streammaster/{id}', [StreamController::class, 'stream_master_delete']);

    Route::get('examtype',[ExamtypeController::class, 'index'])->name('examtype'); 
    Route::post('save-examtype',[ExamtypeController::class, 'create']);
    Route::get('view-examtype/{id}', [ExamtypeController::class, 'view']);
    Route::post('store-examtype', [ExamtypeController::class, 'store']);
    Route::get('delete-examtype/{id}', [ExamtypeController::class, 'examtype_delete']);

    Route::get('teachers',[TeacherController::class, 'index'])->name('teachers'); 
    Route::post('save-teachers',[TeacherController::class, 'create']);
    Route::get('view-teachers/{id}', [TeacherController::class, 'view']);
    Route::post('store-teachers', [TeacherController::class, 'store']);
    Route::get('delete-teachers/{id}', [TeacherController::class, 'teaches_delete']);

    Route::get('marksheet',[MarksheetController::class, 'index'])->name('marksheet'); 

    Route::get('marks',[MarksController::class, 'index'])->name('marks');
    Route::get('show_report_marks', [MarksController::class, 'showmarks']);
    Route::post('show_report_markss', [MarksController::class, 'show_report_markss']);
    Route::post('save-marks',[MarksController::class, 'create']);
    Route::post('class-studentdata',[MarksController::class, 'classstudentdata']);
    Route::post('grade_percentage', [MarksController::class, 'grade_percentage']);
    Route::get('view-marks/{id}', [MarksController::class, 'view']);
    
   // Route::get('view-marks/{id}', [MarksController::class, 'view']);

    Route::post('store-marks', [MarksController::class, 'store']);
    Route::get('delete-marks/{id}', [MarksController::class, 'marks_delete']);




    
    Route::get('sectionmaster',[SectionController::class, 'index'])->name('sectionmaster');     
    Route::post('save-sectionmaster',[SectionController::class, 'create']);
    Route::get('view-sectionmaster/{id}', [SectionController::class, 'view']);
    Route::post('store-sectionmaster', [SectionController::class, 'store']);
    Route::get('delete-sectionmaster/{id}', [SectionController::class, 'section_master_delete']);
    Route::get('primarygroup',[PrimaryGrupController::class, 'index'])->name('primarygroup'); 
    Route::post('save-primarygroupmaster',[PrimaryGrupController::class, 'create']);
    Route::get('view-primarygroupmaster/{id}', [PrimaryGrupController::class, 'view']);
    Route::post('store-primarygroupmaster', [PrimaryGrupController::class, 'store']);
    Route::get('delete-primarygroupmaster/{id}', [PrimaryGrupController::class, 'primarygroup_master_delete']);
    Route::get('remarkmaster',[RemarksController::class, 'index'])->name('remarkmaster'); 
    Route::get('subjectcombinatiomaster',[SubjectCombinationController::class, 'index'])->name('subjectcombinatiomaster');
    Route::post('save-subjectcombinatiomaster',[SubjectCombinationController::class, 'create']);
    Route::get('view-subjectcombinatiomaster/{id}', [SubjectCombinationController::class, 'view']);
    Route::post('store-subjectcombinatiomaster', [SubjectCombinationController::class, 'store'])->name('store-subjectcombinatiomaster');
    Route::get('delete-subjectcombinatiomaster/{id}', [SubjectCombinationController::class, 'subjectcombinatio_master_delete']); 
    // Route::post('/store-subjectcombinatiomaster', 'YourController@store')->name('store');
    // Route::post('/store-subjectcombinatiomaster', 'YourController@store')->name('store-subjectcombinatiomaster');
    // Route::post('delete-subject', [SubjectCombinationController::class, 'subject_delete']);
    Route::get('fetch-subjects', 'SubjectCombinationController@fetchSubjects')->name('fetch-subjects');
    Route::get('/fetch-subjects', 'SubjectCombinationController@fetchSubjects');
    Route::get('store-subjectcombinatiomaster', [SubjectCombinationController::class, 'store'])->name('store-subjectcombinatiomaster');






    /*mobile view*/
    Route::get('mobileview',[MobileController::class, 'index'])->name('mobileview'); 
    Route::get('bus-attandence-list',[MobileController::class, 'list_busAttendence'])->name('bus-attandence-list'); 
    Route::post('mobileview',[MobileController::class, 'Attendance'])->name('mobileview'); 
    Route::post('busstudent-view/{id}', [MobileController::class, 'bus_student']);

    /*Transport  routes*/
    Route::get('addvehical',[AddVehical::class, 'index'])->name('addvehical');
    Route::post('addvehical',[AddVehical::class, 'addvehical'])->name('addvehical');
    Route::get('AddVehical-view/{id}', [AddVehical::class, 'view']);
    Route::get('AddVehical-delete/{id}', [AddVehical::class, 'addvehical_delete']);
    
    /* certificate download */ 
    Route::get('downloadcertificate/{id}', [StudentRegistrationController::class, 'downloadcertificate']);   

    Route::post('AddVehical-store', [AddVehical::class, 'store']);
    Route::get('busstaff',[AddVehical::class, 'busstaff'])->name('busstaff');
    Route::post('busstaff',[AddVehical::class, 'registerstaff'])->name('registerstaff');
    Route::get('vehical',[AddVehical::class, 'vehical'])->name('vehicale');
    Route::get('vehical',[AddVehical::class, 'showvehical'])->name('showvehical');
    Route::get('list',[AddVehical::class,'list'])->name('list');
    Route::get('busstaff',[BusStaff::class, 'index'])->name('busstaff');
    Route::post('busstaff',[BusStaff::class, 'registerbusstaff'])->name('busstaff');
    Route::get('listbusmember',[BusStaff::class, 'listbusmember'])->name('listbusmember');
    Route::get('Challa',[Challa::class, 'index'])->name('Challan');
    Route::post('Challa',[Challa::class, 'registerchallan'])->name('Challa');
    Route::get('partycontroller',[partycontroller::class, 'index'])->name('partycontroller');

    // Maintenance Head master 
    Route::resource('maintenance-head-master', MaintenanceController::class);
    Route::get('view-maintenance-head-master/{id}', [MaintenanceController::class,'view']);
    Route::get('delete-maintenance-head-master/{id}', [RtopaperController::class, 'delete']);
    Route::get('deleteh-maintenance-head-master/{id}', [MaintenanceController::class, 'maintenanceheadpmaster_delete']);

    // maintenance-group-master
    // Route::post('saveg-maintenance-group-master',[MaintenanceController::class, 'createg']);
    Route::post('storeg-maintenance-group-master', [MaintenanceController::class, 'storeg']);
    Route::get('editg-maintenance-group-master/{id}', [MaintenanceController::class,'editg']);
    Route::get('deleteg-maintenance-group-master/{id}', [MaintenanceController::class, 'maintenancegroupmaster_delete']);


    
    // classes
    Route::resource('classes', ClassesController::class);
    Route::get('view-classes/{id}', [ClassesController::class,'view']);
    Route::get('delete-classes/{id}', [RtopaperController::class, 'delete']);
    Route::get('deleteh-classes/{id}', [ClassesController::class, 'classes_delete']);

   // classname
    Route::post('storeg-classname', [ClassesController::class, 'storeg']);
    Route::post('updateclasses', [ClassesController::class, 'editclasses']);
    Route::get('editg-classname/{id}', [ClassesController::class,'editg']);
    Route::get('deleteg-classname/{id}', [ClassesController::class, 'classname_delete']);





    // Rtopaper 
    Route::get('rtopaper',[RtopaperController::class, 'index'])->name('rtopaper');
    Route::post('save-rtopaper',[RtopaperController::class, 'create']);
    Route::get('view-rtopaper/{id}', [RtopaperController::class, 'view']);
    Route::post('store-rtopaper', [RtopaperController::class, 'store']);
    Route::get('delete-rtopaper/{id}', [RtopaperController::class, 'rtopaper_delete']);

    // Schedule
    Route::resource('schedulemaster',ScheduleController::class);
    Route::post('save-schedulemaster',[ScheduleController::class,'create']);
    Route::post('route-schedulemaster',[ScheduleController::class, 'ajax']);
    // terms
    Route::get('terms',[TermsController::class, 'index'])->name('terms');
    Route::post('save-terms',[TermsController::class, 'create']);
    Route::get('view-terms/{id}', [TermsController::class, 'view']);
    Route::get('delete-terms/{id}', [TermsController::class, 'delete']);
    Route::post('store-terms', [TermsController::class, 'store']);
    Route::post('delete-nature-of-work', [TermsController::class, 'Natureofwork_delete']);

    // nature-of-work
    Route::get('NatureOfWork',[NatureofworkController::class, 'index'])->name('NatureOfWork');
    Route::post('save-nature-of-work',[NatureofworkController::class, 'create']);
    Route::get('view-nature-of-work/{id}', [NatureofworkController::class, 'view']);
    Route::get('delete-nature-of-work/{id}', [NatureofworkController::class, 'delete']);
    Route::post('store-nature-of-work', [NatureofworkController::class, 'store']);
    Route::post('delete-nature-of-work', [NatureofworkController::class, 'Natureofwork_delete']);

    Route::get('BusFees',[BusFees::class, 'index'])->name('BusFees');
    Route::get('CourseFees',[CourseFees::class, 'index'])->name('CourseFees');
       
    Route::get('vehical',[AddVehical::class, 'showvehical'])->name('showvehical');
    Route::get('list',[AddVehical::class,'list'])->name('list');

    Route::get('listbusmember',[BusStaff::class, 'listbusmember'])->name('listbusmember');
    Route::get('Challa',[Challa::class, 'index'])->name('Challan');
    Route::post('Challa',[Challa::class, 'registerchallan'])->name('Challa');
    Route::get('challanlist',[Challa::class, 'challanlist'])->name('challanlist');
    Route::get('Refundvoucher',[Refundvoucher::class, 'index'])->name('Refundvoucher');
    
     /*Student Master  routes*/
    Route::get('Student-master',[StudentMaster::class, 'index'])->name('Student-master');
    Route::get('partycontroller',[partycontroller::class, 'index'])->name('partycontroller');
    Route::get('list-party-master',[partycontroller::class, 'list_party_master'])->name('list-party-master');
    Route::post('save-addpartymaster',[partycontroller::class, 'addpartymaster'])->name('save-addpartymaster');
    // Route::get('partymaster-delete/{id}', [partycontroller::class, 'party_master_delete']);
    Route::get('partymaster-delete/{id}', [partycontroller::class, 'party_master_delete']);
    Route::get('partymaster-view/{id}', [partycontroller::class, 'view']);
    Route::post('partymaster-store', [partycontroller::class, 'store']);
    Route::get('RTOpaper',[RTOpaper::class, 'index'])->name('RTOpaper');
    Route::post('save-rto-paper',[RTOpaper::class, 'savertopaper'])->name('save-rto-paper');
    Route::get('list-rto-paper',[RTOpaper::class, 'rto_paper_list'])->name('list-rto-paper');
    Route::get('rtopaper-delete/{id}', [RTOpaper::class, 'delete']);
    Route::post('rtopaper-delete', [RTOpaper::class, 'rto_paper_delete']);
    Route::get('rtopaper-view/{id}', [RTOpaper::class, 'view']);
    Route::post('rto-paper-filter',[RTOpaper::class, 'RTO_paper_filer']);
    Route::post('rtopaper-store', [RTOpaper::class, 'store']);
    
    /*Transport  routes*/
    // Route::get('addvehical',[AddVehical::class, 'index'])->name('addvehical');
    Route::post('save-addvehical',[AddVehical::class, 'addvehical'])->name('addvehical');
    Route::get('addvehical',[AddVehical::class, 'index'])->name('addvehical');
    Route::post('save-addvehical',[AddVehical::class, 'addvehical']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/scholars',[RegistrationController::class, 'schalars_all'])->name('scholars');
    Route::get('/Academics',[RegistrationController::class, 'Academics_all'])->name('Academics');
    Route::get('/all-transport-view',[RegistrationController::class, 'Transport_all'])->name('all-transport-view');
    Route::get('/Fees',[RegistrationController::class, 'Fees_all'])->name('Fees');
    Route::get('/hrms',[RegistrationController::class, 'hrms_all'])->name('hrms');
    

    Route::get('/Dashboard ',[RegistrationController::class, 'dashboard'])->name('dashboard');


    // Area master 
    Route::resource('area-master', AreaController::class);
    Route::get('view-area-master/{id}', [AreaController::class,'view']);
    Route::get('delete-area-master/{id}', [AreaController::class, 'delete']);
    Route::post('save-route-area-bus',[RouteController::class,'create']);
    Route::get('delete-route-name/{id}', [RouteController::class, 'route_name_delete']);
    Route::get('delete-route/{id}', [RouteController::class, 'route_delete']);
    
    // Route master 
    Route::resource('route-master', RouteController::class);
    Route::get('view-route-master/{id}', [RouteController::class,'view']);
    Route::get('delete-route-master/{id}', [RouteController::class, 'delete']);
    Route::post('route-data',[RouteController::class, 'ajax']);
    Route::get('view-bus-route-master/{id}',[RouteController::class, 'view_bus']);

    // Bus stop 
    Route::get('bus-stop', [BusstopController::class, 'index'])->name('bus-stop');
    Route::post('bus-stop-create', [BusstopController::class, 'create']);
    Route::get('bus-stop-view/{id}', [BusstopController::class, 'view']);
    Route::post('busstop-delete', [BusstopController::class, 'busstop_delete']);
    Route::post('bus-stop-store', [BusstopController::class, 'store']);
    Route::get('delete-busstop/{id}', [BusstopController::class, 'bs_soft_delete']);
    Route::get('RouteMaster', [RouteMaster::class, 'index'])->name('RouteMaster');

    // Driver / Conductor Master 
    Route::get('driver-conductor-master',[BusStaff::class, 'index'])->name('driver-conductor-master');
    Route::post('save-driver-conductor-master',[BusStaff::class, 'create'])->name('save-driver-conductor-master');
    Route::get('view-driver-conductor-master/{id}', [BusStaff::class, 'view']);
    Route::post('store-driver-conductor-master', [BusStaff::class, 'store']);
    Route::get('delete-driver-conductor-master/{id}', [BusStaff::class, 'busstaff_delete']);

    // teacherbusassign
    Route::get('teacherbusassign',[TeacherBusAssignController::class, 'index'])->name('teacherbusassign');
    Route::get('teacherbusassign_student',[TeacherBusAssignController::class, 'student_get'])->name('syudent_get');
    Route::get('teacherbusassign_student_shedule_name',[TeacherBusAssignController::class, 'scholarbusassign_student_shedule_namee'])->name('teacherbusassign_student_shedule_nameee');
    Route::get('teacherbusassign_student_pick_up_routes',[TeacherBusAssignController::class, 'scholarbusassign_student_pick_up_routes'])->name('teacherbusassign_student_pick_up_routes');
    Route::get('teacherbusassign_student_bus_stop_name',[TeacherBusAssignController::class, 'scholarbusassign_student_bus_stop_name'])->name('teacherbusassign_student_bus_stop_name');
    Route::get('teacherbusassign_student_bus_no',[TeacherBusAssignController::class, 'scholarbusassign_student_bus_no'])->name('teacherbusassign_student_bus_no');
    Route::post('teacherbusassign_post_pickup', [TeacherBusAssignController::class, 'scholarbusassign_post_pickup']);
    Route::get('teacherbusassign_student_shedule_name_drop',[TeacherBusAssignController::class, 'scholarbusassign_student_shedule_name_drop'])->name('teacherbusassign_student_shedule_name_drop');
    Route::get('teacherbusassign_student_drop_routes',[TeacherBusAssignController::class, 'scholarbusassign_student_drop_routes'])->name('teacherbusassign_student_drop_routes');
    Route::get('teacherbusassign_student_bus_stop_name_drop',[TeacherBusAssignController::class, 'scholarbusassign_student_bus_stop_name_drop'])->name('teacherbusassign_student_bus_stop_name_drop');
    Route::post('teacherbusassign_post_drop', [TeacherBusAssignController::class, 'scholarbusassign_post_drop']);
    Route::get('data_foredit_pickup',[TeacherBusAssignController::class, 'data_foredit_pickup'])->name('data_foredit_pickup');

    // scholarbusassign
    Route::get('scholarbusassign',[ScholarbusassignController::class, 'index'])->name('scholarbusassign');
    Route::get('scholarbusassign_student',[ScholarbusassignController::class, 'student_get'])->name('student_get');
    Route::get('scholarbusassign_student_shedule_name',[ScholarbusassignController::class, 'scholarbusassign_student_shedule_namee'])->name('scholarbusassign_student_shedule_nameee');
    Route::get('scholarbusassign_student_pick_up_routes',[ScholarbusassignController::class, 'scholarbusassign_student_pick_up_routes'])->name('scholarbusassign_student_pick_up_routes');
    Route::get('scholarbusassign_student_bus_stop_name',[ScholarbusassignController::class, 'scholarbusassign_student_bus_stop_name'])->name('scholarbusassign_student_bus_stop_name');
    Route::get('scholarbusassign_student_bus_no',[ScholarbusassignController::class, 'scholarbusassign_student_bus_no'])->name('scholarbusassign_student_bus_no');
    Route::post('scholarbusassign_post_pickup', [ScholarbusassignController::class, 'scholarbusassign_post_pickup']);
    Route::get('scholarbusassign_student_shedule_name_drop',[ScholarbusassignController::class, 'scholarbusassign_student_shedule_name_drop'])->name('scholarbusassign_student_shedule_name_drop');
    Route::get('scholarbusassign_student_drop_routes',[ScholarbusassignController::class, 'scholarbusassign_student_drop_routes'])->name('scholarbusassign_student_drop_routes');
    Route::get('scholarbusassign_student_bus_stop_name_drop',[ScholarbusassignController::class, 'scholarbusassign_student_bus_stop_name_drop'])->name('scholarbusassign_student_bus_stop_name_drop');
    Route::post('scholarbusassign_post_drop', [ScholarbusassignController::class, 'scholarbusassign_post_drop']);
    Route::get('data_foredit_pickup',[ScholarbusassignController::class, 'data_foredit_pickup'])->name('data_foredit_pickup');
    Route::get('data_studata',[ScholarbusassignController::class, 'data_studata'])->name('data_studata');

    
    // student_ledger 
    Route::get('student_ledger', [FeesTypesMasterController::class, 'student_ledger'])->name('student_ledger');
    Route::get('cancle_student_ledger', [FeesTypesMasterController::class, 'cancle_student_ledger'])->name('cancle_student_ledger');
    Route::post('search-student-ledger', [FeesTypesMasterController::class, 'search_student_ledger'])->name('search-student-ledger');
    Route::post('search-cancle-student-ledger', [FeesTypesMasterController::class, 'search_cancle_student_ledger'])->name('search-cancle-student-ledger');
    Route::get('cancle_student_ledger_delete/{id}', [FeesTypesMasterController::class, 'student_ledger_delete']);

    Route::get('pdf-export-stu/{id}', [FeesTypesMasterController::class, 'export_stu_Pdf'])->name('export_stu.pdf');

    Route::get('view-student-ledger/{id}', [FeesTypesMasterController::class, 'view_student_ledger'])->name('view-student-ledger');
    Route::post('student-ledger-receipt-challan', [FeesreceiptchallanController::class, 'student_ledger_receipt_challan'])->name('student-ledger-receipt-challan');
    Route::post('student-view-part', [FeesreceiptchallanController::class, 'student_view_part'])->name('student-view-part');

    Route::get('bus-fees-master', [busfeesmasterController::class, 'index'])->name('bus-fees-master');
    Route::post('save-bus-fees-type', [busfeesmasterController::class, 'create']);
    Route::get('Busfees-delete/{id}', [busfeesmasterController::class, 'busfees_delete']);
    
    // bus_data
    Route::get('bus_data',[BusdataController::class , 'index'])->name('bus_data');
    Route::get('bus_details/{bus_number}',[BusdataController::class , 'bus_details'])->name('bus_details');
    Route::get('fees_payments/{id}',[FeesPaymentController::class , 'index'])->name('fees_payments');
    Route::get('fees_payments_success/{id}', [FeesPaymentController::class , 'fees_payments_success'])->name('fees_payments_success');
    Route::post('save_feesreceipt_user', [FeesPaymentController::class , 'save_feesreceipt_user']);
    Route::post('search-due-fee-student',[FeesPaymentController::class , 'search_student_name'])->name('search-due-fee-student');
    Route::post('/search-scholer-payments', [FeesPaymentController::class, 'get_student_info'])->name('search-fees-master-student');
// FeesreceiptchallanController
    Route::post('student-details',[FeesPaymentController::class , 'student_details']);


    // Route::post('save-driver-conductor-master',[BusStaff::class, 'create'])->name('save-driver-conductor-master');
    // Route::get('view-driver-conductor-master/{id}', [BusStaff::class, 'view']);
    // Route::post('store-driver-conductor-master', [BusStaff::class, 'store']);
    // Route::post('delete-driver-conductor-master', [BusStaff::class, 'busstaff_delete']);

    // Fees routes
    Route::get('fees-type-master', [feestypemasterController::class, 'show'])->name('fees-type-master');
    Route::post('save-fees-type-master', [feestypemasterController::class, 'create']);
    Route::get('edit/{id}', [feestypemasterController::class, 'edit']);
    Route::post('feestype-update', [feestypemasterController::class, 'update']);
    Route::get('fees-type-delete/{id}', [feestypemasterController::class, 'fees_type_master_delete']);
    Route::get('delete/{id}', [feestypemasterController::class, 'delete']);
    Route::get('late-fees-limit',[LateFeesLimit::class, 'index'])->name('late-fees-limit');
    Route::get('late-fees-master',[LateFeesMasterController::class, 'late_fees_master'])->name('late-fees-master');
    Route::get('late-fees-master-delete/{id}',[LateFeesMasterController::class, 'late_fees_master_soft_delete'])->name('late-fees-master-delete');
    Route::post('save-late-fees-master', [LateFeesMasterController::class, 'save_late_fees_master']);
    Route::get('late-fees-master-edit/{id}', [LateFeesMasterController::class, 'late_fees_master_edit']);
    Route::put('late-fees-master-update/{id}', [LateFeesMasterController::class, 'late_fees_master_update']);
    Route::get('late-fees-limit',[LateFeesLimit::class, 'index'])->name('late-fees-limit');
    Route::post('update-late-fees-limit', [LateFeesLimit::class, 'update_late_fees_limit']);

    Route::get('fees-types-master', [FeesTypesMasterController::class, 'index'])->name('fees-types-master');
    Route::post('save-fees-types-master', [FeesTypesMasterController::class, 'create']);
    Route::get('fees-types-master-edit/{id}', [FeesTypesMasterController::class, 'edit']);
    Route::post('fees-types-master-update', [FeesTypesMasterController::class, 'update']);
    Route::post('fees-types-master-delete', [FeesTypesMasterController::class, 'delete']);
    Route::get('fees-register', [feesregisterController::class, 'index'])->name('fees-register');
    Route::post('get-fees-register-data', [feesregisterController::class, 'feesregisterdata'])->name('get-fees-register-data');

    
    // student_ledger 
    Route::get('student_ledger', [FeesTypesMasterController::class, 'student_ledger'])->name('student_ledger');

    Route::post('save_report', [DefaultersListController::class, 'report']);
    Route::get('defaulters_list', [DefaultersListController::class, 'index'])->name('defaulters_list');
    Route::post('save_defaulters_list', [DefaultersListController::class, 'create']);
    Route::get('view_defaulters_list/{id}', [DefaultersListController::class, 'view']);
    Route::post('store_defaulters_list', [DefaultersListController::class, 'store']);
    Route::get('defaulter_list_csv/{id}', [DefaultersListController::class, 'defaulter_list_csv']);


    Route::get('pdf-export', [DefaultersListController::class, 'export_Pdfdefaulter'])->name('export.pdf');
    Route::post('/exports-csv', [DefaultersListController::class, 'export'])->name('exports.csv'); 
    Route::get('/search', [DefaultersListController::class, 'search'])->name('search');
    

    Route::post('search-student-ledger', [FeesTypesMasterController::class, 'search_student_ledger'])->name('search-student-ledger');
    Route::get('view-student-ledger/{id}', [FeesTypesMasterController::class, 'view_student_ledger'])->name('view-student-ledger');

    
    Route::get('bus-fees-master', [busfeesmasterController::class, 'index'])->name('bus-fees-master');
    Route::post('save-bus-fees-type', [busfeesmasterController::class, 'create']);
    Route::post('Busfees-delete', [busfeesmasterController::class, 'busfees_delete']);

    Route::get('course-fees-structure-master', [CourseFeesStructureMaster::class, 'course_fees_structure_master'])->name('course-fees-structure-master');

    Route::get('create-course-fees-structure-master', [CourseFeesStructureMaster::class, 'create_course_fees_structure_master'])->name('create-course-fees-structure-master');
    Route::get('create-course-fees-structure-master-view/{id}', [CourseFeesStructureMaster::class, 'editview']);

    Route::get('course-fees-structure-master-list', [CourseFeesStructureMaster::class, 'course_fees_structure_master_list'])->name('course-fees-structure-master-list');
    Route::get('studentRegistration', [CourseFeesStructureMaster::class, 'studentRegistration'])->name('studentRegistration');

    Route::get('course-fees-structure-master-delete/{id}', [CourseFeesStructureMaster::class, 'course_fees_structure_delete']);
    Route::post('delete-row', [CourseFeesStructureMaster::class, 'deleteRow']);
    Route::post('student-delete-row', [CourseFeesStructureMaster::class, 'studentdeleteRow']);

    Route::post('course-fees-structure-master-delete', [CourseFeesStructureMaster::class, 'course_fees_structure_master_delete'])->name('course-fees-structure-master-delete');
    Route::post('save-course-fees-structure-master', [CourseFeesStructureMaster::class, 'save_course_fees_structure_master'])->name('save-course-fees-structure-master');
    Route::post('edit-course-fees-structure-master', [CourseFeesStructureMaster::class, 'edit_course_fees_structure_master_data'])->name('edit-course-fees-structure-master');
    Route::post('edit-student-fees-structure-master', [CourseFeesStructureMaster::class, 'edit_student_fees_structure_master_data'])->name('edit-student-fees-structure-master');
    Route::post('bus-facility-on', [CourseFeesStructureMaster::class, 'updateCheckbox'])->name('bus-facility-on');
    Route::post('student-bus-fees', [CourseFeesStructureMaster::class, 'updatebusfees'])->name('student-bus-fees');

    Route::get('total-structure-row', [CourseFeesStructureMaster::class, 'total_structure_row'])->name('total-structure-row');

    Route::get('get_previous_structure', [CourseFeesStructureMaster::class, 'get_previous_structure'])->name('get_previous_structure');
    Route::post('save-structure-row', [CourseFeesStructureMaster::class, 'save_structure_row'])->name('save-structure-row');
    Route::post('save-next-year-fees', [CourseFeesStructureMaster::class, 'save_next_year_fees'])->name('save-next-year-fees');
    
    Route::post('delete-structure-row', [CourseFeesStructureMaster::class, 'delete_structure_row'])->name('delete-structure-row');

    Route::get('fees_receipt_challan',[FeesreceiptchallanController::class, 'index'])->name('fees_receipt_challan');
    Route::post('search_student_name', [FeesreceiptchallanController::class, 'search_student_name']);
    Route::post('get_student_info', [FeesreceiptchallanController::class, 'get_student_info']);
    Route::post('save_feesreceipt_challan', [FeesreceiptchallanController::class, 'save_feesreceipt_challan']);
    
    Route::post('get_student_fees_struct', [FeesreceiptchallanController::class, 'get_student_fees_struct']);
    Route::post('get_student_fees_struct_view', [FeesreceiptchallanController::class, 'get_student_fees_struct_view']);

    // Route::get('save_class_name', [InquiryEntryController::class, 'save_class_name'])->name('save_class_name');



    Route::get('enquiry-data', [EnquiryListdataController::class,'index'])->name('enquiry-data');
    Route::post('filter-enquiry-list',[EnquiryListdataController::class, 'filter_enquiryList']);

    Route::post('save_resume_inq', [ResumeController::class, 'save_resume_inq']);
    
    Route::post('save_student_inquiryentry', [InquiryEntryController::class, 'save_student_inquiryentry']);
    Route::get('adminenquirylist', [InquiryEntryController::class,'adminenquirylist'])->name('adminenquirylist');
    Route::get('followupdate', [InquiryEntryController::class,'followupdate'])->name('followupdate');
    Route::get('duestuamount', [InquiryEntryController::class,'duestuamount'])->name('duestuamount');
    Route::resource('follow', InquiryEntryController::class);
    Route::get('followupdateedit/{id}', [InquiryEntryController::class, 'followupdateedit'])->name('followupdateedit');

     Route::post('save_student_inquiryentry', [InquiryEntryController::class, 'save_student_inquiryentry']);
     Route::get('adminenquirylist', [InquiryEntryController::class,'adminenquirylist'])->name('adminenquirylist');
     Route::get('followupdate', [InquiryEntryController::class,'followupdate'])->name('followupdate');


    Route::resource('follow', InquiryEntryController::class);
     Route::get('followupdateedit/{id}', [InquiryEntryController::class, 'followupdateedit'])->name('followupdateedit');
     Route::post('savefollowupdate', [InquiryEntryController::class, 'savefollowupdate']);
     Route::post('save-followup-status', [InquiryEntryController::class,'save_followup_status'])->name('save-followup-status');
    Route::post('filter-followup',[InquiryEntryController::class, 'filter_followup']);
    Route::post('filter-duestuamount',[InquiryEntryController::class, 'filter_duestuamount']);
    Route::get('perstudueamount/{id}', [InquiryEntryController::class, 'perstudueamount']);

     Route::get('master_registration_view', [InquiryEntryController::class, 'master_registration_view']);
    Route::post('saveenquiry', [InquiryEntryController::class, 'saveenquiry']);


     Route::post('savefollowupdate', [InquiryEntryController::class, 'savefollowupdate']);
     Route::post('save-followup-status', [InquiryEntryController::class,'save_followup_status'])->name('save-followup-status');
    // Route::post('filter-followup',[InquiryEntryController::class, 'filter_followup']);
     Route::post('filter-allenquiry',[InquiryEntryController::class, 'filter_allenquiry']);

    //Route::resource('enquiryeditlist', InquiryEntryController::class);

    Route::post('classsection-view', [InquiryEntryController::class, 'getsectionviaclass']);
    Route::get('enquiryeditlist/{id}', [InquiryEntryController::class, 'enquiryeditlist'])->name('enquiryeditlist');
    Route::get('enquiryviewlist/{id}', [InquiryEntryController::class, 'enquiryviewlist'])->name('enquiryviewlist');
    Route::get('registrationeditlist/{id}', [InquiryEntryController::class, 'registrationeditlist'])->name('registrationeditlist');
    /*exquiry  Module*/
    Route::get('enquiryrecipt/{id}',[EnquiryReciptController::class, 'index'])->name('enquiryrecipt'); 
    Route::get('scholars_profile/{id}', [InquiryEntryController::class, 'scholars_profile'])->name('scholars_profile');    

    Route::get('student-master', [MasterRegistrationController::class,'student_master'])->name('student-master');
    Route::get('master_registration_view', [InquiryEntryController::class, 'master_registration_view']); 
    Route::get('admin-pre-enquiryform', [InquiryEntryController::class,'adminpreenquiryform'])->name('adminpreenquiryform');
    Route::get('admin-pre-enquiryfeeslist', [InquiryEntryController::class,'adminpreenquiryfeeslist'])->name('admin-pre-enquiryfeeslist');
    
    Route::get('admin-preenquiryform', [InquiryEntryController::class,'admin_preenquiryform'])->name('admin-preenquiryform');
    
    Route::post('filter-preenquiry',[InquiryEntryController::class, 'filter_preenquiry'])->name('filter-preenquiry');
    Route::post('save_student_preinquiryentry', [InquiryEntryController::class, 'save_student_preinquiryentry']);
    Route::get('preenquiryviewlist/{id}', [InquiryEntryController::class, 'preenquiryviewlist'])->name('preenquiryviewlist');
    Route::post('update_preenquiryview', [InquiryEntryController::class, 'update_preenquiryview']);

    Route::get('registrationviewlist/{id}', [InquiryEntryController::class, 'registrationviewlist'])->name('registrationviewlist');
    Route::get('feesmasterviewlist/{id}', [InquiryEntryController::class, 'feesmasterviewlist'])->name('feesmasterviewlist');
    Route::post('resetpasswordadmin',[InquiryEntryController::class,'resetpasswordadmin']);
    
    Route::get('/file-download', [DownloadFileController::class, 'index'])->name('file-download');

    Route::post('saveeditregistration', [InquiryEntryController::class, 'saveeditregistration']);
    Route::get('getcastename', [InquiryEntryController::class, 'getcastename'])->name('getcastename');
    Route::post('getsiblingbyfathersname', [InquiryEntryController::class, 'getsiblingbyfathersname'])->name('getsiblingbyfathersname');
    
    Route::get('bus-view/{id}', [busfeesmasterController::class, 'view']);
    Route::post('bus-store', [busfeesmasterController::class, 'store']);
    Route::get('bus-delete/{id}', [busfeesmasterController::class, 'delete']);
    Route::get('bus-fees-master-edit/{id}', [busfeesmasterController::class, 'edit']);

    Route::resource('inquiry-data', InquiryController::class);


/*Student registration data*/
//Route::get('student-registrations', [StudentRegistrationController::class,'student_registrations'])->name('student-registrations');
//Route::get('add-student-registrations',[StudentRegistrationController::class,'add_student_registrations'])->name('add-student-registrations');
    //state city dropdown 
    Route::get('dependent-dropdown', [DropdownController::class, 'index']);
    Route::post('api/fetch-states', [DropdownController::class, 'fetchState']);
    Route::post('api/fetch-cities', [DropdownController::class, 'fetchCity']);

    Route::get('course-fees-head-orders', [Course_fees_head_orders::class, 'course_fees_head_orders_list']);
    Route::get('course_fees_head_delete/{id}', [Course_fees_head_orders::class, 'course_fees_head_delete']);
    Route::get('course-fees-head-orders-edit/{id}', [Course_fees_head_orders::class, 'course_fees_head_orders_edit']);

    Route::post('course-fees-head-orders-sortable', [Course_fees_head_orders::class, 'course_fees_head_orders_sortable']);
    
    Route::post('save-course-fees-head-orders', [Course_fees_head_orders::class, 'course_fees_head_orders_save']);
    Route::post('course-fees-head-orders-delete', [Course_fees_head_orders::class, 'course_fees_head_orders_delete']);

    /*Student registration data*/
    Route::get('student-registrations', [StudentRegistrationController::class,'student_registrations'])->name('student-registrations');
    Route::get('add-student-registrations',[StudentRegistrationController::class,'add_student_registrations'])->name('add-student-registrations');
//     Route::get('student-registrations', [StudentRegistrationController::class,'student_registrations'])->name('student-registrations');
//     Route::get('add-student-registrations',[StudentRegistrationController::class,'add_student_registrations'])->name('add-student-registrations');

    Route::get('generate-due-chart', [FeesDuechart::class, 'generate_due_chart'])->name('generate-due-chart');
    Route::post('classsection-view/{id}', [FeesDuechart::class, 'class_student']);
    Route::get('generate-due-chart-list/{id}/{session_send}',[FeesDuechart::class, 'generate_due_chart_list'])->name('generate-due-chart-list');
    Route::get('generate-due-chart-status', [FeesDuechart::class, 'generate_due_chart_status'])->name('generate-due-chart-status');
    Route::post('save-due-chart', [FeesDuechart::class, 'save_due_chart'])->name('save-due-chart');
    // Route::get('save-due-chart', [FeesDuechart::class, 'save_due_chart'])->name('save-due-chart');
    
    Route::post('save_student_duechart', [FeesDuechart::class, 'save_student_duechart'])->name('save_student_duechart');

    Route::get('map/{id}', [MapController::class,'showMap']);
    Route::get('getNewDestination', [MapController::class, 'getNewDestination'])->name('getNewDestination');
    Route::post('filterstuaddre',[MapController::class, 'stuaddress'])->name('filterstuaddre'); 

    //student panel
    Route::get('student_calender',[StudentPanelController::class,'student_calender'])->name('student_calender');
    Route::get('student_fees_leadger',[FeesreceiptchallanController::class,'student_fees_leadger'])->name('student_fees_leadger');
    Route::get('student_announcement',[StudentPanelController::class,'student_announcement'])->name('student_announcement');

    Route::get('session',[SessionController::class,'index'])->name('session');
    Route::post('create-session',[SessionController::class,'create'])->name('create_session');


    Route::get('razorpay-payment', [RazorpayPaymentController::class, 'index']);
    Route::post('razorpay-payment', [RazorpayPaymentController::class, 'store'])->name('razorpay.payment.store');

// HRMS


Route::get('employee',[EmployeesController::class, 'index'])->name('employee'); 
Route::post('save-employee',[EmployeesController::class, 'create']);
Route::get('view-employee/{id}', [EmployeesController::class, 'view']);
Route::post('store-employee', [EmployeesController::class, 'store']);
Route::get('delete-employee/{id}', [EmployeesController::class, 'employee_delete']);

Route::get('department',[DepartmentController::class, 'index'])->name('department'); 
Route::post('save-department',[DepartmentController::class, 'create']);
Route::get('view-department/{id}', [DepartmentController::class, 'view']);
Route::post('store-department', [DepartmentController::class, 'store']);
Route::get('delete-department/{id}', [DepartmentController::class, 'department_delete']);

Route::get('position',[PositionController::class, 'index'])->name('position'); 
Route::post('save-position',[PositionController::class, 'create']);
Route::get('view-position/{id}', [PositionController::class, 'view']);
Route::post('store-position', [PositionController::class, 'store']);
Route::get('delete-position/{id}', [PositionController::class, 'position_delete']);

Route::get('attendance',[AttendanceController::class, 'index'])->name('attendance'); 
Route::post('save-attendance',[AttendanceController::class, 'create']);
Route::get('view-attendance/{id}', [AttendanceController::class, 'view']);
Route::post('store-attendance', [AttendanceController::class, 'store']);
Route::get('delete-attendance/{id}', [AttendanceController::class, 'attendance_delete']);

Route::get('holidays',[HolidaysController::class, 'index'])->name('holidays'); 
Route::post('save-holidays',[HolidaysController::class, 'create']);
Route::get('view-holidays/{id}', [HolidaysController::class, 'view']);
Route::post('store-holidays', [HolidaysController::class, 'store']);
Route::get('delete-holidays/{id}', [HolidaysController::class, 'holidays_delete']);

Route::get('salaries',[SalariesController::class, 'index'])->name('salaries'); 
Route::post('save-salaries',[SalariesController::class, 'create']);
Route::get('view-salaries/{id}', [SalariesController::class, 'view']);
Route::post('store-salaries', [SalariesController::class, 'store']);
Route::get('delete-salaries/{id}', [SalariesController::class, 'salaries_delete']);


Route::get('leaverequests',[LeaverequestsController::class, 'index'])->name('leaverequests'); 
Route::post('save-leaverequests',[LeaverequestsController::class, 'create']);
Route::get('view-leaverequests/{id}', [LeaverequestsController::class, 'view']);
Route::post('store-leaverequests', [LeaverequestsController::class, 'store']);
Route::get('delete-leaverequests/{id}', [LeaverequestsController::class, 'leaverequests_delete']);

Route::get('collection', [CollectionController::class, 'index']);

});

