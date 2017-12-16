(function($) {
    var paramsort;
    $.fn.dynamicallySortable = function() {
        paramsort = $('meta[name=sort]').attr('content');
        this.each(function() {
            if($(this).data('sort')===paramsort) {
                $(this).addClass('is_sorted');
                var currentDir = 'down';
                if($('meta[name=sortdir]').attr('content')==='desc'){
                    currentDir = 'up';
                }
                $(this).append($('<span class="glyphicon glyphicon-arrow-'+currentDir+'"></span>'));
            }
        });
        this.click(function(){
            var dir = 'asc';
            if($('meta[name=sortdir]').attr('content')==='asc' && paramsort === $(this).data('sort')){
                dir = 'desc';
            }
            var newLocation = marmarait_updateQueryStringParameterInCurrent('sort_dir', dir);
            newLocation = marmarait_updateQueryStringParameter(newLocation, 'sort', $(this).data('sort'));
            location.href = newLocation;
        });
    };
})(jQuery);
function marmarait_updateQueryStringParameter(uri, key, value) {
    var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
    var separator = uri.indexOf('?') !== -1 ? "&" : "?";
    if (uri.match(re)) {
        return uri.replace(re, '$1' + key + "=" + value + '$2');
    }
    else {
        return uri + separator + key + "=" + value;
    }
}
function marmarait_updateQueryStringParameterInCurrent(key, value) {
    var uri = window.location.href;
    return marmarait_updateQueryStringParameter(uri, key, value);
}