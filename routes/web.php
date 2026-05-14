<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PrintController;

Route::get('/', function () {
    // return Inertia::render('Welcome', [
    //     'canLogin' => Route::has('login'),
    //     'canRegister' => Route::has('register'),
    //     'laravelVersion' => Application::VERSION,
    //     'phpVersion' => PHP_VERSION,
    // ]);
    return redirect('/login');
});

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
/*
|--------------------------------------------------------------------------
| ADMIN ONLY
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    // dashboard
    Route::get('/dashboard', [
        DashboardController::class,
        'index'
    ])->name('dashboard');

    // categories
    Route::resource(
        'categories',
        CategoryController::class
    );

    // products
    Route::resource(
        'products',
        ProductController::class
    );
});


/*
|--------------------------------------------------------------------------
| ADMIN + CASHIER
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:admin,cashier'
])->group(function () {

    // POS
    Route::get('/pos', [
        POSController::class,
        'index'
    ])->name('pos.index');

    Route::post('/pos/checkout', [
        POSController::class,
        'checkout'
    ])->name('pos.checkout');

    // reports
    Route::get('/reports', [
        ReportController::class,
        'index'
    ])->name('reports.index');

    // print receipt
    Route::get('/transactions/{id}/print', [
        PrintController::class,
        'printReceipt'
    ])->name('transactions.print');

    // export pdf
    Route::get('/reports/pdf', [
        PrintController::class,
        'exportPDF'
    ])->name('reports.pdf');

});


/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [
        ProfileController::class,
        'edit'
    ])->name('profile.edit');

    Route::patch('/profile', [
        ProfileController::class,
        'update'
    ])->name('profile.update');

    Route::delete('/profile', [
        ProfileController::class,
        'destroy'
    ])->name('profile.destroy');

});
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//     Route::resource('categories', CategoryController::class);

//     Route::resource('products', ProductController::class);
//     Route::get('/pos', [POSController::class, 'index'])->name('pos.index');

//     Route::post('/pos/checkout', [POSController::class, 'checkout'])
//         ->name('pos.checkout');
    
//     Route::get('/dashboard', [DashboardController::class, 'index'])
//         ->name('dashboard');

//     Route::get('/reports', [ReportController::class, 'index'])
//         ->name('reports.index');

//         Route::get('/transactions/{id}/print', [
//         PrintController::class,
//         'printReceipt'
//     ])->name('transactions.print');

//     Route::get('/reports/pdf', [
//         PrintController::class,
//         'exportPDF'
//     ])->name('reports.pdf');

//     });



require __DIR__.'/auth.php';
