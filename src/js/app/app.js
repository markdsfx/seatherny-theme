//modules
import { CommonHelper } from './utils/common.helper';
import './lazyload/contentlazyload.ux';
// import fancybox from '@fancyapps/fancybox';

// components
import './components/header.ux';
import './components/gallery.ux';
import './components/logo-slider.ux';

class WebApp {

    constructor($window, $document, _data) {

        this.$window = $window;
        this.$document = $document;
        this.data = (_data) ? _data : {};

    }

    init() {

        this.$document.ready( () => { this.afterDocumentreadyHook(); } );
        this.$window.on( 'load', () => { this.afterWindowloadHook(); } );

    }

    clearData() {

        this.data = {};
        return true;

    }

    afterDocumentreadyHook(){

        this.bindScrollToAnchor();
        this.customSelect();
        this.videoYt();
        this.vidPreview();

        $('#page-content').css({
            'min-height' : this.$window.height() - $('#page-footer').height()
        });
        $("html, body").animate({scrollTop: 1});

        let anchor = CommonHelper.getUrlParameter('goto');
        if(!anchor){
            setTimeout(function(){ 
                $("html, body").animate({scrollTop: 1});
            }, 200);
        }

        $('.service-item').bind('click', function(){
            $(this).toggleClass('active-item');
        });

        $('.number-only .forminator-input').keypress(function(event) {
            var input = String.fromCharCode(event.which);
            var regex = /[0-9]|\./;
            
            // Allow only numeric characters
            if (!regex.test(input)) {
            event.preventDefault();
            }
        });

    }

    afterWindowloadHook(){

        let anchor = CommonHelper.getUrlParameter('goto');
        if(anchor){
            this.scrollToAnchor(anchor);
        }

        let smoothanchor = CommonHelper.getUrlParameter('gt');
        if(smoothanchor){
            this.scrollToAnchorById('#'+smoothanchor);
        }

    }

    bindScrollToAnchor() {

        let wa = this;
        $('*[data-ux="scroll-to-anchor"]').bind('click', function(){
            let target = $(this).attr('data-target');
            if(target){
                wa.scrollToAnchor(target);
            } else {
                $('html, body').animate({
                    scrollTop: ($(window).height() - ($('#page-header').height()))
                }, 1200);
            }
        });

        
        $('.ux-scroll-to-anchor').bind('click', function(ev){
            ev.preventDefault();
            let target = $(this).attr('href');
            if(target){
                if($(this).hasClass('home-only')){
                    if($('body').hasClass('home')){
                        wa.scrollToAnchorById(target);
                    } else {
                        window.location = $(this).attr('data-home');
                    }
                } else {
                    wa.scrollToAnchorById(target);
                }
            } else {
                $('html, body').animate({
                    scrollTop: ($(window).height() - ($('#page-header').height()))
                }, 1200);
            }
        });

    }

    scrollToAnchor(target) {
        if($('*[data-anchor="'+target+'"]').length){
            $('html, body').animate({
                scrollTop: $('*[data-anchor="'+target+'"]').offset().top - ($(window).height() / 5)
            }, 1200);
        }
    }

    scrollToAnchorById(target){
        if($(target).length){
            $('html, body').animate({
                scrollTop: $(target).offset().top - 30
            }, 1200);
        }
    }

    customSelect() {
        $(".select-styled").on("click", function(e) {
            $(this).siblings(".select-options").slideToggle('fast');
            if ($(this).parent().hasClass('active')) {
                setTimeout(() => $(this).parent().removeClass('active'), 200);
            }
            else {
                $(this).parent().addClass('active');
            }
            e.stopPropagation();
        });
      
        $(".select-options li").on("click", function() {
            var selectedValue = $(this).text();
            $(this).closest(".select-field").find(".select-styled").text(selectedValue);
            $(this).closest(".select-options").hide();
            $(this).parents('.select-field').removeClass('active');
        });
      
        $(document).on("click", function(e) {
            if (!$(e.target).closest(".select-field").length) {
              $(".select-options").hide();
              $(this).parents('.select-field').removeClass('active');
            }
        });
    }

    videoYt() {
        $("#playButtonYt").on("click", function() {
            var iframe = $(".yt-player iframe")[0];
            var videoUrl = iframe.getAttribute("src");
            var src = videoUrl.split('?')[0];
            src += "?autoplay=1";
            iframe.setAttribute("src", src);
            $(this).parent().find('.feature-video').hide();
            $(this).hide();
        });
    }

    vidPreview() {
        var player;

        function onYouTubeIframeAPIReady() {
          // Hover event
          $(".video-container").hover(function() {
            var videoId = $(this).data('video-id');
            if (player) {
              player.loadVideoById(videoId);
            }
          });
      
          // Mouse leave event to stop video playback
          $(".video-container").mouseleave(function() {
            if (player) {
              player.stopVideo();
            }
          });
        }
      
        $(document).ready(function() {
          // Load the YouTube API asynchronously
          var tag = document.createElement('script');
          tag.src = 'https://www.youtube.com/iframe_api';
          var firstScriptTag = document.getElementsByTagName('script')[0];
          firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
      
          // Wait for the YouTube API to be ready
          window.onYouTubeIframeAPIReady = onYouTubeIframeAPIReady;
        });
    }
}

const _WebApp = new WebApp( 
    $(window), 
    $(document), 
    { 
        started : Date.now() 
    }
).init();