<?php

use App\Http\Controllers\LeadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\LookupController;
use App\Http\Controllers\SchemeController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\SurveyorController;
use App\Http\Controllers\ContractorController;
use App\Http\Controllers\AssessContractController;
use App\Http\Controllers\HeaBerAssessorController;
use App\Http\Controllers\ContractorMessageController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ToolboxTalkController;
use App\Http\Controllers\ErrorLogController;



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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::prefix('dashboard')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/contractor-jobs', [HomeController::class, 'getContractorJobs'])->name('dashboard.contractor-jobs');
    Route::post('/property-contracts', [HomeController::class, 'propertyContracts'])->name('dashboard.property-contracts');
    Route::post('/property-contracts-order', [HomeController::class, 'propertyContractsOrder'])->name('dashboard.property-contracts-order');
    Route::post('/calendar', [HomeController::class, 'getCalendarJobs'])->name('dashboard.calendar');
    Route::get('/scheduler', [HomeController::class, 'scheduler'])->name('dashboard.scheduler');
    Route::get('/calendar-appointments', [HomeController::class, 'calendar_appointments'])->name('dashboard.calander.appointments');

    Route::post('/properties-jobs', [HomeController::class, 'propertiesJobs'])->name('dashboard.properties-jobs');
    Route::get('/contractor-properties-gantt', [HomeController::class, 'contractorPropertiesGantt'])->name('dashboard.contractor-properties-gantt');
});

Route::get('/dashboard-post-work-log', [HomeController::class, 'postWorkLog'])->name('dashboard.postWorkLog');
Route::get('/admin-profile', [HomeController::class, 'adminProfile'])->name('admin-profile');
Route::post('/admin-update', [HomeController::class, 'adminUpdate'])->name('admin-update');
Route::post('/changeStatusNofication', [HomeController::class, 'changeStatusNofication'])->name('changeStatusNofication');

// Users --Admin
Route::prefix('dashboard/user')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('user');
    Route::get('/create', [UserController::class, 'createUser'])->name('user.create');
    Route::get('/{id}', [UserController::class, 'editUser'])->name('user.edit');
    Route::get('/delete/{id}', [UserController::class, 'deleteUser'])->name('user.delete');
    Route::post('/create', [UserController::class, 'storeUser'])->name('user.store');
    Route::post('/update', [UserController::class, 'updateUser'])->name('user.update');
});

// Users -- Surveyor
Route::prefix('dashboard/appuser')->group(function () {
    Route::get('/', [SurveyorController::class, 'index'])->name('surveyor');
    Route::get('/create', [SurveyorController::class, 'createSurveyor'])->name('surveyor.create');
    Route::get('/{id}', [SurveyorController::class, 'editSurveyor'])->name('surveyor.edit');
    Route::get('/delete/{id}', [SurveyorController::class, 'deleteSurveyor'])->name('surveyor.delete');
    Route::post('/create', [SurveyorController::class, 'storeSurveyor'])->name('surveyor.store');
    Route::post('/update', [SurveyorController::class, 'updateSurveyor'])->name('surveyor.update');
});

// Client
Route::prefix('dashboard/client')->group(function () {
    Route::get('/', [ClientController::class, 'index'])->name('client');
    Route::get('/create', [ClientController::class, 'createClient'])->name('client.create');
    Route::get('/{id}', [ClientController::class, 'editClient'])->name('client.edit');
    Route::get('/delete/{id}', [ClientController::class, 'deleteClient'])->name('client.delete');
    Route::post('/create', [ClientController::class, 'storeClient'])->name('client.store');
    Route::post('/update', [ClientController::class, 'updateClient'])->name('client.update');
});

