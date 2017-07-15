var app = (function(win,doc){
    'use strict';

    var config = {
            root: doc.querySelector('[data-root]') ? doc.querySelector('[data-root]').value : win.location
        },
        templates = {
            message_form: function(text){
                return "<div class='container-xs form-validation'>" +
                            "<span class='label label-danger'>" +
                                text +
                            "</span>" +
                        "</div>";
            }
        },
        _ = {
            forms: function(){
                $('form').validate();
                $('input[required]').each(function(){
                    $(this).rules('add',{
                        messages: {
                            required: templates.message_form("Este campo es obligatorio")
                        }
                    });
                });

                $('input[data-number]').each(function(){
                    $(this).rules('add',{
                        number: true,
                        messages: {
                            minlength: templates.message_form("Debe ingresar al menos {0} caracter"),
                            number: templates.message_form("Debe ingresar un número")
                        }
                    });
                });

            },
            carousel : function(){
                var elem = doc.querySelector('[data-slider]');
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
            },
            datePicker: function(){
                $('input[data-date--picker]').datepicker();
            }
        };

    _.scrollTo = function(){
        $('[data-scroll]').on('click', function(event){
            if(this.getAttribute('prevent')){
                event.preventDefault();
            }
            var to = this.getAttribute('data-scroll');
            $("html, body").animate({
                scrollTop: ($(to).offset().top - 80) + 'px'
            },200);
        });
    };

    _.newsletter = function(){
        $('.newsletter-subscribe').on('submit',function(event){
            event.preventDefault();
            var btn = this.querySelector('[type="submit"]');
            var textButton = btn.innerHTML;
            var textLoading = btn.getAttribute('data-loading-text');
            btn.innerHTML = textLoading;

            var url = this.getAttribute('action');
            var email = this.querySelector('[type="email"]');
            if(!email.value.match(/(.*)@(.*)\.(.*)/g)){
                btn.innerHTML = textButton;
                return;
            }

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    email: email.value
                }
            }).then(function(data){
                console.log(data);
            }).catch(function(error){
                console.log(error);
            }).always(function(){
                setTimeout(function(){
                    btn.innerHTML = textButton;
                }, 500);
            });
        });
    };

    return {

        init : function(){
            for(var func in _){
                _[func]();
            }
        }
    };


})(window,document);