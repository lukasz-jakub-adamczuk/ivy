isis.funcs = {
    // functions
    fetchTemplate: function(template) {
        $.get(base + '/pub/fragment/fetch-template/' + template, function(data) {
            return $.parseHTML(data);
        });
    },
    getCurrentDate: function(sep) {
        var now = new Date(),
            sep = sep || '-';
        return now.getUTCFullYear() + sep + (now.getUTCMonth() < 10 ? '0' : '') + (now.getUTCMonth()+1) + sep + (now.getUTCDate() < 10 ? '0' : '') + (now.getUTCDate());
    },
    getCheckboxValue: function(name) {
        // used for upload image form
        var el = $(name);
        if (el.is(':checkbox')) {
            return el.is(':checked') ? true : false;
        } else {
            return el.val() ? true : false;
        }
    },
    showOverlay: function(params) {
        if (params) {
            if (params.header) {
                $('.dialog h3').text(params.header);
            }
            if (params.url) {
                $.get(params.url, function(data) {
                    if (params.iframe) {
                        $('#overlay .content').html(isis.funcs.getIndicator(true) + '<iframe id="previewer" class="preview"></iframe>');

                        var iframe = $('#previewer');
                        iframe.attr('src', params.url);
                        
                        iframe.load(function() {
                            $('#overlay .indicator').remove();
                        });

                    } else {
                        $('#overlay .content').html(data);
                    }
                });
            }
        }
        $('#overlay').removeClass('hidden');
        $('body').addClass('disable-scrolling');
    },
    hideOverlay: function() {
        $('#overlay').addClass('hidden');
        $('body').removeClass('disable-scrolling');
    },
    disableTrigger: function(tgr) {
        if (tgr.type == 'button') {
            tgr.setAttribute('disabled', true);
        }
        if (tgr.href) {
            tgr.setAttribute('data-disabled', true);
        }
    },
    enableTrigger: function(tgr) {
        if (tgr.type == 'button') {
            tgr.removeAttribute('disabled');
        }
        if (tgr.href) {
            tgr.removeAttribute('data-disabled');
        }
    },
    getIndicator: function(visible) {
        return '<div class="indicator'+(visible ? '' : ' hidden')+'"><div class="loading"></div><span></span></div>';
    },
    showIndicator: function(tgr, text) {
        isis.funcs.disableTrigger(tgr);
        
        var indicator, spinner, message;

        indicator = $(tgr).siblings('.indicator');

        if (indicator.length > 0) {
            console.log('indicator exists');
        } else {
            $(tgr).parent().prepend(isis.funcs.getIndicator(false));
            indicator = $(tgr).siblings('.indicator');
        }

        // indicator = tgr.siblings('.indicator');
        spinner = indicator.children('.loading');
        message = indicator.children('span');
        
        message.text(text);
        indicator.removeClass('hidden');
    },
    hideIndicator: function(tgr, text) {
        var indicator, spinner, message;
        
        indicator = $(tgr).siblings('.indicator');
        spinner = indicator.children('.loading');
        message = indicator.children('span');

        setTimeout(function() {
            message.text(text);
        }, 1500);

        setTimeout(function() {
            indicator.addClass('hidden');
            isis.funcs.enableTrigger(tgr);
        }, 2000);
    },
    showButtonIndicator: function(tgr, text) {
        isis.funcs.disableTrigger(tgr);
        
        var indicator, spinner, message;
        var w = tgr.offsetWidth,
            h = tgr.offsetHeight;

            // console.log($(tgr).offsetWidth);

        spinner = $('<div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>');
        
        $(tgr).attr('data-text', $(tgr).text()).html(spinner).css({'width': w, 'height': h});
    },
    hideButtonIndicator: function(tgr, text) {
        var indicator, spinner, message;
        
        // indicator = $(tgr).siblings('.indicator');
        // spinner = indicator.children('.loading');
        // message = indicator.children('span');

        setTimeout(function() {
            $(tgr).text(tgr.getAttribute('data-text'));
        }, 1500);
    }
}