<!DOCTYPE html>
<html>
<head>
    <title>{{$details['title']}}</title>
</head>
<body>

<div style="width: fit-content;margin:0 auto;">
    <p>{{"Hi, ".$details['name']}},</p>
    <p>
        here is your <strong>{{$details['title']}}</strong>, click on Attachment button to view/download PDF.
    </p>
    <p>
        <a href="{{$details['file']}}" target="_blank" style="background-color:#1A47A3;color:#fff;border-radius:4px;padding:6px 9px;text-decoration:none;">Attachment</a>
    </p>
    <p>
        If you have any inquiries, please feel free to contact us.
    </p>
    <p>
        Many thanks,
    </p>
    <p>
        BCR Retrofit
    </p>

    @if($details['config']['company_logo'] != '' && $details['config']['company_logo'] != null)
        <img src="{{ asset('assets/images/company_logo/'.$details['config']['company_logo']) }}" style="width: 158px;height:90px;" width="158" height="90">
    @endif
</div>
</body>
</html>