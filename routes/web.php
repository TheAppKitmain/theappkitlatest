<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    NotificationController,
    AdminController,
    ShopifyController,
    FirebaseController,
    TemplateviewController,
    EmployeeUpdateController,
    BuildappController,
    OtpController,
    BlogController as AdminBlogController, // Alias to avoid conflict
    FaqController as AdminFaqController, // Alias to avoid conflict
    OurWorkController as AdminOurWorkController, // Alias to avoid conflict
    AddteamController,
    ToDoListController,
    InternalUpdatesController,
    QuoteListController,
    BlogcategoriesController,
    AddCategoryController,
    AddThemeController,
    AllthemesController,
    MyteamController,
    AboutappnotesController,
    QuotesController,
    InvoicepaymentController,
    ProjectmanagerclientController,
    GetStartedController,
    ChatController,
    TimelineController,
    BugPMController,
    WebBugController,
    AdminaboutappController
};

use App\Http\Controllers\Admin\Team\DevloperappsController;
use App\Http\Controllers\Admin\Custom\BugController;

use App\Http\Controllers\{
    ContactFormController as FrontendContactFormController, // Alias to avoid conflict
    BlogController as FrontendBlogController, // Alias to avoid conflict
    FaqController as FrontendFaqController, // Alias to avoid conflict
    ResidentialController as FrontendResidentialController, // Alias to avoid conflict
    ContactController as FrontendContactController, // Alias to avoid conflict
    OurWorkController as FrontendOurWorkController, // Alias to avoid conflict
    HomeController as FrontendHomeController, // Alias to avoid conflict
    ThemeController as FrontendThemeController, // Alias to avoid conflict
    ThemeCategoryController as FrontendThemeCategoryController, // Alias to avoid conflict
    BuildappController as FrontendBuildappController, // Alias to avoid conflict
    OtpController as FrontendOtpController // Alias to avoid conflict
};

use App\Http\Controllers\Admin\Template\DashboardController;
use App\Http\Controllers\Admin\Template\TemplateuserController;
use App\Http\Controllers\Admin\Template\MyaccountController;
use App\Http\Controllers\Admin\Template\E_Commerce\MyappController;
use App\Http\Controllers\Admin\Template\E_Commerce\TypographyController;
use App\Http\Controllers\Admin\Template\E_Commerce\ProductController;
use App\Http\Controllers\Admin\Template\E_Commerce\CollectionController;
use App\Http\Controllers\Admin\Template\E_Commerce\MyOrderController;
use App\Http\Controllers\Admin\Template\E_Commerce\ShippingController;
use App\Http\Controllers\Admin\Template\ThemeAppStoreController;
use App\Http\Controllers\Admin\Template\PaymentInfoController;
use App\Http\Controllers\Admin\Template\PushNotificationController;
use App\Http\Controllers\Admin\Template\PublishController;
use App\Http\Controllers\Admin\Template\PrivacyPolicyController;
use App\Http\Controllers\Admin\Template\E_Commerce\TemplateSettingController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\Template\E_Commerce\CouponController;
use App\Http\Controllers\Admin\Template\E_Commerce\ECommStripeCredentialsController;
use App\Http\Controllers\Admin\Template\Food_Delivery\TemplateSettingController as FoodTemplateSettingController;
use App\Http\Controllers\Admin\Template\Food_Delivery\TypographyController as FoodTypographyController;
use App\Http\Controllers\Admin\Template\Food_Delivery\CategoryController;
use App\Http\Controllers\Admin\Template\Food_Delivery\ProductAttributeController;
use App\Http\Controllers\Admin\Template\Food_Delivery\ProductController as FoodProductController;
use App\Http\Controllers\Admin\Template\Food_Delivery\PushNotificationController as FoodPushNotificationController;
use App\Http\Controllers\Admin\Template\Food_Delivery\PromoController;
use App\Http\Controllers\Admin\Template\Food_Delivery\CustomerController;
use App\Http\Controllers\Admin\Template\Food_Delivery\ContactController;
use App\Http\Controllers\Admin\Template\Food_Delivery\BannerController;
use App\Http\Controllers\Admin\Template\Food_Delivery\ShopController;
use App\Http\Controllers\Admin\Template\Food_Delivery\PaymentController as  FoodPaymentController;
use App\Http\Controllers\Admin\Template\Food_Delivery\ECommSquareCredentialsController;
use App\Http\Controllers\Admin\Template\Booking\CartypeController;
use App\Http\Controllers\Admin\Template\Booking\HomeController;
use App\Http\Controllers\Admin\Template\Booking\CustomerController as BookingCustomerController;
use App\Http\Controllers\Admin\Template\Booking\ServiceController;
use App\Http\Controllers\Admin\Template\Booking\DealController;
use App\Http\Controllers\Admin\Template\Booking\PromoController as BookingPromoController;
use App\Http\Controllers\Admin\Template\Booking\FaqController;
use App\Http\Controllers\Admin\Template\Booking\TemplateSettingController as BookingTemplateSettingController;
use App\Http\Controllers\Admin\Template\Booking\BookingController;
use App\Http\Controllers\Admin\Template\Booking\MyOrderController as BookingMyOrderController;
use App\Http\Controllers\Admin\Template\Meal_Prep\TemplateSettingController as MealPrepTemplateSettingController;
use App\Http\Controllers\Admin\Template\Meal_Prep\CollectionController as MealPrepCollectionController;
use App\Http\Controllers\Admin\Template\Meal_Prep\ProductController as MealPrepProductController;




