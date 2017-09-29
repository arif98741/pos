$(document).ready(function() {
	

	$('.btn').click(function(){
		var details = {
		name: $('.name').val(),
		roll: $('.roll').val(),
		departmnet: $('.departmnet').val(),
		address: $('.address').val()
		}

		if (detail.name == '' || details.roll=='' || details.department== '' | details.address=='') {
			alert('Field Must Not be empty');
			return false;
		} else {

		}

	});



	
});