<?php
/**
 * Footer template
 *
 * @package SDEV
 * @subpackage SDEV WP
 * @since SDEV WP Theme 2.0
 */
    $footer_class = 'page-footer';
    $footer_class .= (defined('FOOTER_ALT_CLASS')) ? ' page-footer--alt' : '';
?>

<script>
jQuery(function ($) {

    var page = 1;
    var loading = false;
    var categorySlug = 'your-category-slug'; // Replace with the desired category slug

    function loadListings(searchTerm = '') {
        loading = true;

        // Hide the list and show the loading gif
        $('#related-listings').hide();
        $('#loading-gif').show();

        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                action: 'load_related_listings',
                page: page,
                category: categorySlug,
                search: searchTerm, // Pass the search term to the server
            },
            beforeSend: function () {
                // Show loading gif while waiting for the response
                $('#loading-gif').show();
            },
            success: function (response) {
                // Hide the loading gif and show the list when the response is received
                $('#loading-gif').hide();
                $('#related-listings').show();

                // Replace content with new listings
                $('#related-listings').html(response);

                // Display numeric pagination
                var paginationContainer = $('#related-listings').find('.numeric-pagination');

                if (paginationContainer.length > 0) {
                    addPaginationClickHandlers();
                }

                // Highlight the anchor tag corresponding to the current URL
                highlightCurrentPage();

                // Move the highlighted element to the top
                moveHighlightedToTop();

                loading = false;
            },
        });
    }

    function addPaginationClickHandlers() {
        $('.numeric-pagination a').on('click', function (e) {
            e.preventDefault();
            page = $(this).text(); // Set the current page based on the clicked link
            loadListings($('#search-input').val());
        });

        // Add previous and next button click handlers
        $('.numeric-pagination .prev').on('click', function (e) {
            e.preventDefault();
            if (page > 1) {
                page--;
                loadListings($('#search-input').val());
            }
        });

        $('.numeric-pagination .next').on('click', function (e) {
            e.preventDefault();
            page++;
            loadListings($('#search-input').val());
        });
    }

    function highlightCurrentPage() {
        var currentUrl = window.location.href;

        // Loop through anchor tags and check if their href matches the current URL
        $('a').each(function () {
            var href = $(this).attr('href');

            // Check if the href is not undefined and if it is the same as the current URL
            if (href && href === currentUrl) {
                $(this).addClass('highlighted'); // Add a class to highlight the anchor tag
            }
        });
    }

    function moveHighlightedToTop() {
        var highlightedElement = $('.listing-link.highlighted');

        if (highlightedElement.length > 0) {
            // Move the highlighted element to the top of its container
            highlightedElement.parent().prepend(highlightedElement);
        }
    }

    // Load listings on initial page load
    loadListings();

    // Add event listener for the search input
    $('#search-input').on('input', function () {
        page = 1; // Reset the page when the user starts typing
        var searchTerm = $(this).val();
        if (searchTerm === '') {
            // If the search term is empty, show all listings
            loadListings();
        } else {
            // Otherwise, load listings based on the search term
            loadListings(searchTerm);
        }
    });

    // Add event listener for hitting the Enter key
    $('#search-input').on('keyup', function (e) {
        if (e.key === 'Enter') {
            var searchTerm = $(this).val();
            if (searchTerm === '') {
                // If the search term is empty, show all listings
                loadListings();
            } else {
                // Otherwise, load listings based on the search term
                loadListings(searchTerm);
            }
        }
    });

    // Highlight the anchor tag corresponding to the current URL on initial page load
    highlightCurrentPage();

    // Move the highlighted element to the top on initial page load
    moveHighlightedToTop();
    


    


});


</script>

        <footer id="page-footer" class="<?= $footer_class ?>">
            <?php 
                get_template_part('src/views/partials/footer', 'upper');  
            ?>
        </footer>

        <footer id="page-footer" class="<?= $footer_class ?> footer-lower">
            <?php get_template_part('src/views/partials/footer', 'lower'); ?>
        </footer>
    </div> <!-- page main wrapper -->
    <div class="non_visual_wrapper opt__step">
        <?php get_template_part('src/views/partials/footer', 'body-end'); ?>
        <?php wp_footer(); ?>
    </div>
</body>
</html>