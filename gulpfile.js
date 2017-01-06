const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    mix.sass('backend/backend.scss');
    mix.sass('login.scss');
    mix.sass('logout.scss');
    mix.sass('emails.scss');
    mix.sass('app.scss');
    mix.sass('welcome.scss');
    mix.sass('404.scss');

    mix.browserify([
        // home scripts and helper
    	'Notifier/Helper.js',
    	'Notifier/app/App.js',

    	// components
    	'Notifier/components/Header.js'
    ], 'public/js/notifier.js');

    mix.copy(
        'resources/assets/js/vendor/vue.js',
        'public/js/vendor/vue.js'
    );
});
