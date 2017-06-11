$('.delete').submit(function(e) {
    e.preventDefault();
    var self = $(this);
    var data = self.serialize();
    var href = $(this).attr("action");

    $.ajax({
        url: href,
        data: data,
        processData: false,
        type: 'POST',
        success: function () {
            self.closest("article").remove();
        }
    });
});

$('.add').submit(function(e) {
    e.preventDefault();
    var self = $(this);
    var data = self.serialize();
    var returnHref = self.find('.go').attr('href');
    var href = location.href.substr(10, location.href.length);
    if(href.includes('add')) {
        $.ajax({
            url: href,
            data: data,
            processData: false,
            type: 'POST',
            success: function (data) {
                $('body').html(data);
                history.pushState(null, null, returnHref);
            }
        });
    } else {
        $.ajax({
            url: href,
            data: data,
            processData: false,
            type: 'POST',
            success: function (data) {
                $('body').html(data);
                history.pushState(null, null, returnHref);
            }
        });
    }
});

$('.go').click(function(e) {
    e.preventDefault();
    var href = $(e.target).attr('href');

    $.ajax({
        url: href,
        processData: false,
        type: 'GET',
        success: function (data) {
            $('body').html(data);
            history.pushState(null, null, href);
        }
    });
});



