<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KnowhowController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\DashboardController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    return redirect('/');
})->name('dashboard');

Route::redirect('/dashboard', '/');

// Authenticate users before accessing URLs
Route::group(['middleware' => ['auth']], function () {

    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::get('/logud', [DashboardController::class, 'logud'])->name('logud');
    Route::get('/todo/confirm/{id}', [DashboardController::class, 'todoComplete'])->name('home.todo.complete');

    // KUNDEOPGAVER PREFIX
    Route::prefix('tools/kundeopgaver')->group(function () {
        
        Route::get('/', [KnowhowController::class, 'kundeopgaver'])->name('kundeopgaver.index')
        Route::post('/ny', [KnowhowController::class, 'kundeopgaverPost'])->name('kundeopgaver.post');
        Route::get('edit/{id}', [KnowhowController::class, 'kundeopgaver_edit'])->name('kundeopgaver.edit');
        Route::post('edit/{id}/updateKundeopgave', [KnowhowController::class, 'kundeopgaverUpdate'])->name('kundeopgaver.update');
        Route::post('edit/{id}/postNote', [KnowhowController::class, 'kundeopgaverNotePost'])->name('kundeopgaver.note.post');

    });

    Route::prefix('tools/servicesager')->group(function () {

        Route::post('/ny', [KnowhowController::class, 'externalServicePost'])->name('externalservice.post');

    });

    // MANAGER PREFIX
    Route::group(['prefix' => 'lukkelister', 'middleware' => ['role:administrator|manager']], function() {
        
        Route::get('/', [ManagerController::class, 'todosIndex'])->name('manager.todos.index');
        Route::post('/ny', [ManagerController::class, 'todosPost'])->name('manager.lukkeliste.post');
        Route::get('/rediger/{id}', [ManagerController::class, 'todosRediger'])->name('manager.lukkeliste.rediger');
        Route::post('/rediger/{id}', [ManagerController::class, 'todosUpdate'])->name('manager.lukkeliste.update');

    });

    // MANAGER PREFIX
    Route::group(['prefix' => 'rapporter', 'middleware' => ['role:administrator|manager']], function() {
        
        Route::get('/lukkeliste', [ManagerController::class, 'rapporterTodosIndex'])->name('manager.rapporter.lukkeliste');

    });

    // ADMIN PREFIX
    Route::group(['prefix' => 'admin', 'middleware' => ['role:administrator']], function() {
        
        Route::get('/services', [AdminController::class, 'servicesIndex'])->name('admin.services.index');
        Route::get('/services/edit/{id}', [AdminController::class, 'servicesEdit'])->name('admin.services.edit');
        Route::post('/services/edit/{id}', [AdminController::class, 'servicesUpdate'])->name('admin.services.update');

        Route::get('/users', [AdminController::class, 'usersIndex'])->name('admin.users.index');
        Route::get('/users/actas/{user_id}', [AdminController::class, 'usersActAs'])->name('admin.users.act.as');
        Route::get('/users/ny', [AdminController::class, 'usersCreate'])->name('admin.users.create');
        Route::post('/users/ny', [AdminController::class, 'usersPost'])->name('admin.users.post');
        Route::get('/users/edit/{id}', [AdminController::class, 'usersEdit'])->name('admin.users.edit');
        Route::post('/users/edit/{id}', [AdminController::class, 'usersUpdate'])->name('admin.users.update');

    });

});