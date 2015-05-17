<html>
<head>
	<title>Plex Server - Watched Programs</title>
	<link href="css/styles.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
	<h1>Hello World - Initial Testing - Ignore this please</h1>
	
	<input type="button" onClick="getAuthCode();" value="Get Auth Code"><br><br>
	<input type="button" onClick="doAThing();" value="Do a thing"><br><br>
	<input type="button" onClick="doSomething();" value="Start"> 
	<input type="hidden" value="" id="authcode"><br>
	<!-- <input type="button" onClick="doNextThing()" value="Do The Next Thing"> -->
	<h2>Output Here:</h2>
	<pre id="output"></pre>
	(Some output goes to the console)
</div>


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
 <script src="js/bootstrap.js"></script>
 <script src="config.js"></script>
 <script>


	function getAuthCode(){

			
			$.ajax({
				headers:{
					'Authorization' : 'Basic '+userpass, 
					'X-Plex-Client-Identifier' : 'RobsPlexWebClient-1',
					'X-Plex-Product' : 'RobsPlexWebClient',
					'X-Plex-Version' : '1'
				},
				
				type: 'post',
				url: 'https://plex.tv/users/sign_in.json',
				success: function(result){
					auth_token = result.user.authentication_token;
					$('#output').append('Auth Token: '+auth_token+'\n\n');
					$('#authcode').val(auth_token);

				},
				error : function(xhr,textStatus,errorThrown){
					$('#output').append('ERROR: '+xhr.status+' '+textStatus+' '+errorThrown+'\n');
				}
			});
	}

	function doAThing(){


			$.ajax({
				headers:{
					'Authorization' : 'Basic '+userpass, 
					'X-Plex-Client-Identifier' : 'RobsPlexWebClient-1',
					'X-Plex-Product' : 'RobsPlexWebClient',
					'X-Plex-Version' : '1'
				},
				
				type: 'get',
				url: 'https://plex.tv/api/users',
				success: function(result){
					console.log(result);
					

				}
			});
	}
	

 	function doSomething(){

 			$.ajax({
				headers:{
					'Authorization' : 'Basic '+userpass,
					'X-Plex-Client-Identifier' : 'RobsPlexWebClient-1',
					'X-Plex-Product' : 'RobsPlexWebClient',
					'X-Plex-Version' : '1',
					'X-Plex-Device-Name' : 'RobsPlexWebClient-1',
					'X-Plex-Token': $('#authcode').val(),
					'Accept' : 'application/json'
				},
 				type: 'get',
				url: 'http://192.168.0.14:32400/library/sections',
				success: function(result){
					$.each(result._children,function(count,child){
						$('#output').append(child.title+"\n");
					});
					
					
					
				},
				error : function(xhr,textStatus,errorThrown){
					$('#output').append('ERROR: '+xhr.status+' '+textStatus+' '+errorThrown+'\n');
				}
				
 			});
 	}


</script>
</html>