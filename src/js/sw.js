
/*
** Google Workbox.
** Routing and Caching of resources.
** https://developers.google.com/web/tools/workbox
*/

importScripts('https://storage.googleapis.com/workbox-cdn/releases/3.2.0/workbox-sw.js');

const vaCacheName = 'va79-cache';
const vaRevision = '00001';

if ( workbox )
{

    /*
    ** PRECACHE:
    */
    workbox.precaching.precacheAndRoute([
        { url: '/wp-content/themes/va79-base-theme/public/js/app.js', revision: vaRevision },
        { url: '/wp-content/themes/va79-base-theme/public/css/header.css', revision: vaRevision },
        { url: '/wp-content/themes/va79-base-theme/public/css/footer.css', revision: vaRevision }
    ]);


    /*
    ** ROUTE: All Wordpress pretty urls.
    */
    workbox.routing.registerRoute(
        new RegExp('^/([\w\/]*(\.html)?)$'),
        workbox.strategies.staleWhileRevalidate({
            cacheName: vaCacheName + '-pages',
            plugins: [
                new workbox.expiration.Plugin({
                    maxEntries: 100,
                    maxAgeSeconds: 7 * 24 * 60 * 60,
                })
            ],
        })
    );


    /*
    ** ROUTE: All Js files.
    */
    workbox.routing.registerRoute(
        new RegExp('.*\.js'),
        workbox.strategies.staleWhileRevalidate({
            cacheName: vaCacheName + '-js',
            plugins: [
                new workbox.expiration.Plugin({
                    maxEntries: 100,
                    maxAgeSeconds: 7 * 24 * 60 * 60,
                })
            ],
        })
    );


    /*
    ** ROUTE: All Css files.
    */
    workbox.routing.registerRoute(
        new RegExp('.*\.css'),
        workbox.strategies.staleWhileRevalidate({
            cacheName: vaCacheName + '-css',
            plugins: [
                new workbox.expiration.Plugin({
                    maxEntries: 100,
                    maxAgeSeconds: 7 * 24 * 60 * 60,
                })
            ],
        })
    );

    
    /*
    ** ROUTE: All Image files.
    */
    workbox.routing.registerRoute(
        new RegExp('.*\.(?:png|jpg|jpeg|svg|gif)'),
        workbox.strategies.staleWhileRevalidate({
            cacheName: vaCacheName + '-img',
            plugins: [
                new workbox.expiration.Plugin({
                    maxEntries: 100,
                    maxAgeSeconds: 7 * 24 * 60 * 60,
                })
            ],
        })
    );


    /*
    ** ROUTE: All Google fonts.
    */
    workbox.routing.registerRoute(
        new RegExp('https://fonts.(?:googleapis|gstatic).com/(.*)'),
        workbox.strategies.cacheFirst({
            cacheName: vaCacheName + '-gfonts',
            plugins: [
                new workbox.expiration.Plugin({
                    maxEntries: 30,
                    maxAgeSeconds: 7 * 24 * 60 * 60,
                }),
            ],
        }),
    );


    /*
    ** ROUTE: Font Awesome fonts.
    */
    workbox.routing.registerRoute(
        new RegExp('https://maxcdn.bootstrapcdn.com/font-awesome/(.*)'),
        workbox.strategies.cacheFirst({
            cacheName: vaCacheName + '-fafonts',
            plugins: [
                new workbox.expiration.Plugin({
                    maxEntries: 30,
                    maxAgeSeconds: 7 * 24 * 60 * 60,
                }),
            ],
        }),
    );


    /*
    ** GA: Offline Google Analytics handling.
    */
    workbox.googleAnalytics.initialize();

}