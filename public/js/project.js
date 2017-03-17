$(document).ready(function () {
    $('.parent_comment').on('click', function () {
        $('#comment').val($(this).attr('data-user-name')+', ');
        $('#parent_id').val($(this).attr('data-user-id'));
        $('#comment').focus();
        $('#comment').scroll();
    })
})
