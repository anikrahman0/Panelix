function initializeSelect2AjaxMultiple(selector, url, placeholder, length, value, $tag) {
    valueArr = value.split(",");
    $(selector).select2({
        tags: $tag,
        ajax: {
            url: url,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    term: params.term
                };
            },
            processResults: function (data) {
                console.log(data.results);
                
                return {
                    results: data.results
                };
            },
        },
        minimumInputLength: length,
        placeholder: placeholder
    }).val(valueArr).trigger("change.select2");
}

function initializeSelect2Multiple(selector, placeholder, value, $tag) {
    valueArr = value.split(",");
    $(selector).select2({
        tags: $tag,
        placeholder: placeholder,
    }).val(valueArr).trigger("change.select2");
}


function initializeSelect2AjaxSingle(selector, url, placeholder, required, length, value) {
    $(selector).select2({
        ajax: {
            url: url,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    term: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: data.results
                };
            },
        },
        minimumInputLength: length,
        placeholder: placeholder,
        allowClear : required=='required' ? false : true
    }).val(value).trigger("change.select2");
}

function initializeSelect2Single(selector, placeholder, required, value) {
    $(selector).select2({
        placeholder: placeholder,
        allowClear : required=='required' ? false : true
    }).val(value).trigger("change.select2");
}


$(document).ready(function() {
    var errorElement = $('.error-text-area').first();
    var headerHeight = $('.page-main-header').outerHeight()
    if (errorElement.length) {
        $('html, body').animate({
            scrollTop: errorElement.offset().top - headerHeight - 100
        }, 'smooth');
    }
});