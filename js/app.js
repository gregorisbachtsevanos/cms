$( document ).ready(function() {
	$('#more-transaction').click((e) => {
		e.preventDefault();
		// $("#transaction-modal").removeClass("modal")
		let data = $(e.target).closest('#transactions-form')
		$.post('../app/requests/properties/index.php', {
			action: 'add-more-transaction',
			type: $(data).find('#select').val(),
			category: $(data).find('#category').val(),
			description: $(data).find('#description').val(),
			amount: $(data).find('#amount').val(),
			payed_amount: $(data).find('#payed_amount').val(),
			file: $(data).find('#file').val(),
			estatedrive: 1
		}, function (res) {
			// let data = jQuery.parseJSON(res)
			console.log(res)
		})
		$(data).find('#select').val('s'),
		$(data).find('#category').val(''),
		$(data).find('#description').val(''),
		$(data).find('#amount').val(''),
		$(data).find('#payed_amount').val(''),
		$(data).find('#file').val('')
		$('#msg').css('opacity', '1').html("Added")
		setTimeout(() => {
			$('#msg').css('opacity', '0')
		}, 1000)
	})

});