use App\Http\Controllers\Admin\Team\DashboardController as TeamDashboardController;
use App\Http\Controllers\Admin\Team\MyaccountController as TeamMyaccountController;
use App\Http\Controllers\Admin\Team\AppkitUpdatesController;
use App\Http\Controllers\Admin\Team\DevloperappsController as TeamDevloperappsController;
use App\Http\Controllers\Admin\EmployeeUpdateController as TeamEmployeeUpdateController;



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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', function () {
    $session_out = Request::input('q');
    if ($session_out == 'session_out') {
        Auth::logout();
        return view('appkit_frontend.index');
    } else {
        return view('appkit_frontend.index');
    }
})->name('myhome');

Route::get('/pricing', function () {
    return view('appkit_frontend.pricing');
});
Route::get('/solutions', function () {
    return view('appkit_frontend.solutions');
});
Route::get('/Ecommerce', function () {
    return view('appkit_frontend.Ecommerce');
});
Route::get('/booking', function () {
    return view('appkit_frontend.booking');
});
Route::get('/documents', function () {
    return view('appkit_frontend.documents');
});
Route::get('/shopify', function () {
    return view('appkit_frontend.shopify');
});
Route::get('/shopify_page', function () {
    return view('appkit_frontend.shopify_page');
});
Route::get('/privacy_policy', function () {
    return view('appkit_frontend.privacy_policy');
});

Route::post('contact-request', [FrontendContactFormController::class, 'contactRequest'])->name('contact-request');

Route::resource('blog', FrontendBlogController::class);
Route::get('blog-category/{blogcategory?}', [FrontendBlogController::class, 'bloglist'])->name('blog-category');
Route::resource('faqs', FrontendFaqController::class);
Route::resource('residential', FrontendResidentialController::class);

Route::get('contact_us', [FrontendContactController::class, 'contact_us'])->name('contact_us');
Route::get('reload-captcha', [FrontendContactController::class, 'reloadCaptcha']);

Route::resource('work', FrontendOurWorkController::class);
Route::post('contact_us_appkit', [FrontendContactController::class, 'contact_appkit_submit'])->name('contact_us_appkit');
Route::post('shopifymail', [FrontendContactController::class, 'shopifymail'])->name('shopifymail');
Route::get('frontent_home', [FrontendHomeController::class, 'index'])->name('frontent_home');

Route::resource('themes', FrontendThemeController::class);
Route::get('category-themes/{id}', [FrontendThemeController::class, 'show'])->name('category_theme');
Route::get('logout', [FrontendThemeController::class, 'logout']);
Route::get('template_modal', [FrontendThemeController::class, 'template_modal'])->name('template_modal');

Route::get('themecategory/{slug}', [FrontendThemeCategoryController::class, 'show']);
Route::any('template/{slug}', [FrontendThemeCategoryController::class, 'register_theme'])->name('template');

Route::resource('buildapp', FrontendBuildappController::class);

