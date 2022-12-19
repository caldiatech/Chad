<h3>Choose Your Mats <i class="uk-icon-question fsize-12 tooltip light-grey uk-icon-justify"  data-uk-tooltip title="Browse our extensive matting choices and find the perfect fit for your presentation"></i></h3>
                    <div class="uk-grid w100 uk-margin-remove uk-text-large">
                      <div class="uk-width-large-4-10 line-height-select  uk-display-inline form-radio-buttons   uk-width-1-1 uk-padding-remove">
                          <label class=" light uk-margin-small-right" for="matborder_whole">Set Mat Border Width:</label>   
                      </div>

                      <div class="uk-width-large-3-10   uk-display-inline form-radio-buttons  uk-width-1-1 uk-padding-remove">
                          <div class="select-wrapper wrapper-large input-append spinner">
                            <select id="matborder_whole" id="matborder_whole" onChange="generateNewImageFrame()">
                                <option value="1">1</option>
                                <option value="2" selected="selected">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                            </select>
                            <div class="add-on"> 
                              <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                              <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
                            </div>
                          </div>
                      </div>

                      <div class="uk-width-large-3-10   uk-display-inline form-radio-buttons   uk-width-1-1 uk-padding-remove"> 
                          <div class="select-wrapper wrapper-large input-append spinner">
                            <select id="matborder_fractions" id="matborder_fractions" onChange="generateNewImageFrame()">
                                <option value=".125">1/8</option>
                                <option value=".25">1/4</option>
                                <option value=".375">3/8</option>
                                <option value=".5" selected="selected">1/2</option>
                                <option value=".625">5/8</option>
                                <option value=".75">3/4</option>
                                <option value=".875">7/8</option>
                            </select> 
                            <div class="add-on"> 
                              <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                              <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
                            </div>
                          </div>
                      </div>
                    

                       



                    <div class="uk-width-divider-blank uk-margin-small"></div>
                        
                      <div class="pricing-box full-width">
                        <div class="uk-grid" data-uk-grid-margin="">
                <div class="uk-width-1-1 uk-width-large-1-3 pricing-box-item uk-padding-remove tm-delayed-animations">
                  <div class="uk-panel uk-panel-box tm-panel-padding-vertical uk-scrollspy-init-inview uk-scrollspy-inview uk-animation-scale-up " data-uk-scrollspy="{cls:'fade', delay:300, repeat: false}">
                              <h5 class="text-uppercase">
                                  <label class="uk-form-label light full-width" for="stm">
                                    <input type="radio" class="uk-margin-medium-right" id="stm" name="mat_type" value="1">Single Top Mat
                                  </label>
                              </h5>
                                <a href="#matcolor" id="mat_choice" class="uk-text-small uk-text-center"  data-uk-modal data-mat="1">Select Mat Color</a>

                                <div class="uk-thumbnail uk-thumbnail-medium">
                                    <a href="#matcolor" id="mat_image_choice" data-uk-modal data-mat="1"> <img src="{{ url('_front/assets/images/nomat.jpg') }}" id="mat1" style="width:152px; height: 110px;"> </a>
                                </div>

                                  <ul class="uk-list uk-list-space fsize-12">
                                    <li>
                                          <label class="uk-form-label light full-width" for="stm-1">
                                                <input type="checkbox" class="uk-margin-medium-right" id="stm-1" name="option1[]" onClick="generateNewImageFrame()">V-Groove
                                            </label>
                                    </li>
                                    <li>
                                            <label class="uk-form-label light full-width" for="stm-2">
                                                <input type="checkbox" class="uk-margin-medium-right" id="stm-2" name="option1[]" onClick="generateNewImageFrame()">Reverse Bevel Cut
                                            </label>
                                    </li>
                                    <li>
                                            <label class="uk-form-label light full-width" for="stm-3">
                                                <input type="checkbox" class="uk-margin-medium-right" id="stm-3" name="option1[]" onClick="generateNewImageFrame()">Raised Mat
                                            </label>
                                    </li>
                                  </ul>
                  </div>
                </div>
                <div class="uk-width-1-1 uk-width-large-1-3 pricing-box-item uk-padding-remove  tm-delayed-animations disabled">
                  <div class="uk-panel uk-panel-box tm-panel-padding-vertical uk-scrollspy-init-inview uk-scrollspy-inview uk-animation-scale-up " data-uk-scrollspy="{cls:'fade', delay:300, repeat: false}">
                    <h5 class="text-uppercase"><label class="uk-form-label light full-width" for="dm">
                                  <input type="radio" class="uk-margin-medium-right" id="dm" name="mat_type" value="2">Double Mat
                              </label>
                            </h5>
                    
                               <a href="#matcolor" id="mat_choice2" class="uk-text-small uk-text-center"  data-mat="2">Select Mat Color</a>

                                <div class="uk-thumbnail uk-thumbnail-medium">
                                     <a href="#matcolor" id="mat_image_choice2"  data-mat="2"> <img src="{{ url('_front/assets/images/nomat.jpg') }}" id="mat2" style="width:152px; height: 110px;"> </a>
                                </div>

                                  <ul class="uk-list uk-list-space fsize-12">
                                    <li>
                                          <label class="uk-form-label light full-width" for="stm-1">
                                                Set Offset 
                                                <select name="offset2" id="offset2"  onChange="generateNewImageFrame()">
                                                    <option value=".25">1/4</option>
                                                    <option value=".375">3/8</option>
                                                    <option value=".5">1/2</option>
                                                    <option value=".625">5/8</option>
                                                    <option value=".75">3/4</option>
                                                    <option value=".875">7/8</option>
                                                    <option value="1">1"</option>
                                                </select> 
                                            </label>
                                    </li>
                                    <li>
                                            <label class="uk-form-label light full-width" for="stm-4">
                                                <input type="checkbox" class="uk-margin-medium-right option2" id="stm-4" name="option2[]" onClick="generateNewImageFrame()">Reverse Bevel Cut
                                            </label>
                                    </li>
                                    <li>
                                            <label class="uk-form-label light full-width" for="stm-5">
                                                <input type="checkbox" class="uk-margin-medium-right option2" id="stm-5" name="option2[]" onClick="generateNewImageFrame()">Raised Mat
                                            </label>
                                    </li>
                                  </ul>

                  </div>
                </div>
                <div class="uk-width-1-1 uk-width-large-1-3 pricing-box-item uk-padding-remove  tm-delayed-animations">
                  <div class="uk-panel uk-panel-box tm-panel-padding-vertical uk-scrollspy-init-inview uk-scrollspy-inview uk-animation-scale-up " data-uk-scrollspy="{cls:'fade', delay:300, repeat: false}">
                    <h5 class="text-uppercase"><label class="uk-form-label light full-width" for="tm">
                                  <input type="radio" class="uk-margin-medium-right" id="tm" name="mat_type" value="3">Triple Mat
                              </label>
                            </h5>
                                                
                             <a href="#matcolor" id="mat_choice3" class="uk-text-small uk-text-center"  data-mat="3">Select Mat Color</a>

                                <div class="uk-thumbnail uk-thumbnail-medium">
                                   <a href="#matcolor" id="mat_image_choice3"  data-mat="3"> <img src="{{ url('_front/assets/images/nomat.jpg') }}" id="mat3" style="width:152px; height: 110px;"> </a>
                                </div>

                                  <ul class="uk-list uk-list-space fsize-12">
                                    <li>
                                          <label class="uk-form-label light full-width" for="stm-1">
                                                Set Offset 
                                                <select name="offset3" id="offset3" onChange="generateNewImageFrame()">
                                                   <option value=".25">1/4</option>
                                                    <option value=".375">3/8</option>
                                                    <option value=".5">1/2</option>
                                                    <option value=".625">5/8</option>
                                                    <option value=".75">3/4</option>
                                                    <option value=".875">7/8</option>
                                                    <option value="1">1"</option>
                                                </select> 
                                            </label>
                                    </li>
                                    <li>
                                            <label class="uk-form-label light full-width" for="stm-6">
                                                <input type="checkbox" class="uk-margin-medium-right option3" id="stm-6" name="option3[]" onClick="generateNewImageFrame()">Reverse Bevel Cut
                                            </label>
                                    </li>
                                    <li>
                                            <label class="uk-form-label light full-width" for="stm-7">
                                                <input type="checkbox" class="uk-margin-medium-right option3" id="stm-7" name="option3[]" onClick="generateNewImageFrame()">Raised Mat
                                            </label>
                                    </li>
                                  </ul>

                  </div>
                </div>

              </div>
                      </div> <!-- <div class="pricing-box">  -->


                      
                  </div>

                  
                  <div class="uk-modal" id="matcolor">
                      <div class="uk-modal-dialog bg-white uk-modal-dialog-large">
                          <div class="uk-modal-header"><h3>Select Mat Color</h3></div>
                              <div class="uk-grid uk-container-center">

                                 @foreach($graphikMatsAPI->mat as $graphikMatsAPIs)
                                                                                                    
                                      <div class="uk-thumbnail uk-thumbnail-small uk-width-1-4 uk-container-center">
                                          <a href="#selectedMats" class="full-width uk-text-center selectMat" onClick="selectedMat('{{ $graphikMatsAPIs->sku }}','{{ $graphikMatsAPIs->shortDescription }}',{{ $graphikMatsAPIs->priceData->markUpPrice }})"> <img src="http://image.pictureframes.com/images/mats/{{ $graphikMatsAPIs->sku }}.gif" > </a>
                                          <div class="uk-thumbnail-caption"><a href="#" class="full-width uk-text-center" onClick="selectedMat('{{ $graphikMatsAPIs->sku }}','{{ $graphikMatsAPIs->shortDescription }}',{{ $graphikMatsAPIs->priceData->markUpPrice }})">{{ $graphikMatsAPIs->shortDescription }}</a></div>
                                      </div>                                
                                
                                @endforeach 
                              </div>  
                               

                          <div class="uk-modal-footer">       
                              <input type ="hidden" name="mat_value" id="mat_value">                       
                              <a href="javascript:void(0)" class="uk-button uk-button-small uk-button-primary uk-modal-close" id="selectedMat">Select</a>
                              <span class="uk-text-danger" id="matDesc"></span>
                          </div>
                      </div>
                  </div>


