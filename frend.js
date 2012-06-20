$(function(){
    "use strict";
    FREND.setup();
});

var FREND = (function($) {
    "use strict";

    var f = {};
    
    f.newElements = [
        {name: 'Paragraph', tag: 'p'},
        {name: 'Heading 1', tag: 'h1'},
        {name: 'Heading 2', tag: 'h2'},
        {name: 'Heading 3', tag: 'h3'}
    ];

    f.setup = function() {
        var self = this;

        if (this.isLoggedIn()) {
            $.get('/frend/ui.php', function(data){
                $(data).appendTo('body');
                self.toggleEditor();
                self.bindButtons();
                self.toggleBarPosition($.cookie('frend-bar-position'));
            });
        }
    };

    f.isLoggedIn = function() {
        if ($.cookie('frendauth')) {
            return true;
        }

        return false;
    };

    f.logout = function() {
        $.cookie('frendauth', null);
        $('#frend-bar').remove();
        window.location.reload();
    };

    f.toggleEditor = function() {
        if ($('body').hasClass('frend-content-edit-mode')) {
            $('body').removeClass('frend-content-edit-mode');
            $('.editable').children().each(function(){
                $(this).attr('contenteditable', null).removeClass('frend-content-editable');
            });
            $(this).text('Enable Editor').addClass('active');
        } else {
            $('.editable').children().each(function(){
                $(this).attr('contenteditable', 'true').addClass('frend-content-editable');
            });
            $('body').addClass('frend-content-edit-mode');
            $(this).text('Disable Editor').removeClass('active');
        }
    };

    f.toggleBarPosition = function(jumpTo) {
        var $adminBar = $('#frend-bar');

        if ($adminBar.hasClass('bottom') || jumpTo === 'top') {
            $adminBar.removeClass('bottom');
            $('#frend-bar-switch').html('&#x25BC;');
            $.cookie('frend-bar-position', 'top', {expires: 28});
        } else {
            $adminBar.addClass('bottom');
            $('#frend-bar-switch').html('&#x25B2;');
            $.cookie('frend-bar-position', 'bottom', {expires: 28});
        }
    };

    f.save = function() {
        var $status = $('#frend-bar-status');
        var $button = $(this);
        var $content = $('html').clone();
        var filename = window.location.pathname.split('/').splice(-1,1)[0];
        
        $content = FREND.cleanDom($content);
        
        $button.attr('disabled', 'true');
        $status.html("Saving&hellip;");

        $.ajax('/frend/index.php',{
            type: 'post',
            data: {content: $content.html(), file: filename},
            success: function(data){
                $status.html("Saved!");
                setTimeout(function(){
                    $status.html("");
                    $button.attr('disabled', null);            
                }, 1000);},
            error: function(){
               $status.html("Error! Something went wrong.");
               $button.attr('disabled', null);     
            }
        });
    };
    
    //remove all traces of the edit bar
    f.cleanDom = function($dom) {
        $('#frend-bar, #frend-bar-style', $dom).remove();
        $('.frend-content-edit-mode', $dom).removeClass('frend-content-edit-mode');
        $('.frend-content-editable', $dom).removeClass('frend-content-editable').attr('contentEditable', null);
        $('#frend-new-element', $dom).remove();
        
        //find scripts or css with "chrome-extension://" in the src/href
        $('link[href^=chrome-extension]', $dom).remove();
        $('script[src^=chrome-extension]', $dom).remove();
        
        
        return $dom;
    };
    
    f.toggleNewElement = function() {       
       if ($('body').hasClass('frend-new-element-mode')) {
           $('body').removeClass('frend-new-element-mode');
           $('#frend-new-element').not('select-element').remove();
           $('.frend-content-editable').unbind('mouseover');
           $('body').off('click', '#frend-new-element');
       } else {
           $('body').addClass('frend-new-element-mode');
           $('.frend-content-editable').mouseover(function(){
               $('#frend-new-element').not('select-element').remove();
               $('<div/>')
                   .attr('id', 'frend-new-element')
                       .html("▶ Insert new element here")
                           .insertAfter($(this));
           });
           
           $('body').one('click', '#frend-new-element', function(){
               var $dropdown = $('<select/>');

               $(FREND.newElements).each(function(){
                   $('<option/>').attr('value', this.tag).text(this.name).appendTo($dropdown);
               });
               
               $(this).html($dropdown);
               $('<input/>').attr('type', 'submit').attr('value', 'Insert').appendTo($(this));
               
               $('.frend-content-editable').unbind('mouseover');
           });
           
           $('body').one('click', '#frend-new-element input', function(){
               var elType = $(this).prev('select').attr('value');
               $('<' + elType + '/>')
                   .text('Your content here')
                       .attr('contenteditable', 'true')
                           .addClass('frend-content-editable')
                               .insertAfter($('#frend-new-element'))
                                   .focus()
                                       .selectText();
               
               FREND.toggleNewElement();
                               
               $('#frend-new-element').remove();
           });
       }
    };
    
    f.createLink = function() {
       var uri = prompt("Enter your URL","http://");
       if (uri !== null && uri !== '') {
           document.execCommand('createLink', false, uri);
       }
    };

    f.bindButtons = function() {
        var self = this;
        
        $('#frend-bar-switch').click(self.toggleBarPosition);
        
        $('#frend-bar-save').click(self.save);

        $('#frend-bar-logout').click(self.logout);

        $('#frend-bar-enable').click(self.toggleEditor);
        
        $('#frend-bar-insert').click(self.toggleNewElement);
        
        $('#frend-bar-bold').click(function(){
            document.execCommand('bold');
        });
        
        $('#frend-bar-underline').click(function(){
            document.execCommand('underline');
        });
        
        $('#frend-bar-italic').click(function(){
            document.execCommand('italic');
        });
        
        $('#frend-bar-linebreak').click(function(){
            document.execCommand('insertLineBreak');
        });
        
        $('#frend-bar-link').click(self.createLink);
    };

    return f;
})(jQuery);


