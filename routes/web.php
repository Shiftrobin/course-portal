<?php

//Backend
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;

use App\Http\Controllers\Backend\CountryController;
use App\Http\Controllers\Backend\CourseNameController;
use App\Http\Controllers\Backend\UniversityController;
use App\Http\Controllers\Backend\LevelController;

use App\Http\Controllers\Backend\CampusController;
use App\Http\Controllers\Backend\BudgetController;
use App\Http\Controllers\Backend\CourseController;
use App\Http\Controllers\Backend\ApplicationController;
use App\Http\Controllers\Backend\DefaultController;
use App\Http\Controllers\Backend\HomeSeoController;

//Frontend
use App\Http\Controllers\Frontend\CoursePageController;
use App\Http\Controllers\Frontend\SiteMapController;
use App\Http\Controllers\Frontend\DefaultPageController;
use Illuminate\Support\Facades\Artisan;

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

//cache clear
Route::get('/cc', function(){
	try {
        Artisan::call('config:clear');
		Artisan::call('view:clear');
        Artisan::call('route:clear');
		Artisan::call('cache:clear');
		//Artisan::call('config:cache');
		//Artisan::call('route:cache');
		//Artisan::call('view:cache');
	    return "Cache Cleared!";
	} catch(\Exception $e) {
		dd($e);
	}
});


//public route
Route::get('/', [CoursePageController::class, 'index'])->name('home')->middleware('pagespeed');
Route::get('/get-more-courses', [CoursePageController::class, 'getMoreCourses'])->name('course.get-more-courses')->middleware('noindex','pagespeed');
Route::get('/apply/{universitySlug}/{courseSlug}/{id}',[CoursePageController::class, 'apply'])->name('apply.now')->middleware('pagespeed');
Route::post('/apply/store',[CoursePageController::class, 'applyNowStore'])->name('apply.now.store')->middleware('noindex','throttle:10,1');

Route::get('/apply', [DefaultPageController::class, 'applyList'])->name('apply.list')->middleware('pagespeed');
Route::get('/apply/{universitySlug}', [DefaultPageController::class, 'applyByUniversity'])->name('apply.university')->middleware('pagespeed');
Route::get('/apply/{universitySlug}/{courseSlug}', [DefaultPageController::class, 'applyByUniversityAndCourse'])->name('apply.university.course')->middleware('pagespeed');

//SiteMap route
Route::get('/sitemap',[SiteMapController::class,'index'])->name('sitemap');

//Redirect routes
require __DIR__.'/redirect.php';

// user login
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// auth routes
require __DIR__.'/auth.php';

