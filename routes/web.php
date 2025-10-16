<?php

use App\Http\Controllers\BackEnd\AdminDashboardController;
use App\Http\Controllers\BackEnd\CategoryController;
use App\Http\Controllers\BackEnd\ClientController;
use App\Http\Controllers\BackEnd\ContactController;
use App\Http\Controllers\BackEnd\CourseController;
use App\Http\Controllers\BackEnd\GalleryController;
use App\Http\Controllers\BackEnd\LandingPageController;
use App\Http\Controllers\backEnd\StudentController;
use App\Http\Controllers\BackEnd\NotificationController;
use App\Http\Controllers\backEnd\OrderController;
use App\Http\Controllers\BackEnd\ProjectController;
use App\Http\Controllers\BackEnd\ServiceController;
use App\Http\Controllers\BackEnd\SliderController;
use App\Http\Controllers\BackEnd\TeacherController;
use App\Http\Controllers\BackEnd\TeamController;
use App\Http\Controllers\FrontEnd\Account\MemberAccountController;
use App\Http\Controllers\FrontEnd\CourseController as FrontEndCourseController;
use App\Http\Controllers\FrontEnd\HomeController;
use App\Http\Controllers\FrontEnd\NoticeController;
use App\Http\Controllers\FrontEnd\PanelController;
use App\Http\Controllers\FrontEnd\ServiceController as FrontEndServiceController;
use App\Http\Controllers\FrontEnd\TempImagesController ;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
/*Front end routes*/ 
Route::get('/',[HomeController::class,'index'])->name('home');
// Course routes
Route::get('/course',[FrontEndCourseController::class,'index'])->name('home.course');
Route::get('/course/{id}', [FrontEndCourseController::class, 'show'])->name('home.course.show');
Route::get('/course/enroll/{id}', [FrontEndCourseController::class, 'enroll'])->name('home.course.enroll');
Route::post('/course/order/store',[FrontEndCourseController::class,'store'])->name('home.course.enroll.order.store');
// about
Route::get('/about',[HomeController::class,'about'])->name('home.about');
Route::get('/about/management',[HomeController::class,'management'])->name('home.management');
Route::get('/about/team',[HomeController::class,'team'])->name('home.team');
Route::get('/about/org-chart',[HomeController::class,'orgChart'])->name('home.org-chart');
Route::get('/client-and-partner',[HomeController::class,'client'])->name('home.client');
// Front End gallery routes
Route::get('/Gallery',[HomeController::class,'gallery_view'])->name('home.gallery.view');
// Front end Controller routes
Route::get('/contact',[HomeController::class,'contact'])->name('home.contact.view');
Route::post('/contact/store',[HomeController::class,'contact_store'])->name('home.contact.store');
// Front end notice routes
Route::get('/all-notice',[NoticeController::class,'all_notice'])->name('home.notice.all');
Route::get('/notice/{id}',[NoticeController::class,'notice'])->name('home.notice.show');
Route::get('/notice/search', [NoticeController::class, 'search'])->name('home.notice.search');

// Front end service routes
Route::get('/all-project',[HomeController::class,'project_all'])->name('home.project.all');
Route::get('/project/{id}',[HomeController::class,'project_show'])->name('home.project.show');
Route::get('/project/search', [HomeController::class, 'project_search'])->name('home.project.search');
// Front end service routes
// Fixed Services Start
Route::get('/service/ventilation-system',[FrontEndServiceController::class,'ventilation_system'])->name('home.service.fixed-ventilation-system-page');
Route::get('/service/fire-fighting-system',[FrontEndServiceController::class,'fighting_system'])->name('home.service.fixed-fire-fighting-system-page');
Route::get('/service/plumbing-works',[FrontEndServiceController::class,'plumbing_works'])->name('home.service.fixed-plumbing-works-page');
Route::get('/service/additional-works',[FrontEndServiceController::class,'additional_works'])->name('home.service.fixed-additional-works-page');
// Fixed Services End

