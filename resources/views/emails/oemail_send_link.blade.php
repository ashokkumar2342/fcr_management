<!DOCTYPE html>
<html>
<head>
	<title>Otp Verification</title>
	 

<style type="text/css">
body{
	padding:20px;
}
	p{
		font-size: 11px;
	}
	li{
		font-size: 11px;
	}
	ul {
    	padding-left:15px;margin-top:-10px; 
	}
	#logo{ 
		padding-bottom: 40px;
	}

	#main-div{
		/*border: solid 1px #000;*/
		padding:20px;
		background-color: rgb(240,240,240);
		font-family: Tahoma;

	}

</style>
</head>
<body> 
<div id="main-div">
	<div id="logo"> 
	
</div>
	<br>
	<p>Dear User,</p>
	<p><a href="{{ route('admin.forgot.password.reset',$link) }}"></a></b> is the verification code for registration on joygaon.</p>
	
</div>
		 
</body>
</html>