isis.callbacks = {
    runArticleInfoCallback: function(data) {
        console.warn('runArticleInfoCallback...');
        var values = $('.messages .hidden', data);
        $.each(values, function(idx, itm) {
            console.log(itm.getAttribute('data-object-value'));
            $('#'+itm.getAttribute('data-object-id')).val(itm.getAttribute('data-object-value'));
        });
        // var cover = $('#cover-photo-img')[0];
        // cover.setAttribute('src', cover.getAttribute('src') + $('.messages strong', data).text());

        // $('#cover-photo-preview').removeClass('hidden');
    },
    clickChosenTabCallback: function() {
        $('[data-tab=tab-chosen]').click();
        isis.events.removeImageClickEvent();
    }
};