Route::post('user_register', [FrontendOtpController::class, 'user_register'])->name('user_register');
Route::resource('otp', FrontendOtpController::class);
Route::any('user_otp', [FrontendOtpController::class, 'user_otp'])->name('user_otp');
Route::get('otp_resend', [FrontendOtpController::class, 'otp_resend']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Super Admin
Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/admin/{type?}', [AdminController::class, 'index'])->name('super_admin');
    Route::resource('/admin', AdminController::class)->except(['index']);
    Route::get('/shopify_customers/{type?}', [ShopifyController::class, 'index'])->name('shopify_customers');
    Route::match(['get', 'post'], 'send-notification', [NotificationController::class, 'manage_notification'])->name('manage_notification');
    Route::resource('shopify_customers', ShopifyController::class)->except('index');
    Route::get('buglist', [BugController::class, 'buglist'])->name('buglist');
    Route::get('bug/{id}', [BugController::class, 'getbug'])->name('getbug');
    Route::get('showuser_app/{id}', [AdminController::class, 'showuser_app'])->name('showuser_app');
    Route::get('show_shopify_users/{id}', [ShopifyController::class, 'show_shopify_users'])->name('show_shopify_users');
    Route::get('all-messages', [FirebaseController::class, 'index'])->name('get_all_messages');
    Route::get('all-messages-data/{id?}', [FirebaseController::class, 'load_ajex_data'])->name('load_ajex_data');
    Route::get('get_count', [FirebaseController::class, 'get_count'])->name('get_count');
    Route::get('get_test_data', [FirebaseController::class, 'get_test_data'])->name('get_test_data');
    Route::post('send-message', [FirebaseController::class, 'send_message'])->name('send_message');
    Route::get('get-message/{id}', [FirebaseController::class, 'get_message'])->name('get_message');
    Route::get('showuser_app_data/{id}/{app_id}', [AdminController::class, 'showuser_app_data'])->name('showuser_app_data');
    Route::get('showuser_temp_data/{id}', [TemplateviewController::class, 'showuser_temp_data'])->name('showuser_temp_data');
    Route::get('employee_updates_list', [EmployeeUpdateController::class, 'employee_updates_list'])->name('employee_updates_list');
    Route::get('show_employee_updates/{id}', [EmployeeUpdateController::class, 'show_employee_updates'])->name('show_employee_updates');
    Route::post('short-task-list', [AdminController::class, 'short_task_list'])->name('short_task_list');
    Route::resource('user_template', TemplateviewController::class);
    Route::resource('get_started', GetStartedController::class);
    Route::resource('uploadbuild', UploadbuildController::class);
    Route::post('agreement_upload', [UploadbuildController::class, 'agreement_upload'])->name('agreement_upload');
    Route::post('bugstatus', [AdminController::class, 'bugstatus'])->name('bugstatus');
    Route::post('add_xd_link', [AdminController::class, 'add_xd_link'])->name('add_xd_link');
    Route::post('maintanence_mail', [AdminController::class, 'maintanence_mail'])->name('maintanence_mail');
    Route::post('missed_maintanence_mail', [AdminController::class, 'missed_maintanence_mail'])->name('missed_maintanence_mail');
    Route::post('missed_server_mail', [AdminController::class, 'missed_server_mail'])->name('missed_server_mail');
    Route::post('upload_details', [AdminController::class, 'upload_details'])->name('upload_details');
    Route::post('UploadAdminDetail', [AdminController::class, 'UploadAdminDetail'])->name('UploadAdminDetail');
    Route::post('pmmulaatiple_status_bug', [AdminController::class, 'pmmultiple_status_bug'])->name('pmmultiple_status_bug');
    Route::resource('addteam', AddteamController::class);
    Route::resource('faq', AdminFaqController::class);
    Route::get('faq-position/{id}', [AdminFaqController::class, 'position'])->name('faq-position');

    Route::resource('to_do_list', ToDoListController::class);
    Route::get('view_list/{id}', [ToDoListController::class, 'view_list'])->name('view_list');
    Route::post('task_reply', [ToDoListController::class, 'task_reply'])->name('task_reply');
    Route::get('delete_task/{id}', [ToDoListController::class, 'delete_task'])->name('delete_task');
    Route::post('task_status', [ToDoListController::class, 'task_status'])->name('task_status');

    Route::resource('internal_update', InternalUpdatesController::class)->only('index');
    Route::resource('quote_list', QuoteListController::class)->only('index');
    Route::get('show_notes/{id}', [InternalUpdatesController::class, 'show_notes'])->name('show_notes');
    Route::get('show_quotes/{id}', [QuoteListController::class, 'show_quotes'])->name('show_quotes');
    Route::post('store_notes', [InternalUpdatesController::class, 'store_notes'])->name('store_notes');
    Route::get('edit_note/{id}', [InternalUpdatesController::class, 'edit_note'])->name('edit_note');
    Route::post('update_notes', [InternalUpdatesController::class, 'update_notes'])->name('update_notes');
    Route::get('view_note/{id}', [InternalUpdatesController::class, 'view_note'])->name('view_note');
    Route::post('note_reply', [InternalUpdatesController::class, 'note_reply'])->name('note_reply');
    Route::post('note_status', [InternalUpdatesController::class, 'note_status'])->name('note_status');
    Route::post('quote_status', [QuoteListController::class, 'quote_status'])->name('quote_status');

    Route::get('delete_quote/{id}', [QuoteListController::class, 'delete_quote'])->name('delete_quote');
    Route::get('delete_note/{id}', [InternalUpdatesController::class, 'delete_note'])->name('delete_note');
    Route::get('bug_preview/{id}', [AdminController::class, 'bug_preview'])->name('bug_preview');
    
    Route::resource('blogcategory', BlogcategoriesController::class);
    Route::resource('theme_blog', AdminBlogController::class);
    Route::resource('our_work', AdminOurWorkController::class);
    Route::resource('addcategory', AddCategoryController::class);
    Route::resource('addtheme', AddThemeController::class);
    Route::resource('allthemes', AllthemesController::class);
    Route::resource('myteam', MyteamController::class);
    Route::resource('aboutappnotes', AboutappnotesController::class);
    Route::resource('quotes', QuotesController::class);
    Route::put('update_quote/{id}', [QuotesController::class, 'update_quote'])->name('update_quote');
    Route::resource('invoicepayment', InvoicepaymentController::class);
    Route::post('update_invoice_url', [InvoicepaymentController::class, 'update_invoice_url']);
    Route::match(['get', 'post'], 'project-managers', [AdminController::class, 'project_manager'])->name('project_manager');
    Route::match(['get', 'post'], 'developers', [AdminController::class, 'developers'])->name('developers');
    Route::get('edit-users-data/{id}/{type}', [AdminController::class, 'edit_project_manager'])->name('edit_project_manager');
    Route::put('update-users-data/{id}/{type}', [AdminController::class, 'update_project_manager'])->name('update_project_manager');
    Route::delete('delete-users-data/{id}/{type}', [AdminController::class, 'delete_project_manager'])->name('delete_project_manager');
    Route::match(['get', 'post'], 'custom_users', [AdminController::class, 'custom_users'])->name('custom_users');
    Route::get('edit_custom_users/{id}/{type}', [AdminController::class, 'edit_custom_users'])->name('edit_custom_users');
    Route::put('update_custom_users/{id}/{type}', [AdminController::class, 'update_custom_users'])->name('update_custom_users');
    Route::delete('delete_custom_users/{id}/{type}', [AdminController::class, 'delete_custom_users'])->name('delete_custom_users');
    Route::post('paymentstatus', [AdminController::class, 'paymentstatus'])->name('paymentstatus');
    Route::post('assignpm', [AdminController::class, 'assignpm'])->name('assignpm');
    Route::get('customer/pending', [ProjectmanagerclientController::class, 'myclientspending'])->name('myclientspending');
    Route::get('customer/confirmed', [ProjectmanagerclientController::class, 'myclientsconfirmed'])->name('myclientsconfirmed');
    Route::post('clientsstatus', [AdminController::class, 'clientsstatus'])->name('clientsstatus');
    Route::resource('chat', ChatController::class);
    Route::resource('timeline', TimelineController::class);
    Route::resource('pm_bugs', BugPMController::class);
    Route::post('timeline_tasksstatus', [AdminController::class, 'timeline_tasksstatus'])->name('timeline_tasksstatus');
    Route::get('message/{id}', [ChatController::class, 'getMessage'])->name('message');
    Route::post('message', [ChatController::class, 'sendMessage']);
    Route::get('delete-task/{id}', [TimelineController::class, 'custom_delete'])->name('delete_task');
    Route::post('select-developers', [DevloperappsController::class, 'store'])->name('select-developers');
    Route::get('remove-developers/{id}', [DevloperappsController::class, 'delete'])->name('remove-developers');
    Route::post('verifyandroid', [AdminController::class, 'verifyandroid'])->name('verifyandroid');
    Route::post('verifyios', [AdminController::class, 'verifyios'])->name('verifyios');
    Route::resource('web-update', WebBugController::class);
    Route::post('web_bugstatus', [WebBugController::class, 'bugstatus'])->name('web_bugstatus');
    Route::get('delete-webbug/{id}', [WebBugController::class, 'custom_delete'])->name('delete_webbug');
    Route::post('webappkit_tasksstatus', [WebBugController::class, 'webappkit_tasksstatus'])->name('webappkit_tasksstatus');
    Route::resource('adminaboutapp', AdminaboutappController::class);
    Route::group(['prefix' => 'app', 'as' => 'app.'], function () {
        Route::resource('adminaboutapp', AdminaboutappController::class);
    });
    Route::resource('blogcategories', BlogcategoriesController::class);

});

