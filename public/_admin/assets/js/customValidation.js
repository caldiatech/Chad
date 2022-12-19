$('#pageform').submit(function () {
			error=0;
			$("div").remove(".error");
			$.each($('#pageform .required'), function()
			{
				if($(this).val() == '' && $(this).attr('id')!="email"){
					$(this).css( {"border" :"solid 1px #F00"});
					$(this).after('<div class="error">This field is required.</div>');
					error = 1;
				} else {
					$(this).css( {"border" :"solid 1px #CCC"});
				}
				
				if($(this).attr('id')=="email") {
						var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
						if (!filter.test($("#email").val())) {	
							 $(this).css( {"border" :"solid 1px #F00"});						
							 $(this).after('<div class="error">Please enter valid email address.</div>');
							 error = 1;
						 }	else {
							 $(this).css( {"border" :"solid 1px #CCC"});						
						 }
				}
			});

        
			if(error==1) {return false;}
			// Other groups validated here
		});