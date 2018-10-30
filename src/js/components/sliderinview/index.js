var Utils = require('../../components/utils/index.js');
var inView = require('in-view');
var Swiper = require('swiper');

var sliderInView = {

    swiper: null,
    slider: null,

    init: function()
    {
        this.slider = Utils.find( '.main-slider' );

        if( this.slider )
        {
            this.sliderInView();
        }
        else
        {
            console.debug( 'Slider not present on page.' );
        }
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
            this.swiper = new Swiper( this.slider , {
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

            
            // Swiper Events

            this.swiper.on('init', () => {
                console.debug( 'Slider entered the viewport and was initialized' );
            });


            this.swiper.on('slideChangeTransitionEnd', () => {
                // var currentSlide = this.swiper.slides[ this.swiper.realIndex ];
                console.debug( 'Slider is now showwing slide nr: ' + this.swiper.realIndex );
            });


            this.swiper.on('destroy', () => {
                console.debug( 'Slider left the viewport and was destroyed' );
            });

        }
    },


    deactivateSwiper: function()
    {
        if( this.swiper )
        {
            this.swiper.destroy( true , false );
            this.swiper = null;
        }
    }

}


module.exports = sliderInView;

