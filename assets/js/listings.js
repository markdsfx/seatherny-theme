jQuery(document).ready(function($) {
    // Ajax request when a post title is clicked
    $('.post-title').on('click', function() {
        var post_id = $(this).data('post-id');

        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                action: 'get_post_content',
                post_id: post_id
            },
            success: function(response) {
                // Display the content in the right panel
                $('#right-panel').html(response);
            }
        });
    });
});