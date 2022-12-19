<?php
$get_frames_ctr = 0; $frame_row_counter = $frame_all_counter = 0;
?>

<div class="swiper-nav-container uk-position-relative">
  <div class="swiper-container">
    <div class="swiper-wrapper"> 
      @if($get_static_frames_count > 0)
        @foreach($get_static_frames as $frame_key => $frame_obj)
          <div class="frame-slider-item swiper-slide" data-id="{{$frame_all_counter}}">
          <?php 
          $attr = '';
          $frame_obj_attr = $frame_obj['attributes'];
          foreach($frame_obj_attr as $i => $frame_obj_attr_item){
            if($attr != ''){
              $attr .= ',';
            }
            $attr .= $frame_obj_attr_item;
          } 
          $this_frame_sku = $frame_obj['sku'];
          $this_frame_materials = $frame_obj['material'];
          $this_frame_title = $this_frame_sku. ' ' .$frame_obj['title'];
          $this_frame_width = $frame_obj['width'];
          $this_frame_color = stringify_items($frame_obj['color']);
          $this_frame_style = stringify_items($frame_obj['style']);

          ?>

            <img src="{{url('uploads/photo-gallery/'.$this_frame_sku.'_l.jpg')}}" width="175" height="175" onclick="changeFrame('{{$this_frame_sku}}','{{$this_frame_width}}',0,'{{$this_frame_title}}')" id="frameimg-{{$frame_all_counter}}" alt="{{$this_frame_title}}" data-style="{{$this_frame_style}}" data-color="{{$this_frame_color}}" data-width="{{$this_frame_width}}" data-filter="{{$attr}}" data-sku="{{$this_frame_sku}}" data-material="{{$this_frame_materials}}">
                             
          <?php $get_frames_ctr++; $frame_all_counter++; ?>
          </div>
        @endforeach
      @endif
    </div>  <!-- <div class="swiper-pagination"></div>  -->
      <!-- If we need navigation buttons -->     
  </div>
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div> 
</div>
