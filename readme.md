## Va79 Base Wordpress theme boilerplate
A basic worpress theme boilerplate for builing, but not limmited to, corporate websites. It utilizes [NPM](https://www.npmjs.com/) for dependancy management, [Laravel Mix](https://laravel.com/docs/5.7/mix) to compiling assets with webpack, and [TGM Plugin Activation](http://tgmpluginactivation.com/) for installing required plugins within the wordpress admin.  

  #### Note
I recoment forking this repo to customize it to your liking.  

#### NPM
This theme uses [NPM](https://www.npmjs.com/) for dependancy management.
```console
$ cd your/theme/directory
$ npm install // to initialize and install the dependancies.
```

#### Laravel Mix
This theme uses [Laravel Mix](https://laravel.com/docs/5.7/mix) to compiling assets with webpack. The content of the /src directory will be compiled to the /public directory. (You must run npm install for mix to work.)  

Use the following commands from within your theme directory.
```console
$ npm run dev // Run all Mix tasks.
```
```console
$ npm run production // Run all Mix tasks and minify output.
```
```console
$ npm run watch // Continue running in your terminal and watch all relevant files for changes.
```


#### TGM Plugin Activation
This theme uses [TGM Plugin Activation](http://tgmpluginactivation.com/) for installing the following required plugins:
- [Advanced Custom Fields](https://nl.wordpress.org/plugins/advanced-custom-fields/)
- [Advanced Custom Fields: Flexible Content Field](https://www.advancedcustomfields.com/resources/flexible-content/)
- [Advanced Custom Fields: Gallery Field](https://www.advancedcustomfields.com/resources/gallery/)
- [Advanced Custom Fields: Repeater Field](https://www.advancedcustomfields.com/resources/repeater/)
- [CMS Tree Page View](https://nl.wordpress.org/plugins/cms-tree-page-view/)
- [Cache Enabler](https://nl.wordpress.org/plugins/cache-enabler/)
- [reSmush.it Image Optimizer](https://nl.wordpress.org/plugins/resmushit-image-optimizer/)

#### Service worker
This theme uses a [Google Workbox](https://developers.google.com/web/tools/workbox/) service worker to leverage browser caching

#### Functions.php
The functions.php loads a va79-theme-class.php file packed with all kinds of nice trickery:
- Clean up the header and footer.
- Loading header, footer, ie8 and ie9 css files. 
- Loading app.js and html5shiv.js
- Adds four widget areas for the footer.
- etc... View the source code its pretty self explanatory.

#### Todo
- Testing the theme for v1.0 tag.

#### Fork / Comments / Suggestions
Please feel free to fork this repo to make it your own or to send any comments or suggestions my way. Any chance to improve, and there are lots, are always welcome.

#### About Vanaf1979.nl
Wordpress, php, javascript and css development enthusiast. [Vanaf1979.nl](http://vanaf1979.nl)