// Batch
Route::prefix('dashboard/batch')->group(function () {
    Route::get('/', [BatchController::class, 'index'])->name('batch');
    Route::get('/create', [BatchController::class, 'createBatch'])->name('batch.create');
    Route::get('/{id}', [BatchController::class, 'editBatch'])->name('batch.edit');
    Route::get('/delete/{id}', [BatchController::class, 'deleteBatch'])->name('batch.delete');
    Route::post('/create', [BatchController::class, 'storeBatch'])->name('batch.store');
    Route::post('/update', [BatchController::class, 'updateBatch'])->name('batch.update');
});
Route::get('/check-reminder', [PropertyController::class, 'checkReminder'])->name('checkReminder');
Route::post('/filter-reminder', [PropertyController::class, 'filterReminder'])->name('filterReminder');
// Property
Route::prefix('dashboard/lead')->group(function () {
    Route::get('/{scheme_id}', [LeadController::class, 'index'])->name('lead');
    Route::get('/create/new', [LeadController::class, 'createLead'])->name('lead.create');
    Route::get('/edit/{id}', [LeadController::class, 'editLead'])->name('lead.edit');
    Route::get('/show/{id}', [LeadController::class, 'showLead'])->name('lead.show');
    Route::get('/delete/{id}', [LeadController::class, 'deleteLead'])->name('lead.delete');
    Route::post('/create', [LeadController::class, 'storeLead'])->name('lead.store');
    Route::post('/update', [LeadController::class, 'updateLead'])->name('lead.update');
    Route::get('email/lead-send-email-create', [LeadController::class, 'createLeadEmail'])->name('lead.createLeadEmail');
    Route::get('email/lead-send-email-view', [LeadController::class, 'leadViewEmail'])->name('lead.leadViewEmail');
    Route::post('/send-email-property', [LeadController::class, 'sendEmailCustom'])->name('lead.sendEmailCustom');
    Route::post('/create-appointment', [LeadController::class, 'createAppointment'])->name('lead.createAppointment');
    Route::get('/delete-appointment/{id}', [LeadController::class, 'deleteAppointment'])->name('lead.deleteAppointment');
    Route::post('/send-email-property', [LeadController::class, 'sendEmailCustom'])->name('lead.sendEmailCustom');
    Route::post('/store-reason', [LeadController::class, 'leadReason'])->name('lead.reason');
    Route::post('/lead-to-property', [LeadController::class, 'convertLeadToProperty'])->name('lead.to.property');
    Route::post('/lead-status-change', [LeadController::class, 'leadStatus'])->name('lead.status.change');
});
Route::prefix('dashboard/property')->group(function () {
    Route::get('/{scheme_id}', [PropertyController::class, 'index'])->name('property');
    Route::get('/create/new', [PropertyController::class, 'createProperty'])->name('property.create');
    Route::get('/show/{id}', [PropertyController::class, 'showProperty'])->name('property.show');
    Route::get('/assign-contractor/{property_id}/{contract_id}', [PropertyController::class, 'assignContractor'])->name('property.assign-contractor');
    Route::get('/edit/{id}', [PropertyController::class, 'editProperty'])->name('property.edit');
    Route::get('/delete/{id}', [PropertyController::class, 'deleteProperty'])->name('property.delete');
    Route::post('/create', [PropertyController::class, 'storeProperty'])->name('property.store');
    Route::post('/store-contract', [PropertyController::class, 'storeContract'])->name('property.storeContract');
    Route::post('/update-contract', [PropertyController::class, 'updateContract'])->name('property.updateContract');
    Route::get('/delete-contract/{id}', [PropertyController::class, 'deleteContract'])->name('property.deleteContract');
    Route::post('/update', [PropertyController::class, 'updateProperty'])->name('property.update');
    Route::get('/get-surveyors/{property_id}', [PropertyController::class, 'getSurveyors'])->name('property.getSurveyors');
    Route::post('/assign-surveyor', [PropertyController::class, 'assignSurveyor'])->name('property.assignSurveyor');
    Route::post('/add-third-party-form', [PropertyController::class, 'addThirdPartyForm'])->name('property.addThirdPartyForm');
    Route::get('/change-third-party-form-status/{id}/{status}', [PropertyController::class, 'changeThirdPartyStatus'])->name('property.changeThirdPartyStatus');
    Route::get('/remove-surveyor/{property_id}', [PropertyController::class, 'removeSurveyor'])->name('property.removeSurveyor');
    Route::post('/work-order/upload', [PropertyController::class, 'uploadWorkOrder'])->name('property.uploadWorkOrder');
    Route::get('/work-order/change-status/{id}/{status}', [PropertyController::class, 'changeWorkOrderStatus'])->name('property.changeWorkOrderStatus');
    Route::get('/report/{inspection_id}/delete', [PropertyController::class, 'reportDelete'])->name('property.report.delete');
    Route::get('/report/{inspection_id}/{mode}', [PropertyController::class, 'property_report'])->name('property.new_report');
    Route::get('/sendPdfClient/{inspection_id}', [PropertyController::class, 'sendPdfClient'])->name('property.sendPdfClient');

    Route::get('/report/report-edit/{inspection_id}', [PropertyController::class, 'reportEdit'])->name('reportEdit');
    Route::post('/update-variation', [PropertyController::class, 'updateVariation'])->name('property.updateVariation');
    Route::post('/create-reminder', [PropertyController::class, 'createReminder'])->name('property.createReminder');

    Route::get('/delete-reminder/{id}', [PropertyController::class, 'deleteReminder'])->name('property.deleteReminder');
    Route::post('/update-proper-notes', [PropertyController::class, 'updateNotes'])->name('property.updateNotes');
    Route::post('safety-health-form-update', [PropertyController::class, 'safetyHealthUpdate'])->name('safetyHealthUpdate');

    Route::get('/assign-assessor/{property_id}/{contract_id}', [PropertyController::class, 'assignAssessor'])->name('property.assignAssessor');
    Route::post('/store-assessor', [PropertyController::class, 'storeAssessor'])->name('property.storeAssessor');
    Route::post('/update-assessor', [PropertyController::class, 'updateAssessor'])->name('property.updateAssessor');
    Route::get('/delete-assessor/{id}', [PropertyController::class, 'deleteAssessor'])->name('property.deleteAssessor');
    Route::post('/change-status/{id}', [PropertyController::class, 'changePropertyStatus'])->name('property.changePropertyStatus');

    Route::get('/delete-post-work-log/{id}', [PropertyController::class, 'deletePostWorkLog'])->name('property.deletePostWorkLog');
    Route::post('/add-post-work-log', [PropertyController::class, 'addPostWorkLog'])->name('property.addPostWorkLog');
    Route::post('/update-post-work-log', [PropertyController::class, 'updatePostWorkLog'])->name('property.updatePostWorkLog');

    Route::post('/update-financials', [PropertyController::class, 'updateFinancials'])->name('property.updateFinancials');

    Route::post('/add-measure', [PropertyController::class, 'addMeasure'])->name('property.addMeasure');
    Route::post('/updateMeaStatus', [PropertyController::class, 'updateMeaStatus'])->name('updateMeaStatus');
    Route::get('/delete-measure/{id}', [PropertyController::class, 'deleteMeasure'])->name('property.deleteMeasure');
    Route::get('/delete-measures/{id}', [PropertyController::class, 'deleteMeasures'])->name('property.deleteMeasures');

    Route::get('/delete-document/{id}', [PropertyController::class, 'deleteDocument'])->name('property.deleteDocument');
    Route::get('/delete-variation-document/{id}', [PropertyController::class, 'deleteVariationDocument'])->name('property.deleteVariationDocument');

    Route::post('/note/store', [PropertyController::class, 'storeNote'])->name('property.note.store');
    Route::post('/note/update', [PropertyController::class, 'updateNote'])->name('property.note.update');
    Route::get('/note/edit/{note_id}', [PropertyController::class, 'getNote'])->name('property.note.edit');
    Route::get('/note/{property_id}', [PropertyController::class, 'getNotes'])->name('property.note');
    Route::get('/delete-note/{id}', [PropertyController::class, 'deleteNote'])->name('property.note.delete');
    Route::get('/delete-sheet/{id}', [PropertyController::class, 'deleteSheet'])->name('signinout.deletesheet');


    Route::get('/surveyor_logs/{property_id}', [PropertyController::class, 'surveyorLogs'])->name('property.surveyorLogs');
    Route::get('/surveyor_logs/details/{id}', [PropertyController::class, 'surveyorLogDetails'])->name('property.surveyorLogDetails');

    Route::get('/inspection_report/export/{id}', [PropertyController::class, 'exportInspectionReport'])->name('property.exportInspectionReport');
    Route::get('/import/new', [PropertyController::class, 'importProperty'])->name('property.import');
    Route::post('/import/store', [PropertyController::class, 'storeImportProperty'])->name('property.import.store');
    Route::get('/export-documents/{property_id}/{contract_id}', [PropertyController::class, 'export_documents'])->name('property.export-documents');
    Route::get('/export-documents2/{property_id}/{assessor_id}', [PropertyController::class, 'export_documents2'])->name('property.export-documents2');
    Route::get('/export-all-documents/{property_id}', [PropertyController::class, 'export_all_documents'])->name('property.export-all-documents');
    Route::get('/export-all-documents2/{property_id}', [PropertyController::class, 'export_all_documents2'])->name('property.export-all-documents2');

    Route::put('/contractor-property-unit-update', [PropertyController::class, 'updateContractorPropertyUnits'])->name('property.updateContractorPropertyUnits');
    Route::get('/snag_report/{id}/{mode}', [PropertyController::class, 'snag_report'])->name('property.snag_report');
    Route::post('/photo/store', [PropertyController::class, 'photoUploads'])->name('property.photo.store');
    Route::get('/photo/get/{fk_perperty_id}/{fk_section_id}', [PropertyController::class, 'getUploadsPhotoBySection'])->name('property.photo.get');
    Route::post('/photo/delete-file', [PropertyController::class, 'deletephotofile'])->name('property.photo.delete');
    Route::post('/photo/delete-photo-comment', [PropertyController::class, 'deletePhotoComment'])->name('property.photo.comment');
    Route::get('/photo/download-all/{property_id}/{fk_section_id?}', [PropertyController::class, 'downloadimgs'])->name('property.photo.download');
    //new appointment and mail
    Route::get('email/property-send-email-create', [PropertyController::class, 'createpropertyEmail'])->name('property.createpropertyEmail');
    Route::get('email/property-send-email-view', [PropertyController::class, 'propertyViewEmail'])->name('property.propertyViewEmail');
    Route::post('/send-email-property', [PropertyController::class, 'sendEmailCustom'])->name('property.sendEmailCustom');
    Route::post('/create-appointment', [PropertyController::class, 'createAppointment'])->name('property.createAppointment');
    Route::get('/delete-appointment/{id}', [PropertyController::class, 'deleteAppointment'])->name('property.deleteAppointment');
    Route::post('/send-email-property', [PropertyController::class, 'sendEmailCustom'])->name('property.sendEmailCustom');
});

