<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css?family=Didact+Gothic');
        * {
            font-family: 'Didact Gothic', sans-serif !important;
        }
        /* Media Queries */
        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
    </style>
</head>

<body style="margin: 0; padding: 0; width: 100%; background-color: #F2F4F6;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td style="width: 100%; margin: 0; padding: 0; background-color: #F2F4F6;" align="center">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <!-- Email Body -->
                    <tr>
                        <td style="width: 100%; margin: 0; padding: 0; border-top: 1px solid #EDEFF2; border-bottom: 1px solid #EDEFF2; background-color: #FFF;" width="100%">
                            <table style="width: auto; max-width: 700px;padding: 0;">
                                <tr>
                                    <td style="padding: 35px;">
                                        <p style="margin-top: 0; color: #000;  line-height: 1.5em;text-align: left;">
                                            {{$details['to_greeting']}}
                                        </p>
                                        <p style="margin-top: 0; color: #000;  line-height: 1.5em;text-align: left;">
                                            {!! $details['to_body'] !!}
                                        </p>
                                        @if(sizeOf($details['files']))
                                        {{-- <p style="margin-top: 0; color: #000;  line-height: 1.5em;text-align: left;">
                                            I attach your new quote, please review and let me know if it is to your requirements.
                                        </p> --}}
                                        @foreach($details['files'] as $key => $fls)
                                        <p style="margin-top: 0; color: #000;  line-height: 1.5em;text-align: left;">
                                        <a href="{{ $fls['url'] }}" download="{{$fls['url'] }}" style="margin-top: 0; color: #1A47A3;text-decoration:underline;  line-height: 1.5em;text-align: left;">
                                            {{ $fls['name'] }}
                                        </a></p>
                                        @endforeach
                                        @endif
                                        <p style="margin-top: 0; color: #000;  line-height: 1.5em;text-align: left;">
                                            {{$details['to_regards']}}
                                        </p>
                                        <p style="margin-top: 0; color: #000;  line-height: 1.5em;text-align: left;">
                                            {{$details['to_regards_by']}}
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Logo -->
                    <tr>
                        <td style="padding: 25px 0; text-align: center; background:#fff;">
                            <a style=" font-weight: bold; color: #2F3133; text-decoration: none; text-shadow: 0 1px 0 white;">
                                <img src="{{$details['logo']}}" style="height:100px;" alt="">
                            </a>
                        </td>
                    </tr>
                    <!-- Footer -->
                    <tr>
                        <td>
                            <table style="width: auto; max-width: 570px; margin: 0 auto; padding: 0; text-align: center;" align="center">
                                <tr>
                                    <td style="color: #AEAEAE; padding: 35px; text-align: center;">
                                        <p style="margin-top: 0; color: #000; font-size: 12px; line-height: 1.5em;text-align: center;">
                                            &copy; {{ date('Y') }} <a style="color: #1A47A3;" href="{{ url(env("APP_URL")) }}" target="_blank">BCR</a>. All rights reserved.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
