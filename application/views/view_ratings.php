<div class="nav-wrapper subNav">
	<span class="brand-logo" style="text-transform: none !important;">Evaluation Results</span>
</div>
<main>
	<div class="container">
		<div class="row">
			<div class="col s12 m10 l10 offset-l1 offset-m1">
				<div class="card">
					<div class="card-content" style="width: 90%; margin:auto;">
						<div class="row" style="margin-top:20px; margin-bottom: 20px;">
							<div class="col l10 m10 s12 offset-l1 offset-m1">
								<button class="waves-effect waves-light btn col l12 m12 s12" id='view-ratings' type='submit' onclick='return updateRatings();'>Update Ratings</button>
							</div>
						</div>
						<div class="row">
							<table class="striped" id='ratings-table'>
								<thead>
									<tr>
										<th>Teacher</th>
										<th>Rating</th>
									</tr>
								</thead>
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