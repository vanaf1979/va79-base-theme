const mix = require('laravel-mix');
const ImageminPlugin = require('imagemin-webpack-plugin').default;
const CopyWebpackPlugin = require('copy-webpack-plugin');
const imageminMozjpeg = require('imagemin-mozjpeg');


mix.autoload({})
.js('src/js/app.js', 'public/js/app.js')
.js('src/js/sw.js', 'public/js/sw.js')
.sass('src/css/header.scss', 'public/css/header.css')
.sass('src/css/header-ie9.scss', 'public/css/header-ie9.css')
.sass('src/css/header-ie8.scss', 'public/css/header-ie8.css')
.sass('src/css/footer.scss', 'public/css/footer.css')
.sass('src/css/style.scss', 'style.css')
.sass('src/css/rtl.scss', 'rtl.css')
.options({
  processCssUrls: false,
  autoprefixer: {
    options: {
      browsers: '>0.1%'
    }
  },
  postCss: [
    require('cssnext')
  ]
})
.webpackConfig({
  plugins: [
      new CopyWebpackPlugin([
        {
          from: 'src/img',
          to: 'public/img',
        }
      ]),
      new ImageminPlugin({
          test: /\.(jpe?g|png|gif|svg)$/i,
          plugins: [
              imageminMozjpeg({
                  quality: 80,
              })
          ]
      })
  ]
});


// Full API
// mix.js(src, output);
// mix.react(src, output); <-- Identical to mix.js(), but registers React Babel compilation.
// mix.ts(src, output); <-- Requires tsconfig.json to exist in the same folder as webpack.mix.js
// mix.extract(vendorLibs);
// mix.sass(src, output);
// mix.standaloneSass('src', output); <-- Faster, but isolated from Webpack.
// mix.fastSass('src', output); <-- Alias for mix.standaloneSass().
// mix.less(src, output);
// mix.stylus(src, output);
// mix.postCss(src, output, [require('postcss-some-plugin')()]);
// mix.browserSync('my-site.dev');
// mix.combine(files, destination);
// mix.babel(files, destination); <-- Identical to mix.combine(), but also includes Babel compilation.
// mix.copy(from, to);
// mix.copyDirectory(fromDir, toDir);
// mix.minify(file);
// mix.sourceMaps(); // Enable sourcemaps
// mix.version(); // Enable versioning.
// mix.disableNotifications();
// mix.setPublicPath('path/to/public');
// mix.setResourceRoot('prefix/for/resource/locators');
// mix.autoload({}); <-- Will be passed to Webpack's ProvidePlugin.
// mix.webpackConfig({}); <-- Override webpack.config.js, without editing the file directly.
// mix.then(function () {}) <-- Will be triggered each time Webpack finishes building.
// mix.options({
//   extractVueStyles: false, // Extract .vue component styling to file, rather than inline.
//   globalVueStyles: file, // Variables file to be imported in every component.
//   processCssUrls: true, // Process/optimize relative stylesheet url()'s. Set to false, if you don't want them touched.
//   purifyCss: false, // Remove unused CSS selectors.
//   uglify: {}, // Uglify-specific options. https://webpack.github.io/docs/list-of-plugins.html#uglifyjsplugin
//   postCss: [] // Post-CSS options: https://github.com/postcss/postcss/blob/master/docs/plugins.md
// });
