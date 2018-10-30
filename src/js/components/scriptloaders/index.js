var utils       = require('../../components/utils/index.js');

var scriptLoaders = {

  init: function( ) {

    // Add Google Analytics
    //this.addGoogleAnalytics();

    // Register Service Worker
    this.registerServiceworkerJs();

    // Add footer css
    this.addFooterCss();

  },


  registerServiceworkerJs: function()
  {
    if ( 'serviceWorker' in navigator )
    {
      window.addEventListener( 'load' , () => {
        navigator.serviceWorker.register('/wp-content/themes/va79/public/js/sw.js');
        console.log('Service worker registered');
      });
    }
  },


  addFooterCss: function()
  {
    // Add footer css styles.
    utils.addStyle( '/app/themes/vanaf1979/public/css/footer.css' , 'body' , null );
  },


  addGoogleAnalytics: function()
  {
    // Append and initialize Google Analytics.
    utils.addScript( 'https://www.googletagmanager.com/gtag/js?id=UA-75868924-1' , () => {
      window.dataLayer = window.dataLayer || [];
      function gtag()
      {
        dataLayer.push(arguments);
      }
      gtag( 'js' , new Date() );
      gtag( 'config' , 'UA-75868924-1' );
    });
  },


}


module.exports = scriptLoaders;
