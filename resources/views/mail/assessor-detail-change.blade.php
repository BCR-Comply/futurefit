<!DOCTYPE html>
<html>
<head>
    <title>{{$details['title']}}</title>
</head>
<body>

<div>
    <p>Hi {{$details['client_name']}}, your login details have been successfully changed:</p>
    <table>
        <tr>
            <th style="text-align: left">Login Path:</th>
            <td><a target="_blank" href="{{$details['login_url']}}">{{$details['login_url']}}</a></td>
        </tr>
        <tr>
            <th style="text-align: left">Username:</th>
            <td>{{$details['email']}}</td>
        </tr>
        <tr>
            <th style="text-align: left">Password:</th>
            <td>{{$details['password']}}</td>
        </tr>
        </tbody>
    </table>
    @if($details['config']['android_path'] != '' && $details['config']['android_path'] != null)
        <p>
            Please click <a href="{{ $details['config']['android_path'] }}">here</a> to download the Lite APP for <b>Android</b>:
        </p>
        <table>
            <tr>
                <th style="text-align: left">Login path for Android App:</th>
                <td><a target="_blank" href="{{ $details['config']['android_path'] }}">{{ $details['config']['android_path'] }}</a></td>
            </tr>
            <tr>
                <th style="text-align: left">Username:</th>
                <td>{{$details['email']}}</td>
            </tr>
            <tr>
                <th style="text-align: left">Password:</th>
                <td>{{$details['password']}}</td>
            </tr>
            </tbody>
        </table>
    @endif
    @if($details['config']['ios_path'] != '' && $details['config']['ios_path'] != null)
        <p>
            Please click <a href="{{ $details['config']['ios_path'] }}">here</a> to download the Lite APP for <b>IOS</b>:
        </p>
        <table>
            <tr>
                <th style="text-align: left">Login path for IOS App:</th>
                <td><a target="_blank" href="{{ $details['config']['ios_path'] }}">{{ $details['config']['ios_path'] }}</a></td>
            </tr>
            <tr>
                <th style="text-align: left">Username:</th>
                <td>{{$details['email']}}</td>
            </tr>
            <tr>
                <th style="text-align: left">Password:</th>
                <td>{{$details['password']}}</td>
            </tr>
            </tbody>
        </table>
    @endif
    <p>
        You can upload Pre-, During- and Post-Works Surveys and photographs via the dashboard.
    </p>
    <p>
        If you have any inquiries, please feel free to contact us.
    </p>
    <p>
        Many thanks
    </p>
    <p><b>The </b>{{$details['config']['name'] ?? ''}} team</p>
    <p><b>Phone: </b>{{$details['config']['phone'] ?? ''}}</p>
    <p><b>Email: </b>{{$details['config']['email'] ?? ''}}</p>
    @if($details['config']['website'] != '' && $details['config']['website'] != null)
     <p><b>Website: </b>{{$details['config']['website']}}</p>
     @endif
     <br>
    @if($details['config']['instagram_link'] != '' && $details['config']['instagram_link'] != null && $details['config']['tiktok_link'] != '' && $details['config']['tiktok_link'] != null && $details['config']['facebook_link'] != '' && $details['config']['facebook_link'] != null && $details['config']['youtube_link'] != '' && $details['config']['youtube_link'] != null && $details['config']['x_link'] != '' && $details['config']['x_link'] != null && $details['config']['linkedin_link'] != '' && $details['config']['linkedin_link'] != null)
    <p>
       <b>Social media:</b>
    </p>
    <p>
        @if($details['config']['instagram_link'] != '' && $details['config']['instagram_link'] != null)  Instagram: {{$details['config']['instagram_link']}} <br> @endif
        @if($details['config']['tiktok_link'] != '' && $details['config']['tiktok_link'] != null)  TikTok: {{$details['config']['tiktok_link']}} <br> @endif
        @if($details['config']['facebook_link'] != '' && $details['config']['facebook_link'] != null)  Facebook: {{$details['config']['facebook_link']}} <br> @endif
        @if($details['config']['youtube_link'] != '' && $details['config']['youtube_link'] != null)  YouTube: {{$details['config']['youtube_link']}} <br> @endif
        @if($details['config']['x_link'] != '' && $details['config']['x_link'] != null)  X (Twitter): {{$details['config']['x_link']}} <br> @endif
        @if($details['config']['linkedin_link'] != '' && $details['config']['linkedin_link'] != null)  LinkedIn: {{$details['config']['linkedin_link']}} @endif
    </p>
    @endif
    @if($details['config']['company_logo'] != '' && $details['config']['company_logo'] != null)
        <img style="margin-top: 55px;" src="{{ asset('assets/images/company_logo/'.$details['config']['company_logo']) }}" width="158" height="90">
    @endif
</div>
</body>
</html>
