<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminBlogPostController;
use App\Http\Controllers\AdminLegalCaseController;
use App\Http\Controllers\AdminContactMessageController;
use App\Http\Controllers\AdminAboutController;

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

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/cases', [HomeController::class, 'cases'])->name('cases');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/blog/{post}', [HomeController::class, 'showPost'])->name('blog.show');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Profile routes
Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Blog yönetimi
    Route::resource('blog-posts', AdminBlogPostController::class);
    
    // Dava yönetimi
    Route::resource('legal-cases', AdminLegalCaseController::class);
    
    // Kullanıcı yönetimi
    Route::resource('users', AdminUserController::class);
    
    // İletişim mesajları yönetimi
    Route::resource('contact-messages', AdminContactMessageController::class)->except(['create', 'store', 'edit', 'update']);
    Route::patch('contact-messages/{contactMessage}/toggle-read', [AdminContactMessageController::class, 'toggleRead'])->name('contact-messages.toggle-read');
    Route::get('contact-messages/{contactMessage}/reply', [AdminContactMessageController::class, 'showReplyForm'])->name('contact-messages.reply');
    Route::post('contact-messages/{contactMessage}/send-reply', [AdminContactMessageController::class, 'sendReply'])->name('contact-messages.send-reply');
    
    // Hakkımda bölümü yönetimi
    Route::get('about', [AdminAboutController::class, 'index'])->name('about.index');
    Route::post('about', [AdminAboutController::class, 'update'])->name('about.update');
});
