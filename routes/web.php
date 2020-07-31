<?php

use App\FaqStudent;
use App\FaqInstructor;
use App\User;
use App\Setting;
use App\Helpers\AttendanceHelper;


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



  
Route::middleware(['web','IsInstalled' ,'switch_languages'])->group(function () {

    // Auth Routes
Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');
  
      Route::get('/', 'HomeController@index')->name('webhome');
        Route::get('/learnpage', 'HomeController@newhome')->name('oldhome');
        Route::post('/contactsubmit','HomeController@contact')->name('contactsubmit');

      Auth::routes(['verify' => true, 'register' => false]);

    Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

    Route::get('/home', 'HomeController@index')->name('home');
 

    Route::prefix('admins')->group(function (){
        Route::get('/', 'AdminController@index')->name('admin.index');
    });
  
  

  Route::middleware(['web', 'auth', 'switch_languages'])->group(function () {

    // Player Settings
    Route::get('/admin/playersetting','PlayerSettingController@get')->name('player.set');
    Route::post('/admin/playersetting/update','PlayerSettingController@update')->name('player.update');


    Route::get('admin/ads','AdsController@getAds')->name('ads');
    Route::post('admin/ads/insert','AdsController@store')->name('ad.store');

    Route::get('admin/ads/setting','AdsController@getAdsSettings')->name('ad.setting');

    Route::put('admin/ads/timer','AdsController@updateAd')->name('ad.update');

    Route::put('admin/ads/pop','AdsController@updatePopAd')->name('ad.pop.update');

    Route::delete('admin/ads/delete/{id}','AdsController@delete')->name('ad.delete');

    Route::get('admin/ads/create','AdsController@create')->name('ad.create');

    Route::get('admin/ads/edit/{id}','AdsController@showEdit')->name('ad.edit');

    Route::put('admin/ads/edit/{id}','AdsController@updateADSOLO')->name('ad.update.solo');

    Route::put('admin/ads/video/{id}','AdsController@updateVideoAD')->name('ad.update.video');

    Route::post('admin/ads/bulk_delete', 'AdsController@bulk_delete');

    Route::post('/quickupdate/course/{id}','QuickUpdateController@courseQuick')->name('course.quick');
    Route::post('/quickupdate/user/{id}','QuickUpdateController@userQuick')->name('user.quick');
    Route::post('/quickupdate/slider/{id}','QuickUpdateController@sliderQuick')->name('slider.quick');
    Route::post('/quickudate/course/{id}','QuickUpdateController@courseabc')->name('course.featured');
    Route::post('/quickupdate/category/{id}','QuickUpdateController@categoryQuick')->name('category.quick');
    Route::post('/quickupdate/language/{id}','QuickUpdateController@languageQuick')->name('language.quick');
    Route::post('/quickupdate/pag/{id}','QuickUpdateController@pageQuick')->name('page.quick');
    Route::post('/quickupdate/what/{id}','QuickUpdateController@whatQuick')->name('what.quick');
    Route::post('/quickupdate/ansr/{id}','QuickUpdateController@ansrQuick')->name('ansr.quick');
    Route::post('/quickupdate/Chapter/{id}','QuickUpdateController@ChapterQuick')->name('Chapter.quick');
    Route::post('/quickupdate/testimonial/{id}','QuickUpdateController@testimonialQuick')->name('testimonial.quick');
    Route::post('/quickupdate/subcategory/{id}','QuickUpdateController@subcategoryQuick')->name('subcategory.quick');
    Route::post('/quickupdate/childcategory/{id}','QuickUpdateController@childcategoryQuick')->name('childcategory.quick');
    Route::post('/quickupdate/y/{id}','QuickUpdateController@categoryfQuick')->name('categoryf.quick');
    Route::post('/quickupdate/blog_status/{id}','QuickUpdateController@blog_statusQuick')->name('blog.status.quick');
    Route::post('/quickupdate/blog_approved/{id}','QuickUpdateController@blog_approvedQuick')->name('blog.approved.quick');
    Route::post('/quickupdate/status/{id}','QuickUpdateController@reviewstatusQuick')->name('reviewstatus.quick');
    Route::post('/quickupdate/approved/{id}','QuickUpdateController@reviewapprovedQuick')->name('reviewapproved.quick');
    Route::post('/quickupdate/featured/{id}','QuickUpdateController@reviewfeaturedQuick')->name('reviewfeatured.quick');
    Route::post('/quickupdate/faq/{id}','QuickUpdateController@faqQuick')->name('faq.quick');
    Route::post('/quickupdate/faqinstructor/{id}','QuickUpdateController@faqInstructorQuick')->name('faqInstructor.quick');

    Route::post('/quickupdate/order/{id}','QuickUpdateController@orderQuick')->name('order.quick');

    Route::prefix('user')->group(function (){
    Route::get('/','UserController@viewAllUser')->name('user.index');
       Route::post('/search','UserController@searchuser')->name('user.search');
    Route::get('/assign','UserController@assignStudent')->name('assign.index');
     Route::post('/assign','UserController@assignToStudent')->name('assign.index');
     Route::get('/adduser','UserController@create')->name('user.add');
       Route::post('/unassign/{id}','UserController@unassign')->name('unassign.index');
    Route::post('/insertuser','UserController@store')->name('user.store');
    Route::get('edit/{id}','UserController@edit')->name('user.edit');
    Route::put('/edit/{id}','UserController@update')->name('user.update');   
    Route::delete('delete/{id}','UserController@destroy')->name('user.delete');
    });

    Route::resource("admin/country","CountryController");
    Route::resource("admin/state","StateController");
    Route::resource("admin/city","CityController");
    

    

    Route::get('/admin/api','ApiController@setApiView')->name('api.setApiView');
    Route::post('admin/api','ApiController@changeEnvKeys')->name('api.update');
    Route::put('/review/update/{id}','ReviewratingController@update')
    ->name('review.update');

    Route::resource('facts', 'SliderfactsController');
    Route::get('coursetext', 'CoursetextController@show');
    Route::put('coursetext/update', 'CoursetextController@update');
    Route::get('getstarted', 'GetstartedController@show');
    Route::put('getstarted/update', 'GetstartedController@update');
    Route::resource('hometext', 'HomeTextController');
    Route::get('terms', 'TermsController@show')->name('termscondition');
    Route::put('termscondition', 'TermsController@update');
    Route::get('policy', 'TermsController@showpolicy')->name('policy');
    Route::put('privacypolicy', 'TermsController@updatepolicy');

    Route::resource('reports','ReportReviewController');
    
    Route::get('aboutpage', 'AboutController@show')->name('about.page');
    Route::put('aboutupdate', 'AboutController@update');
    Route::get('comingsoon', 'ComingSoonController@show')->name('comingsoon.page');
    Route::put('comingsoonupdate', 'ComingSoonController@update');
    Route::get('careers', 'CareersController@show')->name('careers.page');
    Route::put('careers/update', 'CareersController@update');
    Route::resource('faq','FaqController');
    Route::resource('faqinstructor','FaqInstructorController');
    Route::resource('carts', 'CartController');

    Route::get('currency', 'CurrencyController@show');
    Route::put('currency/update', 'CurrencyController@update');
    
    Route::resource('order', 'OrderController');

    Route::get('widget', 'WidgetController@edit')->name('widget.setting');
    Route::put('widget/update', 'WidgetController@update');
    Route::post('admin/class/{id}/addsubtitle','SubtitleController@post')->name('add.subtitle');
    Route::post('admin/class/{id}/delete/subtitle','SubtitleController@delete')->name('del.subtitle');

    Route::get('frontslider', 'CategorySliderController@show')->name('category.slider');
    Route::put('frontslider/update', 'CategorySliderController@update');

    Route::resource('requestinstructor', 'InstructorRequestController');

    Route::resource('coupon','CouponController');
    Route::get('all/instructor', 'InstructorRequestController@allinstructor')->name('all.instructor');
    Route::get('view/order/admin/{id}', 'OrderController@vieworder')->name('view.order');

    Route::resource('user/course/report','CourseReportController');

   

    Route::get('admin/lang', 'LanguageController@showlang')->name('show.lang');

    Route::get('admin/frontstatic/{local}', 'LanguageController@frontstaticword')->name('frontstatic.lang');

    Route::post('/admin/update/{lang}/frontTranslations/content','LanguageController@frontupdate')->name('static.trans.update');

    Route::get('admin/adminstatic/{local}', 'LanguageController@adminstaticword')->name('adminstatic.lang');

    Route::post('/admin/update/{lang}/adminTranslations/content','LanguageController@adminupdate')->name('admin.static.update');

    Route::get('admin/pwa', 'PwaSettingController@index')->name('show.pwa');

    Route::post('/admin/pwa/update/manifest','PwaSettingController@updatemanifest')->name('manifest.update');

    Route::post('/admin/pwa/update/sw','PwaSettingController@updatesw')->name('sw.update');

    Route::post('/admin/pwa/update/icons','PwaSettingController@updateicons')->name('icons.update');

    Route::post('/admin/manualcity','CityController@addcity')->name('city.manual');

    Route::resource('user/question/report','QuestionReportController');

  });

  Route::middleware(['web', 'is_active', 'auth','admin_instructor', 'switch_languages','userdailyattendance'])->group(function () {

     $zoom_enable = Setting::first()->zoom_enable;



    Route::prefix('user')->group(function (){
      Route::get('edit/{id}','UserController@edit')->name('user.edit');
      Route::put('/edit/{id}','UserController@update')->name('user.update');
    });

    Route::resource('category','CategoriesController');
    Route::get('/category/{slug}','CategoriesController@show')->name('category.show'); 
    Route::resource('subcategory','SubcategoryController');
    Route::resource('childcategory','ChildcategoryController');
    Route::resource('course','CourseController');
    Route::resource('courseinclude','CourseincludeController');
    Route::resource('coursechapter','CoursechapterController');
    Route::resource('whatlearns','WhatlearnsController');
    Route::resource('relatedcourse','RelatedcourseController');
    Route::resource('questionanswer','QuestionanswerController');
    Route::resource('courseanswer', 'AnswerController');
    Route::resource('viewprocess','ViewProcessController');
    Route::resource('courseclass','CourseclassController');
    Route::resource('reviewrating','ReviewratingController');
    Route::resource('announsment','AnnounsmentController');
    Route::get('/course/create/{id}','CourseController@showCourse')->name('course.show');
    Route::post('/category/insert','CategoriesController@categoryStore')->name('cat.store');
    Route::post('/subcategory/insert','SubcategoryController@SubcategoryStore')->name('child.store');
    Route::put('/course/include/{id}','CourseController@testup')->name('corinc.update');
    Route::put('/course/whatlearns/{id}','CourseController@test')->name('what.update');
    Route::put('/course/coursechapter/{id}','CourseController@tes')->name('chapter.update');
    Route::get('send', 'CourseclassController@store')->name('notification');
    Route::resource('courselang','CourseLanguageController');
    Route::get("admin/dropdown","CourseController@upload_info");
    Route::get("admin/gcat","CourseController@gcato");


    Route::get('instructor', 'InstructorController@index')->name('instructor.index');
    Route::resource('userenroll', 'InstructorEnrollController');
    Route::get('attendances/students/{id}', 'AttendanceController@viewStudentsAttendance')->name('students.attendances');
      Route::post('attendances/students/{id}', 'AttendanceController@viewStudentsAttendanceByDate')->name('students.attendances.post');
    Route::resource('instructorquestion', 'InstructorQuestionController');
    Route::resource('instructoranswer', 'InstructorAnswerController');
    Route::get('coursereview', 'CourseReviewController@index');
    Route::get('attendance/students','AttendanceController@StudentAttendance')->name('students.attendance.index');


    Route::resource('instructor/announcement', 'InstructorAnnouncementController');
    Route::resource('usermessage', 'ContactUsController');
    Route::resource('languages', 'LanguageController');

    Route::get('reposition/category', 'CategoriesController@reposition')->name('category_reposition');

    Route::get('reposition/class', 'CourseclassController@reposition')->name('class_reposition');

    Route::get('reposition/slider', 'SliderController@reposition')->name('slider_reposition');

    Route::resource('admin/quiztopic', 'QuizTopicController');

    Route::resource('/admin/questions', 'QuizController');

   // Route::resource('blog', 'BlogController');

  });

  
  
  Route::middleware(['web','switch_languages','userdailyattendance','auth'])->group(function () {

    Route::post('rating/show/{id}','ReviewratingController@rating')->name('course.rating');
    Route::post('reports/insert/{id}','ReportReviewController@store')->name('report.review');
    Route::get('/course/{id}/{slug}','CourseController@CourseDetailPage')->name('user.course.show');
    Route::get('all/blog','BlogController@blogpage')->name('blog.all');
    Route::get('about/show','AboutController@aboutpage')->name('about.show');
    Route::get('show/comingsoon','ComingSoonController@comingsoonpage')
    ->name('comingsoon.show');
    Route::get('show/careers','CareersController@careerpage')->name('careers.show');
    Route::get('detail/blog/{id}','BlogController@blogdetailpage')->name('blog.detail');
    Route::get('gotomycourse', 'CourseController@mycoursepage')->name('mycourse.show');

    Route::get('show/help', function(){
    $data = FaqStudent::first();
    $item = FaqInstructor::first();
    return view('front.help.faq',compact('data', 'item')); 
    })->name('help.show');

    Route::post('show/wishlist/{id}','WishlistController@wishlist');
    Route::post('remove/wishlist/{id}','WishlistController@removewishlist');

    Route::get('enroll/show/{id}', 'EnrollmentController@enroll')->name('show.enroll');

    Route::get('show/coursecontent/{id}', 'CourseController@CourseContentPage');

    Route::post('addquestion/{id}','QuestionanswerController@question');
    Route::post('addanswer/{id}','AnswerController@answer');
    Route::post('delete/wishlist/{id}', 'WishlistController@deletewishlist');

    Route::post('addtocart', 'CartController@addtocart')->name('addtocart');

    Route::post('removefromcart/{id}','CartController@removefromcart')
      ->name('remove.item.cart');


    Route::post('gotocheckout', 'CheckoutController@checkoutpage');
    
    Route::get('notifications/{id}', 'NotificationController@markAsRead')
    ->name('markAsRead');
    Route::get('delete/notifications', 'NotificationController@delete')
    ->name('deleteNotification');

    Route::get('/view', 'DownloadController@getDownload');

    Route::get('/download/{id}', 'DownloadController@getDownload')->name('downloadPdf')->middleware('auth');

    Route::post('review/helpful/{id}', 'ReviewHelpfulController@store')->name('helpful');
    Route::post('review/delete/{id}', 'ReviewHelpfulController@destroy')
    ->name('helpful.delete');

    Route::get('gotocategory/page/{id}', 'CategoriesController@categorypage')->name('category.page');
    Route::get('gotosubcategory/page/{id}', 'CategoriesController@subcategorypage')->name('subcategory.page');
    Route::get('gotochildcategory/page/{id}', 'CategoriesController@childcategorypage')->name('childcategory.page');

    Route::post('apply/instructor', 'InstructorRequestController@instructor')
    ->name('apply.instructor');

    Route::get('search', 'SearchController@index')->name('search');

    Route::get('/user/movie/time/{endtime}/{movie_id}/{user_id}','TimeHistoryController@movie_time');

    Route::get('all/purchase', 'OrderController@purchasehistory')->name('purchase.show');
      Route::get('reports', 'ReportController@index')->name('front.report.index');
        Route::get('reports/attendance/show', 'ReportController@showAttendance')->name('attendance.show');
    Route::get('invoice/show/{id}', 'OrderController@invoice')->name('invoice.show');

    
    Route::get('profile/show/{id}', 'UserProfileController@userprofilepage')->name('profile.show');

    Route::get('dashboard','UserProfileController@userdashboard')->name('dashboard')->middleware('auth');

       Route::get('profile/attendance/{id}', 'UserProfileController@userattendance')->name('profile.attendance');
    Route::put('/edit/{id}','UserProfileController@userprofile')->name('user.profile');

    Route::post('course/reports/{id}','CourseReportController@store')->name('course.report');

    Route::get('watch/course/{id}', 'WatchController@watch')->name('watchcourse');
    Route::get('watch/courseclass/{id}', 'WatchController@watchclass')->name('watchcourseclass');
    Route::get('stoplecture', 'WatchController@stopClass')->name('stopclass');
    Route::get('stopcourse', 'CourseController@stopCourse')->name('stopcourse');

    Route::get('language-switch/{local}', 'LanguageSwitchController@languageSwitch')->name('languageSwitch');

    Route::get("country/dropdown","CountryController@upload_info");
    Route::get("country/gcity","CountryController@gcity");

    Route::view('terms_condition', 'terms_condition');
    Route::view('privacy_policy', 'privacy_policy');

    Route::get('detail/faq/{id}','HelpController@faqstudentpage')->name('faq.detail');
    Route::get('faqinstructor/detail/{id}','HelpController@faqinstructorpage')->name('faqinstructor.detail');

    Route::view('user_contact', 'front.contact');
    Route::post('contact/user', 'ContactUsController@usermessage')
    ->name('contact.user');

    Route::get('tabcontent/{id}','TabController@show');

    Route::post('paywithpaypal', 'PaypalController@payWithpaypal')->name('payWithpaypal');
    Route::get('getpaymentstatus', 'PaypalController@getPaymentStatus')->name('status');

    Route::get('event', 'InstaMojoController@index');
    Route::post('pay', 'InstaMojoController@pay');
    Route::get('pay-success', 'InstaMojoController@success');

    Route::get('stripe', 'StripePaymentController@stripe');
    Route::post('paytostripe', 'StripePaymentController@payStripe')->name('stripe.pay');

    Route::get('payment/braintree', 'BraintreeController@get_bt');
    Route::post('payment/braintree', 'BraintreeController@payment');

    Route::get('razorpay', 'RazorpayController@pay')->name('pay');
    Route::post('dopayment', 'RazorpayController@dopayment')->name('dopayment');

    Route::post('/paywithpaystack', 'PayStackController@redirectToGateway')->name('paywithpaystack');
    Route::get('callback', 'PayStackController@handleGatewayCallback'); 

    Route::post('apply/coupon', 'ApplyCouponController@applycoupon');

    Route::post('removecoupon/{id}','ApplyCouponController@remove')
      ->name('remove.coupon');

    Route::post('/paywithpayment', 'PaytmController@order')->name('paywithpayment');
    Route::post('/payment/status', 'PaytmController@paymentCallback');

    //Route::post('process/banktransfer', 'BankTransferController@banktransfer');
    
    Route::get('watchcourse/in/frame/{url}/{course_id}', 'WatchController@view')->name('watchinframe');

    Route::get('start_quiz/{id}', 'QuizStartController@quizstart')->name('start_quiz');

    Route::post('/start_quiz/store/{id}','QuizStartController@store')->name('start.quiz.store');

    Route::get('finish/{id}','QuizStartController@show')->name('start.quiz.show');

    Route::get('pages/{slug}','PageController@showpage')->name('page.show');

    Route::get('invoice/download/{id}', 'OrderController@pdfdownload')->name('invoice.download');

    Route::get('watch/lightbox/{id}', 'WatchController@lightbox')->name('lightbox');

    Route::post('question/reports/{id}','QuestionReportController@store')->name('question.report');

    

  });

});


