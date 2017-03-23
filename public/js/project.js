$(document).ready(function () {
    $('.children_comments').hide();
    $mark = $('#user_id').attr('user-mark');
    for($i = $mark; $i < 6; $i++){
        $('#'+ $i).attr('class', 'glyphicon glyphicon-star-empty');
    }
    for($i = 1; $i <= $mark; $i++){
        $('#'+ $i).attr('class', 'glyphicon glyphicon-star');
    }



    $('.parent_comment').on('click', function () {
        $('#comment').val($(this).attr('data-user-name')+', ');
        $('#parent_id').val($(this).attr('data-user-id'));
        $('#comment').focus();
        $('#comment').scroll();
    })

     $('.answers').on('click', function () {
         $('.comment'+$(this).attr('comment-id')).slideToggle();
     })

    $('.glyphicon').on('click', function () {
        $id = $(this).attr('id');
        for($i = $id; $i < 6; $i++){
            $('#'+ $i).attr('class', 'glyphicon glyphicon-star-empty');
        }
        for($i = 1; $i <= $id; $i++){
            $('#'+ $i).attr('class', 'glyphicon glyphicon-star');
        }

        $.ajax({
            method: 'POST',
            url: url,
            data: {
                mark: $id,
                user_id: $('#user_id').val(),
                restaurant_id: $('#restaurant_id').val(),
                _token: token}
        })

    })
})
