<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth','verified'])->group(function (){
    Route::get('/dashboard', \App\Livewire\Dashboard::class)->name('dashboard');

    // User
    Route::prefix('user')->name('user.')->group(function (){
        Route::get('/all', \App\Livewire\User\Index::class)->name('index');
        Route::get('/create', \App\Livewire\User\Create::class)->name('create');
        Route::get('/{user}/edit', \App\Livewire\User\Edit::class)->name('edit');
        Route::get('/{user}/details', \App\Livewire\User\Show::class)->name('show');
    });

    // House
    Route::prefix('houses')->name('houses.')->group(function (){
        Route::get('/all', \App\Livewire\Houses\Index::class)->name('index');
        Route::get('/create', \App\Livewire\Houses\Create::class)->name('create');
        Route::get('/{house}/edit', \App\Livewire\Houses\Edit::class)->name('edit');
        Route::get('/{house}/details', \App\Livewire\Houses\Show::class)->name('show');
    });

    // Rso
    Route::prefix('rso')->name('rso.')->group(function (){
        Route::get('/all', \App\Livewire\FieldForce\Rso\Index::class)->name('index');
        Route::get('/create', \App\Livewire\FieldForce\Rso\Create::class)->name('create');
        Route::get('/{rso}/edit', \App\Livewire\FieldForce\Rso\Edit::class)->name('edit');
        Route::get('/{rso}/details', \App\Livewire\FieldForce\Rso\Show::class)->name('show');
    });

    // Retailer
    Route::prefix('retailer')->name('retailer.')->group(function (){
        Route::get('/all', \App\Livewire\Retailer\Index::class)->name('index');
        Route::get('/create', \App\Livewire\Retailer\Create::class)->name('create');
        Route::get('/{retailer}/edit', \App\Livewire\Retailer\Edit::class)->name('edit');
        Route::get('/{retailer}/details', \App\Livewire\Retailer\Show::class)->name('show');
        Route::get('/retailer/import', \App\Livewire\Retailer\Import::class)->name('import');
    });

    // Itop Replace
    Route::prefix('itop-replace')->name('itopReplace.')->group(function (){
        Route::get('/all', \App\Livewire\Services\ItopReplace\Index::class)->name('index');
        Route::get('/create', \App\Livewire\Services\ItopReplace\Create::class)->name('create');
        Route::get('/{replace}/edit', \App\Livewire\Services\ItopReplace\Edit::class)->name('edit');
        Route::get('/{replace}/details', \App\Livewire\Services\ItopReplace\Show::class)->name('show');
    });
});


//require __DIR__.'/auth.php';