Route::get("allcountry/dropdown","AllCountryController@upload_info");
Route::get("allcountry/gcity","AllCountryController@gcity");

Route::resource('featurecourse', 'FeatureCourseController');

Route::post('/paywithpaytm', 'FeatureCourseController@order')->name('paywithpaytm');
Route::post('/featurepayment/status', 'FeatureCourseController@paymentCallback');


Route::get('answersheet/{id}', 'QuizTopicController@delete')->name('answersheet');

Route::get('tryagain/{id}', 'QuizStartController@tryagain')->name('tryagain');

Route::get('admin/instructor/settings', 'InstructorSettingController@view')->name('instructor.settings');

Route::post('admin/instructor/update', 'InstructorSettingController@update')->name('instructor.update');

Route::get('instructor/details', 'InstructorSettingController@instructor')->name('instructor.pay');

Route::post('instructor/payout/{id}', 'InstructorSettingController@settings')->name('instructor.payout');


Route::get('pending/payout', 'PayoutController@pending')->name('pending.payout');

Route::get('admin/instructor', 'AdminPayoutController@index')->name('admin.instructor');

Route::get('admin/pending/{id}', 'AdminPayoutController@pending')->name('admin.pending');
Route::get('admin/paid/{id}', 'AdminPayoutController@paid')->name('admin.paid');


Route::post('admin/payout/bulk_payout/{id}', 'AdminPayoutController@bulk_payout');

Route::post('admin/paypal/{id}', 'PaymentController@paypal')->name('admin.paypal');




Route::post('featuredwithpaypal', 'FeatureCourseController@payWithpaypal')->name('featuredWithpaypal');
Route::get('getfeaturedstatus', 'FeatureCourseController@getPaymentStatus')->name('featured');




Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
  \UniSharp\LaravelFilemanager\Lfm::routes();
});