Route::get('/all-service',[FrontEndServiceController::class,'all'])->name('home.service.all');
Route::get('/service/{id}',[FrontEndServiceController::class,'service'])->name('home.service.show');
Route::get('/service/search', [FrontEndServiceController::class, 'search'])->name('home.service.search');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Admin panel routes
Route::middleware(['auth', 'verified','role:admin'])->group( function () {
    Route::get('/admin/dashboard',[AdminDashboardController::class,'index'])->name('admin.dashboard');
    // STUDENT ROUTES
    Route::get('admin/student/all',[StudentController::class,'index'])->name('admin.student.all');
    Route::get('admin/student/crate/',[StudentController::class,'create'])->name('admin.student.create');
    Route::post('admin/student/store/',[StudentController::class,'store'])->name('admin.student.store');
    Route::get('admin/student/edit/{id}',[StudentController::class,'edit'])->name('admin.student.edit');
    Route::post('admin/student/update',[StudentController::class,'update'])->name('admin.student.update');
    Route::post('admin/student/delete/',[StudentController::class,'delete'])->name('admin.student.delete');
    
    // CONTACT QUESTION ROUTS
    Route::get('admin/contact/all',[ContactController::class,'index'])->name('admin.contact.all');
    Route::get('admin/contact/edit/{id}',[ContactController::class,'edit'])->name('admin.contact.edit');
    Route::post('admin/contact/update',[ContactController::class,'update'])->name('admin.contact.update');
    Route::post('admin/contact/delete/',[ContactController::class,'delete'])->name('admin.contact.delete');
   
    // PROJECT ROUTES
    Route::get('/admin/project',[ProjectController::class,'index'])->name('admin.project');
    Route::post('/admin/project/store',[ProjectController::class,'store'])->name('admin.project.store');
    Route::get('/admin/project/edit/{id}',[ProjectController::class,'edit'])->name('admin.project.edit');
    Route::post('/admin/project/update',[ProjectController::class,'update'])->name('admin.project.update');
    Route::post('/admin/project/delete/',[ProjectController::class,'delete'])->name('admin.project.delete');
    Route::get('/admin/project/show/{id}',[ProjectController::class,'show'])->name('admin.project.show');
    
    // project RESOURCE ROUTES
    Route::post('/admin/project/resource/store',[ProjectController::class,'store_resource'])->name('admin.project.resource.store');
    Route::post('/admin/project/resource/update/',[ProjectController::class,'update_resource'])->name('admin.project.resource.update');
    Route::post('/admin/project/resource/delete/',[ProjectController::class,'delete_resource'])->name('admin.project.resource.delete');

    // CATEGORY ROUTES
    Route::get('/admin/category',[CategoryController::class,'index'])->name('admin.category');
    Route::post('/admin/category/store',[CategoryController::class,'store'])->name('admin.category.store');
    Route::get('/admin/category/edit/{id}',[CategoryController::class,'edit'])->name('admin.category.edit');
    Route::post('/admin/category/update',[CategoryController::class,'update'])->name('admin.category.update');
    Route::post('/admin/category/delete/',[CategoryController::class,'delete'])->name('admin.category.delete');
    Route::get('/admin/category/show/{id}',[CategoryController::class,'show'])->name('admin.category.show');
    // SERVICE ROUTES
    Route::get('/admin/service',[ServiceController::class,'index'])->name('admin.service');
    Route::post('/admin/service/store',[ServiceController::class,'store'])->name('admin.service.store');
    Route::get('/admin/service/edit/{id}',[ServiceController::class,'edit'])->name('admin.service.edit');
    Route::post('/admin/service/update',[ServiceController::class,'update'])->name('admin.service.update');
    Route::post('/admin/service/delete/',[ServiceController::class,'delete'])->name('admin.service.delete');
    Route::get('/admin/service/show/{id}',[ServiceController::class,'show'])->name('admin.service.show');
    // SLIDER ROUTES
    Route::get('/admin/slider',[SliderController::class,'index'])->name('admin.slider');
    Route::post('/admin/slider/store',[SliderController::class,'store'])->name('admin.slider.store');
    Route::get('/admin/slider/edit/{id}',[SliderController::class,'edit'])->name('admin.slider.edit');
    Route::post('/admin/slider/update',[SliderController::class,'update'])->name('admin.slider.update');
    Route::post('/admin/slider/delete/',[SliderController::class,'delete'])->name('admin.slider.delete');
    Route::get('/admin/slider/show/{id}',[SliderController::class,'show'])->name('admin.slider.show');
    // Team ROUTES
    Route::get('/admin/team',[TeamController::class,'index'])->name('admin.team');
    Route::post('/admin/team/store',[TeamController::class,'store'])->name('admin.team.store');
    Route::get('/admin/team/edit/{id}',[TeamController::class,'edit'])->name('admin.team.edit');
    Route::post('/admin/team/update',[TeamController::class,'update'])->name('admin.team.update');
    Route::post('/admin/team/delete/',[TeamController::class,'delete'])->name('admin.team.delete');
    Route::get('/admin/team/show/{id}',[TeamController::class,'show'])->name('admin.team.show');
    // NOTIFICATION ROUTES
    Route::get('/admin/notification',[NotificationController::class,'index'])->name('admin.notification');
    Route::post('/admin/notification/store',[NotificationController::class,'store'])->name('admin.notification.store');
    Route::get('/admin/notification/edit/{id}',[NotificationController::class,'edit'])->name('admin.notification.edit');
    Route::post('/admin/notification/update',[NotificationController::class,'update'])->name('admin.notification.update');
    Route::post('/admin/notification/delete/',[NotificationController::class,'delete'])->name('admin.notification.delete');
    Route::get('/admin/notification/show/{id}',[NotificationController::class,'show'])->name('admin.notification.show');
    // CLIENT ROUTES
    Route::get('/admin/client',[ClientController::class,'index'])->name('admin.client');
    Route::post('/admin/client/store',[ClientController::class,'store'])->name('admin.client.store');
    Route::get('/admin/client/edit/{id}',[ClientController::class,'edit'])->name('admin.client.edit');
    Route::post('/admin/client/update',[ClientController::class,'update'])->name('admin.client.update');
    Route::post('/admin/client/delete/',[ClientController::class,'delete'])->name('admin.client.delete');
    Route::get('/admin/client/show/{id}',[ClientController::class,'show'])->name('admin.client.show');
    // GALLERY ROUTES
    Route::get('/admin/gallery',[GalleryController::class,'index'])->name('admin.gallery');
    Route::post('/admin/gallery/store',[GalleryController::class,'store'])->name('admin.gallery.store');
    Route::get('/admin/gallery/edit/{id}',[GalleryController::class,'edit'])->name('admin.gallery.edit');
    Route::post('/admin/gallery/update',[GalleryController::class,'update'])->name('admin.gallery.update');
    Route::post('/admin/gallery/delete/',[GalleryController::class,'delete'])->name('admin.gallery.delete');
    Route::get('/admin/gallery/show/{id}',[GalleryController::class,'show'])->name('admin.gallery.show');
    // LANDING PAGE ROUTES
    Route::get('/admin/landing_page',[LandingPageController::class,'index'])->name('admin.landing_page');
    Route::post('/admin/landing_page/logo/store',[LandingPageController::class,'logo_store'])->name('admin.landing_page.logo.store');
    Route::post('/admin/landing_page/site_info/store',[LandingPageController::class,'site_info_store'])->name('admin.landing_page.site_info.store');
    Route::post('/admin/landing_page/about/store',[LandingPageController::class,'about_store'])->name('admin.landing_page.about.store');
    Route::post('/admin/landing_page/feature_video/store',[LandingPageController::class,'feature_video_store'])->name('admin.landing_page.feature_video.store');
});



require __DIR__.'/auth.php';
