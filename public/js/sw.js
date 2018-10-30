/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 7);
/******/ })
/************************************************************************/
/******/ ({

/***/ 7:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(8);


/***/ }),

/***/ 8:
/***/ (function(module, exports) {


/*
** Google Workbox.
** Routing and Caching of resources.
** https://developers.google.com/web/tools/workbox
*/

importScripts('https://storage.googleapis.com/workbox-cdn/releases/3.2.0/workbox-sw.js');

var vaCacheName = 'va79-cache';
var vaRevision = '00001';

if (workbox) {

    /*
    ** PRECACHE:
    */
    workbox.precaching.precacheAndRoute([{ url: 'app/themes/vanaf1979/public/js/app.js', revision: vaRevision }, { url: 'app/themes/vanaf1979/public/css/header.css', revision: vaRevision }, { url: 'app/themes/vanaf1979/public/css/footer.css', revision: vaRevision }]);

    /*
    ** ROUTE: All Wordpress pretty urls.
    */
    workbox.routing.registerRoute(new RegExp('^/([\w\/]*(\.html)?)$'), workbox.strategies.staleWhileRevalidate({
        cacheName: vaCacheName + '-pages',
        plugins: [new workbox.expiration.Plugin({
            maxEntries: 100,
            maxAgeSeconds: 7 * 24 * 60 * 60
        })]
    }));

    /*
    ** ROUTE: All Js files.
    */
    workbox.routing.registerRoute(new RegExp('.*\.js'), workbox.strategies.staleWhileRevalidate({
        cacheName: vaCacheName + '-js',
        plugins: [new workbox.expiration.Plugin({
            maxEntries: 100,
            maxAgeSeconds: 7 * 24 * 60 * 60
        })]
    }));

    /*
    ** ROUTE: All Css files.
    */
    workbox.routing.registerRoute(new RegExp('.*\.css'), workbox.strategies.staleWhileRevalidate({
        cacheName: vaCacheName + '-css',
        plugins: [new workbox.expiration.Plugin({
            maxEntries: 100,
            maxAgeSeconds: 7 * 24 * 60 * 60
        })]
    }));

    /*
    ** ROUTE: All Image files.
    */
    workbox.routing.registerRoute(new RegExp('.*\.(?:png|jpg|jpeg|svg|gif)'), workbox.strategies.staleWhileRevalidate({
        cacheName: vaCacheName + '-img',
        plugins: [new workbox.expiration.Plugin({
            maxEntries: 100,
            maxAgeSeconds: 7 * 24 * 60 * 60
        })]
    }));

    /*
    ** ROUTE: All Google fonts.
    */
    workbox.routing.registerRoute(new RegExp('https://fonts.(?:googleapis|gstatic).com/(.*)'), workbox.strategies.cacheFirst({
        cacheName: vaCacheName + '-gfonts',
        plugins: [new workbox.expiration.Plugin({
            maxEntries: 30,
            maxAgeSeconds: 7 * 24 * 60 * 60
        })]
    }));

    /*
    ** ROUTE: Font Awesome fonts.
    */
    workbox.routing.registerRoute(new RegExp('https://maxcdn.bootstrapcdn.com/font-awesome/(.*)'), workbox.strategies.cacheFirst({
        cacheName: vaCacheName + '-fafonts',
        plugins: [new workbox.expiration.Plugin({
            maxEntries: 30,
            maxAgeSeconds: 7 * 24 * 60 * 60
        })]
    }));

    /*
    ** GA: Offline Google Analytics handling.
    */
    workbox.googleAnalytics.initialize();
}

/***/ })

/******/ });