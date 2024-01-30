var url = "http://127.0.0.1:8000";

//Likes
$(document).ready(function() {
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

    //Buscador

    $('#buscador').submit(function(){
        $(this).attr('action',url+'/gente/'+$('#buscador #search').val());
    });
});

