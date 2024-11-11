<!DOCTYPE html>
<html>
<head>
    <title>{{$details['title']}}</title>
</head>
<body>

<div style="width: fit-content;margin:0 auto;">
    <p>{{"Hi, ".$details['name']}},</p>
    <p>
        {{$details['body']}}.
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

    @if($details['config']->company_logo != '' && $details['config']->company_logo != null)
        <img src="{{ env('ADMIN_URL').'/public/assets/images/company_logo/'.$details['config']->company_logo }}" style="width: 158px;height:90px;" width="158" height="90">
    @endif
</div>
</body>
</html>