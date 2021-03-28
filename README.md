
<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Optimization
Though Laravel Mix is optimized for Laravel usage, it may be used for any type of application. Begin by installing Laravel Mix through NPM or Yarn, and then copying the example Mix file to your project root.

    mkdir my-app && cd my-app
    npm init -y
    npm install laravel-mix --save-dev
    cp node_modules/laravel-mix/setup/webpack.mix.js ./

You should now have the following directory structure:

    node_modules/
    package.json
    webpack.mix.js

The webpack.mix.js file is your configuration layer on top of webpack.
Most of your time will be spent here.

Head over to your webpack.mix.js file:

    const mix = require('laravel-mix');
    
    mix.js('src/app.js', 'dist')
       .sass('src/app.scss', 'dist')
       .setPublicPath('dist');

Take note of the source paths.
You're free to amend the paths to match your preferred structure, but if you're happy with our defaults simply run the following command to create the files and directories:

    mkdir src && touch src/app.{js,scss}

You're all set now.
Compile everything down by running:

    node_modules/.bin/webpack --config=node_modules/laravel-mix/setup/webpack.config.js

You should now see:

    dist/app.css
    dist/app.js
    dist/mix-manifest.json (Your asset dump file, which we'll discuss later.)

## Concatenation and Minification

```js
mix.combine(['src', 'files'], 'destination');
mix.babel(['src', 'files'], destination);
mix.minify('src');
mix.minify(['src']);

```

If used properly, Laravel Mix and webpack should take care of all the necessary module bundling and minification for you. However, you may have some legacy code or vendor libraries that need to be concatenated and minified. Not a problem.

### [](https://laravel-mix.com/docs/4.0/concatenation-and-minification#combine-files)Combine Files

Consider the following snippet:

```js
mix.combine(['one.js', 'two.js'], 'merged.js');

```

This will naturally merge  `one.js`  and  `two.js`  into a single file, called  `merged.js`. As always, during development, that merged file will remain uncompressed. However, for production (`export NODE_ENV=production`), this command will additionally minify  `merged.js`.

#### [](https://laravel-mix.com/docs/4.0/concatenation-and-minification#combine-files-with-babel-compilation)Combine Files With Babel Compilation

If you need to concatenate JavaScript files that have been written in ES2015, you may update your  `mix.combine()`  call to  `mix.babel()`. The method signature is identical. The only difference is that, after the files have been concatenated, Laravel Mix will perform Babel compilation on the result to transform the code to vanilla JavaScript that all browsers can understand.

```js
mix.babel(['one.js', 'two.js'], 'merged.js');

```

### [](https://laravel-mix.com/docs/4.0/concatenation-and-minification#minify-files)Minify Files

Similarly, you may also minify one or more files with the  `mix.minify()`  command.

```js
mix.minify('path/to/file.js');
mix.minify(['this/one.js', 'and/this/one.js']);

```

There are a few things worth noting here:

1.  This method will create a companion  `*.min.ext`  file. So minifying  `app.js`  will generate  `app.min.js`.
2.  Once again, the minification will only take place during a production build. (`export NODE_ENV=production`).
3.  There is no need to call  `mix.combine(['one.js', 'two.js'], 'merged.js').minify('merged.js');`Just stick with the single  `mix.combine()`  call. It'll take care of both.