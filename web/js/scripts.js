$(document).ready(function() {
    console.log('jquery ready...');
    var opts = {
        container: 'epiceditor',
        textarea: 'form-markdown',
        basePath: '../EpicEditor-v0.2.2',
        // clientSideStorage: true,
        // localStorageName: 'epiceditor',
        clientSideStorage: false,
        localStorageName: '',
        useNativeFullscreen: true,
        parser: marked,
        file: {
            defaultContent: '',
            autoSave: 10000
        },
        theme: {
            base: '/themes/base/epiceditor.css',
            preview: '/themes/preview/preview-dark.css',
            editor: '/themes/editor/epic-dark.css'
        },
        button: {
            preview: true,
            fullscreen: true,
            bar: "auto"
        },
        focusOnLoad: false,
        shortcut: {
            modifier: 18,
            fullscreen: 70,
            preview: 80
        },
        string: {
            togglePreview: 'Toggle Preview Mode',
            toggleEdit: 'Toggle Edit Mode',
            toggleFullscreen: 'Enter Fullscreen'
        },
        autogrow: {
            minHeight: 450,
            maxHeight: 450
        }
    };

    isis.vars.editor = new EpicEditor(opts);

    // epiceditor init
    if ($('#form-markdown').length > 0) {
        if ($('#form-markdown').text().length > 0) {
            isis.vars.editor.load();
        } else {
            isis.vars.editor.load();
            isis.vars.editor.getElement('editor').body.innerHTML = '';
        }
    }


    // click events
    $('#overlay').unbind().click(function(event) {
        console.log('click overlay...');

        isis.funcs.hideOverlay();
    });

    $('#close-tgr').unbind().click(function(event) {
        console.log('click close trigger...');

        isis.funcs.hideOverlay();
    });

    $('.dialog').unbind().click(function(event) {
        event.stopPropagation();
    });

    // keys events
    $(document).keydown(function(event) {
        console.log('('+event.keyCode+') key down...');

        pressed = event.keyCode;
    });

    $(document).keyup(function(event) {
        console.log('('+event.keyCode+') key up...');
        pressed = null;

        // esc
        if (event.keyCode == 27) {
            isis.funcs.hideOverlay();
        }

        return false;
    });




    $('#console-tgr').unbind().click(function() {
        console.log('console-tgr click...');

        $.get(this.href, function(data) {
            console.log('console-tgr ajax...');
            var tgr = $('#console-tgr');
            tgr.attr('href', tgr.attr('data-href'));

            var stack = tgr.next();
            if (stack.is(':visible')) {
                stack.slideUp(500);
                tgr.text('Konsola (pokaż)');
            } else {
                stack.slideDown(500);
                tgr.text('Konsola (ukryj)');
            }
        }).then(function() {
            console.log('console-tgr click promise...');
        });
        return false;
    });

    


    

    // callbacks

    
    // events
    // console.log('bind event');
    
    
    


    

    // check function to run after load page and execute
    runAfterAction = conf.func;
    if (runAfterAction.substr(-3) == 'Add') {
        runAfterAction = runAfterAction.replace('Add', 'Info');
    }
    // console.log(conf.func + '...');
    if (typeof isis.actions[runAfterAction] == 'function') {
        console.log('runAfterFunction defined...');
        isis.actions[runAfterAction]();
    }

    if (conf.act == 'index') {
        isis.events.bindCommonIndexActionEvent();
    }
    if (conf.act == 'add' || conf.act == 'info') {
        isis.events.bindCommonInfoActionEvent();
    }
});