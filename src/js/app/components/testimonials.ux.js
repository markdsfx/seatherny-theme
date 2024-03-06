import owlCarousel from 'owl.carousel';

class TestimonialsUX {
    
    constructor($elem) {

        this.$elem = $elem;
        this.$logoSliderClass = $('.testimonials-slider');
        this.slideClass = $('.testimonials-slider .list-item');
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
            // stagePadding: 365,
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
                '<div class="nav-button owl-prev"><img class="arrow" src="https://wastemgmtdev.wpengine.com/wp-content/uploads/2023/08/arrow-left-2.png"/></div>',
                '<div class="nav-button owl-next"><img class="arrow" src="https://wastemgmtdev.wpengine.com/wp-content/uploads/2023/08/arrow-right-2.png"/></div>'
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
    if($('.block--custom-layout__testimonial-slider').length){
        let _module = new TestimonialsUX($('.block--custom-layout__testimonial-slider'));
        _module.init();

    }



    // const pageHeader = document.querySelector("#page-header");

    // window.addEventListener("scroll", () => {
    //     const scrollY = window.pageYOffset;

    //     if (scrollY >= 100) {
    //         pageHeader.classList.remove("sticky");
    //     } else {
    //         pageHeader.classList.add("sticky");
    //     }

    //     if (scrollY === 0) {
    //         pageHeader.classList.add("sticky");
    //     }
    // });


});
