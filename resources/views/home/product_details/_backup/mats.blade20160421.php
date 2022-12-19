<h3>Choose Your Mats <i class="uk-icon-question fsize-12 tooltip light-grey uk-icon-justify"  data-uk-tooltip title="Browse our extensive matting choices and find the perfect fit for your presentation"></i></h3>
                    <div class="uk-grid w100 uk-margin-remove uk-text-large">
                      <div class="uk-width-large-4-10 line-height-select  uk-display-inline form-radio-buttons   uk-width-1-1 uk-padding-remove">
                          <label class=" light uk-margin-small-right" for="matborder_whole">Set Mat Border Width:</label>   
                      </div>

                      <div class="uk-width-large-3-10   uk-display-inline form-radio-buttons  uk-width-1-1 uk-padding-remove">
                          <div class="select-wrapper wrapper-large input-append spinner">
                            <select id="matborder_whole" id="matborder_whole"><option>1</option><option>2</option><option>3</option></select>
                            <div class="add-on"> 
                              <a href="javascript:;" class="spin-up" data-spin="up"><i class="uk-icon-sort-up"></i></a>
                              <a href="javascript:;" class="spin-down" data-spin="down"><i class="uk-icon-sort-down"></i></a>
                            </div>
                          </div>
                      </div>

                      <div class="uk-width-large-3-10   uk-display-inline form-radio-buttons   uk-width-1-1 uk-padding-remove"> 
                          <div class="select-wrapper wrapper-large input-append spinner">
                            <select id="matborder_fractions" id="matborder_fractions"><option>1/2</option><option>2/3</option><option>1/3</option></select> "
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
                                                <input type="checkbox" class="uk-margin-medium-right" id="stm-1" name="option1[]">V-Groove
                                            </label>
                                    </li>
                                    <li>
                                            <label class="uk-form-label light full-width" for="stm-2">
                                                <input type="checkbox" class="uk-margin-medium-right" id="stm-2" name="option1[]">Reverse Bevel Cut
                                            </label>
                                    </li>
                                    <li>
                                            <label class="uk-form-label light full-width" for="stm-2">
                                                <input type="checkbox" class="uk-margin-medium-right" id="stm-2" name="option1[]">Raised Mat
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
                                                <select name="offset2" id="offset2">
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
                                            <label class="uk-form-label light full-width" for="stm-2">
                                                <input type="checkbox" class="uk-margin-medium-right option2" id="stm-2" name="option2[]">Reverse Bevel Cut
                                            </label>
                                    </li>
                                    <li>
                                            <label class="uk-form-label light full-width" for="stm-2">
                                                <input type="checkbox" class="uk-margin-medium-right option2" id="stm-2" name="option2[]">Raised Mat
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
                                                <select name="offset3" id="offset3">
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
                                            <label class="uk-form-label light full-width" for="stm-2">
                                                <input type="checkbox" class="uk-margin-medium-right option3" id="stm-2" name="option3[]">Reverse Bevel Cut
                                            </label>
                                    </li>
                                    <li>
                                            <label class="uk-form-label light full-width" for="stm-2">
                                                <input type="checkbox" class="uk-margin-medium-right option3" id="stm-2" name="option3[]">Raised Mat
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
                                          <a href="#" class="full-width uk-text-center selectMat" onClick="selectedMat('{{ $graphikMatsAPIs->sku }}','{{ $graphikMatsAPIs->shortDescription }}')"> <img src="http://image.pictureframes.com/images/mats/{{ $graphikMatsAPIs->sku }}.gif" > </a>
                                          <div class="uk-thumbnail-caption"><a href="#" class="full-width uk-text-center" onClick="selectedMat('{{ $graphikMatsAPIs->sku }}','{{ $graphikMatsAPIs->shortDescription }}')">{{ $graphikMatsAPIs->shortDescription }}</a></div>
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

    
  $("input[name=mat_type]:radio").change(function () {
      if(this.value == 1) {
        $("#offset2").attr('disabled','disabled');
        $(".option2").attr('disabled','disabled');

        $("#offset3").attr('disabled','disabled');
        $(".option3").attr('disabled','disabled');

        $("#mat_choice2,#mat_choice3,#mat_image_choice2,#mat_image_choice3").removeAttr('data-uk-modal');

        
      } else if(this.value == 2) {
        $("#offset2").removeAttr('disabled');
        $(".option2").removeAttr('disabled');
        $("#mat_choice2,#mat_image_choice2").attr('data-uk-modal','data-uk-modal')

        $("#offset3").attr('disabled','disabled');
        $(".option3").attr('disabled','disabled');
        $("#mat_choice3,#mat_image_choice3").removeAttr('data-uk-modal');
      } else if(this.value == 3) {
          $("#offset3").removeAttr('disabled');
          $(".option3").removeAttr('disabled');          
          $("#mat_choice2,#mat_image_choice2,#mat_choice3,#mat_image_choice3").attr('data-uk-modal','data-uk-modal')
      }
      
  });


  function selectedMat(sku,name) {      
    // $("#selectedMat").removeAttr('data-sku');  
    // $("#selectedMat").removeAttr('data-name'); 
    // $("#selectedMat").removeAttr('data-sku2');  
    // $("#selectedMat").removeAttr('data-name2'); 
    // $("#selectedMat").removeAttr('data-sku3');  
    // $("#selectedMat").removeAttr('data-name3'); 
    $("#selectedMat").removeData('sku'); 
    $("#selectedMat").removeData('name'); 
    
    $("#matDesc").html("  You select " + name);
    //if($("#mat_value").val()==1) {
      $("#selectedMat").attr('data-sku',sku);
      $("#selectedMat").attr('data-name',name);
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
        
         var mat1,mat2,mat3;
         if($("#mat_value").val()==1) {               
           
            $("#mat1").attr('data-sku',$('#selectedMat').data('sku'));
            $("#mat1").attr('src', 'http://image.pictureframes.com/images/mats/'+$('#selectedMat').data('sku')+'.gif')    


            if($('#mat2').data('sku') != "") {
                var newSrc = "https://pod.cloud.graphikservices.com/renderEMF/render?imgUrl={{ url(PRODUCT_IMAGE_PATH.$product->fldProductSlug.'/'.MEDIUM_IMAGE.$product->fldProductImage) }}&imgHI=8&imgWI=11&maxW=400&maxH=400&t=1.5&r=1.5&b=1.5&l=1.5&m1b=1&off=0.375&mat1="+$('#selectedMat').data('sku')+"&sku="+$("#mainImage").attr('data-sku')+"&frameW="+$("#mainImage").attr('data-width')+"&mat2="+$('#mat2').data('sku')+"&off="+$( "#offset2" ).val();
            } else {

              var newSrc = "https://pod.cloud.graphikservices.com/renderEMF/render?imgUrl={{ url(PRODUCT_IMAGE_PATH.$product->fldProductSlug.'/'.MEDIUM_IMAGE.$product->fldProductImage) }}&imgHI=8&imgWI=11&maxW=400&maxH=400&t=1.5&r=1.5&b=1.5&l=1.5&m1b=1&off=0.375&mat1="+$('#selectedMat').data('sku')+"&sku="+$("#mainImage").attr('data-sku')+"&frameW="+$("#mainImage").attr('data-width');
            } 

   
          } else if($("#mat_value").val()==2) {
            $("#mat2").attr('src', 'http://image.pictureframes.com/images/mats/'+$('#selectedMat').data('sku')+'.gif')
            $("#mat2").attr('data-sku',$('#selectedMat').data('sku'));

             var newSrc = "https://pod.cloud.graphikservices.com/renderEMF/render?imgUrl={{ url(PRODUCT_IMAGE_PATH.$product->fldProductSlug.'/'.MEDIUM_IMAGE.$product->fldProductImage) }}&imgHI=8&imgWI=11&maxW=400&maxH=400&t=1.5&r=1.5&b=1.5&l=1.5&m1b=1&off=0.375&mat1="+$('#mat1').data('sku')+"&sku="+$("#mainImage").attr('data-sku')+"&frameW="+$("#mainImage").attr('data-width')+"&mat2="+$('#selectedMat').data('sku')+"&off="+$( "#offset2" ).val();

          } else if($("#mat_value").val()==3) {
            $("#mat3").attr('src', 'http://image.pictureframes.com/images/mats/'+$('#selectedMat').data('sku')+'.gif')
            $("#mat3").attr('data-sku',$('#selectedMat').data('sku'));

             var newSrc = "https://pod.cloud.graphikservices.com/renderEMF/render?imgUrl={{ url(PRODUCT_IMAGE_PATH.$product->fldProductSlug.'/'.MEDIUM_IMAGE.$product->fldProductImage) }}&imgHI=8&imgWI=11&maxW=400&maxH=400&t=1.5&r=1.5&b=1.5&l=1.5&m1b=1&off=0.375&mat1="+$('#mat1').data('sku')+"&sku="+$("#mainImage").attr('data-sku')+"&frameW="+$("#mainImage").attr('data-width')+"&mat2="+$('#mat2').data('sku')+"&off="+$( "#offset2" ).val()+"&mat3="+$('#selectedMat').data('sku')+"&off3="+$( "#offset3" ).val();

          } 

         
          $("#mainImage").attr('src',newSrc);
        
    });

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