<?php
global $mk_options;

//date_default_timezone_set('America/Mexico_City');
//$date = new DateTime("now", new DateTimeZone('America/Mexico_City') );
$mk_footer_class = $show_footer = $disable_mobile = $footer_status = '';

$post_id = global_get_post_id();
if($post_id) {
  $show_footer = get_post_meta($post_id, '_template', true );
  $cases = array('no-footer', 'no-header-footer', 'no-header-title-footer', 'no-footer-title');
  $footer_status = in_array($show_footer, $cases);
}

if($mk_options['disable_footer'] == 'false' || ( $footer_status )) {
  $mk_footer_class .= ' mk-footer-disable';
}

if($mk_options['footer_type'] == '2') {
  $mk_footer_class .= ' mk-footer-unfold';
}


$boxed_footer = (isset($mk_options['boxed_footer']) && !empty($mk_options['boxed_footer'])) ? $mk_options['boxed_footer'] : 'true';
$footer_grid_status = ($boxed_footer == 'true') ? ' mk-grid' : ' fullwidth-footer';
$disable_mobile = ($mk_options['footer_disable_mobile'] == 'true' ) ? $mk_footer_class .= ' disable-on-mobile'  :  ' ';

?>

<section id="mk-footer-unfold-spacer"></section>

<section id="mk-footer" class="<?php echo $mk_footer_class; ?>" <?php echo get_schema_markup('footer'); ?>>
    <?php if($mk_options['disable_footer'] == 'true' && !$footer_status) : ?>
    <div class="footer-wrapper<?php echo $footer_grid_status;?>">
        <div class="mk-padding-wrapper">
            <?php mk_get_view('footer', 'widgets'); ?>
            <div class="clearboth"></div>
        </div>
    </div>
    <?php endif;?>
    <?php mk_get_view('footer', 'sub-footer', false, ['footer_status' => $footer_status, 'footer_grid_status' => $footer_grid_status]); ?>
</section>
</div>
<?php 
global $is_header_shortcode_added;
mk_get_header_view('holders', 'secondary-menu', ['header_shortcode_style' => $is_header_shortcode_added]); ?>
</div>

<div class="bottom-corner-btns js-bottom-corner-btns">
<?php
    mk_get_view('footer', 'navigate-top');
    mk_get_view('footer', 'quick-contact');
    do_action('add_to_cart_responsive');
?>
</div>




<?php
mk_get_header_view('global', 'full-screen-search');
?>


