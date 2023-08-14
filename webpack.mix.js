const mix = require('laravel-mix');
const path = require('path');

mix
   .setPublicPath('./')

   //js
   .ts('assets/public/js/app.ts', 'build/public')
   .ts('assets/admin/js/app.ts', 'build/admin')

   //styles
   .sass('assets/public/styles/app.scss', 'build/public')
   .sass('assets/admin/styles/app.scss', 'build/admin')

   //webpack additional settings
   .webpackConfig({
      resolve: {
          extensions: [".ts", ".tsx", ".js", ".jsx"],
          alias: {
              '@pubRoot': path.resolve(__dirname, 'assets/public/js/'),
              '@pubCore': path.resolve(__dirname, 'assets/public/js/Core/'),
              '@pubGames': path.resolve(__dirname, 'assets/public/js/Games/')
          },
      },
  })
   .version();