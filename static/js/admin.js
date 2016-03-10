	// change input enables according to type of user selected
	$('select#usertype').on('change', function(evt){
		var selected = $("#usertype").val();
		console.log(selected);
		if (selected === 'student')
		{
			$('#section').removeAttr('readonly');
			$('#gradelevel').removeAttr('readonly');
			$('#level').attr('readonly', 'readonly');
			$('#cluster').attr('readonly', 'readonly');
			$('#sat').attr('readonly', 'readonly');
			$('#position').attr('disabled', 'disabled');
		}
		else 
		{
			if (selected === 'faculty')
			{
				$('#level').removeAttr('readonly');
				$('#cluster').removeAttr('readonly');
				$('#sat').removeAttr('readonly');
				$('#position').removeAttr('disabled');
			}
			else
			{
				$('#level').attr('readonly', 'readonly');
				$('#cluster').attr('readonly', 'readonly');
				$('#sat').attr('readonly', 'readonly');
				$('#position').attr('disabled', 'disabled');
			}
			$('#section').attr('readonly', 'readonly');
			$('#gradelevel').attr('readonly', 'readonly');
		}
	});

	// because students are default
	$(document).ready(function (){
		if ($("#usertype").val() === 'student')
		{
			$('#section').removeAttr('readonly');
			$('#gradelevel').removeAttr('readonly');
		}
	});

	// creates a new user in the db
	function saveUser()
	{
		var logid = $('#adminlogid').val();
		var uname = $('#uname').val();
		var password = $('#adminpassword').val();
		var usertype = $('#usertype').val();
		var sat = $('#sat').val();
		var gradelevel = $('#gradelevel').val();
		var section = $('#section').val();
		var position = $('#position').val();
		var level = $('#level').val();
		var cluster = $('#cluster').val();
				
		var dataString = 'uname='+ uname + '&logid='+ logid + '&password='+ password
			+ '&usertype=' + usertype + '&sat=' + sat + '&gradelevel=' + gradelevel + '&section=' + section + '&position=' + position
			+ '&level=' + level + '&cluster=' + cluster;
			
		$.ajax({
			type: "POST",
			url: "/admin/save_user",
			data: dataString,
			cache: false,
			success: function(result)
			{
				var result=trim(result);
				if(result=='correct')
				{
					window.location='/admin/create_users';
				} 
				else $("#status").html(result);
			}
		});
		return false;
	}
	
	// don't know if this is essential; too lazy to debug
	function trim(str)
	{
		var str=str.replace(/^\s+|\s+$/,'');
		return str;
	}
	
	// loads teachers for section tagging
	displaySubjectTeachers();
	function displaySubjectTeachers() {
		if ( !! document.getElementById('section-form'))
		{
			var link = "/admin/get_faculty";
			
			$.get(link,{},function(response){
				response.faculty.forEach(function(teacher){
					$('select[id^='+ 'teachers').append($('<option>', { 
						value: teacher.id,
						text : teacher.name + ' - ' + teacher.subject 
					}));
				});
				
			});
		}
	}
	
	displayTeacherIdForPhotos();
	function displayTeacherIdForPhotos() {
		if ( !! document.getElementById('user-photo'))
		{
			var link = "/admin/get_faculty";
			
			$.get(link,{},function(response){
				response.faculty.forEach(function(teacher){
					
					$('select[id=user-photo]').append($('<option>', { 
						value: teacher.id,
						text : teacher.name 
					}));
				});
				
			});
		}
	}
	
	function searchUser()
	{
		// remove previous search results
		$('#linkspace').find('tr').remove();
		var searchType = '';
		var searchString = $('#searchstring').val();
		var $input = $('form').find(':input[type=radio]');
		for (var a = 0; a < $input.length; a++) 
		{
			if ($input[a].checked) 
			{
				searchType = $input[a].value;
				break;
			}
		}
		
		var dataString = 'search=' + searchString + "&modifier=" + searchType;
		$.ajax({
			type: "POST",
			url: "/admin/search_for",
			data: dataString,
			cache: false,
			success: function(response)
			{
				if (response.type === 'student')
				{
					$('#linkspace').append("<tr><th>Name</th><th>Grade Level</th><th>Section</th></tr>");
				}
				else if (response.type === 'faculty')
				{
					$('#linkspace').append("<tr><th>Name</th><th>Subject</th><th>Level</th><th>Cluster</th><th>Position</th></tr>");
				}
				else $('#linkspace').append("<tr><th>Name</th></tr>");
				
				response.results.forEach(function(user)
				{
					if (response.type === 'student')
					{
						$('#linkspace').append("<tr><td><a href='/admin/manage/" + user.id + "'>" + user.name + "</a></td>\
						<td>" + user.gradelevel + "</td><td>" + user.section + "</td><td><a href='/admin/delete_user/" + user.id + "'>Delete User</a></td>/tr>");
					}
					else if (response.type === 'faculty')
					{	
						$('#linkspace').append("<tr><td><a href='/admin/manage/" + user.id + "'>" + user.name + "</a></td>\
						<td>" + user.subject + "</td><td>" + user.level + "</td><td>" + user.cluster + "</td><td>"
						 + user.supervisor + "</td><td><a href='/admin/delete_user/" + user.id + "'>Delete User</a></td>/tr>");
					}
					else $('#linkspace').append("<tr><td><a href='/admin/manage/" + user.id + "'>" + user.name + "</a></td><td><a href='/admin/delete_user/" 
						+ user.id + "'>Delete User</a></td>/tr>");
				});
			}
		});
		return false;
	}

	displayUserInfo();
	function displayUserInfo() {
		if ( !! document.getElementById('protectedInfo'))
		{
			var link = "/admin/dump_user_info/"+ $("#targetid").val();
						
			$.get(link,{},function(response){
				$('#protectedInfo').append("<li>User Login ID: " + response.info.logid + "</a></li>");

				$("#usertype").val(response.info.type);
				$("#uname").val(response.info.name);
				
				if (response.info.gradelevel !== '' && response.info.section !== '')
				{
					$('#gradelevel').val(response.info.gradelevel);
					$('#section').val(response.info.section);
				}
				
				if (response.info.subject !== '' && response.info.cluster !== '' && response.info.level !== '' )
				{
					$('#sat').val(response.info.subject);
					$('#cluster').val(response.info.cluster);
					$('#level').val(response.info.level);
				}
				
				if (response.info.position !== '')
				{
					$('#protectedInfo').val(response.info.position);
				}
			});
		}
	}
	
	function editUser()
	{
		var uname = $('#uname').val();
		var password = $('#adminpassword').val();
		var usertype = $('#usertype').val();
		var sat = $('#sat').val();
		var gradelevel = $('#gradelevel').val();
		var section = $('#section').val();
		var position = $('#position').val();
		var level = $('#level').val();
		var cluster = $('#cluster').val();
		var targetid = $('#targetid').val();
				
		var dataString = 'uname='+ uname + '&targetid='+ targetid + '&password='+ password
			+ '&usertype=' + usertype + '&sat=' + sat + '&gradelevel=' + gradelevel + '&section=' + section + '&position=' + position
			+ '&level=' + level + '&cluster=' + cluster;
		console.log(dataString);
		$.ajax({
			type: "POST",
			url: "/admin/edit_user",
			data: dataString,
			cache: false,
			success: function(result)
			{
				var result=trim(result);
				if(result=='correct')
				{
					location.reload();
				}
				else $("#status").html(result);
			}
		});
		return false;
	}
	
	// NOT DONE YET
	displaySubjects();
	function displaySubjects()
	{
		if ( !! document.getElementById('sectiontable'))
		{
			var link = "/admin/get_section_subjects";
			
			$.get(link,{},function(response){
				response.faculty.forEach(function(teacher){
					$('select[id^='+ 'teachers').append($('<option>', { 
						value: teacher.id,
						text : teacher.name + ' - ' + teacher.subject 
					}));
				});
				
			});
			
		}
		
	}
	
	function editPercentages()
	{
		console.log('okay');
		// post resquest
		$.post( "/admin/edit_percentages", $("#percentageTable").serialize() )
			.done(function( result ) {
				if (result === 'correct')
				{
					location.reload();
				}
				else $('#status').html(result);
		});
		return false;
	}
