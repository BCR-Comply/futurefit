<!DOCTYPE html>
<html>
<head>
    <title>{{$details['title']}}</title>
</head>
<body>

<div>
    <p>Hi {{$details['client_name']}}, you have been added to the Complete Insulation dashboard as a <b>Contractor</b>. Your login details are below:</p>
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
    <p>
        Within the portal, you will find all works assigned to you, accompanied by relevant documentation. Additionally, you will be able to upload supporting documentation for the completed tasks.
    </p>
    <p>
        Please click here to download the Lite APP for <b>Android</b> or here for <b>iOS</b>:
    </p>
    <table>
        <tr>
            <th style="text-align: left">Login Path for Android App: </th>
            <td><a target="_blank" href="https://bcrcomply.com/apps/Complete_lite_19122023_1412.apk">https://bcrcomply.com/apps/Complete_lite_19122023_1412.apk</a></td>
        </tr>
        <tr>
            <th style="text-align: left">Login Path for IOS App:</th>
            <td><a target="_blank" href="https://apps.apple.com/us/app/complete-insulation-lite/id1567544678">https://apps.apple.com/us/app/complete-insulation-lite/id1567544678</a></td>
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
    <p>
        The App will enable you to see all works assigned to you.  You can also upload Pre-, During- and Post-Works Surveys and take photographs using the APP.
    </p>
    <p>
        If you have any inquiries, please feel free to contact us.
    </p>
    <p>
        Many thanks
    </p>
    <p>The <b>{{$details['config']['name'] ?? ''}} team</b></p>
    <p><b>Phone: </b>{{$details['config']['phone'] ?? ''}}</p>
    <p><b>Email: </b>{{$details['config']['email'] ?? ''}}</p>
    @if($details['config']['webiste'] != '' && $details['config']['webiste'] != null)
     <p><b>Website: </b>{{$details['config']['webiste'] ?? ''}}</p> 
     @endif
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
    <img style="margin-top: 70px;" src="{{ asset('assets/images/email-company-logo.png') }}" width="158" height="90">
</div>
</body>
</html>