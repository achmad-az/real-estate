let mix = require('laravel-mix');
let path = require('path');

let assetSrc = 'assets/src';
let assetDist = 'assets/dist';

mix.setResourceRoot('../');
mix.setPublicPath(path.resolve('./'));

// Configure PostCSS plugins
let postcssPlugins = [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
];

// Development configuration
if (!mix.inProduction()) {
    mix.webpackConfig({
        devtool: 'source-map',
        watchOptions: {
            ignored: [
                path.posix.resolve(__dirname, './node_modules'),
                path.posix.resolve(__dirname, './assets/dist')
            ]
        }
    });

    mix.sourceMaps();
}

// Compile assets
mix.js(`${assetSrc}/js/app.js`, `${assetDist}/js`)
   //.js(`${assetSrc}/js/newsletter.js`, `${assetDist}/js`) // Menambahkan newsletter.js ke build
   .postCss(`${assetSrc}/css/app.css`, `${assetDist}/css`, postcssPlugins)
   .postCss(`${assetSrc}/css/editor-style.css`, `${assetDist}/css`, postcssPlugins)
   .copy(`${assetSrc}/fonts`, `${assetDist}/fonts`) 
   .copy(`${assetSrc}/images`, `${assetDist}/images`);

// Production specific
if (mix.inProduction()) {
    mix.version();
} else {
    mix.options({ manifest: false });
}

// BrowserSync
mix.browserSync({
    proxy: 'http://real-estate.test',
    host: 'real-estate.test',
    open: 'external',
    port: 8000,
    files: [
        `${assetSrc}/css/**/*.css`,
        `${assetSrc}/js/**/*.js`
    ]
});