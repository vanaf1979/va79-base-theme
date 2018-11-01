
/* Import utilities. */
var utils = require('./components/utils/index.js');


/* Import components. */
var scriptLoaders = require('./components/scriptloaders/index.js');
var sliderInView = require('./components/sliderinview/index.js');
var footerInView = require('./components/footerinview/index.js');
var slideMenu = require('./components/slidemenu/index.js');


/* Initialize components. */
utils.domready( () => {

    // Load external scripts and styles.
    scriptLoaders.init();

    slideMenu.init();
    
    // Simple demo of inview.js
    footerInView.init();

    // Demo of inview.js in comination with swiper.js
    sliderInView.init();

})