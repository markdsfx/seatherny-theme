import owlCarousel from 'owl.carousel';

class TeamSliderUX {
    
    constructor($elem) {

        this.$elem = $elem;
        this.$slider = $('.team-slider');
        this.slideClass = $('.team-slider .list-item');
        this.owl = false;

    }

    init() {
        
        if(this.$slider.length){
            this.initSlider();
        }

    }

    initSlider() {

        // let prevArrow = this.$slider.attr('data-prev');
        // let nextArrow = this.$slider.attr('data-next');

        this.owl = this.$slider.owlCarousel({
            // stagePadding: 365,
            items: 3,
            loop: false,
            autoplay: false,
            autoplayTimeout: 11000,
            dots:false,
            autoHeight: false,
            autoWidth: true,
            nav: true,
            margin: 32,
            stagePadding: 50,
            responsive:{
                0:{
                  items: 1,
                  stagePadding: 0,
                  margin: 30,
                },
                767:{
                  items: 3,
                  stagePadding: 25,
                },
                1000:{
                  items: 3,
                  margin: 32
                }
              },
            navText : [
                '<div class="nav-button owl-prev"><img class="arrow" src="https://wastemgmtdev.wpengine.com/wp-content/uploads/2023/07/arrow-left-1.png"/></div>',
                '<div class="nav-button owl-next"><img class="arrow" src="https://wastemgmtdev.wpengine.com/wp-content/uploads/2023/07/arrow-right-1.png"/></div>'
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
    if($('.block--custom-layout__team-slider').length){
        let _module = new TeamSliderUX($('.block--custom-layout__team-slider'));
        _module.init();
    }

    document.addEventListener("DOMContentLoaded", function() {
        // Video Player
        const videoPlayer = document.getElementById('videoPlayer');
        const playButton = document.getElementById('playButton');
    
        // Function to toggle play and pause
        function togglePlayPause() {
          if (videoPlayer.paused || videoPlayer.ended) {
            videoPlayer.play();
            playButton.style.display = 'none'; // Hide play button when playing
          } else {
            videoPlayer.pause();
            playButton.style.display = 'block'; // Show play button when paused
          }
        }
    
        // Event listener for play button click
        playButton.addEventListener('click', togglePlayPause);
    
        // Event listener for video play/pause
        videoPlayer.addEventListener('play', () => {
          playButton.style.display = 'none'; // Hide play button when video is playing
        });
    
        videoPlayer.addEventListener('pause', () => {
          playButton.style.display = 'block'; // Show play button when video is paused
        });      
        
    });



    //Copy Clipboard

    function myFunction() {
      var copyText = document.getElementById("videoPlayer");
      copyText.select();
      copyText.setSelectionRange(0, 99999);
      navigator.clipboard.writeText(copyText.value);
      
      var tooltip = document.getElementById("myTooltip");
      tooltip.innerHTML = "Copied: " + copyText.value;
    }
    
    function outFunc() {
      var tooltip = document.getElementById("myTooltip");
      tooltip.innerHTML = "Copy to clipboard";
    }
    
  



})