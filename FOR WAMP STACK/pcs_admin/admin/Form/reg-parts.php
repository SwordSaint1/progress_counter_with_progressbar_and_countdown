<div class="col s12">
	<div class="input-field col s12">
		<input type="text" name="" id="parts_number_reg" autocomplete="off"><label>Parts#</label>
	</div>
	<div class="input-field col s12">
		<select class="browser-default z-depth-3" id="line_name_reg" style="border-radius:8px;">
			<option value="" disabled selected>--SELECT LINE NAME--</option>
			<?php 
				require '../../php/conn.php';
				$sql = "SELECT ircs_line FROM pcs_ircs_line ORDER BY ircs_line ASC";
				$stmt = $conn->prepare($sql);
				$stmt->execute();
				foreach($stmt->fetchALL() as $x){
					echo '<option value="'.$x['ircs_line'].'">'.$x['ircs_line'].'</option>';
				}
			?>
		</select>
	</div>
	<div class="col s12 input-field">
		<button class="btn blue col s12 z-depth-3" onclick="register_parts()" style="border-radius:8px;">register</button>
	</div>
</div>