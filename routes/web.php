<?php

use App\Livewire\Authorization\Permission\Create;
use App\Livewire\Authorization\Permission\Edit;
use App\Livewire\Dashboard;
use App\Livewire\Retailer\Import;
use App\Livewire\Services\ItopReplace\Index;
use App\Livewire\Services\ItopReplace\Show;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth','verified'])->group(function (){
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    // User
    Route::prefix('user')->name('user.')->group(function (){
        Route::get('/all', \App\Livewire\User\Index::class)->name('index')->middleware('permission:view user');
        Route::get('/create', \App\Livewire\User\Create::class)->name('create')->middleware('permission:create user');
        Route::get('/{user}/edit', \App\Livewire\User\Edit::class)->name('edit')->middleware('permission:edit user');
        Route::get('/{user}/details', \App\Livewire\User\Show::class)->name('show')->middleware('permission:show user');
    });

    // House
    Route::prefix('houses')->name('houses.')->group(function (){
        Route::get('/all', \App\Livewire\Houses\Index::class)->name('index')->middleware('permission:view house');
        Route::get('/create', \App\Livewire\Houses\Create::class)->name('create')->middleware('permission:create house');
        Route::get('/{house}/edit', \App\Livewire\Houses\Edit::class)->name('edit')->middleware('permission:edit house');
        Route::get('/{house}/details', \App\Livewire\Houses\Show::class)->name('show')->middleware('permission:show house');
    });

    // Rso
    Route::prefix('rso')->name('rso.')->group(function (){
        Route::get('/all', \App\Livewire\FieldForce\Rso\Index::class)->name('index')->middleware('permission:view rso');
        Route::get('/create', \App\Livewire\FieldForce\Rso\Create::class)->name('create')->middleware('permission:create rso');
        Route::get('/{rso}/edit', \App\Livewire\FieldForce\Rso\Edit::class)->name('edit')->middleware('permission:edit rso');
        Route::get('/{rso}/details', \App\Livewire\FieldForce\Rso\Show::class)->name('show')->middleware('permission:show rso');
    });

    // Retailer
    Route::prefix('retailer')->name('retailer.')->group(function (){
        Route::get('/all', \App\Livewire\Retailer\Index::class)->name('index')->middleware('permission:view retailer');
        Route::get('/create', \App\Livewire\Retailer\Create::class)->name('create')->middleware('permission:create retailer');
        Route::get('/{retailer}/edit', \App\Livewire\Retailer\Edit::class)->name('edit')->middleware('permission:edit retailer');
        Route::get('/{retailer}/details', \App\Livewire\Retailer\Show::class)->name('show')->middleware('permission:show retailer');
        Route::get('/retailer/import', Import::class)->name('import')->middleware('permission:import retailer');
    });

    // Itop Replace
    Route::prefix('itop-replace')->name('itopReplace.')->group(function (){
        Route::get('/all', Index::class)->name('index')->middleware('permission:view replace');
        Route::get('/create', \App\Livewire\Services\ItopReplace\Create::class)->name('create')->middleware('permission:create replace');
        Route::get('/{replace}/edit', \App\Livewire\Services\ItopReplace\Edit::class)->name('edit')->middleware('permission:edit replace');
        Route::get('/{replace}/details', Show::class)->name('show')->middleware('permission:show replace');
    });

    // Commission
    Route::prefix('commission')->name('commission.')->group(function (){
        Route::get('/all', \App\Livewire\Services\Commission\Index::class)->name('index')->middleware('permission:view commission');
        Route::get('/create', \App\Livewire\Services\Commission\Create::class)->name('create')->middleware('permission:create commission');
        Route::get('/{commission}/edit', \App\Livewire\Services\Commission\Edit::class)->name('edit')->middleware('permission:edit commission');
        Route::get('/{commission}/details', \App\Livewire\Services\Commission\Show::class)->name('show')->middleware('permission:show commission');
    });

    // Lifting
    Route::prefix('lifting')->name('lifting.')->group(function (){
        Route::get('/all', \App\Livewire\Services\Lifting\Index::class)->name('index')->middleware('permission:view lifting');
        Route::get('/create', \App\Livewire\Services\Lifting\Create::class)->name('create')->middleware('permission:create lifting');
        Route::get('/{lifting}/edit', \App\Livewire\Services\Lifting\Edit::class)->name('edit')->middleware('permission:edit lifting');
        Route::get('/{lifting}/details', \App\Livewire\Services\Lifting\Show::class)->name('show')->middleware('permission:show lifting');
    });

    // Role
    Route::prefix('role')->name('role.')->group(function (){
        Route::get('/all', App\Livewire\Authorization\Role\Index::class)->name('index')->middleware('permission:view role');
        Route::get('/create', \App\Livewire\Authorization\Role\Create::class)->name('create')->middleware('permission:create role');
        Route::get('/{role}/edit', \App\Livewire\Authorization\Role\Edit::class)->name('edit')->middleware('permission:edit role');
    });

    // Permission
    Route::prefix('permission')->name('permission.')->group(function (){
        Route::get('/all', App\Livewire\Authorization\Permission\Index::class)->name('index')->middleware('permission:view permission');
        Route::get('/create', Create::class)->name('create')->middleware('permission:create permission');
        Route::get('/{permission}/edit', Edit::class)->name('edit')->middleware('permission:edit permission');
    });
});


//require __DIR__.'/auth.php';
