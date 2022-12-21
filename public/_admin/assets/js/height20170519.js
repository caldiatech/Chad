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

                      var f=parseFloat($("#edit-height").val()+c);
                      var b=parseFloat($("#edit-width").val()+e);

                      
                      if($("#edit-maintainproportions").val()=="1") {
                         var f=Math.round(b/d*8)/8;
                      }
                      
                      setCustomHeighAndWidth(b+","+f);
                      
                }

                function setCustomHeighAndWidth(e){
                      var d=e.split(",");
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

                      var f=String(b).split(".");
                      var g=String(c).split(".");

                      if(f.length==1){
                            f[1]="0";
                       }
                      
                      if(g.length==1){
                            g[1]="0";
                      }

                      $("#edit-height").val(f[0]);
                      $("#edit-heightfractions").val("."+f[1]);
                      $("#edit-width").val(g[0]);
                      $("#edit-widthfractions").val("."+g[1]);
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

                   
                    if($("#edit-maintainproportions").val()=="1") {
                      b=Math.round(f*d*8)/8;
                    }

                      $("#edit-current-height").val(f);
                      $("#edit-current-width").val(b);
                      setCustomHeighAndWidth(b+","+f);
                   
                }