Route::get('/getOldPdf/{id}', [PropertyController::class, 'getOldPdf'])->name('getOldPdf');
// Contractor
Route::prefix('dashboard/contractor')->group(function () {
    Route::get('/', [ContractorController::class, 'index'])->name('contractor');
    Route::get('/create', [ContractorController::class, 'createContractor'])->name('contractor.create');
    Route::get('/{contractor_id}', [ContractorController::class, 'editContractor'])->name('contractor.edit');
    Route::get('/delete/{id}', [ContractorController::class, 'deleteContractor'])->name('contractor.delete');
    Route::post('/create', [ContractorController::class, 'storeContractor'])->name('contractor.store');
    Route::post('/update', [ContractorController::class, 'updateContractor'])->name('contractor.update');
    Route::put('/update-emergency-detail', [ContractorController::class, 'updateEmergencyDetail'])->name('contractor.updateEmergencyDetail');
});

// HEA/BER Assessor
Route::prefix('dashboard/assessor')->group(function () {
    Route::get('/', [HeaBerAssessorController::class, 'index'])->name('assessor');
    Route::get('/create', [HeaBerAssessorController::class, 'createAssessor'])->name('assessor.create');
    Route::get('/{id}', [HeaBerAssessorController::class, 'editAssessor'])->name('assessor.edit');
    Route::get('/delete/{id}', [HeaBerAssessorController::class, 'deleteAssessor'])->name('assessor.delete');
    Route::post('/create', [HeaBerAssessorController::class, 'storeAssessor'])->name('assessor.store');
    Route::post('/update', [HeaBerAssessorController::class, 'updateAssessor'])->name('assessor.update');
});

