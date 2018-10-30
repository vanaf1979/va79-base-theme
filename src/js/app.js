
/* Import utilities. */
var utils       = require('./components/utils/index.js');


/* Import components. */
var scriptLoaders   = require('./components/scriptloaders/index.js');


/* Initialize components. */
utils.domready( () => {

    scriptLoaders.init();

})