<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Password Reset - MASBA Business App</title>
</head>
<body>
    <div class="center" style="margin: auto;width: 50%; padding: 10px;">
        {{-- <img src="{{ $message->embed(public_path() . '/images/favicon.png') }}" width="20%" height="20%"
   style="display: block;margin: auto;"/> --}}
   <hr>
   <h3> Hello <b>{{$resetPassword['user']}} ,</b>To authenticate , please use the following One Time Password(OTP):</h3><br>
   <h2>{{$resetPassword['otp']}}</h2> <br>
   <p>This OTP is Valid for 6 min,If you require any assistance,please contact our 24 hr Customer
       Service Hotline at +088 01953311132 or You can email us at masba.app@gmail.com <br>.
       <br>Thank you for using MASBA Business App</p>
    <p  class="text-center" style="color: #DEDEDE">Please do not reply to this email as it is auto-generated</p>
    </div>

</body>
</html>
