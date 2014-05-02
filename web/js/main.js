/**
 * On window load
 */
$(window).load(function(){
    open_close_filters();
});

/**
 * Open close filters
 * Activate filters menu buttons
 */
function open_close_filters(){

    $('.filters-buttons li').on('click', function(){

        var el = $('.'+$(this).data('filters'));

        $('.filters-container').removeClass('active');
        $('.filters-buttons li').removeClass('active');

        if(el.hasClass('active')){
            el.removeClass('active');
            $(this).removeClass('active');
        }
        else{
            el.addClass('active');
            $(this).addClass('active');
        }

    });

}
