	// removes ajax message after textbox focus
	function emptyElement()
	{
		$('#status').html("");
	}
	
	// registers user password on first login
	function validRegister()	
	{
		// get user input
		var logid = $('#logid').val();
		var currpass = $('#currpass').val();
		var password = $('#password').val();
		var repassword = $('#repass').val();
		
		var dataString = 'logid='+ logid + '&currpass=' + currpass +'&password='+ password + '&repass=' + repassword;
		
		// post request
		$.ajax({
			type: "POST",
			url: "/app/regpass",
			data: dataString,
			cache: false,
			success: function(result)
			{
				var result=trim(result);
				
				if(result=='correct')
				{
					window.location='/';
				}
				else $("#status").html(result);
			}
		});
		// clear the textboxes
		$('#currpass').val("");
		$('#password').val("");
		$('#repass').val("");
		
		return false;
	}
	
	function validLogin()
	{
		// get credentials
		var logid = $('#logid').val();
		var password = $('#password').val();
		
		var dataString = 'logid='+ logid + '&password='+ password;
		
		// post request
		$.ajax({
			type: "POST",
			url: "/app/auth",
			data: dataString,
			cache: false,
			success: function(result)
			{
				var result=trim(result);
				if(result=='correct')
				{
					window.location='/';
				} 
				else $("#status").html(result);
			}
		});
		// clear textbox
		$('#password').val("");

		return false;
	}

	function validChange()
	{
		// get user input
		var currpass = $('#currpass').val();
		var password = $('#password').val();
		var repassword = $('#repass').val();
		
		var dataString = 'currpass=' + currpass +'&password='+ password + '&repass=' + repassword;
		
		// post request
		$.ajax({
			type: "POST",
			url: "/app/change_pass",
			data: dataString,
			cache: false,
			success: function(result)
			{
				var result=trim(result);
				
				if(result=='correct')
				{
					window.location='/';
				}
				else $("#status").html(result);
			}
		});
		// clear the textboxes
		$('#currpass').val("");
		$('#password').val("");
		$('#repass').val("");
		
		return false;
	}
	
	function trim(str)
	{
		var str=str.replace(/^\s+|\s+$/,'');
		return str;
	}
	
	function updateRatings()
	{
		var link = "/app/calculate_ratings";
		
		$.get(link,{},function(){});
		location.reload();
		//~ displayRatings();
	}
	
	displayRatings();
	function displayRatings()
	{
		if ( !! document.getElementById('ratings-table'))
		{
			var link = "/app/display_ratings";
			
			$.get(link,{},function(response){
				response.results.forEach(function(teacher){
					$("#ratings-table").append("<tr><td>" + teacher.name + "</td><td>" + teacher.rating+ "</td></tr>");
				});			
			});
		}
	}
