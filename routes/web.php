<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataTables\IncidentDataTables;
use App\Http\Controllers\DataTables\EmployeeDataTables;
use App\Http\Controllers\DataTables\ItemDataTables;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Api\IncidentControllerApi;
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



Route::controller(IncidentController::class)->group(function(){
    Route::get('incidencias', 'index')->name('incidencias.index');
    Route::post('incidencias', 'store')->name('incidencias.store');
    Route::get('incidencias/create', 'create')->name('incidencias.create');
    Route::get('incidencias/{incident}', 'show')->name('incidencias.show');
    Route::put('incidencias/{incident}', 'update')->name('incidencias.update');
    Route::delete('incidencias/{incident}', 'destroy')->name('incidencias.destroy');
    Route::get('incidencias/{incident}/edit', 'edit')->name('incidencias.edit');

})->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::resource('empleados', EmployeeController::class);
Route::resource('incidencias', IncidentController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/employees/list/datatables', [EmployeeDataTables::class, 'list'])
    ->name('employees.list.datatables');
    Route::post('/incidents/{id}/review', [IncidentControllerApi::class, 'review'])
    ->name('incidents.review');

    Route::get('employees/datatables', [EmployeeDataTables::class, 'index'])->name('employees.datatables');
Route::get('/items/datatables', [ItemDataTables::class, 'index'])
    ->name('items.datatables');
    Route::get('/items/datatables', [ItemDataTables::class, 'index'])->name('items.datatables');
    Route::get('/incidents/datatables', [IncidentDataTables::class, 'index'])->name('incidents.datatables');
});



// Route::put('/empleados/{id}', [EmployeesControllerApi::class, 'update'])->name('employees.api.update');
// Route::middleware('auth')->group(function () {
//     Route::get('/categories', [CategoryController::class, 'index']);
//     Route::post('/categories', [CategoryController::class, 'store']);
//     Route::get('/categories/{id}', [CategoryController::class, 'show']);
//     Route::put('/categories/{id}', [CategoryController::class, 'update']);
//     Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

// });
// Route::post('/incidentes', [IncidentControllerApi::class, 'store'])->name('incident.api.store');

// Route::post('/empleados', [EmployeesControllerApi::class, 'store'])->name('employees.api.store');
//




require __DIR__.'/auth.php';