//admin group middleware
Route::middleware(['auth','roles:admin','noindex'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile',[AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store',[AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password',[AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password',[AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');
});  //end group admin middleware

//agent group middleware
// Route::middleware(['auth','roles:agent','noindex'])->group(function(){
//     Route::get('/agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');
// });  //end group agent middleware

// admin login
Route::get('/protected-static-void-middlegate', [AdminController::class, 'AdminLogin'])->name('protected.static.void.middlegate')->middleware('noindex');

//get the data for ajax call
Route::middleware(['noindex'])->group(function(){
    Route::get('/get-budget',[DefaultController::class,'GetBudget'])->name('default.get-budget');
    Route::get('/get-level',[DefaultController::class,'GetLevel'])->name('default.get-level');
    Route::get('/get-campus',[DefaultController::class,'GetCampus'])->name('default.get-campus');
    Route::get('/get-university',[DefaultController::class,'GetUniversity'])->name('default.get-university');
});

// authenticated admin
Route::middleware(['auth','roles:admin','noindex'])->group(function(){

    //Home SEO all route
    Route::controller(HomeSeoController::class)->group(function(){
        Route::get('/all/homeseo','AllHomeseo')->name('all.homeseo')->middleware('permission:all.homeseo');
        Route::get('/add/homeseo','AddHomeseo')->name('add.homeseo')->middleware('permission:add.homeseo');
        Route::post('/store/homeseo', 'StoreHomeseo')->name('store.homeseo');
        Route::get('/edit/homeseo/{id}', 'EditHomeseo')->name('edit.homeseo')->middleware('permission:edit.homeseo');
        Route::post('/update/homeseo/{id}', 'UpdateHomeseo')->name('update.homeseo');
        Route::get('/delete/homeseo/{id}', 'DeleteHomeseo')->name('delete.homeseo')->middleware('permission:delete.homeseo');
    });

    //Application all route
    Route::controller(ApplicationController::class)->group(function(){
        Route::get('/all/application','AllApplication')->name('all.application')->middleware('permission:all.application');
        Route::get('/show/application/{id}','ShowApplication')->name('show.application')->middleware('permission:show.application');
        Route::get('/delete/application/{id}', 'DeleteApplication')->name('delete.application')->middleware('permission:delete.application');
        Route::get('/application-download','ApplicationExport')->name('application.download');
    });

    //Course all route
    Route::controller(CourseController::class)->group(function(){
        Route::get('/all/course','AllCourse')->name('all.course')->middleware('permission:all.course');
        Route::get('/add/course','AddCourse')->name('add.course')->middleware('permission:add.course');
        Route::post('/store/course', 'StoreCourse')->name('store.course');
        Route::get('/edit/course/{id}', 'EditCourse')->name('edit.course')->middleware('permission:edit.course');
        Route::post('/update/course/{id}', 'UpdateCourse')->name('update.course');
        Route::get('/delete/course/{id}', 'DeleteCourse')->name('delete.course')->middleware('permission:delete.course');
    });

    //Budget all route
    Route::controller(BudgetController::class)->group(function(){
        Route::get('/all/budget','AllBudget')->name('all.budget')->middleware('permission:all.budget');
        Route::get('/add/budget','AddBudget')->name('add.budget')->middleware('permission:add.budget');
        Route::post('/store/budget', 'StoreBudget')->name('store.budget');
        Route::get('/edit/budget/{id}', 'EditBudget')->name('edit.budget')->middleware('permission:edit.budget');
        Route::post('/update/budget/{id}', 'UpdateBudget')->name('update.budget');
        Route::get('/delete/budget/{id}', 'DeleteBudget')->name('delete.budget')->middleware('permission:delete.budget');
    });

    //Level all route
    Route::controller(LevelController::class)->group(function(){
        Route::get('/all/level','AllLevel')->name('all.level')->middleware('permission:all.level');
        Route::get('/add/level','AddLevel')->name('add.level')->middleware('permission:add.level');
        Route::post('/store/level', 'StoreLevel')->name('store.level');
        Route::get('/edit/level/{id}', 'EditLevel')->name('edit.level')->middleware('permission:edit.level');
        Route::post('/update/level/{id}', 'UpdateLevel')->name('update.level');
        Route::get('/delete/level/{id}', 'DeleteLevel')->name('delete.level')->middleware('permission:delete.level');
    });

     //campus all route
     Route::controller(CampusController::class)->group(function(){
        Route::get('/all/campus','AllCampus')->name('all.campus')->middleware('permission:all.campus');
        Route::get('/add/campus','AddCampus')->name('add.campus')->middleware('permission:add.campus');
        Route::post('/store/campus', 'StoreCampus')->name('store.campus');
        Route::get('/edit/campus/{id}', 'EditCampus')->name('edit.campus')->middleware('permission:edit.campus');
        Route::post('/update/campus/{id}', 'UpdateCampus')->name('update.campus');
        Route::get('/delete/campus/{id}', 'DeleteCampus')->name('delete.campus')->middleware('permission:delete.campus');
    });

    //University all route
    Route::controller(UniversityController::class)->group(function(){
        Route::get('/all/university','AllUniversity')->name('all.university')->middleware('permission:all.university');
        Route::get('/add/university','AddUniversity')->name('add.university')->middleware('permission:add.university');
        Route::post('/store/university', 'StoreUniversity')->name('store.university');
        Route::get('/edit/university/{id}', 'EditUniversity')->name('edit.university')->middleware('permission:edit.university');
        Route::post('/update/university/{id}', 'UpdateUniversity')->name('update.university');
        Route::get('/delete/university/{id}', 'DeleteUniversity')->name('delete.university')->middleware('permission:delete.university');
        Route::get('/status/{id}','status')->name('university.status');
    });

    //Country all route
    Route::controller(CountryController::class)->group(function(){
        Route::get('/all/country','AllCountry')->name('all.country')->middleware('permission:all.country');
        Route::get('/add/country','AddCountry')->name('add.country')->middleware('permission:add.country');
        Route::post('/store/country', 'StoreCountry')->name('store.country');
        Route::get('/edit/country/{id}', 'EditCountry')->name('edit.country')->middleware('permission:edit.country');
        Route::post('/update/country/{id}', 'UpdateCountry')->name('update.country');
        Route::get('/delete/country/{id}', 'DeleteCountry')->name('delete.country')->middleware('permission:delete.country');
    });

    //Course Name all route
    Route::controller(CourseNameController::class)->group(function(){
        Route::get('/all/course_name','AllCourseName')->name('all.course_name')->middleware('permission:all.course_name');
        Route::get('/add/course_name','AddCourseName')->name('add.course_name')->middleware('permission:add.course_name');
        Route::post('/store/course_name', 'StoreCourseName')->name('store.course_name');
        Route::get('/edit/course_name/{id}', 'EditCourseName')->name('edit.course_name')->middleware('permission:edit.course_name');
        Route::post('/update/course_name/{id}', 'UpdateCourseName')->name('update.course_name');
        Route::get('/delete/course_name/{id}', 'DeleteCourseName')->name('delete.course_name')->middleware('permission:delete.course_name');
    });

    //Permission all route
    Route::controller(RoleController::class)->group(function(){
        Route::get('/all/permission','AllPermission')->name('all.permission');
        Route::get('/add/permission','AddPermission')->name('add.permission');
        Route::post('/store/permission', 'StorePermission')->name('store.permission');
        Route::get('/edit/permission/{id}', 'EditPermission')->name('edit.permission');
        Route::post('/update/permission', 'UpdatePermission')->name('update.permission');
        Route::get('/delete/permission/{id}', 'DeletePermission')->name('delete.permission');

    });

    //role all route
     Route::controller(RoleController::class)->group(function(){
        Route::get('/all/role','AllRole')->name('all.role');
        Route::get('/add/role','AddRole')->name('add.role');
        Route::post('/store/role', 'StoreRole')->name('store.role');
        Route::get('/edit/role/{id}', 'EditRole')->name('edit.role');
        Route::post('/update/role', 'UpdateRole')->name('update.role');
        Route::get('/delete/role/{id}', 'DeleteRole')->name('delete.role');

        Route::get('/add/roles/permission','AddRolesPermission')->name('add.roles.permission');
        Route::post('/role/permission/store','RolePermissionStore')->name('role.permission.store');
        Route::get('/all/roles/permission','AllRolesPermission')->name('all.roles.permission');
        Route::get('/admin/edit/roles/{id}','AdminEditRoles')->name('admin.edit.roles');
        Route::post('/admin/roles/update/{id}','AdminRolesUpdate')->name('admin.roles.update');
        Route::get('/admin/delete/roles/{id}','AdminDeleteRoles')->name('admin.delete.roles');

    });

    //Admin user
    Route::controller(AdminController::class)->group(function(){

        Route::get('/all/admin','AllAdmin')->name('all.admin');
        Route::get('/add/admin','AddAdmin')->name('add.admin');
        Route::post('/store/admin','StoreAdmin')->name('store.admin');
        Route::get('/edit/admin/{id}','EditAdmin')->name('edit.admin');
        Route::post('/update/admin/{id}','UpdateAdmin')->name('update.admin');
        Route::get('/delete/admin/{id}','DeleteAdmin')->name('delete.admin');
    });


});  //end Property type all Route
