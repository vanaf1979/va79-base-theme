var inView       = require('in-view');
var Swiper       = require('swiper');

var sliderInView = {

    swiper: null,

    init: function()
    {
        this.sliderInView();
    },


    sliderInView: function()
    {
        inView.offset(-50);

        inView('.main-slider').on( 'enter', ( el ) => {
            
            this.activateSwiper();

        }).on('exit', ( el ) => {
            
            this.deactivateSwiper();

        });
    },


    activateSwiper: function()
    {
        if( ! this.swiper )
        {
            this.swiper = new Swiper('.swiper-container', {
                slidesPerView: 1,
                spaceBetween: 0,
                effect: 'fade',
                autoHeight: true,
                grabCursor: true,
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: true,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });


            this.swiper.on('init', () => {
                console.debug( 'Slider entered the viewport and was initialized' );
            });


            this.swiper.on('slideChangeTransitionEnd', () => {
                // var currentSlide = this.swiper.slides[ this.swiper.realIndex ];
                console.debug( 'Slider is now showwing slide nr: ' + this.swiper.realIndex );
            });

        }
    },


    deactivateSwiper: function()
    {
        if( this.swiper )
        {
            this.swiper.destroy( true , true );
            this.swiper = null;
            console.debug( 'Slider left the viewport and was destroyed' );
        }
    }

}


module.exports = sliderInView;

