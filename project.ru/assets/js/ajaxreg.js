// Регистрация


$('#registerform').submit(function (e) {


	e.preventDefault();

	var password = $('input[name="password"]').val(),
		email = $('input[name="email"]').val(),
		full_name = $('input[name="full_name"]'),
		password_confirm = $('input[name="password_confirm"]'),
		username = $('input[name="username"]').val();
		console.log(username);

	$.ajax({
		url: '/singun',
		type: 'POST',
		dataType: 'json',
		data: {
			username: username,
			password: password,
			email: email,
			full_name: full_name,
			password_confirm: password_confirm
		},
		success (data) {
			if (data.status) {
				document.location.href = '/login';
			} else {
				$('.msg1').text(data.msg1);
				$('.msg2').text(data.msg2);
				$('.msg3').text(data.msg3);
				$('.msg4').text(data.msg4);
				$('.msg5').text(data.msg5);
			}
		}
	});
});