<div class="modal" id="modalviewIRCSPlan" style="width:350px;">
	<div class="row right"><button class="btn-flat modal-close" style="color:green;font-weight: bold;font-size:20px;">&times;</button></div>
	<div class="modal-content">
		<h5 class="center">Change IP</h5>
		<div class="row col s12">
				<input type="hidden" name="" id="planID">
				<input type="hidden" id="recent_ip" name="">
			<div class="input-field col s12">
				<span class="teal-text">IP Address</span>
				<input type="text" name="" id="ip_address" onkeyup="validateIP()">
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn teal waves-effect" id="updateBtn" onclick="updateIrcsIPPlan()" disabled>Update</button>
	</div>
</div>