<footer id="mk_page_footer">
    <?php
    
    wp_footer();

    if( (isset($mk_options['pagespeed-optimization']) and $mk_options['pagespeed-optimization'] != 'false')
     or (isset($mk_options['pagespeed-defer-optimization']) and $mk_options['pagespeed-defer-optimization'] != 'false')) {
    ?>
    <script>
        !function(e){var a=window.location,n=a.hash;if(n.length&&n.substring(1).length){var r=e(".vc_row, .mk-main-wrapper-holder, .mk-page-section, #comments"),t=r.filter("#"+n.substring(1));if(!t.length)return;n=n.replace("!loading","");var i=n+"!loading";a.hash=i}}(jQuery);
    </script>
    <?php } else { ?>

    <?php if(!is_front_page() ) { ?>       
        <script>
        // Run this very early after DOM is ready
        (function ($) {
            // Prevent browser native behaviour of jumping to anchor
            // while preserving support for current links (shared across net or internally on page)
            var loc = window.location,
                hash = loc.hash;

            // Detect hashlink and change it's name with !loading appendix
            if(hash.length && hash.substring(1).length) {
                var $topLevelSections = $('.vc_row, .mk-main-wrapper-holder, .mk-page-section, #comments');
                var $section = $topLevelSections.filter( '#' + hash.substring(1) );
                // We smooth scroll only to page section and rows where we define our anchors.
                // This should prevent conflict with third party plugins relying on hash
                if( ! $section.length )  return;
                // Mutate hash for some good reason - crazy jumps of browser. We want really smooth scroll on load
                // Discard loading state if it already exists in url (multiple refresh)
                hash = hash.replace( '!loading', '' );
                var newUrl = hash + '!loading';
                loc.hash = newUrl;
            }


            //ajustes del Datepicker de la tienda, desactivado en la principal
    
                                            
                    var options = $.extend(
                        {},                         
                        $.datepicker.regional["es"],
                        { dateFormat: "d MM, y" } 
                    );



                    $.datepicker.setDefaults(options);
                                                $("body").on("focus", ".wccpf-datepicker-qu_da_planeas_iniciar_tu_detox", function(){
                                        $(this).datepicker( {
                                                                
                        dateFormat:'dd-mm-yy',minDate: 2,beforeShowDay: disableDates,onSelect: function( dateText ) {
                            $(this).next().hide();
                        }                                
                    });
                }); 

               /* function disableDates(date){
                    var disableDays=["saturday"];
                    var day=date.getDay();
                    for(var i=0;i<disableDays.length;i++){
                        var test=disableDays[i]
                            test=test=="sunday"?0:test=="monday"?1:test=="tuesday"?2:test=="wednesday"?3:test=="thursday"?4:test=="friday"?5:test=="saturday"?6:"";
                            
                            if(day==test){return[false];}
                        }
                    
                    var disableDates='05-02-2018';
                    disableDates=disableDates.split(",");var m=date.getMonth();var d=date.getDate();var y=date.getFullYear();var currentdate=(m+1)+'-'+d+'-'+y;
                    for(var i=0;i<disableDates.length;i++){
                    	if($.inArray(currentdate,disableDates)!=-1)
                    		{return[false];}
                    }
					var weekenddate=$.datepicker.noWeekends(date);return weekenddate;return[true];
                }*/

         

                //date picker jugos

              /*  $.datepicker.setDefaults(options);
                  $("body").on("focus", ".wccpf-datepicker-cundo_quieres_tus_jugos", function(){
                      $(this).datepicker( {                                                                
                        dateFormat:'dd-mm-yy',minDate: 1, beforeShowDay: function( date ){ var day = date.getDay();return [ ( day != 6 )];  }  
                        ,onSelect: function( dateText ) {
                            $(this).next().hide();
                        }                                
                    });
                }); 
                
                */


       } (jQuery));    
        

        jQuery(document).ready(function($){     


            //Desactivar días
            // El formato de fecha es: d/m/y, no hay que usar ceros en el mes
            var unavailableDates = ["19-4-2019","12-8-2019","10-8-2019"];

          function check_cdmx(date) {
              dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
              if ($.inArray(dmy, unavailableDates) != -1) {

                  return [false, "", "unAvailable"];
              } else {
                  var day = date.getDay();
                  return [( day != 0)];
              }
          }


          /*Para Cuernavaca se desactiva el día Domingo y Lunes*/
          function check_cuernavaca(date) {
              dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
              if ($.inArray(dmy, unavailableDates) != -1) {

                  return [false, "", "unAvailable"];
              } else {
                  var day = date.getDay();
                  return [( day != 0 && day != 1)];
              }
          }


          function check_puebla(date) {
              dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
              if ($.inArray(dmy, unavailableDates) != -1) {

                  return [false, "", "unAvailable"];
              } else {
                  var day = date.getDay();
                  return [( day == 2 )];
              }
          }
       
            
            $("#en-donde-estas").change(function() {               
               lugar = $(this).val();
            
                if (lugar == "CDMX") {
                     //ajustes del Datepicker de la tienda
                     //console.log(lugar);                       
                     $('.wccpf-datepicker-qu_da_planeas_iniciar_tu_detox').datepicker('setDate', null);

                     $( ".wccpf-datepicker-qu_da_planeas_iniciar_tu_detox" ).datepicker("destroy");

                    
                    $('.wccpf-datepicker-qu_da_planeas_iniciar_tu_detox').datepicker( {
                       minDate: 2,  
                       dateFormat:'dd-mm-yy',                                       
                       beforeShowDay: check_cdmx
                       //beforeShowDay: check_cdmx 
                    });  
                }

                else if(lugar == "CUERNAVACA"){
                     //console.log(lugar); 
                     //ajustes del Datepicker de la tienda                                             
                    $('.wccpf-datepicker-qu_da_planeas_iniciar_tu_detox').datepicker('setDate', null);

                    $( ".wccpf-datepicker-qu_da_planeas_iniciar_tu_detox" ).datepicker("destroy");
                    
                    $('.wccpf-datepicker-qu_da_planeas_iniciar_tu_detox').datepicker( {
                       minDate: 2,    
                       dateFormat:'dd-mm-yy',  
                       beforeShowDay: check_cuernavaca                                 
                                                
                    });             
         
                }

                else if(lugar == "PUEBLA"){
                    $('.wccpf-datepicker-qu_da_planeas_iniciar_tu_detox').datepicker('setDate', null);

                    $( ".wccpf-datepicker-qu_da_planeas_iniciar_tu_detox" ).datepicker("destroy");
                    
                    $('.wccpf-datepicker-qu_da_planeas_iniciar_tu_detox').datepicker( {
                       minDate: 3,    
                       dateFormat:'dd-mm-yy',  
                       beforeShowDay: check_cuernavaca //Aqui había dejado un comentario en la ver. anterior desaparecida; el criterio se hizo igual al de cuerna.                                 
                                                
                    });             
         
                }

            });


            
            // Date picker de los jugos
            //$('.wccpf-datepicker--cundo_quieres_tus_jugos').datepicker('setDate', null);

                     //$( ".wccpf-datepicker-cundo_quieres_tus_jugos" ).datepicker("destroy");

                /*    
                    $('.wccpf-datepicker-cundo_quieres_tus_jugos').datepicker( {
                       minDate: 1,  
                       dateFormat:'dd-mm-yy',                                       
                       beforeShowDay: check_cdmx
                       //beforeShowDay: check_cdmx 
                    });  
                    
                    
                    */
        }); 
    </script>
    <?php } ?>
   
    <?php } ?>


    <?php 
    // Asks W3C Total Cache plugin to move all JS and CSS assets to before body closing tag. It will help getting above 90 grade in google page speed.
    if(isset($mk_options['pagespeed-optimization']) and $mk_options['pagespeed-optimization'] != 'false' and defined('W3TC')) {
        echo "<!-- W3TC-include-js-head -->";
        echo "<!-- W3TC-include-css -->";
    }
    ?>


</footer>  
</body>
</html>