// Contract
Route::prefix('dashboard/contract')->group(function () {
    Route::get('/', [ContractController::class, 'index'])->name('contract');
    Route::get('/show-contract/{id}', [ContractController::class, 'showContract'])->name('show.contract');
    Route::post('/upload-file', [ContractController::class, 'uploadFile'])->name('contract.uploadFile');
    Route::post('/update-status', [ContractController::class, 'updateStatus'])->name('contract.updateStatus');
    Route::post('/upload-document', [ContractController::class, 'uploadVariationDocument'])->name('contract.uploadVariationDocument');
    Route::post('/create-variation', [ContractController::class, 'createVariation'])->name('contract.createVariation');
    Route::get('/delete-variation/{id}', [ContractController::class, 'deleteVariation'])->name('contract.deleteVariation');
    Route::post('/create-note', [ContractController::class, 'createNote'])->name('contract.createNote');
    Route::get('/delete-note/{id}', [ContractController::class, 'deleteNote'])->name('contract.deleteNote');
    Route::get('/delete-document/{id}', [ContractController::class, 'deleteDocument'])->name('contract.deleteDocument');
    Route::get('/delete-variation-document/{id}', [ContractController::class, 'deleteVariationDocument'])->name('contract.deleteVariationDocument');
});
Route::post('/check-default-contractor', [ContractorController::class, 'checkDefaultContractor'])->name('checkDefaultContractor');
// Assessor Contract
Route::prefix('dashboard/assessor-contract')->group(function () {
    Route::get('/', [AssessContractController::class, 'index'])->name('assessor-contract');
    Route::get('/show-contract/{id}', [AssessContractController::class, 'showContract'])->name('assessor-contract.show');
    Route::get('/photo/get/{fk_perperty_id}/{fk_section_id}', [AssessContractController::class, 'getUploadsPhotoBySection'])->name('assessor-contract.photo.get');
    Route::post('/upload-file', [AssessContractController::class, 'uploadFile'])->name('assessor-contract.uploadFile');
    Route::post('/update-status', [AssessContractController::class, 'updateStatus'])->name('assessor-contract.updateStatus');

    Route::get('/delete-document/{id}', [AssessContractController::class, 'deleteDocument'])->name('assessor-contract.deleteDocument');
});


