	// change input enables according to type of user selected
	$("#createUserForm select[name=createUsertype]").on('change', function(evt){
		var selected = $("#createUserForm select[name=createUsertype]").val();
		if (selected === 'student')
		{
			$("#createUserForm input[name=createUserSection]").removeAttr('disabled');
			$("#createUserForm input[name=createUserGradelevel]").removeAttr('disabled');
			$("#createUserForm input[name=createUserLevel]").attr('disabled', 'disabled');
			$("#createUserForm input[name=createUserCluster]").attr('disabled', 'disabled');
			$("#createUserForm input[name=createUserSubject]").attr('disabled', 'disabled');
			$("#createUserForm select[name=createPosition]").attr('disabled', 'disabled');
			$("#supervisor-position-div input").attr('disabled','disabled');
			$("#supervisor-position-div span").attr('readonly','true');
			$("#supervisor-position-div span").addClass('disabled');
		}
		else 
		{
			if (selected === 'faculty')
			{
				$("#createUserForm input[name=createUserLevel]").removeAttr('disabled');
				$("#createUserForm input[name=createUserCluster]").removeAttr('disabled');
				$("#createUserForm input[name=createUserSubject]").removeAttr('disabled');
				$("#createUserForm select[name=createPosition]").removeAttr('disabled');
				$("#supervisor-position-div select").material_select();
			}
			else
			{
				$("#createUserForm input[name=createUserLevel]").attr('disabled', 'disabled');
				$("#createUserForm input[name=createUserCluster]").attr('disabled', 'disabled');
				$("#createUserForm input[name=createUserSubject]").attr('disabled', 'disabled');
				$("#createUserForm select[name=createPosition]").attr('disabled', 'disabled');
				$("#supervisor-position-div input").attr('disabled','disabled');
				$("#supervisor-position-div span").attr('readonly','true');
				$("#supervisor-position-div span").addClass('disabled');
			}
			$("#createUserForm input[name=createUserSection]").attr('disabled', 'disabled');
			$("#createUserForm input[name=createUserGradelevel]").attr('disabled', 'disabled');
		}
	});

	// because students are default
	$(document).ready(function (){
		if ($("#createUserForm select[name=createUsertype]").val() === 'student')
		{
			$("#createUserForm input[name=createUserSection]").removeAttr('disabled');
			$("#createUserForm input[name=createUserGradelevel]").removeAttr('disabled');
		}
	});

	// creates a new user in the db
	function saveUser()
	{
		var logid = $("#createUserForm input[name=createLogid]").val();
		var uname = $("#createUserForm input[name=createUname]").val();
		var password = $("#createUserForm input[name=createPassword]").val();
		var usertype = $("#createUserForm select[name=createUsertype]").val();
		var sat = $("#createUserForm input[name=createUserSubject]").val();
		var gradelevel = $("#createUserForm input[name=createUserGradelevel]").val();
		var section = $("#createUserForm input[name=createUserSection]").val();
		var position = $("#createUserForm select[name=createPosition]").val();
		var level = $("#createUserForm input[name=createUserLevel]").val();
		var cluster = $("#createUserForm input[name=createUserCluster]").val();
				
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
					$("#createUserStatus").html('User Saved');
				} 
				else $("#createUserStatus").html(result);
			}
		});
		return false;
	}
	
	function saveSection()
	{
		var link = '/admin/save_section';
		
		$.post(link,$("#createSectionForm").serialize() ,function(result){
			$("#createSectionStatus").html(result);
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
		if ( !! document.getElementById('createSectionForm'))
		{
			var link = "/admin/get_faculty";
			
			$.get(link,{},function(response){
				$('.load-select').material_select('destroy');
				response.faculty.forEach(function(teacher){
					$('select[name^='+ 'createAssignTeachers').append($('<option>', { 
						value: teacher.id,
						text : teacher.name + ' - ' + teacher.subject 
					}));
				});
				$('.load-select').material_select();
			});
		}
	}
	
	displayTeacherIdForPhotos();
	function displayTeacherIdForPhotos() {
		if ( !! document.getElementById('facultyPhotoForm'))
		{
			var link = "/admin/get_faculty";
			
			$.get(link,{},function(response){
				$('select[name=userPhotoId]').material_select('destroy');
				response.faculty.forEach(function(teacher){
					
					$('select[name=userPhotoId]').append($('<option>', { 
						value: teacher.id,
						text : teacher.name 
					}));
				});
				$('select[name=userPhotoId]').material_select();
			});
		}
	}
	
	function searchUser()
	{
		// remove previous search results
		$('#linkSpace').find('tr').remove();
		var searchType = '';
		var searchString = $("#searchUserForm input[name=searchString]").val();
		var $input = $('#searchUserForm').find(':input[type=radio]');
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
					$('#linkSpace thead').append("<tr><th>Name</th><th>Grade Level</th><th>Section</th></tr>");
				}
				else if (response.type === 'faculty')
				{
					$('#linkSpace thead').append("<tr><th>Name</th><th>Subject</th><th>Level</th><th>Cluster</th><th>Position</th></tr>");
				}
				else $('#linksSace thead').append("<tr><th>Name</th></tr>");
				
				response.results.forEach(function(user)
				{
					if (response.type === 'student')
					{
						$('#linkSpace tbody').append("<tr><td><a href='/admin/manage/" + user.id + "'>" + user.name + "</a></td>\
						<td>" + user.gradelevel + "</td><td>" + user.section + "</td><td><a href='/admin/delete_user/" + user.id + "'\
						onclick='return deleteUser(this.href);'>Delete User</a></td>/tr>");
					}
					else if (response.type === 'faculty')
					{	
						$('#linkSpace tbody').append("<tr><td><a href='/admin/manage/" + user.id + "'>" + user.name + "</a></td>\
						<td>" + user.subject + "</td><td>" + user.level + "</td><td>" + user.cluster + "</td><td>"
						 + user.supervisor + "</td><td><a href='/admin/delete_user/" + user.id + "' onclick='return deleteUser(this.href);'>Delete User</a></td>/tr>");
					}
					else $('#linkSpace tbody').append("<tr><td><a href='/admin/manage/" + user.id + "'>" + user.name + "</a></td><td><a href='/admin/delete_user/" 
						+ user.id + "' onclick='return deleteUser(this.href, this);'>Delete User</a></td>/tr>");
				});
				if(response.results.length == 0){
					console.log('Hello');
			    	$('#linkSpace>tbody').append('<tr><td>None</td></tr>');
			    	$('#linkSpace>thead>tr').remove();
			    }
			}

		});		
		return false;
	}
	
	function deleteUser(link, ev)
	{
		$.get(link,{},function(result){
			ev.innerHTML = result;
			ev.removeAttribute('href');
			ev.removeAttribute('onclick');
		});
		$('#modal1').openModal();
		searchUser();
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
		// post resquest
		$.post( "/admin/edit_percentages", $("#percentageTable").serialize() )
			.done(function( result ) {
				if (result === 'correct')
				{
					location.reload();
				}
				else $('#percentageTableStatus').html(result);
		});
		return false;
	}
