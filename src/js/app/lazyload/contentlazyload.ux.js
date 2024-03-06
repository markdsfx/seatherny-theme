import { TweenMax, Expo } from 'gsap/TweenMax';
import { CommonHelper } from '../utils/common.helper';
class ContentLazyLoad {
    
    constructor() {
        this.defaults = {
            offset : 100,
            origin : 'y',
            delay : 0.1,
            opacity : 0,
            duration : 0.8,
            classes : {
                targets : {
                    onscroll : 'anim-on-scroll',
                    onload : 'anim-on-load'
                },
                complete : 'anim-complete'
            }
        };
    }
    init(){
            
        $('html, body').addClass('loaded');
        
        this.initTargets();
        // TweenMax.to($('#page-preloader'), 1, {
        //     opacity: 0,
        //     onComplete : () => {
        //         $('#page-preloader').hide();
        //     }
        // });
        // TweenMax.to($('#page-header'), 0.7, {
        //     opacity: 1,
        //     ease: Expo.easeOut,
        //     delay: 0.25
        // });
        // trigger scroll on load
        // $("html, body").animate({scrollTop: 1});
    }
    initTargets(){
        let _obj = this;
        let $targets = $('.'+_obj.defaults.classes.targets.onscroll+' , '+'.'+_obj.defaults.classes.targets.onload);
        $targets.each(function(){
            let $elem = $(this);
            let origin = $(this).attr('data-origin');
            let offset = $(this).attr('data-offset');
            let opacity = $(this).attr('data-opacity');
            let opts = {};
            origin = (origin) ? origin : _obj.defaults.origin;
            offset = (offset) ? offset : _obj.defaults.offset;
            opacity = (opacity) ? opacity : _obj.defaults.opacity;
            if(origin == 'x'){
                TweenMax.set($elem, {
                    x : offset,
                    opacity : opacity 
                });
            } else {
                TweenMax.set($elem, {
                    y : offset,
                    opacity : opacity 
                });
            }
        }).promise().done(function(){
            _obj.bindScroll();
            _obj.showOnLoad();
        });
    }
    animateIn($elem) {
        if($elem){
            
            let delay = $elem.attr('data-delay');
            let duration = $elem.attr('data-duration');
            delay = (delay) ? delay : this.defaults.delay;
            duration = (duration) ? duration : this.defaults.duration;
            TweenMax.to($elem, duration, {
                opacity: 1,
                x: 0,
                y: 0,
                delay: delay,
                onComplete: () => {
                }
            });
            $elem.addClass(this.defaults.classes.complete);
            
            if($elem.hasClass('has-counter') || $elem.hasClass('has-child-counter')){
                let $counter = new CounterController($elem.find('*[data-ctrl="counter"]'));
                setTimeout( () => { $counter.animateToFinal(); } , (delay * 1000));
            }
        }
    }
    showOnLoad() {
        let ins = this;
        let $targets = $('.'+this.defaults.classes.targets.onload+':not(.'+this.defaults.classes.complete+')');
            
        setTimeout(function(){
            $targets.each(function() {
                ins.animateIn( $(this) );
            });
        }, 200);
    }
    bindScroll(){
        let _obj = this;
        $(window).bind('scroll', () => {
            let $targets = $('.'+_obj.defaults.classes.targets.onscroll+':not(.'+_obj.defaults.classes.complete+')');
            $targets.each(function() {
                var $elem = $(this);
                var scroll_offset = $elem.attr('data-scrolloffset');
                scroll_offset = (scroll_offset) ? scroll_offset : 5;
                if(CommonHelper.isInViewport($elem, scroll_offset)){
                    _obj.animateIn($elem);
                }
            });
        });
    }

    bindScrollToAnchor() {
        $('*[data-ux="scroll-to-anchor"]').bind('click', function(){
            let target = $(this).attr('data-target');
            if($('*[data-anchor="'+target+'"]').length){
                $('html, body').animate({
                    scrollTop: $('*[data-anchor="'+target+'"]').offset().top - ($(window).height() / 3)
                }, 1200);
            }
        });
    }
}
$(window).on('load', () => {
    let _module = new ContentLazyLoad();
    _module.init();
});