<?php

use Illuminate\Support\Facades\App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\contactController;

use App\Http\Controllers\SettingController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Crud\ExamController;
use App\Http\Controllers\Crud\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Crud\PaymentController;
use App\Http\Controllers\Crud\SessionController;
use App\Http\Controllers\Crud\VehicleController;
use App\Http\Controllers\Crud\SpendingController;
use App\Http\Controllers\DrivingSchoolController;
use App\Http\Controllers\PaymentControllers;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EleveController;

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

// Main
Route::get('/main', [HomeController::class, 'index'])->name('main');

// Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login-show');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Profile
Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
Route::post('/profile', [ProfileController::class, 'update'])->name('update-profile');
Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('update-password');

// Password Reset
Route::get('/password/reset', [AuthController::class, 'showPasswordResetForm'])->name('password.request');
Route::post('/password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [AuthController::class, 'resetPassword'])->name('password.update');

// Dashboard
Route::prefix('dashboard')->middleware('auth', 'dashboard')->group(function () {
    Route::get('/', [UserController::class, 'dashboard'])->name('dashboard');

    // Users
    Route::resource('users', UserController::class);
    Route::post('/users/{user}/password', [UserController::class, 'updatePassword'])->name('users.updatePassword');

    // Exams
    Route::resource('exams', ExamController::class);
    Route::post('/exams/add-student', [ExamController::class, 'addStudent'])->name('exams.addStudent');
    Route::post('/exams/update-result', [ExamController::class, 'updateResult'])->name('exams.updateResult');
    Route::post('/exams/remove-student', [ExamController::class, 'removeStudent'])->name('exams.removeStudent');

    // Sessions
    Route::resource('sessions', SessionController::class);
    Route::post('/sessions/add-student', [SessionController::class, 'addStudent'])->name('sessions.addStudent');
    Route::post('/sessions/update-isattended', [SessionController::class, 'updateIsAttended'])->name('sessions.updateIsAttended');
    Route::post('/sessions/remove-student', [SessionController::class, 'removeStudent'])->name('sessions.removeStudent');

    // Vehicles
    Route::resource('vehicles', VehicleController::class);

    // Payments
    Route::resource('payments', PaymentController::class);

    // Spendings
    Route::resource('spendings', SpendingController::class);

    // Statistics
    Route::get("statistics", [StatisticsController::class, 'index'])->name('statistics.index');
});

// Settings
Route::prefix('settings')->middleware('auth', 'admin')->group(function () {
    Route::redirect('/', '/settings/general')->name('settings');

    // Permissions
    Route::resource('permissions', PermissionController::class);

    // General
    Route::resource('general', SettingController::class);
});

// Contact
Route::post('/contact', [contactController::class, 'send'])->name('contact.send');

// Language
Route::get('language/{locale}', function ($locale) {
    if (!array_key_exists($locale, config('app.available_locales'))) {
        abort(404);
    }

    // Set the locale
    app()->setLocale($locale);

    // Store the locale in session so that the middleware can register it
    session()->put('locale', $locale);

    // Redirect back to the last page, or home as a fallback
    return redirect()->back();
})->name('language');

Route::post('payments/pdf', [PaymentController::class, 'paymentsPdf'])->name('payments.pdf');

Route::fallback(function () {
    // Return a custom 404 page
    return view('errors.404');
});
Route::get('/', [DrivingSchoolController::class, 'index'])->name('driving-schools.index');

Route::get('/autoecole/inscription', [DrivingSchoolController::class, 'create'])->name('driving-schools.create');

Route::post('/autoecole/inscription', [DrivingSchoolController::class, 'store'])->name('driving-schools.store');

// Page détails auto-école (SHOW)
Route::get('/autoecole/{id}', [DrivingSchoolController::class, 'show'])->name('driving_schools.show');

// Page formulaire paiement (GET)
Route::get('/payment/{school}', [PaymentControllers::class, 'show'])->name('payment.show');

// Traitement du paiement (POST)
Route::post('/payment/{school}', [PaymentControllers::class, 'process'])->name('payment.process');

// Simulation paiement (optionnel)
Route::post('/simulate-payment/{id}', [DrivingSchoolController::class, 'simulatePayment'])->name('payment.simulate');

//Route::get('/driving-schools/shows', [DrivingSchoolController::class, 'Shows'])->name('driving-schools.shows');

Route::get('/comments', [CommentController::class, 'index']);
Route::post('/comments', [CommentController::class, 'store']);
Route::get('/eleves/create', [EleveController::class, 'create'])->name('eleves.create');
Route::post('/eleves', [EleveController::class, 'store'])->name('eleves.store');




Route::get('/eleves/login', [EleveController::class, 'showLoginForm'])->name('eleves.login');
Route::post('/eleves/login', [EleveController::class, 'login'])->name('eleves.login.post');
Route::get('/eleves/dashboard', [EleveController::class, 'dashboard'])->name('eleves.dashboard')->middleware('auth:eleve');
Route::post('/eleves/logout', [EleveController::class, 'logout'])->name('eleves.logout');
