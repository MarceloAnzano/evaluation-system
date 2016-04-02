<div class="nav-wrapper subNav">
	<span class="brand-logo" style="text-transform: none !important;">Evaluation Results</span>
</div>
<main>
	<div class="container">
		<div class="row">
			<div class="col s12 m10 l10 offset-l1 offset-m1">
				<div class="card">
					<div class="card-content" style="width: 90%; margin:auto; margin-top: 20px;">
						<div class="row" style="margin-top:20px; margin-bottom: 20px;">
							<div class="col l2 m2 s2">				
								<select name='viewRatingYear'>
									<?php for ($i = 15; $i < 25; $i++) echo "<option value='20".$i."20".($i+1)."'>20$i-20".($i+1)."</option>"; ?>
								</select>
							</div>
							<div class="col l2 m2 s2">
								<select name='viewRatingSemester'>
									<option value=1>1st Semester</option>
									<option value=2>2nd Semester</option>
								</select>
							</div>
							<div class="col l4 m4 s4">
								<button class="waves-effect waves-light btn col l12 m12 s12" id='view-ratings' type='submit' onclick='return updateRatings();'>View Final Ratings</button>
							</div>
							<?php 
								if ($this->logged_as_principal('principal'))
								{
									echo "<div class='col l4 m4 s4'>";
									echo "<button class='waves-effect waves-light btn col l12 m12 s12' id='view-ratings' type='submit' onclick='return viewAllScores();'>Evaluation Scores</button>";
									echo "</div>";
								}
							?>
<!-- 							<div class="fixed-action-btn horizontal" style="top: 200px; right: 24px;">
								<button class="btn-floating btn-large red waves-effect waves-light" id='view-ratings' type='submit' onclick='return printReport();'>
									<i class="large material-icons">print</i>
								</button>
							</div> -->
						</div>
						<div class="row">
							<table class="striped" id='ratings-table'>
<!--
								<thead>
									<tr>
										<th>Final Ratings</th>
									</tr>
									<tr>
										<th>Teacher</th>
										<th>Rating</th>
									</tr>
								</thead>
-->
							</table>
						</div>
						<div class="row">
							<h6 class="error-message" id='status'></h6>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>			
</main>
<style type="text/css" media="screen">
	table td{
		padding-top:10px !important;
		padding-bottom: 10px !important;
	}
</style>