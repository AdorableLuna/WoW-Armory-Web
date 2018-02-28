let mix = require('laravel-mix');

mix.js(['resources/assets/js/character.js',
        ], 'public/js/character.js');
mix.js(['resources/assets/js/collections.js',
        ], 'public/js/collections.js');

mix.js(['resources/assets/js/background.js',
        ], 'public/js/app.js');

mix.sass('resources/assets/sass/app.scss', 'public/css');