// Lookup routes
Route::prefix('/dashboard/lookup')->group(function () {
    Route::get('/job', [LookupController::class, 'index'])->name('lookup.job');
    Route::get('/job/create', [LookupController::class, 'createJob'])->name('lookup.job.create');
    Route::post('/job', [LookupController::class, 'storeJob'])->name('lookup.job.save');
    Route::get('/job/{id}', [LookupController::class, 'editJob'])->name('lookup.job.edit');
    Route::put('/job/{id}', [LookupController::class, 'updateJob'])->name('lookup.job.update');
    Route::get('/job/delete/{id}', [LookupController::class, 'deleteJob'])->name('lookup.job.delete');
    Route::get('/job/document/delete-document/{id}', [LookupController::class, 'deleteJobDocument'])->name('lookup.job.document.delete');
    Route::get('/job/document/{job_id}', [LookupController::class, 'getJobDocuments'])->name('lookup.job.document');
    Route::post('/job/document/add-document/{job_id}', [LookupController::class, 'storeJobDocument'])->name('lookup.job.document.save');

    Route::get('/scheme', [SchemeController::class, 'index'])->name('lookup.scheme');
    Route::get('/scheme/create', [SchemeController::class, 'create'])->name('lookup.scheme.create');
    Route::post('/scheme', [SchemeController::class, 'store'])->name('lookup.scheme.save');
    Route::get('/scheme/{id}', [SchemeController::class, 'edit'])->name('lookup.scheme.edit');
    Route::put('/scheme/{id}', [SchemeController::class, 'update'])->name('lookup.scheme.update');

    Route::get('/photo-folder', [PropertyController::class, 'photoFolder'])->name('photoFolder');
    Route::post('/saveNewFolder', [PropertyController::class, 'saveNewFolder'])->name('saveNewFolder');
    Route::get('/deletePhotoFolder', [PropertyController::class, 'deletePhotoFolder'])->name('deletePhotoFolder');
});

// Config
Route::prefix('dashboard/config')->group(function () {
    Route::get('', [ConfigController::class, 'index'])->name('config');
    Route::put('/update', [ConfigController::class, 'updateConfig'])->name('config.update');
    Route::get('report-config', [ConfigController::class, 'reportIndex'])->name('report-config');
    Route::put('/report-config-update', [ConfigController::class, 'reportUpdateConfig'])->name('report-config.update');

    Route::post('/save-description-work', [ConfigController::class, 'createDescWork'])->name('desc-work.create');
    Route::post('/update-description-work', [ConfigController::class, 'updateDescWork'])->name('desc-work.update');
    Route::get('/view-description-work/{id}', [ConfigController::class, 'viewDescWork'])->name('desc-work.view');
    Route::get('/delete-description-work/{id}', [ConfigController::class, 'deleteDescWork'])->name('desc-work.delete');
});

