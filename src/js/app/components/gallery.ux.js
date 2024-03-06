import 'owl.carousel';

class GalleryUX {
    constructor($elem) {
        this.$elem = $elem;
        this.$gallerySliderClass = $('.slides');
        this.$thumbnailSliderClass = $('.owl-thumbs');
        this.owlMain = null;
    }

    init() {
        if (this.$gallerySliderClass.length) {
            this.initSlider();
        }
    }

    initSlider() {
        // Initialize main slider
        this.owlMain = this.$gallerySliderClass.owlCarousel({
            items: 1,
            nav: false,
            dots: true,
            thumbs: true,
            thumbsPrerendered: true,
            thumbContainerClass: 'owl-thumbs',
            thumbItemClass: 'owl-thumb-item', // Change 'item' to 'owl-thumb-item'
        });

        // Initialize thumbnail slider
        this.$thumbnailSliderClass.owlCarousel({
            items: 5, // Adjust the number of visible thumbnails as needed
            nav: false,
            dots: false,
            margin: 3,
            responsive: {
                0: {
                    items: 3,
                },
                600: {
                    items: 6,
                },
            },
            onInitialized: this.setThumbsAsNavigation.bind(this),
        });

        // Sync main slider with thumbnail slider
        this.owlMain.on('changed.owl.carousel', (event) => {
            if (event.namespace && event.property.name === 'position') {
                const target = event.relatedTarget.relative(event.property.value);
                this.$thumbnailSliderClass.trigger('to.owl.carousel', [target, 300, true]);
            }
        });

        // Next and Prev navigation for main slider
        this.$elem.find('.carousel-nav.nav-next').click(() => {
            this.owlMain.trigger('next.owl.carousel');
            this.owlMain.trigger('stop.owl.autoplay');
        });

        this.$elem.find('.carousel-nav.nav-prev').click(() => {
            this.owlMain.trigger('prev.owl.carousel');
            this.owlMain.trigger('stop.owl.autoplay');
        });
    }

    setThumbsAsNavigation(event) {
        const thumbs = this.$thumbnailSliderClass.find('.owl-item');
    
        thumbs.on('click', (event) => {
            const clickedThumbnail = $(event.currentTarget);
            const index = clickedThumbnail.index();
    
            // Remove the highlight class from all thumbnails
            thumbs.removeClass('highlight');
    
            // Add the highlight class to the clicked thumbnail
            clickedThumbnail.addClass('highlight');
    
            this.owlMain.trigger('to.owl.carousel', [index, 300, true]);
            this.owlMain.trigger('stop.owl.autoplay');
        });
    }
}

$(function () {
    if ($('.block--custom-layout__gallery').length) {
        let _module = new GalleryUX($('.block--custom-layout__gallery'));
        _module.init();
    }

    var owl = $('.slides');
    owl.owlCarousel({
        loop:true,
        margin:10,
    });

    /*keyboard navigation*/
    $(document.documentElement).keyup(function(event) {    
        if (event.keyCode == 37) { /*left key*/
            owl.trigger('prev.owl.carousel', [700]);
        } else if (event.keyCode == 39) { /*right key*/
            owl.trigger('next.owl.carousel', [700]);
        }
    });

});
