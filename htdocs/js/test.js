(function(a){a.fn.achtung=function(e){var b=(typeof e==="string"),d=Array.prototype.slice.call(arguments,0),c="achtung";return this.each(function(){var f=a.data(this,c);if(b&&e.substring(0,1)==="_"){return this}(!f&&!b&&a.data(this,c,new a.achtung(this))._init(d));(f&&b&&a.isFunction(f[e])&&f[e].apply(f,d.slice(1)))})};a.achtung=function(d){var b=Array.prototype.slice.call(arguments,0),c;if(!d||!d.nodeType){c=a("<div />");return c.achtung.apply(c,b)}this.$container=a(d)};a.extend(a.achtung,{version:"0.3.0",$overlay:false,defaults:{timeout:10,disableClose:false,icon:false,className:"",animateClassSwitch:false,showEffects:{opacity:"toggle",height:"toggle"},hideEffects:{opacity:"toggle",height:"toggle"},showEffectDuration:500,hideEffectDuration:700}});a.extend(a.achtung.prototype,{$container:false,closeTimer:false,options:{},_init:function(c){var d,b=this;c=a.isArray(c)?c:[];c.unshift(a.achtung.defaults);c.unshift({});d=this.options=a.extend.apply(a,c);if(!a.achtung.$overlay){a.achtung.$overlay=a('<div id="achtung-overlay"></div>').appendTo(document.body)}if(!d.disableClose){a('<span class="achtung-close-button ui-icon ui-icon-close" />').click(function(){b.close()}).hover(function(){a(this).addClass("achtung-close-button-hover")},function(){a(this).removeClass("achtung-close-button-hover")}).prependTo(this.$container)}this.changeIcon(d.icon,true);if(d.message){this.$container.append(a('<span class="achtung-message">'+d.message+"</span>"))}(d.className&&this.$container.addClass(d.className));(d.css&&this.$container.css(d.css));this.$container.addClass("achtung").appendTo(a.achtung.$overlay);if(d.showEffects){this.$container.animate(d.showEffects,d.showEffectDuration)}else{this.$container.show()}if(d.timeout>0){this.timeout(d.timeout)}},timeout:function(c){var b=this;if(this.closeTimer){clearTimeout(this.closeTimer)}this.closeTimer=setTimeout(function(){b.close()},c*1000);this.options.timeout=c},changeClass:function(c){var b=this;if(this.options.className===c){return}this.$container.queue(function(){if(!b.options.animateClassSwitch||/webkit/.test(navigator.userAgent.toLowerCase())||!a.isFunction(a.fn.switchClass)){b.$container.removeClass(b.options.className);b.$container.addClass(c)}else{b.$container.switchClass(b.options.className,c,500)}b.options.className=c;b.$container.dequeue()})},changeIcon:function(c,d){var b=this;if((d!==true||c===false)&&this.options.icon===c){return}if(d||this.options.icon===false){this.$container.prepend(a('<span class="achtung-message-icon ui-icon '+c+'" />'));this.options.icon=c;return}else{if(c===false){this.$container.find(".achtung-message-icon").remove();this.options.icon=false;return}}this.$container.queue(function(){var e=a(".achtung-message-icon",b.$container);if(!b.options.animateClassSwitch||/webkit/.test(navigator.userAgent.toLowerCase())||!a.isFunction(a.fn.switchClass)){e.removeClass(b.options.icon);e.addClass(c)}else{e.switchClass(b.options.icon,c,500)}b.options.icon=c;b.$container.dequeue()})},changeMessage:function(b){this.$container.queue(function(){a(".achtung-message",a(this)).html(b);a(this).dequeue()})},update:function(b){(b.className&&this.changeClass(b.className));(b.css&&this.$container.css(b.css));(typeof(b.icon)!=="undefined"&&this.changeIcon(b.icon));(b.message&&this.changeMessage(b.message));(b.timeout&&this.timeout(b.timeout))},close:function(){var c=this.options,b=this.$container;if(c.hideEffects){this.$container.animate(c.hideEffects,c.hideEffectDuration)}else{this.$container.hide()}b.queue(function(){b.removeData("achtung");b.remove();if(a.achtung.$overlay&&a.achtung.$overlay.is(":empty")){a.achtung.$overlay.remove();a.achtung.$overlay=false}b.dequeue()})}})})(jQuery);




/**
 * achtung 0.3.0
 * 
 * Growl-like notifications for jQuery
 *
 * Copyright (c) 2009 Josh Varner <josh@voxwerk.com>
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @license http://www.opensource.org/licenses/mit-license.php
 * @author Josh Varner <josh@voxwerk.com>
 */

