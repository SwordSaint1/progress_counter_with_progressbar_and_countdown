<div class="modal" id="viewPart">
	<div class="modal-footer"><button class="right btn-flat modal-close red-text" style="font-weight: bold;font-size:20px;">&times;</button></div>
	<div class="modal-content">
		<input type="hidden" name="" id="ref_id">
		<div class="row">
			<div class="col s12">
				<div class="col s12 input-field">
					<span class="red-text">Parts:</span>
					<input type="text" name="" id="part_number" autocomplete="off">
				</div>
				<div class="col s12 input-field">
					<span class="red-text">IRCS Line Name:</span>
					<input type="text" name="" id="line_name" autocomplete="off">
				</div>
				<div class="col s6 input-field">
					<button class="btn col s12 teal z-depth-3" style="border-radius:8px;" id="update_parts" onclick="update_part()">update</button>
				</div>
				<div class="col s6 input-field">
					<button class="btn col s12 red z-depth-3" style="border-radius:8px;" id="delete_parts" onclick="del_part()">delete</button>
				</div>
			</div>
		</div>
	</div>
</div>