Route::prefix('/dashboard/contract')->group(function () {
    Route::get('/markAsRead', [HomeController::class, 'markAsRead'])->name('notification.markAsRead');
    Route::get('/acceptPropertyContract/{contract}', [HomeController::class, 'acceptPropertyContract'])->name('contractor.accept.contract');
    Route::get('/rejectPropertyContract/{contract}', [HomeController::class, 'rejectPropertyContract'])->name('contractor.reject.contract');

    Route::post('/contractorsAndAdmins', [HomeController::class, 'contractorsAndAdmins'])->name('dashboard.contractor-admin');
});

// Chat
Route::get('/dashboard/contractor-chat/{id?}/{notification_id?}', [ContractorMessageController::class, 'openChat'])->name('chat.open');
Route::get('/openChatNoti', [ContractorMessageController::class, 'openChatNoti'])->name('openChatNoti');
Route::post('/dashboard/send-contractor-message', [ContractorMessageController::class, 'sendMessage'])->name('contractor.send-message');
Route::post('/dashboard/send-new-contractor-message', [ContractorMessageController::class, 'index'])->name('chat.send-new-message');
Route::post('getProp', [ContractorMessageController::class, 'getProp'])->name('getProp');
Route::get('/user-login-status/{id?}', [ContractorMessageController::class, 'userLoginStatus'])->name('userLoginStatus');

Route::prefix('/dashboard/document')->group(function () {
    Route::get('/index', [DocumentController::class, 'index'])->name('document.index');
    Route::get('/create', [DocumentController::class, 'create'])->name('document.create');
    Route::post('/store', [DocumentController::class, 'store'])->name('document.store');
    Route::get('/archive/{id}', [DocumentController::class, 'archive'])->name('document.archive');
    Route::post('/filter_document', [DocumentController::class, 'filter_document'])->name('document.filter');
    Route::post('/upload_contract_document', [DocumentController::class, 'upload_contract_document'])->name('document.contract.upload');
});

// Toolbox talk routes
Route::prefix('/dashboard/toolbox-talk')->group(function () {
    Route::get('/', [ToolboxTalkController::class, 'index'])->name('toolboxTalk');
    Route::get('/create', [ToolboxTalkController::class, 'create'])->name('toolboxTalk.create');
    Route::post('/', [ToolboxTalkController::class, 'store'])->name('toolboxTalk.store');
    Route::post('/item-update', [ToolboxTalkController::class, 'itemUpdate'])->name('toolboxTalk.item.update');
    Route::get('/{id}', [ToolboxTalkController::class, 'edit'])->name('toolboxTalk.edit');
    Route::put('/{id}', [ToolboxTalkController::class, 'update'])->name('toolboxTalk.update');
    Route::get('/archive/{id}/{status}', [ToolboxTalkController::class, 'archiveToggle'])->name('toolboxTalk.archiveToggle');
    Route::get('/delete/{id}', [ToolboxTalkController::class, 'delete'])->name('toolboxTalk.delete');

    Route::get('/item/delete/{id}', [ToolboxTalkController::class, 'deleteToolboxTalkItem'])->name('toolboxTalk.deleteToolboxTalkItem');
    Route::get('/item/{id}', [ToolboxTalkController::class, 'getToolboxTalkItems'])->name('toolboxTalk.getToolboxTalkItems');
    Route::post('/item/{id}', [ToolboxTalkController::class, 'storeToolboxTalkItems'])->name('toolboxTalk.storeToolboxTalkItems');
});
Route::get('/errors', [ErrorLogController::class, 'errors'])->name('errors');
// Error Logs routes
Route::get('/dashboard/error-logs', [ErrorLogController::class, 'index'])->name('errorlogs');
Route::get('/dashboard/error-logs/delete/{id}', [ErrorLogController::class, 'deleteErrorlog'])->name('errorlog.delete');

Route::get('/con-form-view', function () {
    return view('dashboard.property.reports.contract-form');
});
Route::get('/con-form', function () {
    genrateContractPdf();
});
