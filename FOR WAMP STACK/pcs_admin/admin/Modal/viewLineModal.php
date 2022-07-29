<div class="modal modal-fixed-footer" id="viewIRCSLineModal">
	<div class="modal-content">
		<div class="row">
			<input type="hidden" id="recent_ip_txt" name="">
			<input type="hidden" name="" id="recent_line_name">
			<div class="input-field">
				<input type="hidden" name="" id="contentID">
			</div>
			<div class="input-field">
				Line Number
				<input type="text" name="" id="line_name_txt" disabled>
			</div>
			<div class="input-field">
				Line Name
				<input type="text" name="" id="ircs_line_txt" onkeyup="validate_name()">
			</div>
			<div class="input-field">
				IP Address
				<input type="text" name="" id="ip_txt" autocomplete="off" onkeyup="validateIP()">
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn teal waves-effect" onclick="updateIRCSLine()" id="updateBtn" disabled>Update</button>
		<button class="btn red" onclick="deleteIRCSLinename()">delete</button>
		<button class="btn-flat modal-close">cancel</button>
	</div>
</div>