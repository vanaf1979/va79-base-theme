var inView       = require('in-view');

var footerInView = {

    init: function( ) {

        this.testToConsole();

    },


    testToConsole: function()
    {
        inView.offset(-50);

        inView('.footer')
        .on( 'enter', ( el ) => {
            console.log('Footer entered the viewport');
        })
        .on('exit', ( el ) => {
            console.log('Footer left the viewport');
        });
    },

}


module.exports = footerInView;
