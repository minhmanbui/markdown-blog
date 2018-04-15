$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
    $('.js-read-post').on('click', function(e) {
        showPostDetailModal($(this));
    });

    $('.js-approve-post').on('click', function(e) {
        approvePost($(this));
    });

    $('.js-remove-post').on('click', function(e) {
        removePost($(this));
    });
});

function showPostDetailModal(element)
{
    var url = element.data('url');

    $.get(url, function(content) {
        $('#post-modal').html(content).modal('show');
    })
}

function approvePost(element)
{
    var r = confirm("You want to approve this post ?");

    if (!r) {
        return;
    }

    var url = element.data('url');

    $.post(url, {}, function(data) {
        if (!data.status) {
            alert(data.message);
        } else {
            window.location.reload();
        }
    });
}

function removePost(element)
{
    var r = confirm("You want to remove this post ?");

    if (!r) {
        return;
    }

    var url = element.data('url');

    $.post(url, {}, function(data) {
        if (!data.status) {
            alert(data.message);
        } else {
            window.location.reload();
        }
    });
}
