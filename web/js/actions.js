isis.actions = {
    runNewsCommmentIndex: function() {
        isis.events.acceptClickEvent();
        isis.events.removeClickEvent();
    },
    runArticleCommmentIndex: function() {
        isis.events.acceptClickEvent();
        isis.events.removeClickEvent();
    },
    runStoryCommmentIndex: function() {
        isis.events.acceptClickEvent();
        isis.events.removeClickEvent();
    },
    runUserCommmentIndex: function() {
        isis.events.acceptClickEvent();
        isis.events.removeClickEvent();
    },
    runPostmanIndex: function() {
        isis.events.markClickEvent();
        isis.events.lockClickEvent();
        isis.events.unlockClickEvent();
        // temporary
        isis.events.checkAllMassCheckboxesEvent();
    },

    runNewsInfo: function() {
        isis.events.bindCommonInfoActionEvent();

        isis.events.publishClickEvent();

        // isis.events.toggleImageFragmentChangeEvent();
        isis.events.chooseImagesClickEvent();
    },
    runNewsImageInfo: function() {
        isis.events.tabClickEvent();
        isis.events.fetchImagesEvent();
        isis.events.removeClickEvent();
        isis.events.removeItemClickEvent();
        isis.events.showLayerClickEvent();

        isis.events.sortableListEvent('sortable-images');

        isis.events.chooseClickEvent();
    },
    runArticleInfo: function() {
        isis.events.bindCommonInfoActionEvent();

        isis.events.previewClickEvent();
        isis.events.toggleImageFragmentChangeEvent();
        isis.events.chooseImageFragmentClickEvent();
        isis.events.removeImageFragmentClickEvent();
    },
    runArticleImageInfo: function() {
        console.log('runArticleImageInfo...');
        isis.events.tabClickEvent();
        isis.events.fetchImagesEvent();
        isis.events.removeImageClickEvent();
        isis.events.removeItemClickEvent();
        isis.events.showLayerClickEvent();

        isis.events.sortableListEvent('sortable-images');

        isis.events.chooseClickEvent();
    },
    runStoryInfo: function() {
        isis.events.addClickEvent();
        isis.events.saveClickEvent();

        isis.events.toggleImageFragmentChangeEvent();
        isis.events.chooseImageFragmentClickEvent();
    },
    runStoryInfo: function() {
        isis.events.addClickEvent();
        isis.events.saveClickEvent();

        isis.events.toggleImageFragmentChangeEvent();
        isis.events.chooseImageFragmentClickEvent();
    },
    runArticleCategoryInfo: function() {
        isis.events.chooseImagesClickEvent();


    },
    runArticleCategoryOrder: function() {
        isis.events.sortableListEvent('sortable-categories');
    },
    runStoryCategoryOrder: function() {
        isis.events.sortableListEvent('sortable-categories');
    },
    runArticleVerdictInfo: function() {
        var features,
            plus, minus;

        if ($('#form-features').val()) {
            features = JSON.parse($('#form-features').val());

            console.log(features);

            if (features.plus) {
                plus = '';

                $.get(base + '/inner/get-template/?name=parts/verdict-feature-plus', function(data) {
                    $.each(features.plus, function(idx, itm) {
                        plus += data.replace('%value%', itm);
                    });
                    $('#form-features-advantages').append(plus);
                });
            }
            if (features.minus) {
                minus = '';

                $.get(base + '/inner/get-template/?name=parts/verdict-feature-minus', function(data) {
                    $.each(features.minus, function(idx, itm) {
                        minus += data.replace('%value%', itm);
                    });
                    $('#form-features-disadvantages').append(minus);
                });
            }
        }
        // console.log(features);

        $('[data-js=add-advantage]').unbind().click(function() {
            var input = '<div class="feature"><input name="features[plus][]" type="text" class="input" value="" placeholder="Wpisz odpowiednią cechę" data-feature-type="plus" /><a href="" data-js="remove-item">Usuń</a></div>';
            $('#form-features-advantages').append(input);

            isis.events.removeItemClickEvent();
        });

        $('[data-js=add-disadvantage]').unbind().click(function() {
            var input = '<div class="feature"><input name="features[minus][]" type="text" class="input" value="" placeholder="Wpisz odpowiednią cechę" data-feature-type="plus" /><a href="" data-js="remove-item">Usuń</a></div>';
            $('#form-features-disadvantages').append(input);

            isis.events.removeItemClickEvent();
        });

        isis.events.removeItemClickEvent();

        isis.events.verdictScoreChangeEvent();
    },
    runFragmentInfo: function() {
        console.log('fragment info...');
        isis.events.sortableListEvent('sortable-platforms');

        var template = '',
            system = '';

        $.get(base + '/fragment/fetch-template/fragments,game-info-system', function(data) {
            // template = $($.parseHTML(data));
            template = data;
        }).then(function() {
            console.log('template ready...');

            
        });

        $('#form-fragment-platform').change(function() {
            if ($(this).val()) {
                console.log($(this).val());
                $('#form-fragment-platform + span').removeAttr('data-disabled').removeClass('disabled');
                system = template.split('none').join($(this).val());
                // console.log(system);
                // console.log(typeof system);
            }
        });


        $('[data-js=add-item]').unbind().click(function() {
            console.log('add element...');

            if (this.getAttribute('data-disabled')) {
                return false;
            }

            system = $($.parseHTML(system));

            var item = system.clone();

            var platform = $('#form-fragment-platform');

            var wrapper = $('#sortable-platforms');
            var selected = platform.children('optgroup').children('option:selected').attr('disabled', true);

            platform.children('option:first').attr('selected', true);
            platform.next().attr('data-disabled', true).addClass('disabled');

            $('h3', item).text(selected.text());

            $('header', item).next().attr('id', selected.val() + '-platform');

            wrapper.append(item);


            // events
            isis.events.toggleDisplayClickEvent();
            isis.events.removeItemClickEvent();

            var datepickers = $('#' + selected.val() + '-platform .datepicker');
            $.each(datepickers, function(idx, itm) {
                isis.events.dateClickEvent(itm.id);
            });

        });
        
        isis.events.toggleDisplayClickEvent();
        isis.events.removeItemClickEvent();

        var datepickers = $('.datepicker');
        $.each(datepickers, function(idx, itm) {
            isis.events.dateClickEvent(itm.id);
        });
    },
    runFragmentLogoImage: function() {
        console.log('fragment image...');
        // isis.events.sortableListEvent('sortable-platforms');
    },
    runFileManagerIndex: function() {
        // dir content clicks
        $('.dir-content label a').unbind().click(function(event) {
            console.log('click event...');
            // stop while alt pressed
            if (pressed == 18) {
                console.log('click event with key pressed...');
                // return false;
                // event.stopPropagation;
                event.stopPropagation;
            }
            // return false;
        });
/*
        // pill actions
        $('#toggle-layout .pill').unbind().click(function() {
            $(this).siblings().removeClass('active');
            $(this).addClass('active');

            localStorage.setItem('data-layout', this.getAttribute('data-layout'));

            // console.log(localStorage.getItem('data-layout'))

            $('.dir-content').attr('class', 'dir-content ' + this.getAttribute('data-layout'));
        });

        // console.log(localStorage.getItem('data-layout'));

        // initialize
        if (!localStorage.getItem('data-layout')) {
            console.log('layout initialize...');
            $('#toggle-layout span')[0].click();
        } else {
            $('#toggle-layout .icon-' + localStorage.getItem('data-layout')).click();
        }*/
    },
    runFileManagerInfoFileInfo: function() {
        // ...
        console.log('run after action...');
        isis.events.showLayerClickEvent();

        isis.events.downloadButtonClickEvent();
    }
}