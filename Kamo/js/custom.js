jQuery('.gallery').each(function() {
    jQuery(this).magnificPopup({
        delegate: 'a',
        type: 'image',
        gallery: {
            enabled: true
        },
    });
});
