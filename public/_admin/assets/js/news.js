$('#news_category').load(mypath+'/dnradmin/news-category/display/'+category_id);
	  
	  function addCategory() { 		

			$("#news_category").load(mypath+"/dnradmin/news-category/new").fadeIn("slow");
  	  }
	  
	  function saveCategory() {
		var category_name = $("#name").val();		
		$.ajax({	
			type: "POST",
			url: mypath+"/dnradmin/news-category/new",			
			data: $("#frmCategory").serialize(),
			cache: false,
			success: function(){	
				$('#news_category').load(mypath+'/dnradmin/news-category');
			}
		});	
	}
	
	function editCategory(id) {
		$("#news_category").load(mypath+"/dnradmin/news-category/edit/"+id).fadeIn("slow");
	}
	
	function updateCategory(category_id) {
		$.ajax({	
			type: "POST",
			url: mypath+"/dnradmin/news-category/edit/"+category_id,			
			data: $("#frmCategory").serialize(),
			cache: false,
			success: function(){	
				$('#news_category').load(mypath+'/dnradmin/news-category');
			}
		});	
	}
	
	function deleteCategory(id) {
		var c = confirm("Are you sure you want to completely remove this Category from the database?\n\nPress 'OK' to delete.\nPress 'Cancel' to go back without deleting the Category.");
        if(c==true) {	
			$.ajax({	
					type: "GET",
					url: mypath+"/dnradmin/news-category/delete/"+id,
					cache: false,
					success: function(){
						$('#news_category').load(mypath+'/dnradmin/news-category');
					}					
			  });	
		} else {
			$('#news_category').load(mypath+'/dnradmin/news-category');
		}
		
	}