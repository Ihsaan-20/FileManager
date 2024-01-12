<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileManagerController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [FileManagerController::class, 'index']);


Route::get('folder/{folderPath}', [FileManagerController::class, 'showFolder'])->name('show.folder');
Route::post('/file-manager/folder/{folderPath}/upload', [FileManagerController::class, 'uploadFile']);

Route::get('/file-manager/create', [FileManagerController::class, 'create']);
Route::post('/file-manager/folder', [FileManagerController::class, 'createFolder']);
Route::post('/file-manager/upload', [FileManagerController::class, 'uploadFile']);
Route::get('/file-manager/download/{id}', [FileManagerController::class, 'downloadFile']);
Route::get('/file-manager/zip', [FileManagerController::class, 'downloadZip']);
Route::get('/file-manager/share/{id}', [FileManagerController::class, 'shareLink']);
