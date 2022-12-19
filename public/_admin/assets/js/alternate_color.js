// JavaScript Document

		function alternatecolor(id){ 
		 if(document.getElementsByTagName){  
			 var table = document.getElementById(id);  
			 var rows = table.getElementsByTagName("tr");  
			 for(i = 0; i < rows.length; i++){           
				 if(i % 2 == 0){ 
					 rows[i].className = "row1";
				 } else { 
					 rows[i].className = "row2";
				 }      
			 }
		 }
		}	

		function alternatecolor1(id){ 
		 if(document.getElementsByTagName){  
			 var table = document.getElementById(id);  
			 var rows = table.getElementsByTagName("tr");  
			 for(i = 0; i < rows.length; i++){           
				 if(i % 2 == 0){ 
					 rows[i].className = "row1";
				 } else { 
					 rows[i].className = "row2";
				 }      
			 }
		 }
		}	
