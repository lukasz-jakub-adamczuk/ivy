isis.events = {
    bindCommonIndexActionEvent: function() {
        isis.events.massActionsEvent();
    },
    bindCommonInfoActionEvent: function() {
        isis.events.addClickEvent();
        isis.events.saveClickEvent();

        isis.events.toggleVisibilityClickEvent();
    },

    massActionsEvent: function() {
        // mass actions disabled for default
        var massActions = $('.mass-actions .button');
        if (massActions.length > 0) {
            $.each(massActions, function(idx, itm) {
                $(this).attr('disabled', true);
            });
        }

        // maybe refactoring need for better performance
        var massCheckboxes = 0;
        $('.mass-checkbox').change(function() {
            this.checked ? massCheckboxes++ : massCheckboxes--;

            if (massCheckboxes) {
                $.each(massActions, function(idx, itm) {
                    $(this).attr('disabled', false);
                });
            } else {
                $.each(massActions, function(idx, itm) {
                    $(this).attr('disabled', true);
                });
            }
        });
    },


    addClickEvent: function() {
        $('[data-js=add]').unbind().click(function() {
            if ($('#form-markdown').length > 0) {
                // editor must change mode to update html content
                isis.vars.editor.preview();
                isis.vars.editor.edit();

                var previewBody = isis.vars.editor.getElement('previewer').body;
                var theContent = $(isis.vars.editor.getElement('previewer').body).children('div').html();

                $('#form-markup').text(theContent).html();

                // return false;
            }
        });
    },
    saveClickEvent: function() {
        $('[data-js=save]').unbind().click(function() {
            // ...
            var self = this;
            
            isis.funcs.showButtonIndicator(this, 'Zapisywanie');

            if ($('#form-markdown').length > 0) {
                // editor must change mode to update html content
                isis.vars.editor.preview();
                isis.vars.editor.edit();

                var previewBody = isis.vars.editor.getElement('previewer').body;
                var theContent = $(isis.vars.editor.getElement('previewer').body).children('div').html();

                $('#form-markup').text(theContent).html();
            }
            
            // be sure to send right form
            $.post(
                $('article section form').attr('action'), $('article section form').serialize()
            ).then(function(data) {
                isis.funcs.hideButtonIndicator(self, 'Zapisano.');

                // callback for cover photo
                var callback = $('.messages .callback', data).text() || null;
                if (callback) {
                    if (typeof window[callback] == 'function') {
                        window[callback](data);
                    }
                }
            });

            return false;
        });
    },
    publishClickEvent: function() {
        $('[data-js=publish]').unbind().click(function() {
            // ...
            var self = this;
            
            isis.funcs.showButtonIndicator(this, 'Zapisywanie');

            if ($('#form-markdown').length > 0) {
                // editor must change mode to update html content
                isis.vars.editor.preview();
                isis.vars.editor.edit();

                var previewBody = isis.vars.editor.getElement('previewer').body;
                var theContent = $(isis.vars.editor.getElement('previewer').body).children('div').html();

                $('#form-markup').text(theContent).html();
            }
            $('#form-visible').attr('checked', true);
            
            // be sure to send right form
            $.post(
                $('article section form').attr('action'), $('article section form').serialize()
            ).then(function(data) {
                isis.funcs.hideButtonIndicator(self, 'Zapisano.');

                // callback for cover photo
                var callback = $('.messages .callback', data).text() || null;
                if (callback) {
                    if (typeof window[callback] == 'function') {
                        window[callback](data);
                    }
                }
            });

            return false;
        });
    },
    previewClickEvent: function() {
        $('[data-js=preview]').unbind().click(function() {
            // ...
            var url = $('#form-resource-url').val(),
                category = $('#form-category option:selected').attr('data-category-slug'),
                slug = $('#form-slug').val();

            // console.log(category);
            // console.log(slug);

            url = url.replace('category', category).replace('slug', slug);

            if (!url) {
                console.log('url unknown');
                // url = site + '/index.php?ctrl=article&act=info&category='+category+'&slug='+slug;
            }

            // console.log(url);
            
            isis.funcs.showOverlay({
                header: 'Podgląd',
                url: url,
                iframe: true
            });

            
            return false;
        });
    },
    promoteClickEvent: function() {
        $('[data-js=promote]').unbind().click(function() {
            // ...
            isis.events.addClickEvent();
        });
    },
    deleteClickEvent: function() {
        $('[data-js=delete]').unbind().click(function() {
            // ...
        });
    },
    undeleteClickEvent: function() {
        $('[data-js=undelete]').unbind().click(function() {
            // ...
        });
    },
    approveClickEvent: function() {
        // for lobby form
        $('[data-js=approve]').unbind().click(function() {
            if ($('#form-markdown').length > 0) {
                // editor must change mode to update html content
                isis.vars.editor.preview();
                isis.vars.editor.edit();

                var previewBody = isis.vars.editor.getElement('previewer').body;
                var theContent = $(isis.vars.editor.getElement('previewer').body).children('div').html();

                $('#form-markup').text(theContent).html();
            }

            console.log('sending form...');
            
            $.post($('form').attr('action').replace('update', 'approve'), $('form').serialize());

            return false;
        });
    },
    acceptClickEvent: function() {
        // accept comments
        $('[data-js=accept]').unbind().click(function(event) {
            console.log('click get (accept) request...');
            var self = this;
            
            if (this.getAttribute('data-disabled') == true) {
                return false;
            }
            isis.funcs.showIndicator(this, '');

            $(this).parent().css({'visibility': 'visible'});

            $.get(
                this.href
            ).then(function() {
                $(self).parents('li').removeClass('unverified');
                isis.funcs.hideIndicator(self, '');
            });

            return event.preventDefault();
        });
    },
    removeClickEvent: function() {
        // remove comments, existing images for news
        $('[data-js=remove]').unbind().click(function(event) {
            console.log('click get (remove) request...');
            var self = this;

            if (this.getAttribute('data-disabled') == true) {
                return false;
            }
            isis.funcs.showIndicator(this, '');

            $(this).parent().css({'visibility': 'visible'});

            $.get(
                this.href
            ).then(function() {
                $(self).parents('li').fadeOut(1000).remove();
            });

            return event.preventDefault();
        });
    },
    chooseClickEvent: function() {
        // choose images
        $('[data-js=choose]').unbind().click(function(event) {
            console.log('choose click definition...');
            // var self = this;

            if (this.getAttribute('data-disabled') == true) {
                return false;
            }
            // isis.funcs.showIndicator(this, '');


            var imgs = $('#tab-chosen .thumbnail img');

            var html = '';
            $.each(imgs, function(idx, itm) {
                if (news = $(itm).attr('data-news-image')) {
                    html += '<input name="imgs[used]['+news+']" type="hidden" value="' + $(itm).attr('data-asset') + '">';
                } else {
                    html += '<input name="imgs[new][]" type="hidden" value="' + $(itm).attr('data-asset') + '">';
                }
            });
            // var images
            $('#images p').html(html);
            $('#images span').text('Wybrano ' + imgs.length + ' obrazów.');

            isis.funcs.hideOverlay();

            return event.preventDefault();
        });
    },
    markClickEvent: function() {
        // mark feed items
        $('[data-js=mark]').unbind().click(function(event) {
            console.log('click get (mark) request...');
            var self = this;
            
            if (this.getAttribute('data-disabled') == true) {
                return false;
            }
            isis.funcs.showIndicator(this, '');

            $(this).parent().css({'visibility': 'visible'});

            $.get(
                this.href
            ).then(function() {
                $(self).parents('li').removeClass('unverified');
                isis.funcs.hideIndicator(self, '');

                var counter = $('.active .count')[0];
                var value = parseInt(counter.getAttribute('data-count'))-1;
                counter.setAttribute('data-count', value);
                if (value == 0) {
                    counter.removeAttribute('class');
                }

                var counter = $('#notification-tgr')[0];
                var value = parseInt(counter.getAttribute('data-count'))-1;
                counter.setAttribute('data-count', value);
                if (value == 0) {
                    counter.removeAttribute('class');
                }
            });

            return event.preventDefault();
        });
    },
    lockClickEvent: function() {
        // lock feed item before writing news
        $('[data-js=lock]').unbind().click(function(event) {
            var self = this;
            if (this.getAttribute('data-disabled') == true) {
                return false;
            }

            $.get(
                this.href
            ).then(function() {
                $(self).unbind().attr('href', self.href.replace('lock', 'unlock')).attr('data-js', 'unlock').attr('title', 'Odblokuj').removeClass('gray').addClass('black');
                isis.events.unlockClickEvent();
            });

            return event.preventDefault();
        });
    },
    unlockClickEvent: function() {
        // unlock feed item after writing news
        $('[data-js=unlock]').unbind().click(function(event) {
            var self = this;
            if (this.getAttribute('data-disabled') == true) {
                return false;
            }

            $.get(
                this.href
            ).then(function() {
                $(self).unbind().attr('href', self.href.replace('unlock', 'lock')).attr('data-js', 'lock').attr('title', 'Zablokuj').removeClass('black').addClass('gray');
                isis.events.lockClickEvent();
            });

            return event.preventDefault();
        });
    },
    uploadButtonClickEvent: function(type) {
        $('[data-js=upload]').unbind().click(function() {
            // add an image as cover photo
            var self = this;
            console.log('upload-image...');

            var form = $('#upload-file-form'),
                path = $('#upload-form-path');

            
            path = path.val();

            isis.funcs.showButtonIndicator(this, 'Wgrywanie.');

            $('#upload-file-form').submit(function(event) {
                //disable the default form submission
                event.preventDefault();

                //grab all form data  
                var formData = new FormData($(this)[0]);

                console.log($(this)[0]);
                return false;

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false

                }).done(function(data) {
                    isis.funcs.hideButtonIndicator(self, 'Wgrano.');
                    var file = '/' + path.split(',').join('/') + '/' + $('.messages .info strong', data).text();
                    $('#tab-new > div').append('<img src="' + site + file + '" width="160" height="120" class="img-thumb">');

                    isis.events.imageFragmentClickEvent(type, file);
                });
            });
            $('#upload-file-form').submit();

            return false;
        });
    },
    downloadButtonClickEvent: function(type) {
        $('[data-js=download]').unbind().click(function() {
            // add an image as cover photo

            var action = $('#download-file-form').attr('action'),
                path = $('input[name=path]')[0].value,
                urls = $('#form-urls').val(),
                automatic = $('#form-download-automatic-names').is(':checked') ? true : false,
                overrides = $('#form-download-override-files').is(':checked') ? true : false;

            // urls = JSON.parse(urls);
            urls = urls.split("\n");

            console.log(urls);

            $.get(
                action.replace('download-file', 'index') + '/' + path,
                function(data) {
                    $('article').html($('article', data).html());
                }
            ).then(function() {
                // $.urls
                var count = parseInt($('#files-count').text()),
                    name,
                    params,
                    number,
                    files = count;
                $.each(urls, function(idx, itm) {
                    if (itm.trim()) {
                        params = {};
                        params['dataset[urls]'] = itm;
                        params['path'] = path;
                        if (automatic) {
                            // strpad
                            number = count + '';
                            while (number.length < 3)
                                number = '0' + number;
                            params['name'] = 'img-'+(number);
                            count++;
                        }
                        // $.post(action, {'dataset[urls]': itm, 'path': path})
                        $.post(action, params)
                            .done(function(data) {
                                files++;
                                name = $('.messages .info strong', data).text();
                                $('.dir-content').append($('<input id="file-'+files+'" name="files[]" type="checkbox" value="'+site+'/'+path.split(',').join('/')+'/'+name+'">                     <div>                           <span class="res icon-image image-thumbnail"><img src="'+base+'/'+path.split(',').join('/')+'/'+name+'"></span>                            <label for="file-'+files+'">'+name+'</label>                        </div>'));
                                $('#files-count').text(files);
                            }
                        );
                    }
                });
                console.log('ready to fetch images...');
            });

            return false;
        });
    },
    uploadImageClickEvent: function(type, callback) {
        $('[data-js=upload-image]').unbind().click(function() {
            // add an image as cover photo
            var self = this;
            console.log('upload-image...');

            var form = $('#upload-file-form'),
                path = $('#upload-form-path');

            // path shouldn't be empty
            if (path.val() == '') {
                if (type == 'logo') {
                    path.val('assets,games,' + $('#form-category option:selected').attr('data-category-abbr') + '');
                }
                if (type == 'cover') {
                    path.val('assets,backgrounds,' + $('#form-category option:selected').attr('data-category-abbr') + '');
                }
                if (type == 'news') {
                    path.val('assets,news,' + '...');
                }
            }

            path = path.val();

            isis.funcs.showButtonIndicator(this, 'Wgrywanie.');

            $('#upload-file-form').submit(function(event) {
                //disable the default form submission
                event.preventDefault();

                //grab all form data  
                var formData = new FormData($(this)[0]);

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false

                }).done(function(data) {
                    isis.funcs.hideButtonIndicator(self, 'Wgrano.');
                    if (type == 'logo' || type == 'cover') {
                        var file = '/' + path.split(',').join('/') + '/' + $('.messages .info strong', data).text();
                        $('#tab-new > div').append('<img src="' + site + file + '" width="160" height="120" class="img-thumb">');

                        isis.events.imageFragmentClickEvent(type, file);
                    }
                    if (type = 'news') {
                        var files = $('.messages .info strong', data).text().split(', '),
                            asset = '/' + path.split(',').join('/') + '/',
                            images = '';

                        $.each(files, function(idx, itm) {
                            images += '<li><figure class="thumbnail"><span class="icon-close" data-js="remove-image"></span><img src="' + base + asset + itm + '" width="120" height="120" data-asset="' + asset + itm + '" data-type="new"></figure></li>';
                        });
                        $('#sortable-images').append(images);
                    }
                });
            });
            $('#upload-file-form').submit();

            if (callback) {
                callback();
            }

            return false;
        });
    },
    downloadImageClickEvent: function(type, callback) {
        $('[data-js=download-image]').unbind().click(function() {

            // add an image as cover photo
            var self = this;
            console.log('download-image...');
            // http://graphics8.nytimes.com/newsgraphics/2013/10/13/russia/assets/medium/chernayaGryaz_001.jpg

            var path = $('#download-form-path');

            if (path.val() == '') {
                if (type == 'logo') {
                    path.val('assets,games,' + $('#form-category option:selected').attr('data-category-abbr') + '');
                }
                if (type == 'cover') {
                    path.val('assets,games,' + $('#form-category option:selected').attr('data-category-abbr') + ',backgrounds');
                }
                if (type == 'news') {
                    path.val('assets,news,' + '...');
                }
            }

            var action = $('#download-file-form').attr('action'),
                urls = $('#form-urls').val(),
                automatic = isis.funcs.getCheckboxValue('#form-download-automatic-names'),
                overrides = $('#form-download-override-files').is(':checked') ? true : false;

            path = path.val();
            // urls = JSON.parse(urls);

            // need to know how many images downloading
            var items = urls.split('\n');
            console.log(items.length);

            $('#tab-new > div')


            isis.funcs.showButtonIndicator(this, 'Ściąganie.');

            var params = {};
            params['dataset[urls]'] = urls;
            params['path'] = path;
            params['options[automatic-names]'] = automatic;
            params['options[override-files]'] = overrides;

            console.log(type);

            $.post(
                action, params
            ).then(function(data) {
                isis.funcs.hideButtonIndicator(self, 'Ściągnięto.');
                if (type == 'logo' || type == 'cover') {
                    var file = '/' + path.split(',').join('/') + '/' + $('.messages .info strong', data).text();
                    $('#tab-new > div').append('<img src="' + site + file + '" width="160" height="120" class="img-thumb">');

                    isis.events.imageFragmentClickEvent(type, file);
                }
                if (type == 'news') {
                    var files = $('.messages .info strong', data).text().split(', '),
                        asset = '/' + path.split(',').join('/') + '/',
                        images = '';
                    console.log(files);

                    $.each(files, function(idx, itm) {
                        images += '<li><figure class="thumbnail"><span class="icon-close" data-js="remove-item"></span><img src="' + base + asset + itm + '" width="120" height="120" data-asset="' + asset + itm + '" data-type="new"></figure></li>';
                    });
                    $('#sortable-images').append(images);
                    
                }
            });

            if (callback) {
                callback();
            }

            return false;
        });
    },
    chooseImagesClickEvent: function() {
        // images for news
        $('[data-js=choose-images]').unbind().click(function() {
            console.log('show images for news, articles, etc.');
            
            var dialog = $('.dialog div'),
                type = this.getAttribute('data-js-action'),
                news = $('#form-id').val() || 0,
                now = new Date(),
                date = $('#form-creation-date').val(),
                url = '',
                path = 'assets,news,';

                date = date == '' ? isis.funcs.getCurrentDate(',') : date.substr(0, 10).split('-').join(',');
            
            if (parseInt(news)) {
                // console.log('exists' + typeof news);
                path += date + ',' + news;
            } else {
                // console.log('new' + typeof news);
                path += date + ',tmp-' + conf.user.id;
            }
            

            // console.log('news' + news + ', ' + conf.user.id);

            if (type == 'news') {
                $('.dialog h3').text('Wybierz obrazy dla aktualności');
                url = base + '/' + type + '-image/' + news + '/' + path;
            }
            if (type == 'article') {
                $('.dialog h3').text('Wybierz obrazy dla gry');
                path = 'assets,games,' + $('#form-abbr').val() + ',imgs';
                url = base + '/' + type + '-image/' + news + '/' + path;
                // url = base + '/file-manager/info-file-add/' + path;
            }

            isis.funcs.showOverlay();

            // console.log(dialog.attr('data-response'));
            if (dialog.attr('data-response') != type) {
                dialog.html(isis.funcs.getIndicator(true));

                $.get(url, function(data) {
                    dialog.html($('article section', data).html());
                    dialog.attr('data-response', type);
                }).then(function() {
                    console.log('show-images promise...');

                    // action response used in dialog form
                    if (type == 'news') {
                        isis.actions.runNewsImageInfo();
                    }
                    if (type == 'article') {
                        isis.actions.runArticleImageInfo();
                    }

                    // handle uploading and downloading
                    isis.events.uploadImageClickEvent(type, isis.callbacks.clickChosenTabCallback);
                    isis.events.downloadImageClickEvent(type, isis.callbacks.clickChosenTabCallback);
                });
            }
        });
    },
    chooseArticleImagesClickEvent: function() {
        // images for news
        $('[data-js=choose-article-images]').unbind().click(function() {
            console.log('show images for news');
            
            var dialog = $('.dialog div'),
                type = this.getAttribute('data-js-action'),
                news = $('#form-id').val() || 0,
                now = new Date(),
                date = $('#form-creation-date').val(),
                path = 'assets,news,';

                date = date == '' ? isis.funcs.getCurrentDate(',') : date.substr(0, 10).split('-').join(',');
            
            if (news) {
                path += date + ',' + news;
            } else {
                path += date + ',tmp-' + conf.user.id;
            }
            

            console.log(path);

            $('.dialog h3').text('Wybierz obrazy dla aktualności');

            isis.funcs.showOverlay();

            // console.log(dialog.attr('data-response'));
            if (dialog.attr('data-response') != type) {
                dialog.html(isis.funcs.getIndicator(true));

                $.get(base + '/' + type + '-image/' + news + '/' + path, function(data) {
                    dialog.html($('article section', data).html());
                    dialog.attr('data-response', type);
                }).then(function() {
                    console.log('show-images promise...');

                    // action response used in dialog form
                    isis.actions.runNewsImageInfo();

                    // handle uploading and downloading
                    isis.events.uploadImageClickEvent(type, isis.callbacks.clickChosenTabCallback);
                    isis.events.downloadImageClickEvent(type, isis.callbacks.clickChosenTabCallback);
                });
            }
        });
    },
    chooseImageFragmentClickEvent: function() {
        // image fragment
        $('[data-js=choose-image-fragment]').unbind().click(function() {
            console.log('show logo images to choose');
            
            var dialog = $('.dialog div'),
                type = this.getAttribute('data-js-action');

            if (type == 'logo') {
                $('.dialog h3').text('Wybierz logo');
            } else {
                $('.dialog h3').text('Wybierz główny obraz');
            }

            isis.funcs.showOverlay();

            var abbr = $('#form-category option:selected').attr('data-category-abbr');
            var path = 'assets,backgrounds,' + abbr;

            if (type == 'logo') {
                path = 'assets,games,' + abbr;
            }

            // console.log(dialog.attr('data-response'));
            if (dialog.attr('data-response') != type) {
                dialog.html(isis.funcs.getIndicator(true));

                $.get(base + '/fragment/' + type + '-image/' + path, function(data) {
                    dialog.html($('article section', data).html());
                    dialog.attr('data-response', type);
                }).then(function() {
                    console.log('show-images promise...');

                    $('#form-category').attr('readonly', true);

                    // handle tab changing
                    isis.events.tabClickEvent();
                    // upload or download
                    isis.events.showLayerClickEvent();
                    // handle image choosing
                    isis.events.imageFragmentClickEvent(type);

                    // handle uploading and downloading
                    isis.events.uploadImageClickEvent(type);
                    isis.events.downloadImageClickEvent(type);
                });
            }
        });
    },
    removeImageFragmentClickEvent: function() {
        $('[data-js=remove-image-fragment]').unbind().click(function() {
            // ...
            console.log('remove image fragment...');
            var type = this.getAttribute('data-js-action');

            $('#'+type+'-image-fragment-id').attr('value', 0);
            $('#form-'+type+'-fragment').attr('value', '');
            $('#'+type+'-image-div').addClass('hidden');
        });
    },
    imageFragmentClickEvent: function(type, file) {
        // var self = this;
        console.log(type);
        console.log(file);

        var fragment = file;

        $('.img-thumb').unbind().click(function() {
            $('#'+type+'-image-fragment-id').attr('value', this.getAttribute('data-image-fragment-id'));
            $('#'+type+'-image-preview').attr('src', this.getAttribute('src'));
            $('#'+type+'-image-div').removeClass('hidden');

            // console.log(this.getAttribute('data-image-fragment-id'));

            // console.log(fragment);
            // $(this).attr('data-image-fragment')

            var path = fragment || $(this).attr('data-image-fragment');

            // console.log(path);

            // console.log(fragment);
            
            $('#form-'+type+'-fragment').val(path);

            isis.funcs.hideOverlay();
        });
    },
    toggleImageFragmentChangeEvent: function() {
        var visibility = function(template) {
            if (template != '1') {
                $('#logo-image-fragment-div').hide();
                $('#cover-image-fragment-div').show();
            }
            if (template == '1') {
                $('#logo-image-fragment-div').show();
                $('#cover-image-fragment-div').hide();
            }
        };

        // change visibility by template select
        $('#form-template').unbind().change(function() {
            visibility($(this).val());
        });

        // change visibility after form load
        visibility($('#form-template').val());
    },
    removeImageClickEvent: function() {
        // removing new images from news
        $('[data-js=remove-image]').unbind().click(function(event) {
            console.log('remove image...');
            if (this.getAttribute('data-disabled') == true) {
                return false;
            }

            // removing file from file manager
            var action = base + '/file-manager/remove',
                path = $('input[name=path]')[0].value,
                file = $(this).attr('data-asset'),
                params = {};

            params['files[]'] = file;
            params['path'] = path;

            isis.funcs.showIndicator(this, '');

            $.post(
                action, params
            ).then(function(data) {
                console.log('image removed from file menager');

                $(self).parents('li').fadeOut(1000).remove();
            });

            return event.preventDefault();
        });
    },
    verdictScoreChangeEvent: function() {
        $('input[type=range]').change(function() {
            console.log('changing value...');
            var marker = $(this).siblings('span');

            console.log(marker);

            if (marker.length) {
                marker.text(this.value);
            } else {
                $(this).after('<span class="marker">' + this.value + '</span>');
            }
        });
    },
    toggleVisibilityClickEvent: function() {
        $('[data-js=toggle-visibility]').unbind().click(function() {
            console.log('hide visually form controls');
            // hide visually form controls
            var element = $(this).parent().next();

            if (element.hasClass('visually-hidden')) {
                $(this).addClass('icon-slide-up').removeClass('icon-slide-down');
                element.removeClass('visually-hidden');
            } else {
                $(this).addClass('icon-slide-down').removeClass('icon-slide-up');
                element.addClass('visually-hidden');
            }
        });
    },
    toggleDisplayClickEvent: function() {
        $('[data-js=toggle-display]').unbind().click(function() {
            console.log('hide totally element...');
            var element = $(this).parent().next();

            if (element.hasClass('hidden')) {
                $(this).addClass('icon-slide-up').removeClass('icon-slide-down');
                element.removeClass('hidden');
            } else {
                $(this).addClass('icon-slide-down').removeClass('icon-slide-up');
                element.addClass('hidden');
            }
        });
    },
    removeItemClickEvent: function() {
        $('[data-js=remove-item]').unbind().click(function() {
            console.log('remove element...');
            $(this).parent().remove();
        });
        return false;
    },
    sortableListEvent: function(element) {
        // console.log(arguments.callee.name);
        var el = document.getElementById(element);
        new Sortable(el, {
            group: "name",
            store: null, // @see Store
            handle: "li", // Restricts sort start click/touch to the specified element
            // draggable: ".item",   // Specifies which items inside the element should be sortable
            ghostClass: "sortable-ghost",

            onStart: function (/**Event*/evt) { // dragging
                itemEl = evt.item;
            },

            onEnd: function (/**Event*/evt) { // dragging
                itemEl = evt.item;
            },

            onAdd: function (/**Event*/evt){
                itemEl = evt.item;
            },

            onUpdate: function (/**Event*/evt){
                itemEl = evt.item; // the current dragged HTMLElement
                console.log('elem update...');
                var fields = $('#sortable-categories select');

                $.each(fields, function(idx, itm) {
                    $(this).val(idx+1);
                });
            },

            onRemove: function (/**Event*/evt){
                itemEl = evt.item;
            }
        });
    },
    
    addPlatformClickEvent: function(template) {
        var wrapper = $('#sortable-platforms');

        // $.get(base + '/fragment/fetch-template/fragments,game-info-system', function(data) {
        //  var response = $($.parseHTML(data));

        //  // var response = $('template'),
        //  var selected = $('#form-platform option:selected');

        //  $('h3', response).text(selected.text());
            
        //  wrapper.append(response);
        // }).then(function() {
        //  console.log('show-images promise...');
            
        // });
    },
    showLayerClickEvent: function() {
        $('[data-js=show-layer]').unbind().click(function() {
            var layer = $(this).attr('data-layer');

            $('.layer').hide();
            $('#' + layer + '-layer').show();

            $(this).siblings().removeClass('active');
            $(this).addClass('active');
        });
    },
    tabClickEvent: function() {
        $('.tabs li').unbind().click(function() {
            $(this).siblings().removeClass('active');
            $(this).addClass('active');
            
            $('.tab').addClass('hidden');
            $('#' + this.getAttribute('data-tab')).removeClass('hidden');
        });
    },
    dateClickEvent: function(element) {
        // var field = document.getElementById(element);
        var datepicker = new Pikaday({
            // numberOfMonths: 2,
            field: document.getElementById(element),
            // field: $('.datepicker'),
            format: 'DD-MM-YYYY',
            // format: 'YYYY-MM-DD',
            // onSelect: function(date) {
            //  field.value = datepicker.toString();
            // },
            firstDay: 1,
            minDate: new Date('1980-01-01'),
            maxDate: new Date('2020-12-31'),
            yearRange: [1980, 2020]
        });
    },
    checkAllMassCheckboxesEvent: function() {
        $('[data-js=check-all]').unbind().click(function() {
            var checkboxes = $('.mass-checkbox');

            $.each(checkboxes, function(idx, itm) {
                // $(itm).attr('checked', 'checked');
                $(itm).click();
            });
        });
    },
    fetchImagesEvent: function() {
        $('img[data-src]').each(function(idx, itm) {
            $(this).attr('src', $(this).attr('data-src'));
        });
    }
};