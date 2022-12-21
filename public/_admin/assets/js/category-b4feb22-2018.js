			//alert(mypath+'/dnradmin/product_options/display/'+category_id);
			if(product_id!=0) {
				$('#product_options').load(mypath+'/dnradmin/product_options/display/'+category_id+'/'+product_id);
				$('#category').load(mypath+'/dnradmin/category/display/'+category_id+'/'+product_id);
			} else {
				$('#product_options').load(mypath+'/dnradmin/product_options/display/'+category_id);
				$('#category').load(mypath+'/dnradmin/category/display/'+category_id);
			}
		   
		
			function displaySubCategory(id) {
					$('#subcategories').show("slow");				   
					$('#subcategory').load(mypath+'/dnradmin/sub-category/'+id+'/0');
			}
			
			function editCategory(id) {
	
				 location.href = mypath + "/dnradmin/category/edit/"+id;
			}
			
			function deleteCategory(id) {
				var c = confirm("Are you sure you want to completely remove this Category from the database?\n\nPress 'OK' to delete.\nPress 'Cancel' to go back without deleting the Category.");
				if(c==true) {	
					$.ajax({	
							type: "GET",
							url: mypath+ "/dnradmin/category/delete/"+id+"/0/add",
							cache: false,
							success: function(){
								$('#category').load(mypath+'/dnradmin/category/display');
							}					
					  });	
				} else {
					$('#category').load(mypath+'/dnradmin/category/display');
				}
				 
			}
			
			function addCategory(id) {
				location.href = mypath + "/dnradmin/category/new/"+id+"/0";
			}
			
			function addSubCategory(id,product_id)
			{
				location.href = mypath + "/dnradmin/category/new/"+id+"/"+product_id;
			}
			
			function editSubCategory(id,product_id)
			{
				location.href = mypath + "/dnradmin/category/edit/"+id;
			}
			
			function deleteSubCategory(id,category_id) {
				var c = confirm("Are you sure you want to completely remove this Category from the database?\n\nPress 'OK' to delete.\nPress 'Cancel' to go back without deleting the Category.");
				if(c==true) {	
					$.ajax({	
							type: "GET",
							url: mypath+ "/dnradmin/category/delete/"+id+"/0/add",
							cache: false,
							success: function(){
								$('#subcategory').load(mypath+'/dnradmin/sub-category/'+category_id+'/0');
							}					
					  });	
				} else {
					$('#subcategory').load(mypath+'/dnradmin/sub-category/'+category_id+'/0');
				}
				 
			}
			
			function addOptions() {
				$('#product_options').load(mypath+'/dnradmin/product_options/new');
			}
			
			
			
			function saveOptions() {
				var option_name = $("#name").val();		
					console.log($("#frmOptions").serialize());
				$.ajax({	
					type: "POST",
					url: mypath+"/dnradmin/product_options/new",			
					data: $("#frmOptions").serialize(),
					cache: false,
					success: function(){

						$('#product_options').load(mypath+'/dnradmin/product_options');
					}
				});	
			}
			
			function updateOptions(id) {
				var option_name = $("#name").val();		
				$.ajax({	
					type: "POST",
					url: mypath+"/dnradmin/product_options/edit/"+id,			
					data: $("#frmOptions").serialize(),
					cache: false,
					success: function(){	
						$('#product_options').load(mypath+'/dnradmin/product_options');
					}
				});	
			}
			
			function editOptions(id) {
				$('#product_options').load(mypath+'/dnradmin/product_options/edit/'+id);
			}
			
			function deleteOptions(id) {
				var c = confirm("Are you sure you want to completely remove this Options from the database?\n\nPress 'OK' to delete.\nPress 'Cancel' to go back without deleting the Options.");
				if(c==true) {	
					$.ajax({	
							type: "GET",
							url: mypath+ "/dnradmin/product_options/delete/"+id,
							cache: false,
							success: function(){
								$('#product_options').load(mypath+'/dnradmin/product_options');
							}					
					  });	
				} else {
					$('#product_options').load(mypath+'/dnradmin/product_options');
				}
				 
			}
			
			function addAssetsOptions(option_id,product_id) {
				if(product_id=="") {
					product_id=0;
				}
				$('#product_options_assets'+option_id).load(mypath+'/dnradmin/product_options_assets/new/0/'+option_id+'/'+product_id, function() {
				  var i_image_width = 0,
				  i_image_height = 0;
				  var el_image_width = document.querySelector('#uploadedImage');
				  var el_height_options = document.querySelectorAll('#edit-height > option');
				  var el_width_options = document.querySelectorAll('#edit-width > option');
				  i_image_width = parseInt($(el_image_width).attr('width'));
				  i_image_height = parseInt($(el_image_width).attr('height'));
				  		console.log('i_image_width');
				  		console.log(i_image_width);
				  		console.log('i_image_height');
				  		console.log(i_image_height);
				  if(i_image_width > i_image_height){					  
					var el_selection_h = document.querySelector("#edit-height-section");
					$(el_selection_h).addClass('disabled');		  
				  }else{
					var el_selection_w = document.querySelector("#edit-width-section");
					$(el_selection_w).addClass('disabled');	  	

				}


				});
			}
			
			function displayOptionsAssets(option_id,status,product_id) {
				
				if(status == true) { 
					$("#options"+option_id).show("slow");
				} else {
					$("#options"+option_id).hide("slow");
				}
				if(product_id == 0) {
					$('#product_options_assets'+option_id).load(mypath+'/dnradmin/product_options_assets/display/'+option_id);
				} else {
					$('#product_options_assets'+option_id).load(mypath+'/dnradmin/product_options_assets/display/'+option_id+'/'+product_id);
				}
			}
			
			function saveAssetsOptions() {
				var option_name = $("#name").val();		
				var option_id = $("#option_id").val();	
				$.ajax({	
					type: "POST",
					url: mypath+"/dnradmin/product_options_assets/new",			
					data: $("#frmOptionsAssets").serialize(),
					cache: false,
					success: function(data){
						//console.log(data);
						var returnedData = JSON.parse(data);
						
						//console.log(returnedData.option_id);
						//console.log(returnedData.product_id);
	
						$('#product_options_assets'+returnedData.option_id).load(mypath+'/dnradmin/product_options_assets/display/'+returnedData.option_id+'/'+returnedData.product_id);
					}
				});	
			}
			
			function editAssetsOptions(id,option_id,product_id) {
				
				$('#product_options_assets'+option_id).load(mypath+'/dnradmin/product_options_assets/edit/'+id+'/'+option_id+'/'+product_id);

			}
			
			function updateAssetsOptions(id) {
				var option_name = $("#name").val();		
				$.ajax({	
					type: "POST",
					url: mypath+"/dnradmin/product_options_assets/edit/"+id,			
					data: $("#frmOptionsAssets").serialize(),
					cache: false,
					success: function(data){	
						//$('#product_options_assets'+data).load(mypath+'/dnradmin/product_options_assets/display/'+data);
						var returnedData = JSON.parse(data);	
						$('#product_options_assets'+returnedData.option_id).load(mypath+'/dnradmin/product_options_assets/display/'+returnedData.option_id+'/'+returnedData.product_id);
					}
				});	
			}
			
			function deleteAssetsOptions(id,option_id) {
				var c = confirm("Are you sure you want to completely remove this Options Assets from the database?\n\nPress 'OK' to delete.\nPress 'Cancel' to go back without deleting the Options Assets.");
				if(c==true) {	
					$.ajax({	
							type: "GET",
							url: mypath+ "/dnradmin/product_options_assets/delete/"+id,
							cache: false,
							success: function(data){
								$('#product_options_assets'+data).load(mypath+'/dnradmin/product_options_assets/display/'+data);
							}					
					  });	
				} else {
					$('#product_options_assets'+option_id).load(mypath+'/dnradmin/product_options_assets/display/'+option_id);
				}
				 
			}
			
			function displayAssetsPrice(assets_id,status) {
				if(status == true) { 
					$("#assets"+assets_id).show("slow");
				} else {
					$("#assets"+assets_id).hide("slow");
				}
			}

			$('#saveinfo_product').on('click', function(){
		        console.log('saveinfo clciked');
		        $this_checkbox_name = 'category';
		        $this_notification_id = 'required_category';
		        if(has_one_checked('category')){
		        	$this_checkbox_name = 'options';
		        	$this_notification_id = 'required_options';
			        if(has_one_checked('options')){
		        		$this_checkbox_name = 'options_assets';
		        		$this_notification_id = 'required_option_assets';
			          if(has_one_checked('options_assets')){
			            $('.required-notification').html('');
			            $('#pageform').submit();
			            return true;
			          }
			        }
			    }
			    show_notification($this_notification_id, $this_checkbox_name);
			    return false;
		      });
		      function has_one_checked(checkbox_name){
		        console.log('has_one_checked input[name="'+checkbox_name+'"]');
		        var checkboxs = document.querySelectorAll('input[name="'+checkbox_name+'[]"]');
		        console.log(checkboxs);
		        var okay=false;
		        for(var i=0,l=checkboxs.length;i<l;i++)
		        {
		            if(checkboxs[i].checked)
		            {
		                okay=true;
		                break;
		            }
		        }
		        console.log(okay);
		        return okay;
		      }

		      function show_notification(div_id, required_el){
		        $('#'+div_id+' .required-notification').html('<div class="uk-alert uk-alert-danger">Please select atleast one '+required_el+'</div>');
		          UIkit.Utils.scrollToElement(UIkit.$('#'+div_id));
		      }
			