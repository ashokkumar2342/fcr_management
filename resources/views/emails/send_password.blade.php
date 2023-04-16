<!DOCTYPE html>
<html>
<head>
	<title>User Activation</title>
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
	
	<p>Dear {{$user_name}},</p>
	<p>Congratulations, Your Account on <a href="https://dmsjhajjar.in">dmsjhajjar.in</a> have been created.<strong></strong>.</p>
	<p>Your account details is as below: 
	</br>
	<a href="https://dmsjhajjar.in">dmsjhajjar.in</a></p>
	<p>Email: <strong>{{$email}}</strong></p>
	<p>Password: <strong>{{$password}}</strong></p>
	<p>Regards<br>DMSJhajjar.in Team</p>
	
</div>
		 
</body>
</html>