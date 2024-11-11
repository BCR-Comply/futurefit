<?php

use App\Http\Controllers\Api\GeneralController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\SqlController;
use App\Http\Controllers\Api\SyncSaveController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::get('surveyor-inspections-list', [GeneralController::class, 'surveyorInspectionsList']);
Route::get('getToken', [LoginController::class, 'getToken']);
Route::prefix('v1')->group(function () {

    Route::post('saveImg', [SyncSaveController::class, 'saveImg']);
    Route::get('get-sql-tbl-data', [SqlController::class, 'index']);
    Route::get('testNotification', [SqlController::class, 'testNotification']);
    //Login Register Section Start
    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [LoginController::class, 'register']);
    //Login Register Section End

    Route::middleware('auth:api')->group(function () {
        //SQL Data Fetch Start
        Route::get('get-sql-tbl-data-user', [SqlController::class, 'indexUser']);
        Route::get('get-sql-tbl-data-user2', [SqlController::class, 'indexUser2']);
        Route::post('contract-prop-update', [SqlController::class, 'contractPropUpdate']);

        Route::get('/listAdmins',[GeneralController::class, 'listAdmins'])->name('listAdmins');
        Route::get('/noti-count',[GeneralController::class, 'notiCount'])->name('notiCount');
        Route::get('/chatList',[GeneralController::class, 'chatList'])->name('chatList');
        Route::post('/chatListByUser',[GeneralController::class, 'chatListByUser'])->name('chatListByUser');
        Route::post('send-api-message', [GeneralController::class, 'sendApiMessage'])->name('sendApiMessage');
        Route::post('appointment-change', [GeneralController::class, 'appointmentChange'])->name('appointmentChange');
        Route::get('my-propertyList', [GeneralController::class, 'myPropertyList'])->name('myPropertyList');
        Route::get('/report/{inspection_id}/{type}/delete', [GeneralController::class, 'reportDelete'])->name('property.report.delete');
        //SQL Data Fetch End
        //User Section Start
        Route::get('logout', [LoginController::class, 'logout']);
        Route::get('register-display', [GeneralController::class, 'userRegisterDisplay']);
        Route::post('register-update', [GeneralController::class, 'userRegisterUpdate']);
        Route::post('user-login-status', [GeneralController::class, 'userLoginStatus'])->name('userLoginStatus');
        Route::get('get-clients', [GeneralController::class, 'getClients'])->name('getClients');
        //User Section End
        Route::post('third-party-forms', [GeneralController::class, 'thirdPartyForms']);
        Route::get('notification-list', [GeneralController::class, 'userNotificationList']);
        Route::get('notification-count', [GeneralController::class, 'userNotificationCount']);
        Route::post('property-details', [GeneralController::class, 'propertyDetails']);
        Route::get('surveyor-inspections-list', [GeneralController::class, 'surveyorInspectionsList']);
        Route::post('view-pdf-report', [GeneralController::class, 'viewPdfFormReport']);
        Route::post('generatePdf', [GeneralController::class, 'generatePdf']);
        Route::post('add-property', [GeneralController::class, 'addProperty']);
        Route::post('store-property', [GeneralController::class, 'storeProperty']);
        Route::post('signin-out-prop-user', [GeneralController::class, 'signInOutPropUser']);
        Route::get('signin-out-prop-user-get', [GeneralController::class, 'getSignInOutPropUser']);
        Route::get('safepass-data', [GeneralController::class, 'safepassData']);
        Route::post('safepass-update', [GeneralController::class, 'safepassUpdate']);
        Route::get('get-timesheet-status/{id?}', [GeneralController::class, 'getTimeSheetStatus']);
        Route::post('save-snag', [SyncSaveController::class, 'saveSnag'])->name('saveSnag');
        Route::post('update-snag', [SyncSaveController::class, 'updateSnag'])->name('updateSnag');
        Route::post('reply-snag', [SyncSaveController::class, 'replySnag'])->name('replySnag');
        Route::post('snag-status-change', [SyncSaveController::class, 'snageStatusChange'])->name('snageStatusChange');
        Route::post('compliance-save-doc', [SyncSaveController::class, 'compSaveDoc'])->name('compSaveDoc');
        Route::post('bre-sync-save', [SyncSaveController::class, 'breSyncSave']);
        Route::post('retro-sync-save', [SyncSaveController::class, 'retroSyncSave']);
        Route::post('oss-sync-save', [SyncSaveController::class, 'ossSyncSave']);
        Route::post('contract-form-save', [SyncSaveController::class, 'ContactFormSave']);
        Route::post('terreco-form-save', [SyncSaveController::class, 'TerrecoFormSave']);
        Route::post('progress-form-save', [SyncSaveController::class, 'ProggressFormSave']);
        Route::post('pi-form-save', [SyncSaveController::class, 'piFormSave']);
        Route::post('sr-form-save', [SyncSaveController::class, 'srFormSave']);
        Route::post('ws-form-save', [SyncSaveController::class, 'wsFormSave']);
        Route::post('safety-health-form-save', [SyncSaveController::class, 'safetyHealthSave']);
        Route::post('prem-safety-health-form-save', [SyncSaveController::class, 'premSafetyHealthSave']);
        Route::post('rams-cores-vent-save', [SyncSaveController::class, 'ramsCoresVentSave']);
        Route::post('photo-uploads', [SyncSaveController::class, 'photoUploads']);
        Route::post('edit-photo', [SyncSaveController::class, 'editPhoto']);
        Route::post('get-uploaded-photos', [SyncSaveController::class, 'getUploadsPhoto']);
        Route::post('get-uploaded-photos-bysection', [SyncSaveController::class, 'getUploadsPhotoBySection']);
        Route::get('get-folder-list', [SyncSaveController::class, 'getFolderList']);
        Route::post('delete-file-folder', [SyncSaveController::class, 'deleteFileFolder']);
        Route::post('toolbox-talk-save', [SyncSaveController::class, 'toolBoxTalkSave']);
        Route::get('/sse', [SyncSaveController::class, 'streamingData'])->name('sse');
        Route::post('sir-prepration-form-save', [SyncSaveController::class, 'sirPrepFormSave']);
        Route::post('sir-boarding-form-save', [SyncSaveController::class, 'sirBoardFormSave']);
        Route::post('sir-basecoat-form-save', [SyncSaveController::class, 'sirbaseCFormSave']);
        Route::post('sir-finishcoat-form-save', [SyncSaveController::class, 'sirFinshCFormSave']);
        Route::post('sir-job-form-save', [SyncSaveController::class, 'sirJFormSave']);
        Route::post('sir-drawing-form-save', [SyncSaveController::class, 'sirDrawFormSave']);
        
        Route::post('basf-form-save', [SyncSaveController::class, 'basfFormSave']);
        Route::post('as-form-save', [SyncSaveController::class, 'asFormSave']);
        Route::post('ms-form-save', [SyncSaveController::class, 'msFormSave']);
        Route::post('ts-form-save', [SyncSaveController::class, 'tsFormSave']);
        Route::post('hb-form-save', [SyncSaveController::class, 'hbFormSave']);
        Route::post('third-party-form-save', [SyncSaveController::class, 'thirdPartyFormSave']);
        // Route::post('sync-save', [SyncSaveController::class, 'syncSave']);
    });
});
