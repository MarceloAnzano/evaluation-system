	<div class="nav-wrapper subNav">
		<div class="row">
			<div class="col s2 m2 l1">
				<div class="imgholder1x1">
					<?php echo '<img src="'.$this->get_photo($data2).'">'; ?>
				</div>
			</div>
			<div class="col l9">
				<span class="brand-logo"><?php $scores = $data; echo $scores['target']['name']; ?></span>
				<span class="subBrand">
					<?php 
						if($data3 == '1'){
							echo '1st ';
						}else if($data3 == '2'){
							echo '2nd ';
						}
						echo 'semester';
						try{
							if(strlen($data4) > 0) echo ' SY '.substr($data4,0,4).'-'.substr($data4,4,4);
						}
						catch(Exception $e){}
					?>
				</span>
			</div>
		</div>
	</div>
<main>
	<div class="container-div">
		<center class="card" style="width:400px">
			<center class="card-content">
				<div class="card-title"><h4 class="past-title">PAST SCORE</h4></div>
				<center class="row">
					<center class="input-field">
						<?php
						$skip = 0;
						foreach ($scores['target'] as $score)
						{
							if($skip != 0) echo '<h6 style="font-size: 1.2rem;">'.$score.'</h6>';
							$skip++;
						}
						?>
					</center>
				</center>
			</center>
		</center>
	</div>
</main>
