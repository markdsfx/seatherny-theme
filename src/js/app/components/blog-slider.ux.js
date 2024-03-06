import owlCarousel from 'owl.carousel';

class LogoUX {
    
    constructor($elem) {

        this.$elem = $elem;
        this.$logoSliderClass = $('.header-slider');
        this.slideClass = $('.header-slider .list-item');
        this.owl = false;

    }

    init() {
        
        if(this.$logoSliderClass.length){
            this.initSlider();
        }

    }

    initSlider() {

        // let prevArrow = this.$slider.attr('data-prev');
        // let nextArrow = this.$slider.attr('data-next');

        this.owl = this.$logoSliderClass.owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            autoplayTimeout: 11000,
            dots:false,
            autoHeight: true,
            autoWidth: false,
            nav: true,
            margin: 32,
            navText : [
                '<div class="nav-button owl-prev"><img class="arrow" src="http://localhost/evoro/wp-content/uploads/2023/07/arrow-left-1.png"/></div>',
                '<div class="nav-button owl-next"><img class="arrow" src="http://localhost/evoro/wp-content/uploads/2023/07/arrow-right-1.png"/></div>'
            ],
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
    if($('.header-slider-content').length){
        let _module = new LogoUX($('.header-slider-content'));
        _module.init();

    }
})