// $(document).ready(function () {

$('#more-transaction').click((e) => {
	e.preventDefault();
	const data = $(e.target).closest('#transactions-form')
	const type = $(data).find('#select')
	const category = $(data).find('#category')
	const description = $(data).find('#description')
	const amount = $(data).find('#amount')
	const paid_amount = $(data).find('#paid_amount')
	const file = $(data).find('#file')

	if ((amount.val()) < (paid_amount.val())) {
		$('#msg').css({
			'opacity': '1',
			'backgroundColor': '#d55050'
		}).html("The paid amount can't be bigger than the total amount")
		setTimeout(() => {
			$('#msg').css('opacity', '0')
		}, 3500)

	} else if ((type.val().trim() != 0) && (category.val().trim() != 0) && (description.val().trim() != '') && (amount.val().trim() != '')) {
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
			paid_amount: paid_amount.val(),
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
	type, category, description, amount, paid_amount, file.empty()
})

$("#tab6Btn").click((e) => {
	// alert('e')
})
// });