//Template Dashboard

Route::group(['middleware' => ['auth', 'custom']], function () {

    Route::resource('/dashboard', DashboardController::class);
    Route::resource('/template_user', TemplateuserController::class);
    Route::resource('/my-temp-account', MyaccountController::class);
    Route::resource('/myapp', MyappController::class);

    //Route::match(['get', 'post'], 'send-notification', [TemplateuserController::class, 'new_user'])->name('temp_new_user');
    Route::delete('temp_delete_user/{id}', [TemplateuserController::class, 'delete_user'])->name('temp_delete_user');
    Route::get('/temp_edit_customer_user/{id}',[TemplateuserController::class, 'edit_customer_user'])->name('temp_edit_customer_user');
    Route::put('/temp_update_customer_user/{id}', [TemplateuserController::class, 'update_customer_user'])->name('temp_update_customer_user');

    Route::group(['prefix' => 'theme', 'as' => 'theme.'], function () {

        // Template E_Commerce

        Route::resource('/branding', TypographyController::class);
        Route::resource('/products', ProductController::class);
        Route::get('deleted_product_image/{id}/{img}', [ProductController::class, 'deleted_product_image'])->name('deleted_product_image');
        Route::resource('/collections', CollectionController::class);
        Route::resource('/myorders', MyOrderController::class);
        Route::get('new_orders', [MyOrderController::class, 'new_orders'])->name('new_orders');
        Route::get('confirmed_orders', [MyOrderController::class, 'confirmed_orders'])->name('confirmed_orders');
        Route::get('shipped_orders', [MyOrderController::class, 'shipped_orders'])->name('shipped_orders');
        Route::post('update_status', [MyOrderController::class, 'update_status'])->name('update_status');
        Route::resource('/shipping', ShippingController::class);
        Route::resource('/appstore', ThemeAppStoreController::class);
        Route::resource('/paymentinfo', PaymentInfoController::class);
        Route::resource('/notifications', PushNotificationController::class);
        Route::resource('/publish', PublishController::class);
        Route::resource('/privacypolicy', PrivacyPolicyController::class);
        Route::resource('/theme_settings', TemplateSettingController::class);

        // Template E_Commerce

        //Route::match(['get', 'post'], 'send-notification', [PushNotificationController::class, 'manage_notification'])->name('manage_notification');

        Route::post('/splashscreen', [TemplateSettingController::class, 'splash_screen'])->name('splashscreen');
        Route::post('/loginscreen', [TemplateSettingController::class, 'login_screen'])->name('loginscreen');
        Route::post('/signupscreen', [TemplateSettingController::class, 'signup_screen'])->name('signupscreen');

        Route::get('/edit_variant/{id}', [ProductController::class, 'edit_variant'])->name('edit_variants');
        Route::get('/del_variant/{id}', [ProductController::class, 'del_variant'])->name('del_variants');
        Route::post('/update_variants', [ProductController::class, 'update_variant'])->name('update_variants');
        Route::post('/add_variants', [ProductController::class, 'add_variant'])->name('add_variants');

        Route::any('/publish_app', [PaymentController::class, 'publish_app'])->name('publish_app');
        Route::get('/cancel_subscription_data', [PublishController::class, 'cancel_subscription_view'])->name('cancel_subscription_view');
        Route::post('/cancel_subscription', [PaymentController::class, 'cancel_subscription'])->name('cancel_subscription');
        Route::get('/update_subscription_data', [PublishController::class, 'update_subscription_data'])->name('update_subscription_data');
        Route::get('/update_subscription_single/{template_id}/{plan_id}', [PublishController::class, 'update_subscription_single'])->name('update_subscription_single');
        Route::post('/update_subscription', [PaymentController::class, 'update_subscription'])->name('update_subscription');
        Route::get('/addpayment_method', [PublishController::class, 'addpayment_method'])->name('addpayment_method');
        Route::post('/addpayment_method', [PublishController::class, 'addpayment_method_data'])->name('addpayment_method_data');
        Route::post('/deletepayment_method', [PublishController::class, 'deletepayment_method'])->name('deletepayment_method');
        Route::post('/defaultpayment_method', [PublishController::class, 'defaultpayment_method'])->name('defaultpayment_method');

        Route::get('/addcoupon', [CouponController::class, 'create'])->name('addcoupon');
        Route::get('/coupon', [CouponController::class, 'index'])->name('coupon');

        Route::get('/editcoupon/{id}', [CouponController::class, 'edit'])->name('editcoupon');
        Route::post('/storecoupon', [CouponController::class, 'storecoupon'])->name('storecoupon');
        Route::post('/updatecoupon/{id}', [CouponController::class, 'updatecoupon'])->name('updatecoupon');
        Route::post('/destroycoupon/{id}', [CouponController::class, 'destroycoupon'])->name('destroycoupon');

        Route::post('/storestripe', [ECommStripeCredentialsController::class, 'storestripe'])->name('storestripe');
        Route::get('/addstripe', [ECommStripeCredentialsController::class, 'create'])->name('addstripe');
        Route::get('/stripe', [ECommStripeCredentialsController::class, 'index'])->name('stripe');
        Route::get('/editstripe/{id}', [ECommStripeCredentialsController::class, 'edit'])->name('editstripe');
        Route::post('/updatestripe/{id}', [ECommStripeCredentialsController::class, 'update'])->name('updatestripe');
        Route::post('/destroystripe/{id}', [ECommStripeCredentialsController::class, 'destroy'])->name('destroystripe');


        // Template Food & Delivery

        Route::resource('/food_theme_settings', TemplateSettingController::class);

        Route::match(['get', 'post'], 'working_days', [TemplateSettingController::class, 'working_days'])->name('working_days');

        Route::resource('/app_settings', TypographyController::class);

        Route::resource('/food_category', CategoryController::class);
        Route::post('get_category', [ProductAttributeController::class, 'get_category'])->name('get_category');
        Route::post('get_subcategory', [ProductAttributeController::class, 'get_subcategory'])->name('get_subcategory');

        Route::resource('food_products', ProductController::class);
        Route::resource('/food_notifications', FoodPushNotificationController::class);

        Route::match(['get', 'post'], 'add_product/{id}', [ProductController::class, 'add_product_page'])->name('add_products');
        Route::match(['get', 'post'], 'theme_add_product/{id}', [TemplateSettingController::class, 'add_product_page'])->name('theme_add_products');

        Route::get('edit_product/{id}/{product_id}', [ProductController::class, 'edit_product'])->name('edit_product');
        Route::post('edit_product/{id}/{product_id}', [ProductController::class, 'update_product'])->name('update_product');

        Route::post('removeProductImage', [ProductController::class, 'removeProductImage'])->name('removeProductImage');
        Route::post('update_position', [ProductController::class, 'update_position'])->name('update_position');

        Route::post('food_product_attributes/{id}', [ProductAttributeController::class, 'position'])->name('position');
        Route::resource('food_product_attributes', ProductAttributeController::class);
        Route::match(['get', 'post'], 'send-food_notification', [FoodPushNotificationController::class, 'manage_food_notification'])->name('manage_food_notification');

        Route::resource('food_promo', PromoController::class);

        Route::resource('food_customers', CustomerController::class);

        Route::resource('food_contacts', ContactController::class);

        Route::get('show_inbox/{id}', [ContactController::class, 'contact_us'])->name('contact_us');
        Route::match(['get', 'post', 'delete', 'put'], 'banner', [BannerController::class, 'banner'])->name('banner');
        Route::post('banner_position/{id}', [BannerController::class, 'position'])->name('banner_position');
        Route::post('banner_delete/{id}', [BannerController::class, 'delete'])->name('banner_delete');

        Route::match(['get', 'post'], 'shop', [ShopController::class, 'shops'])->name('shops');

        Route::get('food_orders', [PaymentController::class, 'orders'])->name('orders');

        Route::get('food_orders/{id}', [PaymentController::class, 'order_histories'])->name('orders.show');
        Route::get('new_food_orders', [PaymentController::class, 'recent_orders'])->name('recent_orders');
        Route::get('completed_food_orders', [PaymentController::class, 'completed_orders'])->name('completed_orders');
        Route::get('delivery_food_orders', [PaymentController::class, 'delivery_orders'])->name('delivery_orders');
        Route::get('pending_food_orders', [PaymentController::class, 'pending_orders'])->name('pending_orders');

        Route::post('/storesquare', [ECommSquareCredentialsController::class, 'storesquare'])->name('storesquare');
        Route::get('/addsquare', [ECommSquareCredentialsController::class, 'create'])->name('addsquare');
        Route::get('/square', [ECommSquareCredentialsController::class, 'index'])->name('square');
        Route::get('/editsquare/{id}', [ECommSquareCredentialsController::class, 'edit'])->name('editsquare');
        Route::post('/updatesquare/{id}', [ECommSquareCredentialsController::class, 'update'])->name('updatesquare');
        Route::post('/destroysquare/{id}', [ECommSquareCredentialsController::class, 'destroy'])->name('destroysquare');

        Route::get('food_delivery_receipts/{id}', [PaymentController::class, 'delivery_receipt'])->name('food_delivery_receipts');
        Route::post('food_update_status', [PaymentController::class, 'update_status'])->name('food_update_status');

        // Booking Routes

        Route::resource('/app_settings', TypographyController::class);
        Route::resource('cartypes', CartypeController::class);
        Route::get('booking_contacts', [HomeController::class, 'contact_us'])->name('booking_contacts');
        Route::resource('booking_customers', CustomerController::class);
        Route::resource('services', ServiceController::class);
        Route::resource('deals', DealController::class);
        Route::resource('booking_promo', PromoController::class);
        Route::resource('booking_faqs', FaqController::class);
        Route::resource('booking_theme_settings', TemplateSettingController::class);
        Route::match(['get', 'post'], 'working_day_time', [HomeController::class, 'working_day_time'])->name('working_day_time');
        Route::get('bookings', [BookingController::class, 'index'])->name('bookings');
        Route::get('view_job/{id}', [BookingController::class, 'view_job'])->name('view_job');
        Route::get('new_booking', [BookingController::class, 'new_booking'])->name('new_booking');
        Route::get('accept_jobs', [BookingController::class, 'accept_jobs'])->name('accept_jobs');
        Route::get('started_jobs', [BookingController::class, 'started_jobs'])->name('started_jobs');
        Route::get('cancelled_jobs', [BookingController::class, 'cancelled_jobs'])->name('cancelled_jobs');
        Route::get('completed_jobs', [BookingController::class, 'completed_jobs'])->name('completed_jobs');
        Route::post('update_status', [BookingController::class, 'update_status'])->name('update_status');

        Route::resource('booking_orders', MyOrderController::class);
        Route::get('booking_new_orders', [MyOrderController::class, 'new_orders'])->name('booking_new_orders');
        Route::get('booking_confirmed_orders', [MyOrderController::class, 'confirmed_orders'])->name('booking_confirmed_orders');
        Route::get('booking_shipped_orders', [MyOrderController::class, 'shipped_orders'])->name('booking_shipped_orders');
        Route::post('booking_update_status', [MyOrderController::class, 'update_status'])->name('booking_update_status');
        Route::post('/booking_splashscreen', [TemplateSettingController::class, 'splash_screen'])->name('booking_splashscreen');

        // Meal Prep Routes

        Route::resource('/meal_theme_settings', MealTemplateSettingController::class);
        Route::resource('/meal_collections', MealCollectionController::class);
        Route::resource('/meal_products', MealProductController::class);

    });

    //Custom Dashboard

    Route::resource('/home', DashboardController::class);
    Route::resource('/myapps', MyappsController::class);
    Route::get('/mywebapps', [MyappsController::class, 'mywebapps'])->name('mywebapps');
    Route::match(['get', 'post'], 'new_user', [UserController::class, 'new_user'])->name('new_user');
    Route::delete('delete_user/{id}', [UserController::class, 'delete_user'])->name('delete_user');
    Route::get('show_details', [UserController::class, 'show_details'])->name('show_details');
    Route::get('show_admin_details', [UserController::class, 'show_admin_details'])->name('show_admin_details');
    Route::get('/edit_customer_user/{id}', [UserController::class, 'edit_customer_user'])->name('edit_customer_user');
    Route::put('/update_customer_user/{id}', [UserController::class, 'update_customer_user'])->name('update_customer_user');

    // Grouped Routes
    Route::group(['prefix' => 'app', 'as' => 'app.'], function () {
        Route::resource('/aboutapp', AboutappController::class);
        Route::resource('/aboutwebapp', AboutwebController::class);
        Route::resource('/domaindetail', DomaindetailController::class);
        Route::resource('/storeinformation', StoreInformationController::class);
        Route::resource('/appstore', AppstoreController::class);
        Route::resource('/designdetail', DesigndetailController::class);
        Route::resource('/bug', BugController::class);
        Route::resource('/testbuild', TestbuildController::class);
        Route::resource('/buildudid', BuildudidController::class);
        Route::resource('/agreement', AgreementController::class);
        Route::resource('/team', TeamController::class);
        Route::resource('/payment', PaymentController::class);
        Route::resource('/quote', QuoteController::class);
        Route::resource('/project_timeline', ProjectTimelineController::class);
        Route::resource('/chat', ChatController::class);
        Route::resource('/schedulechat', SchedulechatController::class);
        Route::get('/message/{id}', [ChatController::class, 'getMessage'])->name('message');
        Route::post('message', [ChatController::class, 'sendMessage']);
        Route::post('/send_message_user', [ChatController::class, 'sendMessage']);
        Route::get('get_customer_count', [ChatController::class, 'get_count'])->name('get_customer_count');
        Route::get('/user_all_messages/{id}/{pm}', [ChatController::class, 'get_user_chat']);
    });

    Route::get('/delete-bug/{id}', [BugController::class, 'custom_delete'])->name('delete_bug');
    Route::resource('/schedulechat', SchedulechatController::class);
    Route::resource('/myaccount', MyaccountController::class);
    Route::get('/goto_token_subdomain/{template_id}', [DashboardController::class, 'subdomain'])->name('goto_token_subdomain');
    Route::resource('/custom_user', CustomuserController::class);

});

