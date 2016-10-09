(function(win, app){
    'use strict';
    var listener = win.addEventListener ? win.addEventListener : win.attachEvent,
        event = win.addEventListener ? 'load':  'onload';

    listener(event, app.init);

})(window, window.app);