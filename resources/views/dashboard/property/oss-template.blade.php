@extends('layouts.dashboard.app')
@section('content')

    <div class="row mt-3">
        <div class="col-12">
            <div class="card _shadow-1">
                <div class="card-body">
                    <div class="d-flex justify-content-between" style="font-family: Arial">
                        <div>
                            <h2 class="text-black my-0">{{$data['report_name']}}</h2>
                            <h3 class="my-0">{{date('d/m/Y', strtotime($data['date_inspected']))}}</h3>
                        </div>

                        <div class="bg-gray py-1 px-2">
                            <img src="{{asset('assets/images/logo.png')}}" alt="" width="110">
                        </div>
                    </div>


                    <div class="mt-1 d-flex justify-content-between pt-1" style="border-top: 20px black solid">
                        <div>
                            {{-- <p>Type: {{$data['property']['batch']['scheme']['scheme']}}</p> --}}
                        </div>
                        <div>
                            <span><b>Client: </b>{{$data['property']['client']['name']}}</span>
                            <span>|</span>
                            <span><b>Address: </b>{{format_address($data['property']['house_num'], $data['property']['address1'], $data['property']['address2'], $data['property']['address3'], $data['property']['county'], $data['property']['eircode']) }}</span>
                        </div>
                    </div>

                    <div class="row px-2">
                        <div class="col-sm-12 bg-gray">
                            <h3 align="center">Hi, {{$data['property']['client']['name']}}</h3>
                            <p align="center">Thank you once again  for having our team in your home to carry out the assessment for your  Generation Green Home Upgrade.</p>
                            <p align="center">As mentioned earlier  our dedicated financial partner, An Post, is now offering low cost green  lending for energy efficient, home improvement projects such as yours. To find  out more about low cost green lending from An Post, please visit<a href="https://urldefense.com/v3/__https:/anpost.com/greenhub__;!!KLAX!z3hdm0HhLrJ8Do5KO3q00rVhqZ8HOInX8e8afBqKh18R2Xjog5WBAR714FzD_PLP$" target="_blank">&nbsp;An  Post Green Money Loans.</a></p>
                            <p align="center">Following the initial  assessment, we&rsquo;re pleased to offer you the estimated quotation below based on  your requirements, together with costings and relevant grants:</p>
                            <div class="py-2">
                                <h5 class="mb-1 mt-1">Address:</h5>
                                <table>
                                    <tr>
                                        <td>{{$data['property']['client']['name']}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$data['property']['client']['address1']}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$data['property']['client']['address2']}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$data['property']['client']['address3']}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$data['property']['client']['county']}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{$data['property']['client']['eircode']}}</td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>




                    <div class="row mt-3">
                        <div class="col-sm-12">

                            <table class="table table-striped table-bordered">
                                <thead>
                                    <th><h5>Description of Works (Supply & Fit)</h5></th>
                                    <th><h5>Cost</h5></th>
                                </thead>
                                <tbody>
                                @php
                                if($data->fk_forms_id == 22){
                                    $arr = $data['oss_template'];
                                }else if($data->fk_forms_id == 24){
                                    $arr = $data['fuel_template'];
                                }else if($data->fk_forms_id == 23){
                                    $arr = $data['housing_template'];
                                }
                                
                                @endphp
                                @if(sizeof($arr))
                                    @foreach($arr as $oss_template)
                                        <tr>
                                            <td>
                                                <h5 class="my-1">{{$oss_template['measure_name']}}</h5>
                                                <p>Grant: € {{number_format($oss_template['grant_cost'], 2)}}</p>
                                            </td>
                                            <td>€ {{number_format($oss_template['cost_works'], 2)}}</td>
                                        </tr>
                                    @endforeach

                                @endif
                                @php
                                if($data->fk_forms_id == 22){
                                    $arr2 = $data['oss_cost'];
                                }else if($data->fk_forms_id == 24){
                                    $arr2 = $data['fuel_cost'];
                                }else if($data->fk_forms_id == 23){
                                    $arr2 = $data['housing_cost'];
                                }
                                
                                @endphp
                                <tr>
                                    <td style="text-align: right"><h5>Total cost of Works:</h5></td>
                                    <td>€ {{$arr2 ? number_format($arr2['total_cost_works'], 2) : ''}}</td>
                                </tr>
                                    <tr>
                                        <td style="text-align: right"><h5>VAT @13.5%:</h5></td>
                                        <td>€ {{$arr2 ? number_format($arr2['vatcost'], 2) : ''}}</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right"><h5>Total cost of Works Including VAT @13.5%:</h5></td>
                                        <td>€ {{$arr2 ? number_format($arr2['total_client_cost_work_contribution'], 2) : ''}}</td>

                                    </tr>

                                    <tr>
                                        <td colspan="3"><h5>Surveyor Comments – </h5>
                                            <ul type="disc">
                                                <li><em>Please note a Pre &amp; Post BER is required for the SEAI OSS/NHR Grant Scheme. </em></li>
                                                <li><em>Completion of the Pre BER will confirm approval to the SEAI OSS Grant Scheme. </em></li>
                                                <li><em><strong>Please note:</strong> <strong>if       your home qualifies for the SEAI OSS/NHR Grant Scheme there will be an       additional discount for energy credits applicable.</strong></em></li>
                                                <li><em>The Discount for energy credits will be indicated on completion of the pre BER and confirmed on       completion of the post BER. </em></li>
                                                <li><em>Please note to qualify for the grant all external doors will       need to be upgraded. </em><em></em></li>
                                            </ul></td>
                                    </tr>

                                    <tr>
                                        <td colspan="3"><p><strong>Next Steps:</strong></p>
                                            <ul type="disc">
                                                <li>If       you are satisfied with our quotation and wish to proceed, please contact       us on the details listed below and we can take a booking deposit. </li>
                                                <li>As       discussed with your energy consultant, this quotation is an estimate and       may be subject to change on completion of the final technical installer       checks. Should there be a variance in cost, this will be fully explained       in your final quotation. </li>
                                                <li>Pre       &amp; Post BER required for the SEAI OSS Grant Scheme. </li>
                                                <li>Completion       of the HEA will determine the homes suitability to qualify for the       scheme/SEAI OSS Grants. </li>
                                                <li>Please       note if your home qualifies for the SEAI OSS Grant Scheme there will be an       additional discount for energy credits applicable. </li>
                                                <li>The       Discount for energy credits will be confirmed on completion of the pre       BER. </li>
                                                <li>Once       we have a booking deposit we will arrange final installer checks to       finalise your quote. </li>
                                                <li>On       completion of final installer checks, we will issue a final quote, a       contract for the works and documentation to allow us apply for your grant       and carbon credits. </li>
                                                <li>Once all documentation is signed, we will assign a project       manager and schedule in dates to commence your work. </li>
                                                <li>If you would like to discuss this quote or, if you would like       to proceed with the works, please contact your Sales Consultant Adrian       Harrison on (087 273 2382) or e-mail us on <a href="mailto:homeupgrades@sse.com" target="_blank">homeupgrades@sse.com</a></li>
                                                <li>Adrian will also contact you in the coming days to ensure you       have received your quote and to confirm how you wish to proceed. </li>
                                            </ul>
                                            <p>&nbsp;</p>
                                            <p style="text-align: center">Thank you again for your interest in our Generation  Green Home Upgrade.</p>
                                            <p  style="text-align: center"><strong>Kind Regards</strong><strong><br>
                                                    <strong>Adrian Harrison</strong><br>
                                                    <strong>Energy  Services Team&nbsp;</strong><br>
                                                    <strong>SSE  Airtricity</strong></strong></p>
                                        </td>
                                    </tr>


                                </tbody>
                            </table>


                        </div>
                    </div>



                    <div class="mt-2 p-3 d-flex justify-content-between bg-gray">
                        <div class="col-sm-6 d-flex align-items-center">
                            <div class="">
                                <div class="d-flex">
                                    <h4 class="text-black my-1">Date: </h4><h4
                                        class="ml-1 my-1">{{date('d/m/Y', strtotime($data['date_inspected']))}}</h4>
                                </div>
                                <div class="d-flex">
                                    <h4 class="text-black my-0">Signed: </h4><h4
                                        class="ml-1 my-0">{{$data['name']}}</h4>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            @if($data['signature'])
                                <img class="bg-gray img-fluid bg-white float-end"
                                     src="{{asset('/'.$APP_BASE_IMAGE_PATH.'/assets/uploads/inspection_signature/'.$data['signature'])}}"
                                     width="200">
                            @endif
                        </div>
                    </div>


                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->

@endsection
