<?php
$scores = $data;
foreach ($scores['target'] as &$score)
{
	echo '<br>'.$score;
}
