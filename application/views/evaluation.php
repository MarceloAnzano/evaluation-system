
<div class="nav-wrapper subNav">
	<div class="row">
		<div class="col s2 m2 l1">
			<div class="imgholder1x1">
				<?php echo '<img src="'.$this->get_photo($data2['info']['userid']).'">'; ?>
			</div>
		</div>
		<div class="col l9">
			<span class="brand-logo"><?php $person = $data2; echo $person['info']['name']; ?></span>
			<span class="subBrand">
				<?php 
					if($data3 == '1'){
						echo '1st ';
					}else if($data3 == '2'){
						echo '2nd ';
					}
					echo 'semester';
				?>
			</span>
		</div>
	</div>
</div>
<main>
<div class="row">
	<div class="col s8 m8 l8 push-s2 push-m2 push-l2">
		<div class="card">
			<div class="card-content">
				<form id="evalform" action='/app/post_result' method='post'>
					<table class="striped">
						<?php
							// target details
							$person = $data2;
							
							// target semester
							$semester = $data3;
							
							$title_index = 0;
							
							// example
							foreach ($data['questions'] as &$set)
							{
								$num = 0;
								$percent = 0;
								$category = "";
								$question = $data['title'][$title_index];
								echo "<thead><tr><th><h4>".ucwords(str_replace("_", " ", $data['title'][$title_index]))."</h4></th></tr></thead>";
								$title_index++;
								
								// start of table output
								foreach ($set as &$row)
								{
									if ($row[0] > 0)
									{
										if ($row[1] != $category)
										{
											if ($category != "")
											{
												echo "<input name='".$question."Num[]' type='hidden' value='".$num."'/>";
												echo "<input name='".$question."Per[]' type='hidden' value='".$count."'/>";
											}
											
											$count = $row[0];
											$category = $row[1];
											$num = 0;
											echo "<thead><tr><th>$category</th>
											<th class='rating'></th></tr></thead>";
											continue;
										}
									}
									
									$num++;
									echo "<tr><td>".$row[1]."</td>";
									echo "<td><input class='center-align' type='number' name='".$question."[]' min='0' max='4' step='0.5' value=4 required><br></td></tr>";
								}
								
								echo "<input name='".$question."Num[]' type='hidden' value='".$num."'/>";
								echo "<input name='".$question."Per[]' type='hidden' value='".$count."'/>";
							}
							
							echo "<input name='person' type='hidden' value='".$person['info']['userid']."'/>";
							echo "<input name='semester' type='hidden' value='".$semester."'/>";
						?>
					</table>
					<div class="row">
						<button  class="btn-large waves-effect waves-light right modal-trigger" data-target="modal-submit-eval">Submit</h5></button>
					</div>
					<div id="modal-submit-eval" class="modal">
						<center class="modal-content">
							<h5>Submit your answers?</h5>
							<h6>You can not edit your answers once you submit</h6>
						</center>
						<div class="modal-footer">
							<a class="modal-action modal-close waves-effect waves-teal btn-flat">NO</a>
							<a class="modal-action modal-close waves-effect waves-teal btn-flat" id="submit-eval-yes">YES</a>
						</div>
					</div>
					<!-- <button  class="btn waves-effect waves-light right" type='submit' name='submit' value='Submit'>Submit</button>-->
				</form>
				<p id="status"></p>
			</div>
		</div>
	</div>
</div>
</main>


