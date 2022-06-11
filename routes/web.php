<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\order;
use App\Http\Controllers\products;
use App\Http\Controllers\ProfilesController;

use App\Http\Controllers\Mail;
use App\Http\Controllers\email;

use App\Http\Controllers\PaginationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\PDFController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
| Middleware options can be located in `app/Http/Kernel.php`
|
*/



// Homepage Route
Route::group(['middleware' => ['web', 'checkblocked']], function () {
    Route::get('/', 'App\Http\Controllers\WelcomeController@welcome')->name('welcome');
    Route::get('/terms', 'App\Http\Controllers\TermsController@terms')->name('terms');
});

// Authentication Routes
Auth::routes();

// Public Routes
Route::group(['middleware' => ['web', 'activity', 'checkblocked']], function () {

    // Activation Routes
    Route::get('/activate', ['as' => 'activate', 'uses' => 'App\Http\Controllers\Auth\ActivateController@initial']);

    Route::get('/activate/{token}', ['as' => 'authenticated.activate', 'uses' => 'App\Http\Controllers\Auth\ActivateController@activate']);
    Route::get('/activation', ['as' => 'authenticated.activation-resend', 'uses' => 'App\Http\Controllers\Auth\ActivateController@resend']);
    Route::get('/exceeded', ['as' => 'exceeded', 'uses' => 'App\Http\Controllers\Auth\ActivateController@exceeded']);

    // Socialite Register Routes
    Route::get('/social/redirect/{provider}', ['as' => 'social.redirect', 'uses' => 'App\Http\Controllers\Auth\SocialController@getSocialRedirect']);
    Route::get('/social/handle/{provider}', ['as' => 'social.handle', 'uses' => 'App\Http\Controllers\Auth\SocialController@getSocialHandle']);

    // Route to for user to reactivate their user deleted account.
    Route::get('/re-activate/{token}', ['as' => 'user.reactivate', 'uses' => 'App\Http\Controllers\RestoreUserController@userReActivate']);
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity', 'checkblocked']], function () {

    // Activation Routes
    Route::get('/activation-required', ['uses' => 'App\Http\Controllers\Auth\ActivateController@activationRequired'])->name('activation-required');
    Route::get('/logout', ['uses' => 'App\Http\Controllers\Auth\LoginController@logout'])->name('logout');
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity', 'twostep', 'checkblocked']], function () {

    //  Homepage Route - Redirect based on user role is in controller.
    Route::get('/home', ['as' => 'public.home',   'uses' => 'App\Http\Controllers\UserController@index']);

    // Show users profile - viewable by other users.
    Route::get('profile/{username}', [
        'as'   => '{username}',
        'uses' => 'App\Http\Controllers\ProfilesController@show',
    ]);
});

// Registered, activated, and is current user routes.
Route::group(['middleware' => ['auth', 'activated', 'currentUser', 'activity', 'twostep', 'checkblocked']], function () {



    // User Profile and Account Routes
    Route::resource(
        'profile',
        \App\Http\Controllers\ProfilesController::class,
        [
            'only' => [
                'show',
                'edit',
                'update',
                'create',
            ],
        ]
    );
    Route::put('profile/{username}/updateUserAccount', [
        'as'   => '{username}',
        'uses' => 'App\Http\Controllers\ProfilesController@updateUserAccount',
    ]);
    Route::put('profile/{username}/updateUserPassword', [
        'as'   => '{username}',
        'uses' => 'App\Http\Controllers\ProfilesController@updateUserPassword',
    ]);
    Route::delete('profile/{username}/deleteUserAccount', [
        'as'   => '{username}',
        'uses' => 'App\Http\Controllers\ProfilesController@deleteUserAccount',
    ]);
    Route::post('updateuser',[ProfilesController::class,'updateUserAccountData']);
    // Route to show user avatar
    Route::get('images/profile/{id}/avatar/{image}', [
        'uses' => 'App\Http\Controllers\ProfilesController@userProfileAvatar',
    ]);

    // Route to upload user avatar.
    Route::post('avatar/upload', ['as' => 'avatar.upload', 'uses' => 'App\Http\Controllers\ProfilesController@upload']);
});

// Registered, activated, and is admin routes.
Route::group(['middleware' => ['auth', 'activated', 'role:admin', 'activity', 'twostep', 'checkblocked']], function () {
    Route::resource('/users/deleted', \App\Http\Controllers\SoftDeletesController::class, [
        'only' => [
            'index', 'show', 'update', 'destroy',
        ],
    ]);
    Route::view('dashboard','dashboard');

    Route::get("getform",[order::class,'get_form']);
    Route::get("search",[order::class,'getdata']);

    Route::get("display_form/{order_id}",[order::class,'form']);   
    Route::get("getuserdetails",[order::class,'getuserdetails']);
    Route::get("getuserdetailsId/{id}",[order::class,'getuserdetailsId']);

    Route::get("getledger",[order::class,'getledger']);   
    Route::get("getledgerdetail",[order::class,'getledgerdetail']);   

    

    Route::get("getBilling",[order::class,'getBilling']);
    Route::get("getuserBill",[order::class,'getuserBill']);
    Route::get("billupdate/{id}",[order::class,'BillUpdate']);
    Route::get("Billdetail/{id}",[order::class,'Billdetail']);

    Route::get("getBill",[order::class,'getBill']);   
    Route::get("searchBill",[order::class,'serchBill']);
    Route::get("getuserBillDetail",[order::class,'getuserBillDetail']);   

    Route::post("updatebill",[order::class,'updatebill']);



    


    
    
    Route::resource('users', \App\Http\Controllers\UsersManagementController::class, [
        'names' => [
            'index'   => 'users',
            'destroy' => 'user.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);
    Route::post('search-users', 'App\Http\Controllers\UsersManagementController@search')->name('search-users');




    Route::resource('themes', \App\Http\Controllers\ThemesManagementController::class, [
        'names' => [
            'index'   => 'themes',
            'destroy' => 'themes.destroy',
        ],
    ]);

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('routes', 'App\Http\Controllers\AdminDetailsController@listRoutes');
    Route::get('active-users', 'App\Http\Controllers\AdminDetailsController@activeUsers');
});

Route::redirect('/php', '/phpinfo', 301);
Route::get('demo', function () {
    return view('userform');
});
Route::view('product','addproducts');
Route::view('user','user');
Route::view('contact','contact');
Route::view('about','about');
Route::get("Ledger",[order::class,'Ledger']);



Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm']);
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm']);
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::post("contactform",[order::class,'contact']);



Route::get("buy",[order::class,'get_product']);




Route::post("addform",[order::class,'set_order']);
Route::post("addproduct",[products::class,'set_product']);
Route::get("showproduct",[products::class,'get_product']);
Route::get("editproduct/{product_id}",[products::class,'edit_product']);
Route::post('update',[products::class,'update_product']);
Route::get("delete/{id}",[products::class,'delete']);



Route::get('/pagination',[PaginationController::class, 'index']);

Route::get('/pagination/fetch_data',[PaginationController::class,'fetch_data']);

Route::get('create-pdf-file', [PDFController::class, 'index']);
Route::get('/getPdf', [PDFController::class, 'getPdf']);
Route::get('/getBillPdf/{id}', [PDFController::class, 'getBillPdf']);

Route::get('send-email-pdf', [PDFController::class, 'mailindex']);






