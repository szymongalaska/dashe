import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

$(function () {
    $('a').on('click', function (event) {
        event.preventDefault();
        var element = this;

        $.ajax({
            'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            'method': 'GET',
            'url': $(element).attr('href'),
            beforeSend: function(){
                $('main').addClass('loading');
            },

            success:function(response){
                $('nav a').removeClass('text-orange-600');
                $(element).addClass('text-orange-600');
                $('main').hide().removeClass('loading').html(response).fadeIn(400);
                history.pushState(null, '', $(element).attr('href'));
            },
        });
    });
});
