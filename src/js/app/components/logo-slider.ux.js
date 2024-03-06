import owlCarousel from 'owl.carousel';

class LogoUX {
    
    constructor($elem) {

        this.$elem = $elem;
        this.$logoSliderClass = $('.grid-item-wrapper');
        this.slideClass = $('.grid-item-wrapper .list-item');
        this.owl = true;

    }

    init() {
        
        if(this.$logoSliderClass.length){
            this.initSlider();
        }

    }

    initSlider() {

        this.owl = this.$logoSliderClass.owlCarousel({
            autoplay: false,
            autoplayTimeout: 11000,
            dots: true,
            nav: false,
            loop: true,
            margin: 32,
            autoWidth: false,
            responsive: {
                0: {
                    items: 1,
                },
                500: {
                    items: 1,
                },
                768: {
                    items: 1,
                }
            }
        });

        this.$elem.find('.carousel-nav.nav-next').click(() => {
            this.owl.trigger('next.owl.carousel');
            this.owl.trigger('stop.owl.autoplay');
        })
        this.$elem.find('.carousel-nav.nav-prev').click(() => {
            this.owl.trigger('prev.owl.carousel');
            this.owl.trigger('stop.owl.autoplay');
        });

    }

}

$(function(){
    if($('.block--custom-layout__featured-listings').length){
        let _module = new LogoUX($('.block--custom-layout__featured-listings'));
        _module.init();

    }
})