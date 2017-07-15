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
// REF:
// https://github.com/ruyadorno/SimpleSlider/
//
(function (context, definition) {

    'use strict';
    if (typeof module != 'undefined' && module.exports) {
        module.exports = definition();
    } else if (typeof define == 'function' && define.amd) {
        define(function() {
            return (window.SimpleSlider = definition());
        });
    } else {
        context.SimpleSlider = definition();
    }

})(this, function () {

    'use strict';

    // requestAnimationFrame polyfill

    if (!Date.now)
        Date.now = function() { return new Date().getTime(); };

    var vendors = ['webkit', 'moz'];
    for (var i = 0; i < vendors.length && !window.requestAnimationFrame; ++i) {
        var vp = vendors[i];
        window.requestAnimationFrame = window[vp+'RequestAnimationFrame'];
        window.cancelAnimationFrame = (window[vp+'CancelAnimationFrame'] || window[vp+'CancelRequestAnimationFrame']);
    }

    if (/iP(ad|hone|od).*OS 6/.test(window.navigator.userAgent) || // iOS6 is buggy
        !window.requestAnimationFrame || !window.cancelAnimationFrame) {
        var lastTime = 0;
        window.requestAnimationFrame = function(callback) {
            var now = Date.now();
            var nextTime = Math.max(lastTime + 16, now);
            return setTimeout(function() { callback(lastTime = nextTime); }, nextTime - now);
        };
        window.cancelAnimationFrame = clearTimeout;
    }

    // visibilitychange setup, from: https://developer.mozilla.org/en-US/docs/Web/Guide/User_experience/Using_the_Page_Visibility_API
    var hidden, visibilityChange, hasVisibilityHandler;
    if (typeof document.hidden !== "undefined") { // Opera 12.10 and Firefox 18 and later support
        hidden = "hidden";
        visibilityChange = "visibilitychange";
    } else if (typeof document.mozHidden !== "undefined") {
        hidden = "mozHidden";
        visibilityChange = "mozvisibilitychange";
    } else if (typeof document.msHidden !== "undefined") {
        hidden = "msHidden";
        visibilityChange = "msvisibilitychange";
    } else if (typeof document.webkitHidden !== "undefined") {
        hidden = "webkitHidden";
        visibilityChange = "webkitvisibilitychange";
    }

    // ------------------

    function getdef(val, def){
        return val===undefined || val===null || val==='' ? def : val;
    }

    // Extracts the unit from a css value
    function getUnit(args, transitionProperty) {

        var item;
        var count = args.length;
        var unit = '';

        while (--count >= 0) {
            item = args[count];
            if (typeof item === 'string') {
                unit = item
                    .replace(parseInt(item, 10) + '', '');
            }
        }

        // Defaults unit to px if transition property isn't opacity
        if (transitionProperty !== 'opacity' && unit === '') {
            unit = 'px';
        }

        return unit;

    }

    // Test if have children and throw warning otherwise
    function testChildrenNum(value) {

        if (value <= 0) {
            try {
                console.warn(
                    'A SimpleSlider main container element' +
                    'should have at least one child.'
                );
            } catch(e) {}

            return true;

        } else {

            return false;
        }

    }

    function anim(target, prop, unit, transitionDuration, startTime, elapsedTime, fromValue, toValue, easeFunc, scope, cb){

        function loop(_cb) {

            window.requestAnimationFrame(function requestAnimationFunction(time){

                // Starts time in the first anim iteration
                if (startTime === 0) {
                    startTime = time;
                }

                anim(target, prop, unit, transitionDuration, startTime, time, fromValue, toValue, easeFunc, scope, _cb);

            });
        }

        var newValue;

        if (startTime > 0) {

            newValue = easeFunc(elapsedTime - startTime, fromValue, toValue - fromValue, transitionDuration);

            if (elapsedTime - startTime <= transitionDuration) {

                target[prop] = newValue + unit;

            } else {

                target[prop] = (toValue) + unit;

                if (scope && cb) {
                    cb.call(scope);
                    cb = null;
                }
                return;
            }
        }

        loop(cb);

    }

    function startSlides(container, unit, startValue, visibleValue, transitionProperty) {

        var imgs = [];
        var i = container.children.length;

        while (--i >= 0) {
            imgs[i] = container.children[i];
            imgs[i].style.position = 'absolute';
            imgs[i].style.top = '0' + unit;
            imgs[i].style.left = '0' + unit;
            imgs[i].style[transitionProperty] = startValue + unit;
            imgs[i].style.zIndex = 0;
        }

        imgs[0].style[transitionProperty] = visibleValue + unit;
        imgs[0].style.zIndex = 1;

        return imgs;

    }

    function manageRemovingSlideOrder(oldSlide, newSlide) {

        newSlide.style.zIndex = 3;

        if (oldSlide) {
            oldSlide.style.zIndex = 1;
        }

        return newSlide;
    }

    function manageInsertingSlideOrder(oldSlide, newSlide) {

        newSlide.style.zIndex = 4;

        if (oldSlide) {
            oldSlide.style.zIndex = 2;
        }

        return newSlide;
    }

    function parseStringToBoolean(value) {

        if (value === 'false') {
            return false;
        } else {
            return value;
        }

    }

    function updateVisibility(slider) {
        if (document[hidden]) {
            slider.pauseAutoPlay();
        } else {
            slider.resumeAutoPlay();
        }
    }

    // ------------------

    var SimpleSlider = function(containerElem, options){

        this.containerElem = containerElem;
        this.interval = null;

        // User might not send any custom options at all
        if( !options ) {
            options = {};
        }

        var width = parseInt(this.containerElem.style.width || this.containerElem.offsetWidth, 10);

        // Get user defined options or its default values
        this.trProp = getdef(options.transitionProperty, 'left');
        this.trTime = getdef(options.transitionDuration, 0.5);
        this.delay = getdef(options.transitionDelay, 3) * 1000;
        this.unit = getUnit([options.startValue, options.visibleValue, options.endValue], this.trProp);
        this.startVal = parseInt(getdef(options.startValue, -width + this.unit), 10);
        this.visVal = parseInt(getdef(options.visibleValue, '0' + this.unit), 10);
        this.endVal = parseInt(getdef(options.endValue, width + this.unit), 10);
        this.autoPlay = getdef(parseStringToBoolean(options.autoPlay), true);
        this.ease = getdef(options.ease, SimpleSlider.defaultEase);
        this.onChange = getdef(options.onChange, null);
        this.onChangeEnd = getdef(options.onChangeEnd, null);

        this.init();
    };

    SimpleSlider.defaultEase = function (time, begin, change, duration) {

        if ((time = time / (duration / 2)) < 1) {
            return change / 2 * time * time * time + begin;
        } else {
            return change / 2 * ((time -= 2) * time * time + 2) + begin;
        }

    };

    SimpleSlider.easeNone = function(time, begin, change, duration) {

        return change * time / duration + begin;

    };

    SimpleSlider.prototype.init = function() {

        this.reset();
        this.configSlideshow();

    };

    SimpleSlider.prototype.reset = function() {

        if (testChildrenNum(this.containerElem.children.length)) {
            return; // Skip reset logic if don't have children
        }

        this.containerElem.style.position = 'relative';
        this.containerElem.style.overflow = 'hidden';
        this.containerElem.style.display = 'block';

        this.imgs = startSlides(this.containerElem, this.unit, this.startVal, this.visVal, this.trProp);

        this.actualIndex = 0;
        this.inserted = null;
        this.removed = null;
        this.remainingTime = this.delay;

    };

    SimpleSlider.prototype.configSlideshow = function() {

        if (!this.imgs) {
            return false;
        }

        this.startInterval();

    };

    SimpleSlider.prototype.startInterval = function () {

        var self = this;

        if (!this.isAutoPlayable()) {
            return;
        }

        if (this.interval) {
            window.clearTimeout(this.interval);
        }

        // Slideshow/autoPlay timing logic
        (function setInterval() {
            self.intervalStartTime = Date.now();
            self.interval = window.setTimeout(function(){

                self.intervalStartTime = Date.now();
                self.remainingTime = self.delay; // resets time, used by pause/resume logic

                self.change(self.nextIndex());

                // loops
                setInterval();

            }, self.remainingTime);
        })();

        // Handles user leaving/activating the current page/tab
        (function handleVisibilityChange() {

            if (!hasVisibilityHandler && typeof document.addEventListener !== "undefined") {

                document.addEventListener(visibilityChange, function onVisibilityChange() {

                    updateVisibility(self);
                }, false);

                // only assign handler once
                hasVisibilityHandler = true;
            }
        })();

    };

    SimpleSlider.prototype.isAutoPlayable = function () {
        return this.autoPlay && this.imgs.length > 1;
    };

    SimpleSlider.prototype.pauseAutoPlay = function () {

        if (!this.isAutoPlayable()) {
            return;
        }

        this.remainingTime = (this.delay) - (Date.now() - this.intervalStartTime);

        window.clearTimeout(this.interval);
        this.interval = null;

    };

    SimpleSlider.prototype.resumeAutoPlay = function () {

        this.startInterval();

    };

    SimpleSlider.prototype.startAnim = function(target, fromValue, toValue, cb){

        anim(target.style, this.trProp, this.unit, this.trTime * 1000, 0, 0, fromValue, toValue, this.ease, this, cb);

    };

    SimpleSlider.prototype.endAnim = function() {

        if (this.onChangeEnd ||
            Object.prototype.toString.call(this.onChangeEnd) == '[object Function]') {

            this.onChangeEnd(this.actualIndex, this.nextIndex());
        }

    };

    SimpleSlider.prototype.remove = function(index){

        this.removed = manageRemovingSlideOrder(this.removed, this.imgs[index]);

        this.startAnim(this.imgs[index], this.visVal, this.endVal);

    };

    SimpleSlider.prototype.insert = function(index){

        this.inserted = manageInsertingSlideOrder(this.inserted, this.imgs[index]);

        this.startAnim(this.imgs[index], this.startVal, this.visVal, this.endAnim);

    };

    SimpleSlider.prototype.change = function(newIndex){

        var prevIndex = this.actualIndex;

        this.remove(this.actualIndex);
        this.insert(newIndex);

        this.actualIndex = newIndex;

        if (this.onChange ||
            Object.prototype.toString.call(this.onChange) == '[object Function]') {

            this.onChange(prevIndex, this.actualIndex);
        }

    };

    SimpleSlider.prototype.next = function(){

        this.change(this.nextIndex());

        this.startInterval();

    };

    SimpleSlider.prototype.prev = function(){

        this.change(this.prevIndex());

        this.startInterval();

    };

    SimpleSlider.prototype.nextIndex = function(){

        var newIndex = this.actualIndex+1;

        if (newIndex >= this.imgs.length) {
            newIndex = 0;
        }

        return newIndex;

    };

    SimpleSlider.prototype.prevIndex = function(){

        var newIndex = this.actualIndex-1;

        if (newIndex < 0) {
            newIndex = this.imgs.length-1;
        }

        return newIndex;

    };

    SimpleSlider.prototype.dispose = function(){

        window.clearTimeout(this.interval);

        if (this.imgs) {
            var i = this.imgs.length;
            while (--i >= 0) {
                this.imgs.pop();
            }
            this.imgs = null;
        }

        this.containerElem = null;
        this.interval = null;
        this.trProp = null;
        this.trTime = null;
        this.delay = null;
        this.startVal = null;
        this.endVal = null;
        this.autoPlay = null;
        this.actualIndex = null;
        this.inserted = null;
        this.removed = null;
        this.remainingTime = null;
        this.onChange = null;
        this.onChangeEnd = null;
    };

    return SimpleSlider;

});
(function(win, app){
    'use strict';
    var listener = win.addEventListener ? win.addEventListener : win.attachEvent,
        event = win.addEventListener ? 'load':  'onload';

    listener(event, app.init);

})(window, window.app);