/*!
 * jQuery Cookie Plugin
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2011, Klaus Hartl
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.opensource.org/licenses/GPL-2.0
 */
(function($) {
	"use strict";
    $.cookie = function(key, value, options) {

        // key and at least value given, set cookie...
        if (arguments.length > 1 && (!/Object/.test(Object.prototype.toString.call(value)) || value === null || value === undefined)) {
            options = $.extend({}, options);

            if (value === null || value === undefined) {
                options.expires = -1;
            }

            if (typeof options.expires === 'number') {
                var days = options.expires, t = options.expires = new Date();
                t.setDate(t.getDate() + days);
            }

            value = String(value);

            return (document.cookie = [
                encodeURIComponent(key), '=', options.raw ? value : encodeURIComponent(value),
                options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
                options.path    ? '; path=' + options.path : '',
                options.domain  ? '; domain=' + options.domain : '',
                options.secure  ? '; secure' : ''
            ].join(''));
        }

        // key and possibly options given, get cookie...
        options = value || {};
        var decode = options.raw ? function(s) { return s; } : decodeURIComponent;

        var pairs = document.cookie.split('; ');
        for (var i = 0, pair; pair = pairs[i] && pairs[i].split('='); i++) {
            if (decode(pair[0]) === key) return decode(pair[1] || ''); // IE saves cookies with empty string as "c; ", e.g. without "=" as opposed to EOMB, thus pair[1] may be undefined
        }
        return null;
    };
})(jQuery);

jQuery.fn.selectText = function(){
	"use strict";
    var doc = document;
    var element = this[0];
    if (doc.body.createTextRange) {
        var range = document.body.createTextRange();
        range.moveToElementText(element);
        range.select();
    } else if (window.getSelection) {
        var selection = window.getSelection();
        var range = document.createRange();
        range.selectNodeContents(element);
        selection.removeAllRanges();
        selection.addRange(range);
    }
};