$(document).ready(function(){
		// Write on keyup event of keyword input element
		$("#search").keyup(function(){
			// When value of the input is not blank
			if( $(this).val() != "")
			{
				// Show only matching TR, hide rest of them
				$("#page_manager tbody>tr").hide();
				countTR = $("#page_manager td:contains-ci('" + $(this).val() + "')").parent("tr");
				if(countTR.size()==0) {
					$('#page_manager').append('<tr class="displayError"><td colspan="7" align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#F00; font-weight:bold">No Record Found</td></tr>');
					$('#page_navigation').html("");
				} else {
					showPagination($('#show_per_page').val(),countTR.size(),countTR);
										
					$('.displayError').remove();
				}
			}
			else
			{
				// When there is no input or clean again, show everything back								
				$('.displayError').remove();
				$("#page_manager tbody>tr").show();				
				showPagination($('#show_per_page').val(),$('#number_of_items').val(),$('#page_manager tbody>tr'));
			}
		});
		
		

	});
	// jQuery expression for case-insensitive filter
	$.extend($.expr[":"], 
	{
		"contains-ci": function(elem, i, match, array) 
		{
			return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
		}
	});
	


function showPagination(show_per_page,number_of_items,pageTR) {
	//Pagination
		//how much items per page to show
			//var show_per_page = 2;
			//getting the amount of elements inside content div
			//var number_of_items = $('#page_manager tbody>tr').size();
			
			//calculate the number of pages we are going to have
			var number_of_pages = Math.ceil(number_of_items/show_per_page);
		
			//set the value of our hidden input fields
			$('#current_page').val(0);
			$('#show_per_page').val(show_per_page);
			$('#number_of_items').val(number_of_items);
			//now when we got all we need for the navigation let's make it '
		
			/*
			what are we going to have in the navigation?
				- link to previous page
				- links to specific pages
				- link to next page
			*/
			var navigation_html = '<a class="previous_link" href="javascript:previous();">Prev</a>';
			var current_link = 0;
			while(number_of_pages > current_link){
				navigation_html += ' <a class="page_link" href="javascript:go_to_page(' + current_link +')" longdesc="' + current_link +'">'+ (current_link + 1) +'</a>';
				current_link++;
			}
			navigation_html += '<a class="next_link" href="javascript:next();"> Next</a>';
		
			$('#page_navigation').html(navigation_html);
		
			//add active_page class to the first page link
			$('#page_navigation .page_link:first').addClass('current');
		
			//hide all the elements inside content div
			$("#page_manager tbody>tr").hide();
		
			//and show the first n (show_per_page) elements
			pageTR.slice(0, show_per_page).show();
			
}			

function previous(){

	new_page = parseInt($('#current_page').val()) - 1;
	//if there is an item before the current active link run the function
	if($('.current').prev('.page_link').length==true){
		go_to_page(new_page);
	}

}

function next(){
	new_page = parseInt($('#current_page').val()) + 1;
	//if there is an item after the current active link run the function
	if($('.current').next('.page_link').length==true){
		go_to_page(new_page);
	}

}
function go_to_page(page_num){
	//get the number of items shown per page
	var show_per_page = parseInt($('#show_per_page').val());

	//get the element number where to start the slice from
	start_from = page_num * show_per_page;

	//get the element number where to end the slice
	end_on = start_from + show_per_page;

	//hide all children elements of content div, get specific items and show them
	$('#page_manager tbody>tr').hide().slice(start_from, end_on).show();

	/*get the page link that has longdesc attribute of the current page and add active_page class to it
	and remove that class from previously active page link*/
	$('.page_link[longdesc=' + page_num +']').addClass('current').siblings('.current').removeClass('current');

	//update the current page input field
	$('#current_page').val(page_num);

}
//display the pagination
