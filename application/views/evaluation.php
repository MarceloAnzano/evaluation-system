<div style='margin:auto;width:70%'>
	<form action='/app/post_result' method='post'>
		<table>
			<?php
				// target id
				$person = $data2;
				
				// target semester
				$semester = $data3;
				
				$title_index = 0;
				
				foreach ($data['questions'] as &$set)
				{
					$num = 0;
					$percent = 0;
					$category = "";
					$question = $data['title'][$title_index];
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
								echo "<tr><td><b>$category</b></td></tr>";
								continue;
							}
						}
						
						$num++;
						echo "<tr><td>".$row[1]."</td>";
						echo "<td><input type='number' name='".$question."[]' min='0' max='4' step='0.5' value=4 required><br></td></tr>";
					}
					
					echo "<input name='".$question."Num[]' type='hidden' value='".$num."'/>";
					echo "<input name='".$question."Per[]' type='hidden' value='".$count."'/>";
				}
				
				echo "<input name='person' type='hidden' value='".$person."'/>";
				echo "<input name='semester' type='hidden' value='".$semester."'/>";
			?>
			<tr><td><input type='submit' name='submit' value='Submit'></td></tr>
		</table>
	</form>
	<p id="status"></p>
</div>


