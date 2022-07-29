<div class="row">
	<div class="col s12">
		<div class="input-field col s12">
			<select class="browser-default" id="ircs_line_name_txt" onchange="autocompleteLineNo()">
				<option value="" selected disabled>--Select Line Name--</option>
				<?php
					require '../../php/conn.php';
					$qry = "SELECT ircs_line FROM pcs_ircs_line ORDER BY ID DESC";
					$stmt = $conn->prepare($qry);
					$stmt->execute();
					if($stmt->rowCount() > 0){
						foreach($stmt->fetchALL() as $x){
							echo '<option value="'.$x['ircs_line'].'">'.$x['ircs_line'].'</option>';
						}
					}else{
						// DO NOTHING
					}
				?>
			</select>
		</div>
		<div class="input-field col s12">
			<span class="teal-text">Line Number</span>
			<input type="text" id="line_number_txt" disabled>
		</div>
	</div>
</div>