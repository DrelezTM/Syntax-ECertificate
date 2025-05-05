<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AssetController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\UserController;

Route::get('/', [ Controller::class, 'getIndex' ])->name('index');
Route::get('/checkid', [ Controller::class, 'getCheckId' ])->name('checkid');
Route::get('/scan', [ Controller::class, 'getScan' ])->name('scan');

Route::get('/login', [ AuthController::class, 'getLogin' ])->name('login');
Route::post('/login', [ AuthController::class, 'postLogin' ])->name('login.post');

Route::post('/logout', [ AuthController::class, 'logout' ])->name('logout')->middleware('auth:sanctum');

Route::prefix('certificates')->group(function() {
    Route::get('/', [ CertificateController::class, 'getCertificates' ])->name('certificates')->middleware('auth:sanctum');

    Route::get('/add', [ CertificateController::class, 'getAddCertificate' ])->name('certificates.add')->middleware('auth:sanctum');
    Route::post('/add', [ CertificateController::class, 'postAddCertificate' ])->name('certificates.add.post')->middleware('auth:sanctum');
    Route::post('/add/multiple', [ CertificateController::class, 'postAddCertificates' ])->name('certificates.add.post.multiple')->middleware('auth:sanctum');

    Route::get('/edit', [ CertificateController::class, 'getEditCertificate' ])->name('certificates.edit')->middleware('auth:sanctum');
    Route::post('/edit', [ CertificateController::class, 'postEditCertificate' ])->name('certificates.edit.post')->middleware('auth:sanctum');

    Route::delete('/delete', [ CertificateController::class, 'deleteCertificate' ])->name('certificates.delete')->middleware('auth:sanctum');
});

Route::prefix('students')->group(function() {
    Route::get('/', [ StudentController::class, 'getStudents' ])->name('students')->middleware('auth:sanctum');

    Route::get('/add', [ StudentController::class, 'getAddStudent' ])->name('students.add')->middleware('auth:sanctum');
    Route::post('/add', [ StudentController::class, 'postAddStudent' ])->name('students.add.post')->middleware('auth:sanctum');
    Route::post('/add/multiple', [ StudentController::class, 'postAddStudents' ])->name('students.add.post.multiple')->middleware('auth:sanctum');

    Route::get('/edit', [ StudentController::class, 'getEditStudent' ])->name('students.edit')->middleware('auth:sanctum');
    Route::post('/edit', [ StudentController::class, 'postEditStudent' ])->name('students.edit.post')->middleware('auth:sanctum');

    Route::delete('/delete', [ StudentController::class, 'deleteStudent' ])->name('students.delete')->middleware('auth:sanctum');
});

Route::prefix('users')->group(function() {
    Route::get('/', [ UserController::class, 'getUsers' ])->name('users')->middleware('auth:sanctum');

    Route::get('/add', [ UserController::class, 'getAddUser' ])->name('users.add')->middleware('auth:sanctum');
    Route::post('/add', [ UserController::class, 'postAddUser' ])->name('users.add.post')->middleware('auth:sanctum');

    Route::get('/edit', [ UserController::class, 'getEditUser' ])->name('users.edit')->middleware('auth:sanctum');
    Route::post('/edit', [ UserController::class, 'postEditUser' ])->name('users.edit.post')->middleware('auth:sanctum');

    Route::delete('/delete', [ UserController::class, 'deleteUser' ])->name('users.delete')->middleware('auth:sanctum');
});

Route::prefix('assets')->group(function() {
    Route::get('/', [ AssetController::class, 'getFiles' ])->name('assets')->middleware('auth:sanctum');

    Route::get('/add', [ AssetController::class, 'getAddFiles' ])->name('assets.add')->middleware('auth:sanctum');
    Route::post('/add', [ AssetController::class, 'postAddFiles' ])->name('assets.add.post')->middleware('auth:sanctum');

    Route::get('/edit', [ AssetController::class, 'getEditFile' ])->name('assets.edit')->middleware('auth:sanctum');
    Route::post('/edit', [ AssetController::class, 'postEditFile' ])->name('assets.edit.post')->middleware('auth:sanctum');

    Route::delete('/delete', [ AssetController::class, 'deleteFile' ])->name('assets.delete')->middleware('auth:sanctum');
});

Route::get('/{certificate_id}', [ Controller::class, 'getResult' ])->name('result');