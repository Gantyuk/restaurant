$(document).ready(function () {
    $('.children_comments').hide();
    $('.parent_comment').on('click', function () {
        $('#comment').val($(this).attr('data-user-name')+', ');
        $('#parent_id').val($(this).attr('data-user-id'));
        $('#comment').focus();
        $('#comment').scroll();
    })

     $('.answers').on('click', function () {
         $('.comment'+$(this).attr('comment-id')).slideToggle();
     })
})
