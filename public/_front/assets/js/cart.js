function computePrice(qty,price,cnt,id) {
		if(qty=="" || qty == 0){qty=1;}
		total = qty * price;
		$("#price"+cnt).html(total.toFixed(2));
		$("#qty"+cnt).val(qty);	
		//$("#link"+cnt).attr("href", "<?//=$ROOT_URL?>shopping-cart/"+id+"/"+qty+"/")	
	}
	
	function computePriceLatest(qty,price,cnt,id) {
		if(qty=="" || qty == 0){qty=1;}
		total = qty * price;
		$("#priceLatest"+cnt).html(total.toFixed(2));
		$("#qtyLatest"+cnt).val(qty);
		//$("#linkLatest"+cnt).attr("href", "<?//=$ROOT_URL?>shopping-cart/"+id+"/"+qty+"/")	
	}
	
	function addtoCart(ctr) {

	    if(ctr==0) { 

			var product_id = $("#product_id1").val();
			var imgtodrag = $("#mainimage").eq(0);
			var qty = $("#qty").val();
			var selected_value="0";

			if($('select[name="options[]"]').length >0 ) {
				var selected = $('select[name="options[]"]').map(function(){
				//console.log($(this).val());
				//if ($(this).val())
						return $(this).val();
				}).prop('selected', true);
				//console.log(selected);
				var selected_value="";
				$.each(selected, function( index, value ) {
					selected_value+=value+"_";
				});
			} else {
				var selected_value="0";
			}
			
			if(selected_value == "") {selected_value="0";}
			
			
		} else {
			var product_id = $("#product_id"+ctr).val();
			var imgtodrag = $("#image"+ctr).eq(0);
			var qty=1;
			var selected_value="0";
		}
						

		
		//console.log(selected_value);
		/*
		var selected = $('select[name="options[]"]').filter(function() {
		  return $.trim(this.value).length;  
		}).map(function() {
		  return this.value;
		}).get();
		*/
		//alert(url + "/addcart/"+product_id+"/"+qty+"/"+selected_value);
		$.ajax({	
			type: "GET",
			url: url + "/addcart/"+product_id+"/"+qty+"/"+selected_value,			
			cache: false,
			success: function(data){															
					
					var cart = $('#shopping-cart');
												
					if (imgtodrag) {
						var imgclone = imgtodrag.clone()							
							.offset({
								top: imgtodrag.offset().top,
								left: imgtodrag.offset().left
							})
											    
							.css({
								'opacity': '0.5',
								'position': 'absolute',
								'height': '150px',
								'width': '150px',
								'z-index': '100'
						})
							.appendTo($('body'))
							.animate({
							'top': cart.offset().top + 10,
								'left': cart.offset().left + 10,
								'width': 75,
								'height': 75
						}, 1000);
						
						setTimeout(function () {
							//$('#cartImage').effect("shake", {
							//	times: 2
							//}, 200);
							//var cartImagePosition = $( "#cartImage" );
							//var position = cartImagePosition.position()+10;
							
							
							var interval=100,distance=1,times=4;
							 $("#shopping-cart").css('position','relative');
							for(var iter=0;iter<(times+1);iter++){
								$("#shopping-cart").animate({ left: ((iter%2==0 ? distance : distance*-1))}, interval);
							}//for
							//$("#cartImage").css({ left: position.left});
							imgclone.hide();
						}, 1500);
						
						imgclone.animate({
							    'width': 0,
								'height': 0
						}, function () {
							//$("#link"+cnt).detach()							
							//imgclone.removeClass("img-polaroid");																			
							$("#cartItems").text(data);
							
						});
					}
					
					
				} //success
				
				
		});
		
		
			
	}