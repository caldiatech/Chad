   var date_from_string = function(str){
		var months = ["jan","feb","mar","apr","may","jun","jul",
		"aug","sep","oct","nov","dec"];
		var pattern = "^([a-zA-Z]{3})\\s*(\\d{2}),\\s*(\\d{4})$";
		var re = new RegExp(pattern);

		var DateParts = re.exec(str).slice(1);
	
		var Year = DateParts[2];
		var Month = $.inArray(DateParts[0].toLowerCase(), months);
		var Day = DateParts[1];
		return new Date(Year, Month, Day);
	}

 
	var table = $("#page_manager").stupidtable({
		"date":function(a,b){
			// Get these into date objects for comparison.
			aDate = date_from_string(a);
			bDate = date_from_string(b);
	
			return aDate - bDate;
		}
	});
	
		table.bind('aftertablesort', function (event, data) {
			// data.column - the index of the column sorted after a click
			// data.direction - the sorting direction (either asc or desc)
		
			var th = $(this).find("thead th");
			th.find(".arrow").remove();
			var arrow = data.direction === "asc" ? "ascending" : "descending";
			th.find("div").replaceWith('<div class="sort"></div>');
			th.eq(data.column).find("div").replaceWith('<div class="'+arrow+'"></div>');
		});
