/*!
 * strength.js
 * Original author: @aaronlumsden
 * Further changes, comments: @aaronlumsden
 * Licensed under the MIT license
 */
;(function ( $, window, document, undefined ) {

    var pluginName = "strength",
        defaults = {
            strengthClass: 'strength',
            strengthMeterClass: 'strength_meter',
            strengthButtonClass: 'button_strength',
            strengthButtonText: 'Show Password',
            strengthButtonTextToggle: 'Hide Password'
        };

       // $('<style>body { background-color: red; color: white; }</style>').appendTo('head');

    function Plugin( element, options ) {
        this.element = element;
        this.$elem = $(this.element);
        this.options = $.extend( {}, defaults, options );
        this._defaults = defaults;
        this._name = pluginName;
        this.init();
    }

    Plugin.prototype = {

        init: function() {


            var characters = 0;
            var capitalletters = 0;
            var loweletters = 0;
            var number = 0;
            var special = 0;

            var upperCase= new RegExp('[A-Z]');
            var lowerCase= new RegExp('[a-z]');
            var numbers = new RegExp('[0-9]');
            var specialchars = new RegExp('([!,%,&,@,#,$,^,*,?,_,~,.])');

            function GetPercentage(a, b) {
                    return ((b / a) * 100);
                }

                function check_strength(thisval,thisid){
                    if (thisval.length > 8) { characters = 1; $('#'+thisid).parent('.text-wrapper').find('.minsize').addClass('green'); } else { characters = -1; $('#'+thisid).parent('.text-wrapper').find('.minsize').removeClass('green'); };
                    if (thisval.match(upperCase)) { capitalletters = 1;  $('#'+thisid).parent('.text-wrapper').find('.capital').addClass('green');} else { capitalletters = 0;  $('#'+thisid).parent('.text-wrapper').find('.capital').removeClass('green'); };
                    if (thisval.match(lowerCase)) { loweletters = 1;  $('#'+thisid).parent('.text-wrapper').find('.lower').addClass('green'); }  else { loweletters = 0;  $('#'+thisid).parent('.text-wrapper').find('.lower').removeClass('green'); };
                    if (thisval.match(numbers)) { number = 1;  $('#'+thisid).parent('.text-wrapper').find('.number').addClass('green'); }  else { number = 0;  $('#'+thisid).parent('.text-wrapper').find('.number').removeClass('green'); };
                    if (thisval.match(specialchars)) { special = 1;  $('#'+thisid).parent('.text-wrapper').find('.special').addClass('green'); }  else { special = 0;  $('#'+thisid).parent('.text-wrapper').find('.special').removeClass('green'); };

                    var total = characters + capitalletters + loweletters + number + special;
                    var totalpercent = GetPercentage(7, total).toFixed(0);

                    if (!thisval.length) {total = -1;}

                    get_total(total,thisid);
                }

            function get_total(total,thisid){

                var thismeter = $('div[data-meter="'+thisid+'"]');
                if (total <= 1) {
                   thismeter.removeClass();
                   thismeter.addClass('pw-veryweak').html('<p>Strength: <span>very weak</span></p>');
                } else if (total == 2){
                    thismeter.removeClass();
                   thismeter.addClass('pw-weak').html('<p>Strength: <span>weak</span></p>');
                } else if(total <= 4){
                    thismeter.removeClass();
                   thismeter.addClass('pw-medium').html('<p>Strength: <span>medium</span></p>');

                } else {
                     thismeter.removeClass();
                   thismeter.addClass('pw-strong').html('<p>Strength: <span>strong</span></p>');
                }

                if (total == -1) { thismeter.removeClass().html('Strength'); }
            }





            var isShown = false;
            var strengthButtonText = this.options.strengthButtonText;
            var strengthButtonTextToggle = this.options.strengthButtonTextToggle;


            thisid = this.$elem.attr('id');

            //this.$elem.addClass(this.options.strengthClass).attr('data-password',thisid).after('<input style="display:none" class="'+this.options.strengthClass+'" data-password="'+thisid+'" type="text" name="" value=""><a data-password-button="'+thisid+'" href="" class="'+this.options.strengthButtonClass+'">'+this.options.strengthButtonText+'</a><div class="'+this.options.strengthMeterClass+'"><div data-meter="'+thisid+'">Strength</div></div>');
            this.$elem.addClass(this.options.strengthClass).attr('data-password',thisid).after('<input style="display:none" class="'+this.options.strengthClass+'" data-password="'+thisid+'" type="text" name="" value=""><div class="'+this.options.strengthMeterClass+'"><div data-meter="'+thisid+'">Strength</div></div>');

            this.$elem.bind('keyup keydown', function(event) {
                thisval = $('#'+thisid).val();
                $('input[type="password"][data-password="'+thisid+'"]').val(thisval);
                check_strength(thisval,thisid);

            });

             $('input[type="password"][data-password="'+thisid+'"]').bind('keyup keydown', function(event) {
                thisval = $('input[type="password"][data-password="'+thisid+'"]').val();
                $('input[type="password"][data-password="'+thisid+'"]').val(thisval);
                check_strength(thisval,thisid);

            });



            $(document.body).on('click', '.'+this.options.strengthButtonClass, function(e) {
                e.preventDefault();

               thisclass = 'hide_'+$(this).attr('class');




                if (isShown) {
                    $('input[type="password"][data-password="'+thisid+'"]').hide();
                    $('input[type="password"][data-password="'+thisid+'"]').show().focus();
                    $('a[data-password-button="'+thisid+'"]').removeClass(thisclass).html(strengthButtonText);
                    isShown = false;

                } else {
                    $('input[type="password"][data-password="'+thisid+'"]').show().focus();
                    $('input[type="password"][data-password="'+thisid+'"]').hide();
                    $('a[data-password-button="'+thisid+'"]').addClass(thisclass).html(strengthButtonTextToggle);
                    isShown = true;

                }



            });




        },

        yourOtherFunction: function(el, options) {
            // some logic
        }
    };

    // A really lightweight plugin wrapper around the constructor,
    // preventing against multiple instantiations
    $.fn[pluginName] = function ( options ) {
        return this.each(function () {
            if (!$.data(this, "plugin_" + pluginName)) {
                $.data(this, "plugin_" + pluginName, new Plugin( this, options ));
            }
        });
    };

})( jQuery, window, document );