<script>
  //hide the mat details in details price sections

  $("#matDetails1").hide();  
  $("#matDetails2").hide();
  $("#matDetails3").hide();

  $("input[name=mat_type]:radio").change(function () {
      if(this.value == 1) {
        $("#offset2").attr('disabled','disabled');
        $(".option2").attr('disabled','disabled');

        $("#offset3").attr('disabled','disabled');
        $(".option3").attr('disabled','disabled');

        $("#mat_choice2,#mat_choice3,#mat_image_choice2,#mat_image_choice3").removeAttr('data-uk-modal');

        //display the mat1 in details price list
        $("#matDetails1").show();
        $("#matDetails2").hide();
        $("#matDetails3").hide();
        
      } else if(this.value == 2) {
        $("#offset2").removeAttr('disabled');
        $(".option2").removeAttr('disabled');
        $("#mat_choice2,#mat_image_choice2").attr('data-uk-modal','data-uk-modal')

        $("#offset3").attr('disabled','disabled');
        $(".option3").attr('disabled','disabled');
        $("#mat_choice3,#mat_image_choice3").removeAttr('data-uk-modal');

        //display the mat1 and mat2 in details price list
        $("#matDetails1").show();
        $("#matDetails2").show();
        $("#matDetails3").hide();  
      } else if(this.value == 3) {
          $("#offset3").removeAttr('disabled');
          $(".option3").removeAttr('disabled');          
          $("#mat_choice2,#mat_image_choice2,#mat_choice3,#mat_image_choice3").attr('data-uk-modal','data-uk-modal')

          //display the mat1, mat2 and mat3 in details price list
          $("#matDetails1").show();
          $("#matDetails2").show();
          $("#matDetails3").show();
      }
      
  });


  function selectedMat(sku,name,price) {      
    // $("#selectedMat").removeAttr('data-sku');  
    // $("#selectedMat").removeAttr('data-name'); 
    // $("#selectedMat").removeAttr('data-sku2');  
    // $("#selectedMat").removeAttr('data-name2'); 
    // $("#selectedMat").removeAttr('data-sku3');  
    // $("#selectedMat").removeAttr('data-name3'); 
    $("#selectedMat").removeData('sku'); 
    $("#selectedMat").removeData('name'); 
    $("#selectedMat").removeData('price'); 
    
    $("#matDesc").html("  You select " + name);
    //if($("#mat_value").val()==1) {
      $("#selectedMat").attr('data-sku',sku);
      $("#selectedMat").attr('data-name',name);
      $("#selectedMat").attr('data-price',price);
    // } else if($("#mat_value").val()==2) {
    //   $("#selectedMat").attr('data-sku2',sku);
    //   $("#selectedMat").attr('data-name2',name);
    // } else if($("#mat_value").val()==3) {
    //   $("#selectedMat").attr('data-sku3',sku);
    //   $("#selectedMat").attr('data-name3',name);
    // }
  }



  $('#selectedMat').click(function(evt) {
        //evt.preventDefault();
          
        
         if($("#mat_value").val()==1) {               
            if($('#mat1').data('sku')) { $("#mat1").removeData('sku'); } 
            $("#mat1").attr('data-sku',$('#selectedMat').data('sku'));
            $("#mat1").attr('src', 'http://image.pictureframes.com/images/mats/'+$('#selectedMat').data('sku')+'.gif')    
            
            $("#matDetails1_Title").html($('#selectedMat').data('sku') + " - " + $('#selectedMat').data('name'));
            $("#matDetails1_Price").html($('#selectedMat').data('price').toFixed(2)); 

          } else if($("#mat_value").val()==2) {
            if($('#mat2').data('sku')) { $("#mat2").removeData('sku'); } 

            $("#mat2").attr('src', 'http://image.pictureframes.com/images/mats/'+$('#selectedMat').data('sku')+'.gif')
            $("#mat2").attr('data-sku',$('#selectedMat').data('sku'));

            $("#matDetails2_Title").html($('#selectedMat').data('sku') + " - " + $('#selectedMat').data('name'));
            $("#matDetails2_Price").html($('#selectedMat').data('price').toFixed(2)); 

          } else if($("#mat_value").val()==3) {
            if($('#mat3').data('sku')) { $("#mat3").removeData('sku'); } 

            $("#mat3").attr('src', 'http://image.pictureframes.com/images/mats/'+$('#selectedMat').data('sku')+'.gif')
            $("#mat3").attr('data-sku',$('#selectedMat').data('sku'));

            $("#matDetails3_Title").html($('#selectedMat').data('sku') + " - " + $('#selectedMat').data('name'));
            $("#matDetails3_Price").html($('#selectedMat').data('price').toFixed(2)); 
          } 
          
          generateNewImageFrame();        
    });

  function generateNewImageFrame() {
       var matParams=""

       //for mat1
       $("#matDetails1_Details").html("");
       $("#matDetails2_Details").html("");
       $("#matDetails3_Details").html("");

       if($('#mat1').data('sku')) {
          matParams = matParams + "&mat1="+$('#mat1').data('sku'); 
       }

       if($('#stm-1').is(":checked")) {
          matParams = matParams + "&vgrooveOffset=.75";  

          var details = $("#matDetails1_Details").html();          
          $("#matDetails1_Details").html(details+'<span class="light ">V-Groove</span>');
          
       }

       if($('#stm-2').is(":checked")) {
          matParams = matParams + "&m1b=true";  

          var details = $("#matDetails1_Details").html();                 
          $("#matDetails1_Details").html(details+'<br><span class="light ">Reverse Bevel Cut</span>'); 
       }

       if($('#stm-3').is(":checked")) {
          matParams = matParams + "&mat1Raised=true";   

          var details = $("#matDetails1_Details").html();          
          $("#matDetails1_Details").html(details+'<br><span class="light ">Raised Mat</span>');
       }
       //end mat1

       //for mat2
       if($('#mat2').data('sku')) {
          matParams = matParams +  "&mat2="+$('#mat2').data('sku')+"&off="+$( "#offset2" ).val(); 

          var details = $("#matDetails2_Details").html();          
          $("#matDetails2_Details").html(details+'<span class="light ">Offset: '+$( "#offset2" ).val()+'</span>'); 
       }

       if($('#stm-4').is(":checked")) {
          matParams = matParams + "&m2b=true";   

          var details = $("#matDetails2_Details").html();          
          $("#matDetails2_Details").html(details+'<br><span class="light ">Reverse Bevel Cut</span>'); 
       }

       if($('#stm-5').is(":checked")) {
          matParams = matParams + "&mat2Raised=true";   

          var details = $("#matDetails2_Details").html();          
          $("#matDetails2_Details").html(details+'<br><span class="light ">Raised Mat</span>');
       }
       //end mat2

       //for mat3
        if($('#mat3').data('sku')) {
          matParams = matParams +  "&mat3="+$('#mat3').data('sku')+"&off3="+$( "#offset3" ).val(); 

           var details = $("#matDetails3_Details").html();          
          $("#matDetails3_Details").html(details+'<span class="light">Offset: '+$( "#offset3" ).val()+'</span>'); 
        }

        if($('#stm-6').is(":checked")) {
           matParams = matParams + "&m3b=true";   

           var details = $("#matDetails3_Details").html();          
          $("#matDetails3_Details").html(details+'<br><span class="light ">Reverse Bevel Cut</span>'); 
        }

        if($('#stm-7').is(":checked")) {
          matParams = matParams + "&mat3Raised=true";   

          var details = $("#matDetails3_Details").html();          
          $("#matDetails3_Details").html(details+'<br><span class="light ">Raised Mat</span>');
         }

        //end for mat3
        var matSize = $( "#matborder_whole" ).val() + $( "#matborder_fractions" ).val() 
       
        var imageWidth = ($("#imageSize").children('option:selected').data('width')) ? $("#imageSize").children('option:selected').data('width') : 8;
        var imageHeight = ($("#imageSize").children('option:selected').data('height')) ? $("#imageSize").children('option:selected').data('height') : 11;
        var imagePrice = ($("#imageSize").children('option:selected').data('price')) ? $("#imageSize").children('option:selected').data('price') : 0;


        if(matParams=="") {
            matSize = 1.5;
            var newSrc = "https://pod.cloud.graphikservices.com/renderEMF/render?imgUrl={{ url(PRODUCT_IMAGE_PATH.$product->fldProductSlug.'/'.MEDIUM_IMAGE.$product->fldProductImage) }}&imgHI="+imageWidth+"&imgWI="+imageHeight+"&maxW=400&maxH=400&t="+matSize+"&r="+matSize+"&b="+matSize+"&l="+matSize+"&mat1=PM918&m1b=1&off=0.375&sku="+$("#mainImage").attr('data-sku')+"&frameW="+$("#mainImage").attr('data-width');
        } else {
         var newSrc = "https://pod.cloud.graphikservices.com/renderEMF/render?imgUrl={{ url(PRODUCT_IMAGE_PATH.$product->fldProductSlug.'/'.MEDIUM_IMAGE.$product->fldProductImage) }}&imgHI="+imageWidth+"&imgWI="+imageHeight+"&maxW=400&maxH=400&t="+matSize+"&r="+matSize+"&b="+matSize+"&l="+matSize+"&m1b=1&off=0.375&sku="+$("#mainImage").attr('data-sku')+"&frameW="+$("#mainImage").attr('data-width')+matParams;
        } 

          //change the frame information on product details page
          $("#frameName").html($("#mainImage").data('desc'));
          $("#framePrice").html($("#mainImage").data('price').toFixed(2));
          $("#frameSize").html(imageWidth + ' x ' + imageHeight);

          $("#mainImage").attr('src',newSrc);

          //change the price,width and height of image
          $("#descImageWidth").html(imageWidth);
          $("#descImageHeight").html(imageHeight);
          $("#descImagePrice").html(imagePrice.toFixed(2));

          //compute the total price
          paperPrice = Number($("#paperPrice").html() ? $("#paperPrice").html() : 0);
          framePrice = Number($("#mainImage").data('price'));
          mat1Price = Number($("#matDetails1_Price").html() ? $("#matDetails1_Price").html() : 0);
          mat2Price = Number($("#matDetails2_Price").html() ? $("#matDetails2_Price").html() : 0);
          mat3Price = Number($("#matDetails3_Price").html() ? $("#matDetails3_Price").html() : 0);

          console.log("Image Price: " + imagePrice.toFixed(2));
          console.log("Paper Price: " + paperPrice);
          console.log("Frame Price: " + framePrice);
          console.log("MAT 1: " + mat1Price);
          console.log("MAT 2: " + mat2Price);
          console.log("MAT 3: " + mat3Price);

          totalPrice = Number(framePrice.toFixed(2)) + Number(imagePrice.toFixed(2)) + Number(paperPrice.toFixed(2)) + Number(mat1Price.toFixed(2)) + Number(mat2Price.toFixed(2)) + Number(mat3Price.toFixed(2));

          console.log(totalPrice.toFixed(2));
          $("#totalPrice").html(totalPrice.toFixed(2));
          




  }

  $('#mat_choice,#mat_image_choice').click(function(evt) {
       evt.preventDefault();        
       $("#mat_value").val($('#mat_choice').data('mat'));
  });

  $('#mat_choice2,#mat_image_choice2').click(function(evt) {      
       evt.preventDefault();       
       $("#mat_value").val($('#mat_choice2').data('mat'));
  });

  $('#mat_choice3,#mat_image_choice3').click(function(evt) {      
       evt.preventDefault();       
       $("#mat_value").val($('#mat_choice3').data('mat'));
  });



  


</script>                  