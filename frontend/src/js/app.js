var app = (function(win,doc){
    'use strict';

    var config = {
            root: doc.querySelector('[data-root]') ? doc.querySelector('[data-root]').value : win.location
        },
        _ = {
            carousel : function(querySelector){
                var elem = doc.querySelector(querySelector);
                if(elem){
                    app.slider = new SimpleSlider(  elem , {
                        autoPlay: true,
                        transitionProperty: 'left',
                        transitionTime: 1,
                        transitionDelay: 5,
                        visibleValue: 1,
                        startValue: elem.offsetWidth + 'px',
                        endValue: 0
                    });
                }

            },
            menu: function(){
                $('.header-menu__link, .header-menu__sub-items').on('mouseover',function(e){
                    $('.header-menu__sub-items').css({display:'none'});
                    $(this).parent().find('.header-menu__sub-items').css({display:'block'});
                });
                $('.header-menu__sub-items').on('mouseout',function(){
                    $(this).css({display:'none'});
                });
            },
            scrollControl: function(){
                var header = doc.querySelector('.header'),
                    logo = header.querySelector('.header-logo img'),
                    tempLogos = {};
                tempLogos.white = new Image();
                tempLogos.white.src = config.root + 'assets/img/logo-white.svg';
                tempLogos.default = new Image();
                tempLogos.default.src = config.root + 'assets/img/logo.svg';
                $(win).on('scroll',function(){
                    if(doc.querySelector('body').scrollTop >  (win.innerHeight - 90) || doc.querySelector('html').scrollTop > (win.innerHeight - 90) ){
                        if( !$(header).hasClass('header-menu__scrolled')){
                            $(header).addClass('header-menu__scrolled');
                        }
                        logo.src = tempLogos.default.src;
                    }else{
                        logo.src = tempLogos.white.src;
                        $(header).removeClass('header-menu__scrolled');
                    }
                });
            }
        };

    return {

        init : function(){
            _.carousel('[data-slider]');
            _.menu();
            _.scrollControl();
        }
    };


})(window,document);