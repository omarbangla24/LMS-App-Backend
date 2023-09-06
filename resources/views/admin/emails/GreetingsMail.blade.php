<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Test Mail</title>
</head>
<body>
    <div class="center text-center" style="margin: auto;
    width: 600px;
    
    padding: 10px;">
   <img src="{{ $message->embed(public_path() . '/images/favicon.png') }}" width="20%" height="20%"
   style="display: block;margin: auto;"/>
        <h2>{{$details['title']}}</h2>
    <h2>Welcome to MASBA Elite Business Club!</h2>
    <h3>Thank you for downloading our APP.     </h3><br>
    <p><b>MASBA Elite Business Club</b> is an App-based business solution. Here we are providing more than 100+ premium videos related to entrepreneurship. 
        Upon paid subscription, entrepreneurs are going to learn about all knowhows to start a business, guidelines to grow and excel in their business, 
        opportunity to attend exclusive workshops and Q/A session for better knowledge acquiring. Our Membership details are as following:</p><br>
        
        &#10004;  03 Months Membership only @999 BDT <br>
        &#10004;  06 Months Membership only @1799 BDT <br>
        &#10004;  12 Months Membership only @2999 BDT <br>
  
        
    <br>
        
    <p>So, what are you waiting for?? Let’s explore our exclusive videos and learn!! </p>
    <p><b> Someone from our team will be with you shortly.  </b></p>
    <p> To know more about our actions please click on the icons to visit our <b>Facebook</b> page and <b>YouTube</b> Channel  .</p> <br>
        <div class="logo" style="display: block;margin-left: 45%;">
        <a href="https://www.facebook.com/masbainstitute"><img src="{{ $message->embed(public_path() . '/images/facebook.png') }}" width="40px" height="40px"
            /></a>  
        <a href="https://www.youtube.com/c/MASBAInstituteofEntrepreneurship"><img src="{{ $message->embed(public_path() . '/images/youtube.png') }}" width="40px" height="40px"
            /> </a> 
        </div> <br>
         <br>
         <p>
        For more queries, please contact at our customer care number: +088 01953311132. <br>
        </p>
        <p> <b>Thank You</b> </p>
        <br><br>
        <p>This is an automatically generated email – please do not reply to it. If you have any queries regarding your account please email masbaeliteclub@gmail.com .</p>
    </div>
    
</body>
</html>