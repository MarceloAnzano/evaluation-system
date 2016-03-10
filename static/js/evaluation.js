	// not to be confused with the actual survey js
	// this concers administrator tasks only
	
	function createEvaluations()
	{
		// create evaluations
		$.post( "/admin/create_evaluation", $("#semestral-create").serialize() )
			.done(function( result ) {
				var result=trim(result);
				$("#status").html(result);
		});
		evaluationStatus();
		return false;
	}

	function openEvaluation(link)
	{
		var ref = "/admin/open/";
		$.post(ref + link, {} )
			.done(function( result ) {
				var result=trim(result);
				if (link === 1)
					$("#faculty-1st-status").html(result);
				else if (link === 2)
					$("#faculty-2nd-status").html(result);
				else if (link === 3)
					$("#student-status").html(result);
		});
		evaluationStatus();
		return false;
	}
	
	evaluationStatus();
	function evaluationStatus() {
		var link = "/admin/evaluation_status";
		
		$.get(link,{},function(response){
			$("#faculty-1st-status").html(response[0]);
			$("#faculty-2nd-status").html(response[1]);
			$("#student-status").html(response[2]);
		});
	}
	
	// take all the records and put Student Status: open them into the archives
	function archiveEvaluation()
	{
		var ref = "/admin/archive_results";
		$.post(ref, {});
		evaluationStatus();
		return false;
	}
	
	function deleteEvaluation(link)
	{
		var ref = "/admin/delete_evaluation/";
		$.post(ref + link, {});
		evaluationStatus();
		return false;
	}