/*globals jQuery,clearTimeout,document,navigator,setTimeout
*/
(function($) {

/**
 * This is based on the jQuery UI $.widget code. I would have just made this
 * a $.widget but I didn't want the jQuery UI dependency.
 */
$.fn.achtung = function(options)
{
        var isMethodCall = (typeof options === 'string'),
                args = Array.prototype.slice.call(arguments, 0),
                name = 'achtung';

        // handle initialization and non-getter methods
        return this.each(function() {
                var instance = $.data(this, name);

                // prevent calls to internal methods
                if (isMethodCall && options.substring(0, 1) === '_') {
                        return this;
                }

                // constructor
                (!instance && !isMethodCall &&
                        $.data(this, name, new $.achtung(this))._init(args));

                // method call
                (instance && isMethodCall && $.isFunction(instance[options]) &&
                        instance[options].apply(instance, args.slice(1)));
        });
};

$.achtung = function(element)
{
    var args = Array.prototype.slice.call(arguments, 0), $el;

    if (!element || !element.nodeType) {
        $el = $('<div />');
        return $el.achtung.apply($el, args);
    }
    
    this.$container = $(element);
};


/**
 * Static members
 **/
$.extend($.achtung, {
    version: '0.3.0',
    $overlay: false,
    defaults: {
        timeout: 10,
        disableClose: false,
        icon: false,
        className: '',
        animateClassSwitch: false,
        showEffects: {'opacity':'toggle','height':'toggle'},
        hideEffects: {'opacity':'toggle','height':'toggle'},
        showEffectDuration: 500,
        hideEffectDuration: 700
    }
});

/**
 * Non-static members
 **/
$.extend($.achtung.prototype, {
    $container: false,
    closeTimer: false,
    options: {},
    
    _init: function(args)
    {
        var o, self = this;

        args = $.isArray(args) ? args : [];

        
        args.unshift($.achtung.defaults);
        args.unshift({});

        o = this.options = $.extend.apply($, args);

        if (!$.achtung.$overlay) {
            $.achtung.$overlay = $('<div id="achtung-overlay"></div>').appendTo(document.body);
        }

        if (!o.disableClose) {
            $('<span class="achtung-close-button ui-icon ui-icon-close" />')
                .click(function () {  self.close();  })
                .hover(function () { $(this).addClass('achtung-close-button-hover'); },
                       function () { $(this).removeClass('achtung-close-button-hover'); })
                .prependTo(this.$container);
        }

        this.changeIcon(o.icon, true);

        if (o.message) {
            this.$container.append($('<span class="achtung-message">' + o.message + '</span>'));
        }

        (o.className && this.$container.addClass(o.className));
        (o.css && this.$container.css(o.css));

        this.$container
            .addClass('achtung')
            .appendTo($.achtung.$overlay);

        if (o.showEffects) {
            this.$container.animate(o.showEffects, o.showEffectDuration);
        } else {
            this.$container.show();
        }

        if (o.timeout > 0) {
            this.timeout(o.timeout);
        }
    },
    
    timeout: function(timeout)
    {
        var self = this;

        if (this.closeTimer) {
            clearTimeout(this.closeTimer);
        }

        this.closeTimer = setTimeout(function() { self.close(); }, timeout * 1000);
        this.options.timeout = timeout;
    },

    /**
     * Change the CSS class associated with this message, using
     * a transition if available (not availble in Safari/Webkit).
     * If no transition is available, the switch is immediate.
     * 
     * #LATER Check if this has been corrected in Webkit or jQuery UI
     * #TODO Make transition time configurable
     * @param newClass string Name of new class to associate
     */
    changeClass: function(newClass)
    {
        var self = this;

        if (this.options.className === newClass) {
            return;
        }

        this.$container.queue(function() {
            if (!self.options.animateClassSwitch ||
                /webkit/.test(navigator.userAgent.toLowerCase()) ||
                !$.isFunction($.fn.switchClass)) {
                self.$container.removeClass(self.options.className);
                self.$container.addClass(newClass);
            } else {
                self.$container.switchClass(self.options.className, newClass, 500);
            }

            self.options.className = newClass;
            self.$container.dequeue();
        });
    },

    changeIcon: function(newIcon, force)
    {
        var self = this;

        if ((force !== true || newIcon === false) && this.options.icon === newIcon) {
            return;
        }

        if (force || this.options.icon === false) {
            this.$container.prepend($('<span class="achtung-message-icon ui-icon ' + newIcon + '" />'));
            this.options.icon = newIcon;
            return;
        } else if (newIcon === false) {
            this.$container.find('.achtung-message-icon').remove();
            this.options.icon = false;
            return;
        }

        this.$container.queue(function() {
            var $span = $('.achtung-message-icon', self.$container);

            if (!self.options.animateClassSwitch ||
                /webkit/.test(navigator.userAgent.toLowerCase()) ||
                !$.isFunction($.fn.switchClass)) {
                $span.removeClass(self.options.icon);
                $span.addClass(newIcon);
            } else {
                $span.switchClass(self.options.icon, newIcon, 500);
            }

            self.options.icon = newIcon;
            self.$container.dequeue();
        });
    },


    changeMessage: function(newMessage)
    {
        this.$container.queue(function() {
            $('.achtung-message', $(this)).html(newMessage);
            $(this).dequeue();
        });
    },


    update: function(options)
    {
        (options.className && this.changeClass(options.className));
        (options.css && this.$container.css(options.css));
        (typeof(options.icon) !== 'undefined' && this.changeIcon(options.icon));
        (options.message && this.changeMessage(options.message));
        (options.timeout && this.timeout(options.timeout));
    },

    close: function() 
    {
        var o = this.options, $container = this.$container;

        if (o.hideEffects) {
            this.$container.animate(o.hideEffects, o.hideEffectDuration);
        } else {
            this.$container.hide();
        }

        $container.queue(function() {
            $container.removeData('achtung');
            $container.remove();
            
            if ($.achtung.$overlay && $.achtung.$overlay.is(':empty')) {
                $.achtung.$overlay.remove();
                $.achtung.$overlay = false;
            }
            
            $container.dequeue();
        });
    }
});

})(jQuery);
