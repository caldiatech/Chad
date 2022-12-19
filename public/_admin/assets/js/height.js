var imageWidth;var imageHeight;
function uploadedImage() {
  var img = $('#uploadedImage').attr("src");  
  console.log("img : " + img);

  if(typeof img == "undefined") {
    console.log("image not found");

    var img = $(".thumbnail").find('img').attr("src");
    console.log("img : " + img);
  }
  
  //var img = document.getElementById('uploadedImage');
  //var imageWidth = img.clientWidth;
  //var imageHeight = img.clientHeight; 



  var tmpImg = new Image();
    tmpImg.src= img;
    $(tmpImg).one('load',function(){
      orgWidth = tmpImg.width;
      orgHeight = tmpImg.height;
      if(orgHeight > orgWidth){
       ratio = orgHeight / orgWidth;
       ratio = parseFloat(ratio.toFixed(1));
      }else{
       ratio = orgWidth / orgHeight;
       ratio = parseFloat(ratio.toFixed(1));
      }
      /* console.log("orgWidth " + orgWidth);
       console.log("orgHeight " + orgHeight);
       console.log("ratio " + ratio);*/

       $("#edit-aspectRatio").val(ratio);
    });

  
}

uploadedImage();
 //$("#image").on('change', function(){ uploadedImage(); });
var fraction_option_value = 0;
function updateWidth() {
  e="";
  c="";
  var d=$("#edit-aspectRatio").val();

  if($("#edit-widthfractions").val()!=".0") { 
    var e=$("#edit-widthfractions").val();
  }

  if($("#edit-customheightfractions").val()!=".0") {
    var c=$("#edit-heightfractions").val();
  }

  var f=parseFloat($("#edit-height").val()+c) ;
  var b=parseFloat($("#edit-width").val()+e);

  /* var ratio = d;
  var height = Math.round((b/ratio) * 100) / 100;
  var width = Math.round((height/ratio)* 100) / 100;*/
  var ratio = d;
  console.log('f');
  console.log(f);
  console.log('ratio');
  console.log(ratio);
  var height = Math.round((b/ratio) * 100) / 100;
  var width = b;
  console.log('width');
  console.log(width);
  console.log('height');
  console.log(height);

  setCustomHeighAndWidth(width,height);
  /*
  if($("#edit-maintainproportions").val()=="1") {
   var f=Math.round((b/d)*8)/8;
  }
  setCustomHeighAndWidth(b,f);*/
    
}

function getHeight(length, ratio) {
  var height = ((length)/(Math.sqrt((Math.pow(ratio, 2)+1))));
  return height;
}

function getWidth(length, ratio) {
  var width = ((length)/(Math.sqrt((1)/(Math.pow(ratio, 2)+1))));
  return width;
}
function fraction_convert(i_decimal_part, el_fraction_selection){
  //console.log('fraction_convert '+el_fraction_selection+' for '+i_decimal_part);
  var el_fraction_selection_option_val = 0,
  el_fraction_selection_option_val_temp = 0,
  i_decimal_part_temp = parseFloat(i_decimal_part);
  var elements = document.getElementById(el_fraction_selection).options;
  var has_selected = false;
  for(var i = 0; i < elements.length; i++){
    var el_fraction_selection_option = elements[i];
    //console.log(i_decimal_part + '  <  '+ el_fraction_selection_option.value);
    el_fraction_selection_option_val_temp = el_fraction_selection_option.value;
    if(i_decimal_part_temp < el_fraction_selection_option_val_temp && has_selected == false){
      el_fraction_selection_option_val = el_fraction_selection_option_val_temp;
       elements[i].selected = true; has_selected = true;      
    }else{
       elements[i].selected = false;
    }
  }
  //console.log(el_fraction_selection_option_val);
  return el_fraction_selection_option_val;
}

function updateHeight() {

  e="";
  c="";

  var d=$("#edit-aspectRatio").val();

  if($("#edit-widthfractions").val()!="0") {
    var e=$("#edit-widthfractions").val();
  }

  if($("#edit-heightfractions").val()!="0"){
    var c=$("#edit-heightfractions").val();
  }

  var f=parseFloat($("#edit-height").val()+c);
  var b=parseFloat($("#edit-width").val()+e);
  
  var ratio = d;
  console.log('f');
  console.log(f);
  console.log('ratio');
  console.log(ratio);
  var width = Math.round((f/ratio) * 100) / 100;
  var height = f;
  console.log('width');
  console.log(width);
  console.log('height');
  console.log(height);
  setCustomHeighAndWidth(width,height);

  //$("#edit-current-height").val(f);
  //$("#edit-current-width").val(b);
  //setCustomHeighAndWidth(b,f);

}

function setCustomHeighAndWidth(c,b){
  /*var d=e.split(",");
  d[0]=parseFloat(d[0]);
  d[1]=parseFloat(d[1]);
  var c=d[0];var b=d[1];


  if($("#edit-maintainproportions").val()=="1") {

    if(d[0]>d[1]) {
      var c=d[0];
      var b=d[1];
    } else {
      var c=d[1];
      var b=d[0];
    }

  } else {
    if(d[0]<d[1]) {
      var c=d[0];
      var b=d[1];
    } else { 
      var c=d[1];
      var b=d[0];
    }
  }
*/
  var f=String(b).split("."); // b width
  var g=String(c).split("."); // c width

  if(f.length==1){
    f[1]="0";
  }

  if(g.length==1){
    g[1]="0";
  }

  console.log('setCustomHeighAndWidth(c,b)');
  console.log(c);
  console.log(b);
  console.log('g');
  console.log(g);
  console.log('f');
  console.log(f);
  if(b > c){ // width > heighht
    $("#edit-width").val(g[0]);
    console.log('set #edit-width val = '+g[0]);
    $("#edit-widthfractions").val(fraction_convert(parseFloat("."+g[1]),"edit-widthfractions"));
    console.log('set #edit-widthfractions val = '+g[1]);
    $("#edit-heightfractions").val(fraction_convert(parseFloat("."+f[1]),"edit-heightfractions"));
    console.log('set #edit-heightfractions val = '+f[1]);
  }else{
    $("#edit-height").val(f[0]);
    console.log('set #edit-height val = '+f[0]);
    $("#edit-heightfractions").val(fraction_convert(parseFloat("."+f[1]),"edit-heightfractions"));
    $("#edit-widthfractions").val(fraction_convert(parseFloat("."+g[1]),"edit-widthfractions"));
  }
}