Route::group(['middleware' => ['auth', 'developer']], function () {
    Route::resource('dev-dashboard', TeamDashboardController::class);
    Route::resource('dev-myaccount', TeamMyaccountController::class);
    Route::resource('appkitupdate', AppkitUpdatesController::class);
    Route::get('/dev_bug_preview/{id}', [TeamDevloperappsController::class, 'bug_preview'])->name('dev_bug_preview');
    Route::get('developer_buglist', [TeamDevloperappsController::class, 'buglist'])->name('developer_buglist');
    Route::get('/developer_bug/{id}', [TeamDevloperappsController::class, 'getbug'])->name('developer_bug');
    Route::post('/developer_bugstatus', [TeamDevloperappsController::class, 'bugstatus'])->name('developer_bugstatus');
    Route::get('/developer_app', [TeamDevloperappsController::class, 'developer_app'])->name('developer_app');
    Route::resource('employee_update', TeamEmployeeUpdateController::class);
    Route::get('/developer_app_data/{id}/{app_id}', [TeamDevloperappsController::class, 'developer_app_data'])->name('developer_app_data');
    Route::post('/uploadbuild_developer', [TeamDevloperappsController::class, 'uploadbuild_developer'])->name('uploadbuild_developer');
    Route::post('/developer_timeline_tasksstatus', [TeamDevloperappsController::class, 'developer_timeline_tasksstatus'])->name('developer_timeline_tasksstatus');
    Route::get('developer_tasks', [TeamDevloperappsController::class, 'developer_tasks'])->name('developer_tasks');
    Route::post('/developer_timeline_add', [TeamDevloperappsController::class, 'developer_timeline_add'])->name('developer_timeline_add');
    Route::get('/developer_timeline/{id}', [TeamDevloperappsController::class, 'gettask'])->name('developer_timeline');
    Route::post('/multiple_status_bug', [TeamDevloperappsController::class, 'multiple_status_bug'])->name('multiple_status_bug');
});

require __DIR__.'/auth.php';
