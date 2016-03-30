	<div class="nav-wrapper subNav">
		<div class="row">
			<div class="col s2 m2 l1">
				<div class="imgholder1x1">
					<?php $person = $data2; echo '<img src="'.$this->get_photo($person['info']['userid']).'">'; ?>
				</div>
			</div>
			<div class="col l9">
				<span class="brand-logo"><?php $scores = $data; echo $scores['target']['name']; ?></span>
				<span class="subBrand"></span>
			</div>
		</div>
	</div>
<main>
	<div class="container-div">
		<center class="card" style="width:400px">
			<center class="card-content">
				<center class="card-title"><h4>PAST SCORE</h4></center>
				<center class="row">
					<center class="input-field">
						<?php
						$skip = 0;
						foreach ($scores['target'] as $score)
						{
							if($skip != 0) echo '<br>'.$score;
							$skip++;
						}
						?>
					</center>
				</center>
			</center>
		</center>
	</div>
</main>
