<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\classroomController;
use App\Http\Controllers\sectionController;
use App\Http\Controllers\teacherController;
use App\Http\Controllers\studentController;





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



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth' ]
    ], function(){ 

        Route::get('/', function () {
            return view('dashboard');
        });

        Route::resource('grade',GradeController::class);

        Route::get('/claassrooms/index',[classroomController::class,'index'])->name('classrooms.index');
        Route::post('/claassrooms/store',[classroomController::class,'store'])->name('classrooms.store');
        Route::post('/claassrooms/update',[classroomController::class,'update'])->name('classrooms.update');
        Route::post('/claassrooms/delete',[classroomController::class,'delete'])->name('classrooms.delete');
        Route::post('/claassrooms/deletechecked',[classroomController::class,'deleteall'])->name('classrooms.deletechecked');
        Route::post('/claassrooms/filter',[classroomController::class,'filter'])->name('classrooms.filter');
        Route::get('/claassrooms/sections',[sectionController::class,'index'])->name('classrooms.sections');
        Route::get('/classrooms/classbyajax/{grade_id}',[sectionController::class,'classbyajax'])->name('classrooms.classbyajax');

        Route::post('/sections/store',[sectionController::class,'store'])->name('sections.store');
        Route::post('/sections/update',[sectionController::class,'update'])->name('sections.update');
        Route::post('/sections/delete',[sectionController::class,'delete'])->name('sections.delete');

        Route::view('AddParent','livewire.showForm');

        Route::resource('teachers',teacherController::class);

        Route::resource('students',studentController::class);

        Route::get('/students/getclassbyajax/{Grade_id}',[studentController::class,'getclasses']);

        Route::get('/students/getsectionbyajax/{Classroom_id}',[studentController::class,'getsections']);


        
        
      

    });
    


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');






