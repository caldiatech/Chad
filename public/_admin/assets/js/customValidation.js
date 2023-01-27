$('#pageform').submit(function () {
			error=0;
			$("div").remove(".error");
			$.each($('#pageform .required'), function()
			{
				if($(this).val() == '' && $(this).attr('id')!="email" && $(this).attr('id')!="firstname" && $(this).attr('id')!="lastname" && $(this).attr('id')!="name" && $(this).attr('id')!="sub_title"){
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

				if($(this).attr('id')=="firstname") {
						var filter = /^([a-zA-Z' ]+)$/;
						if (!filter.test($("#firstname").val())) {	
							 $(this).css( {"border" :"solid 1px #F00"});						
							 $(this).after('<div class="error">Please enter valid first name.</div>');
							 error = 1;
						 }	else {
							 $(this).css( {"border" :"solid 1px #CCC"});						
						 }
				}

				if($(this).attr('id')=="lastname") {
						var filter = /^([a-zA-Z' ]+)$/;
						if (!filter.test($("#lastname").val())) {	
							 $(this).css( {"border" :"solid 1px #F00"});						
							 $(this).after('<div class="error">Please enter valid last name.</div>');
							 error = 1;
						 }	else {
							 $(this).css( {"border" :"solid 1px #CCC"});						
						 }
				}

				if($(this).attr('id')=="name") {
						var filter = /^([a-zA-Z' ]+)$/;
						if (!filter.test($("#name").val())) {	
							 $(this).css( {"border" :"solid 1px #F00"});						
							 $(this).after('<div class="error">Please enter valid name.</div>');
							 error = 1;
						 }	else {
							 $(this).css( {"border" :"solid 1px #CCC"});						
						 }
				}

				if($(this).attr('id')=="sub_title") {
						var filter = /^([a-zA-Z' ]+)$/;
						if (!filter.test($("#sub_title").val())) {	
							 $(this).css( {"border" :"solid 1px #F00"});						
							 $(this).after('<div class="error">Please enter valid sub_title.</div>');
							 error = 1;
						 }	else {
							 $(this).css( {"border" :"solid 1px #CCC"});						
						 }
				}
			});

        
			if(error==1) {return false;}
			// Other groups validated here
		});