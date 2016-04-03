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
					$('#createSectionForm select[name^=createAssignTeachers]').append($('<option>', { 
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
				$('#facultyPhotoForm select[name=userPhotoId]').material_select('destroy');
				response.faculty.forEach(function(teacher){
					
					$('#facultyPhotoForm select[name=userPhotoId]').append($('<option>', { 
						value: teacher.id,
						text : teacher.name 
					}));
				});
				$('#facultyPhotoForm select[name=userPhotoId]').material_select();
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
				console.log(response);
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
					// if (response.type === 'student')
					// {
					// 	$('#linkSpace tbody').append("<tr><td><a href='/admin/manage/" + user.id + "'>" + user.name + "</a></td>\
					// 	<td>" + user.gradelevel + "</td><td>" + user.section + "</td><td><a class='delete-user' href='/admin/delete_user/" + user.id + "'\
					// 	onclick='return deleteUser(this.href);'>Delete User</a></td>/tr>");
					// }
					// else if (response.type === 'faculty')
					// {	
					// 	$('#linkSpace tbody').append("<tr><td><a href='/admin/manage/" + user.id + "'>" + user.name + "</a></td>\
					// 	<td>" + user.subject + "</td><td>" + user.level + "</td><td>" + user.cluster + "</td><td>"
					// 	 + user.supervisor + "</td><td><a class='delete-user' href='/admin/delete_user/" + user.id + "' onclick='return deleteUser(this.href);'>Delete User</a></td>/tr>");
					// }
					// else $('#linkSpace tbody').append("<tr><td><a href='/admin/manage/" + user.id + "'>" + user.name + "</a></td><td><a class='delete-user' href='/admin/delete_user/" 
					// 	+ user.id + "' onclick='return deleteUser(this.href, this);'>Delete User</a></td>/tr>");
					if (response.type === 'student')
					{
						$('#linkSpace tbody').append("<tr><td><a href='/admin/manage/" + user.id + "'>" + user.name + "</a></td>\
						<td>" + user.gradelevel + "</td><td>" + user.section + "</td><td><a class='delete-user1' href='/admin/delete_user/" + user.id + "'\
						>Delete User</a></td>/tr>");
					}
					else if (response.type === 'faculty')
					{	
						$('#linkSpace tbody').append("<tr><td><a href='/admin/manage/" + user.id + "'>" + user.name + "</a></td>\
						<td>" + user.subject + "</td><td>" + user.level + "</td><td>" + user.cluster + "</td><td>"
						 + user.supervisor + "</td><td><a class='delete-user1' href='/admin/delete_user/" + user.id + "'>Delete User</a></td>/tr>");
					}
					else $('#linkSpace tbody').append("<tr><td><a href='/admin/manage/" + user.id + "'>" + user.name + "</a></td><td><a class='delete-user2' href='/admin/delete_user/" 
						+ user.id + "'>Delete User</a></td>/tr>");
				});
				if(response.results.length == 0){
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
		$('#modal-delete-success').openModal();
		searchUser();
		return false;
	}

	displayUserInfo();
	function displayUserInfo() {
		if ( !! document.getElementById('editUserProtectedInfo'))
		{
			var link = "/admin/dump_user_info/"+ $("#manageUserForm [name=editTargetId]").val();
						
			$.get(link,{},function(response){
				$('#editUserProtectedInfo').append("<li>User Login ID: " + response.info.logid + "</a></li>");

				$("#manageUserForm [name=editUsertype]").val(response.info.type);
				$("#manageUserForm [name=editUname]").val(response.info.name);
				
				if (response.info.gradelevel !== '' && response.info.section !== '')
				{
					$('#manageUserForm [name=editUserGradelevel]').val(response.info.gradelevel);
					$('#manageUserForm [name=editUserSection]').val(response.info.section);
				}
				
				if (response.info.subject !== '' && response.info.cluster !== '' && response.info.level !== '' )
				{
					$('#manageUserForm [name=editUserUserSubject]').val(response.info.subject);
					$('#manageUserForm [name=editUserCluster]').val(response.info.cluster);
					$('#manageUserForm [name=editUserLevel]').val(response.info.level);
				}
				
				if (response.info.position !== '')
				{
					$('#manageUserForm [name=editPosition]').val(response.info.position);
				}
			});
		}
	}
	
	function editUser()
	{
		var uname = $('#manageUserForm [name=editUname]').val();
		var password = $('#manageUserForm [name=editPassword]').val();
		var usertype = $('#manageUserForm [name=editUsertype]').val();
		var sat = $('#manageUserForm [name=editUserUserSubject]').val();
		var gradelevel = $('#manageUserForm [name=editUserGradelevel]').val();
		var section = $('#manageUserForm [name=editUserSection]').val();
		var position = $('#manageUserForm [name=editPosition]').val();
		var level = $('#manageUserForm [name=editUserLevel]').val();
		var cluster = $('#manageUserForm [name=editUserCluster]').val();
		var targetid = $('#manageUserForm [name=editTargetId]').val();
				
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
	
	displaySections();
	function displaySections()
	{
		if ( !! document.getElementById('createSectionForm'))
		{
			var link = "/admin/get_sections";
			
			$.get(link,{},function(response){
				if (response.sections != null)
				{
					response.sections.forEach(function(section){
						$('#createSectionSelect').append($('<option>', { 
						//$('#createSectionForm select[name=createSectionSelect]').append($('<option>', { 
							value: section.concatenated,
							text : section.concatenated
						}));
						$('#createSectionSelect').material_select('destroy');
						$("#createSectionSelect").material_select();
					});
					sectionContainer = response;
				}
			});
		}
		

	}
	
	var sectionContainer;
	$("#createSectionForm select[name=createSectionSelect]").on('change', function(evt){
		if (sectionContainer.status == 'OK')
		{
			if (sectionContainer.sections != null)
			{
				var selected = $("#createSectionForm select[name=createSectionSelect]").val();
				if (selected == '')
				{
					$('#createSectionForm input[name=createSectionGradelevel]').val("");
					$('#createSectionForm input[name=createSectionSection]').val("");
					$('#createSectionForm input[name=createSectionGradelevel]').removeAttr('disabled');
					$('#createSectionForm input[name=createSectionSection]').removeAttr('disabled');
					$('#createSectionForm input[name^=createSubjects]').each(function(){
						$(this).val("");
					});
				}
				else
				{
					var dataString = '';
					sectionContainer.sections.forEach(function(section){
						if (selected == section.concatenated)
						{
							$('#createSectionForm input[name=createSectionGradelevel]').val(section.gradelevel);
							$('#createSectionForm input[name=createSectionSection]').val(section.section);
							$('#createSectionForm input[name=createSectionGradelevel]').attr('disabled', 'disabled');
							$('#createSectionForm input[name=createSectionSection]').attr('disabled','disabled');
							
							var count = 0;
							var limit = Object.keys(section.subjects).length;
							$('#createSectionForm input[name^=createSubjects]').each(function(){
								if (count < limit)
								{
									$(this).val(section.subjects[count].subj);
									count++;
								}
							});
							
							count = 0;
							$('#createSectionForm select[name^=createAssignTeachers]').each(function(){
								if (count < limit)
								{
									// supposed to work on normal selects
									var index = $(this).find('option[value='+section.subjects[count].id+']').index();
									var teacher = $(this).children().eq(index).val();
									$(this).val(teacher);
									count++;
								}
							});
						}
					});		
								
					
				}
			}
		}
	});
	
	function viewAllScores()
	{
		if ( !! document.getElementById('ratings-table'))
		{
			$('.progress').css('display','block');
			$('#ratings-table').css('display','none');
			$(".error-ratings").empty();
			$('#ratings-table thead').empty();
			$('#ratings-table tbody tr').addClass('delete-this-row');
			$('.table-title-here').empty();
			var year = $("select[name=viewRatingYear]").val();
			var semester = $("select[name=viewRatingSemester]").val();
			var link = "/app/display_quest_scores/" + year + "/" + semester;
			if(semester == "2") semstr = "2nd";
			else if(semester == "1") semstr = "1st";
			else semstr ="";
			$.get(link,{},function(response){
				if (response.status == 'OK' && Object.keys(response.scores).length > 0)
				{
					$('.table-title-here').append(
						"<div class='col s8 m8 l8'>\
							<div class='row'><h4 style='margin-bottom:0px;' class='rating-title'>Questionnaire Scores</h4></div>\
							<div class='row'><h6 style='margin-top:0px;'>SY "+year.substring(0,4)+"-"+year.substring(4,8)+" "+semstr+" Semester</h6></div>\
						</div>\
						<div class='col s4 m4 l4 print-holder'>\
							<button class='waves-effect waves-light btn' id='exportThisScores'>Download as csv</button>\
						</div>"
					);			
					$("#ratings-table thead").append(
						"<tr>\
							<th>Evaluator</th>\
							<th>Faculty Evaluated</th>\
							<th>TC Score</th>\
							<th>EA Score</th>\
							<th>AP Score</th>\
							<th>Student Score</th>\
							<th>Evaluation Type</th>\
						</tr>"
					);
					if (response.scores != null )
					{
						response.scores.forEach(function(item){
							$("#ratings-table tbody").append("<tr><td>" + item.evaluator + "</td><td>" + item.evaluated + "</td><td>" 
								+ item.tc + "</td><td>" + item.ea + "</td><td>" + item.ap + "</td><td>" + item.stud + "</td><td>" + item.type + "</td></tr>");
						});
					}
					// else $("#ratings-table tbody").append("<tr><td>Data Not Available</td></tr>");
					$("#ratings-table").tablesorter({sortList: [[0,0]]});
					$('.delete-this-row').remove();
					$("#ratings-table").trigger("update");
					$('.progress').css('display','none');
					$('#ratings-table').css('display','table');
				}else{
					$('.table-title-here').append(
					"<div class='col s8 m8 l8'>\
						<div class='row'><h4 style='margin-bottom:0px;' class='rating-title'>Questionnaire Scores</h4></div>\
						<div class='row'><h6 style='margin-top:0px;'>SY "+year.substring(0,4)+"-"+year.substring(4,8)+" "+semstr+" Semester</h6></div>\
					</div>");
					$(".error-ratings").html("Data not available");
					$('.progress').css('display','none');
				}
			});
		}
		
	}
