var url = "http://127.0.0.1:8000";


$(document).ready(function() {
    //Likes
    $(document).on('click', '.btn-like', function() {
        var heart = $(this);
        var id = heart.data('id');

        $.ajax({
            url: url+'/like/'+id,
            type: 'GET',
            success: function(response) {
                if (response.like) {
                    heart.addClass('btn-dislike').removeClass('btn-like');
                    heart.attr('src', url + '/img/corazon-rojo.png');
                    updateLikesCounter(id, 1);
                } else {
                    console.log('Error al dar like');
                }
            }
        });
    });

    $(document).on('click', '.btn-dislike', function() {
        var heart = $(this);
        var id = heart.data('id');

        $.ajax({
            url: url+'/dislike/'+id,
            type: 'GET',
            success: function(response) {
                if (response.like) {
                    heart.addClass('btn-like').removeClass('btn-dislike');
                    heart.attr('src', url + '/img/corazon-negro.png');
                    updateLikesCounter(id, -1);
                } else {
                    console.log('Error al dar dislike');
                }
            }
        });
    });

    function updateLikesCounter(imageId, delta) {
        var counter = $("#likes-count-" + imageId);
        var currentLikes = parseInt(counter.text()) || 0;
        counter.text(currentLikes + delta);
    }

    //Follow

    $(document).on('click', '.btn-follow', function() {
        var button = $(this);
        var id = button.data('id');

        $.ajax({
            url: url+'/follow/'+id,
            type: 'GET',
            success: function(response) {
                if (response.following) {

                    button.removeClass('btn-primary btn-follow').addClass('btn-danger btn-unfollow').text('Unfollow');
                    button.text('Unfollow');
                } else {
                    console.log('Error al dar follow');
                }
            }
        });
    });

    $(document).on('click', '.btn-unfollow', function() {
        var button = $(this);
        var id = button.data('id');

        $.ajax({
            url: url+'/unfollow/'+id,
            type: 'GET',
            success: function(response) {

                if (!response.following) {
                    button.removeClass('btn-danger btn-unfollow').addClass('btn-primary btn-follow').text('Follow');
                    button.text('Follow');

                } else {
                    console.log('Error al dar unfollow');
                }
            }
        });
    });

    //Buscador

    $('#buscador').submit(function(){
        $(this).attr('action',url+'/gente/'+$('#buscador #search').val());
    });
});

