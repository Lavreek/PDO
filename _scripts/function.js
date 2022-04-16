var urlfile = "../__modal/Request.php";
var div_block = document.getElementById('responce');


$('#button_sbm').on('click', function() {
	var email = $('#email').val();
	var password = $('#password').val();

	var request = "Auth&user_email=" + email + "&user_password=" + password;

	$.ajax ({ 
		method: "POST", url: urlfile, data: request,
		
		success: function(data)  {
			datarelease = data;

			$('#responce').html(datarelease);
		}
	});
})


	$('#basic-addon2').on('click', function() {
		var message = $("input[name='message']").val();

		var request = "message=" + message;

		$.ajax ({ 
			method: "POST", url: urlfile, data: request,
			
			success: function(data)  {
				datarelease = data;

				$('#responce').html(datarelease);
			}
		});

		$("input[name='message']").val("");
		refresh();
	});

	if (window.location.pathname == "/users/")
	{
		setInterval(() => refresh(), 1000);
	}

	function refresh() {
		if (window.location.pathname == "/users/")
		{
			var request = "REFRESH=" + last;

			$.ajax ({ 
				method: "POST", url: urlfile, data: request,
				
				success: function(data)  {
					datarelease = data;

					$('#chat_body').html(datarelease);
				}
			});
		}
	};
	
