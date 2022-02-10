$(document).ready(function () {

	$('#more-transaction').click((e) => {
		e.preventDefault();

		const data = $(e.target).closest('#transactions-form')
		const type = $(data).find('#select')
		const category = $(data).find('#category')
		const description = $(data).find('#description')
		const amount = $(data).find('#amount')
		const payed_amount = $(data).find('#payed_amount')
		const file = $(data).find('#file')

		if ((type.val().trim() != 0) && (category.val().trim() != 0) && (description.val().trim() != '') && (amount.val().trim() != '')) {
			$('#msg').css({
				'opacity': '1',
				'backgroundColor': '#6ac95c'
			}).html("Added")
			setTimeout(() => {
				$('#msg').css('opacity', '0')
			}, 1000)

			$.post('../app/requests/properties/index.php', {
				action: 'add-more-transaction',
				type: type.val(),
				category: category.val(),
				description: description.val(),
				amount: amount.val(),
				payed_amount: payed_amount.val(),
				file: file.val(),
			}, function (res) {
				// console.log(res)
			})

		} else {
			$('#msg').css({
				'opacity': '1',
				'backgroundColor': '#d55050'
			}).html("Empty fields")
			setTimeout(() => {
				$('#msg').css('opacity', '0')
			}, 1000)
		}
		type, category, description, amount, payed_amount, file.empty()
	})

	// $("#add-btn").click((e) => {
	// 	// e.preventDefault();
	// 	let data = $(e.target).closest('#add-modal')
	// 	$.post('../app/requests/properties/ajax-request.php', {
	// 		type: $(data).find('#type')
	// 					.val(),
	// 		title: $(data).find('#title')
	// 					.val(),
	// 		floor: $(data).find('#floor')
	// 					.val(),
	// 		address: $(data).find('#address-map')
	// 					.val(),
	// 		city: $(data).find('#city')
	// 					.val(),
	// 		postal: $(data).find('#postal')
	// 					.val(),
	// 		country: $(data).find('#country')
	// 					.val(),
	// 		double_beds: $(data).find('#double_beds')
	// 					.val(),
	// 		single_beds: $(data).find('#single_beds')
	// 					.val(),
	// 		sofa_beds: $(data).find('#sofa_beds')
	// 					.val(),
	// 		udults: $(data).find('#udults')
	// 					.val(),
	// 		children: $(data).find('#children')
	// 					.val(),
	// 		kitchen: $(data).find('#kitchen')
	// 					.val(),
	// 		children: $(data).find('#children')
	// 					.val(),
	// 		kitchen: $(data).find('#kitchen')
	// 					.val(),
	// 		pets: $(data).find('#pets')
	// 					.val(),
	// 		info: $(data).find('#field-7')
	// 					.val(),
	// 		latitude: $(data).find('#latitude')
	// 					.val(),
	// 		longitude: $(data).find('#longitude')
	// 					.val(),
	// 		files: $(data).find('#files')
	// 					.val()

	// 	}, function (res) {
	// 		alert(res)
	// 	})
	// })

});