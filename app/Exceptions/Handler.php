<?php

namespace App\Exceptions;

use App\Models\Batch;
use App\Models\Client;
use App\Models\DocumentLibrary;
use App\Models\ErrorLogs;
use App\Models\JobLookup;
use App\Models\Property;
use App\Models\Scheme;
use App\Models\Surveyor;
use App\Models\ToolboxTalk;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\View;
use Mockery\Exception\InvalidOrderException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request,Throwable $exception)
    {
        // $actual_link = "https://$_SERVER[HTTP_HOST]";
        // $url = $actual_link;
        // dd($exception);
        if(env('APP_DEBUG') == false){
            if(isset($exception->validator)){
                return parent::render($request, $exception);
            }
        if ($this->isHttpException($exception)) {
           
            $errlog = new ErrorLogs;
            $errlog->error_code = $exception->getStatusCode();
            $errlog->section = request()->segment(2) != null ? request()->segment(2) : request()->segment(1);
            $errlog->url = url()->current();
            $errlog->date = date('Y-m-d');
            $errlog->time = date('H:i:s');

            if (request()->segment(2) == 'property') {
                if(last(request()->segments()) != null) {
                    try {
                        $id = Crypt::decrypt(last(request()->segments()));
                        $property = Property::where('id', $id)->first();
                        
                        if($property != null){
                            $address = format_address(
                                $property->house_num,
                                $property->address1,
                                $property->address2,
                            $property->address3,
                            $property->county,
                            $property->eircode,
                        );
                        $errlog->property_name = $address;
                        $errlog->gen_id = $id;
                    }
                    } catch (DecryptException $e) {}
                }
            }

            if (request()->segment(2) == 'user' || request()->segment(2) == 'contractor' || request()->segment(2) == 'assessor') {

                if(last(request()->segments()) != null) {
                    try {
                        $id = request()->segment(2) == 'contractor' ? last(request()->segments()) : Crypt::decrypt(last(request()->segments()));

                        $user = User::where('id', $id)->first();
                        $errlog->name = $user->lastname != null ? $user->firstname.' '.$user->lastname : $user->firstname;
                        $errlog->gen_id = $id;
                    } catch(DecryptException $e) {}
                }
            }

            if (request()->segment(2) == 'surveyor') {
                if(last(request()->segments()) != null) {
                    try {
                        $id = Crypt::decrypt(last(request()->segments()));

                        $surveyor = Surveyor::where('user_id', $id)->first();
                        $errlog->name = $surveyor->full_name;
                        $errlog->gen_id = $id;
                    } catch(DecryptException $e) {}
                }
            }

            if (request()->segment(2) == 'client') {
                if(last(request()->segments()) != null) {
                    try{
                        $id = Crypt::decrypt(last(request()->segments()));

                        $client = Client::where('id', $id)->first();
                        $errlog->name = $client->name;
                        $errlog->gen_id = $id;
                    }
                     catch(DecryptException $e) {}
                }
            }

            if (request()->segment(2) == 'batch') {
                if(last(request()->segments()) != null) {
                    try{
                        $id = Crypt::decrypt(last(request()->segments()));

                        $batch = Batch::where('id', $id)->first();
                        $errlog->name = $batch->our_ref;
                        $errlog->gen_id = $id;
                    } catch(DecryptException $e) {}
                }
            }

            if (request()->segment(2) == 'lookup') {
                if (request()->segment(3) == 'job') {
                    if(last(request()->segments()) != null) {
                        try{
                            $id = Crypt::decrypt(last(request()->segments()));

                            $joblookup = JobLookup::where('id', $id)->first();
                            $errlog->name = $joblookup->title;
                            $errlog->gen_id = $id;
                        } catch(DecryptException $e) {}
                    }
                }

                if (request()->segment(3) == 'scheme') {
                    if(last(request()->segments()) != null) {
                        try{
                            $id = Crypt::decrypt(last(request()->segments()));

                            $scheme = Scheme::where('id', $id)->first();
                            $errlog->name = $scheme->scheme;
                            $errlog->gen_id = $id;
                        } catch(DecryptException $e) {}
                    }
                }

            }

            if (request()->segment(2) == 'document') {
                if(last(request()->segments()) != null) {
                    try{
                        $id = Crypt::decrypt(last(request()->segments()));

                        $doclib = DocumentLibrary::where('id', $id)->first();
                        $errlog->gen_id = $id;
                    } catch(DecryptException $e) {}
                }
            }

            if (request()->segment(2) == 'toolbox-talk') {
                if(last(request()->segments()) != null) {
                    try{
                        $id = Crypt::decrypt(last(request()->segments()));

                        $tooltalk = ToolboxTalk::where('id', $id)->first();
                        $errlog->name = $tooltalk->talk_title;
                        $errlog->gen_id = $id;
                    } catch(DecryptException $e) {}
                }
            }

            $errlog->message = $exception->getMessage() == '' ? null : $exception->getMessage();
            $errlog->save();
            if(!$request->ajax()){
                return redirect()->route('errors');
            }

            // return response()->view('errors.common-error');
        } else {
            // dd($exception);
            $errlog = new ErrorLogs;
            $errlog->error_code = $exception->getCode();
            $errlog->section = request()->segment(2) != null ? request()->segment(2) : request()->segment(1);
            $errlog->url = url()->current();
            $errlog->date = date('Y-m-d');
            $errlog->time = date('H:i:s');
            $errlog->message = $exception->getMessage() == '' ? null : $exception->getMessage();

            if (request()->segment(2) == 'property') {
                if(last(request()->segments()) != null) {
                    try {
                        $id = Crypt::decrypt(last(request()->segments()));
                        $property = Property::where('id', $id)->first();
                        if($property != null){

                            $address = format_address(
                                $property->house_num,
                                $property->address1,
                                $property->address2,
                                $property->address3,
                                $property->county,
                                $property->eircode,
                            );
                            $errlog->property_name = $address;
                            $errlog->gen_id = $id;
                        }
                    } catch (DecryptException $e) {}
                }
            }

            if (request()->segment(2) == 'user' || request()->segment(2) == 'contractor' || request()->segment(2) == 'assessor') {

                if(last(request()->segments()) != null) {
                    try {
                        $id = request()->segment(2) == 'contractor' ? last(request()->segments()) : Crypt::decrypt(last(request()->segments()));

                        $user = User::where('id', $id)->first();
                        $errlog->name = $user->lastname != null ? $user->firstname.' '.$user->lastname : $user->firstname;
                        $errlog->gen_id = $id;
                    } catch(DecryptException $e) {}
                }
            }

            if (request()->segment(2) == 'surveyor') {
                if(last(request()->segments()) != null) {
                    try {
                        $id = Crypt::decrypt(last(request()->segments()));

                        $surveyor = Surveyor::where('user_id', $id)->first();
                        $errlog->name = $surveyor->full_name;
                        $errlog->gen_id = $id;
                    } catch(DecryptException $e) {}
                }
            }

            if (request()->segment(2) == 'client') {
                if(last(request()->segments()) != null) {
                    try{
                        $id = Crypt::decrypt(last(request()->segments()));

                        $client = Client::where('id', $id)->first();
                        $errlog->name = $client->name;
                        $errlog->gen_id = $id;
                    }
                    catch(DecryptException $e) {}
                }
            }

            if (request()->segment(2) == 'batch') {
                if(last(request()->segments()) != null) {
                    try{
                        $id = Crypt::decrypt(last(request()->segments()));

                        $batch = Batch::where('id', $id)->first();
                        $errlog->name = $batch->our_ref;
                        $errlog->gen_id = $id;
                    } catch(DecryptException $e) {}
                }
            }

            if (request()->segment(2) == 'lookup') {
                if (request()->segment(3) == 'job') {
                    if(last(request()->segments()) != null) {
                        try{
                            $id = Crypt::decrypt(last(request()->segments()));

                            $joblookup = JobLookup::where('id', $id)->first();
                            $errlog->name = $joblookup->title;
                            $errlog->gen_id = $id;
                        } catch(DecryptException $e) {}
                    }
                }

                if (request()->segment(3) == 'scheme') {
                    if(last(request()->segments()) != null) {
                        try{
                            $id = Crypt::decrypt(last(request()->segments()));

                            $scheme = Scheme::where('id', $id)->first();
                            $errlog->name = $scheme->scheme;
                            $errlog->gen_id = $id;
                        } catch(DecryptException $e) {}
                    }
                }

            }

            if (request()->segment(2) == 'document') {
                if(last(request()->segments()) != null) {
                    try{
                        $id = Crypt::decrypt(last(request()->segments()));

                        $doclib = DocumentLibrary::where('id', $id)->first();
                        $errlog->gen_id = $id;
                    } catch(DecryptException $e) {}
                }
            }

            if (request()->segment(2) == 'toolbox-talk') {
                if(last(request()->segments()) != null) {
                    try{
                        $id = Crypt::decrypt(last(request()->segments()));

                        $tooltalk = ToolboxTalk::where('id', $id)->first();
                        $errlog->name = $tooltalk->talk_title;
                        $errlog->gen_id = $id;
                    } catch(DecryptException $e) {}
                }
            }

            $errlog->save();
            if(!$request->ajax()){
                return redirect()->route('errors');
            }

            // return response()->view('errors.common-error');
        }
        }else{
            return parent::render($request, $exception);
        }
    }
}
