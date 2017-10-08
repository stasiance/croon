# FoundationPress

This is a starter-theme for WordPress based on [Foundation 6](http://foundation.zurb.com/sites.html), the most advanced responsive (mobile-first) framework in the world.

## Requirements

**This project requires [Node.js](http://nodejs.org) v4.x.x to v6.11.x to be installed on your machine.**

FoundationPress uses [Sass](http://Sass-lang.com/) (CSS with superpowers). In short, Sass is a CSS pre-processor that allows you to write styles more effectively and tidy.

The Sass is compiled using libsass, which requires the GCC to be installed on your machine. Windows users can install it through [MinGW](http://www.mingw.org/), and Mac users can install it through the [Xcode Command-line Tools](http://osxdaily.com/2014/02/12/install-command-line-tools-mac-os-x/).

## Quickstart

### 1. Clone the repository and install with npm
```bash
$ npm install
```

### 2. Get started

If you want to take advantage of browser-sync (automatic browser refresh when a file is saved), simply open your gulpfile.babel.js and put your local dev-server address and port (e.g http://localhost:8888) in the `URL` variable.

Then, simply run

```bash
$ npm start
```

### 3. Compile assets for production

When building for production, the CSS and JS will be minified. To minify the assets in your `/dist` folder, run

```bash
$ npm run build
```

### Project structure

In the `/src` folder you will the working files for all your assets. Every time you make a change to a file that is watched by Gulp, the output will be saved to the `/dist` folder. The contents of this folder is the compiled code that you should not touch (unless you have a good reason for it).

The `/page-templates` folder contains templates that can be selected in the Pages section of the WordPress admin panel. To create a new page-template, simply create a new file in this folder and make sure to give it a template name.

I guess the rest is quite self explanatory. Feel free to ask if you feel stuck.

### Styles and Sass Compilation

 * `style.css`: Do not worry about this file. (For some reason) it's required by WordPress. All styling are handled in the Sass files described below

 * `src/assets/scss/app.scss`: Make imports for all your styles here
 * `src/assets/scss/global/*.scss`: Global settings
 * `src/assets/scss/components/*.scss`: Buttons etc.
 * `src/assets/scss/modules/*.scss`: Topbar, footer etc.
 * `src/assets/scss/templates/*.scss`: Page template styling

 * `dist/assets/css/app.css`: This file is loaded in the `<head>` section of your document, and contains the compiled styles for your project.

If you're new to Sass, please note that you need to have Gulp running in the background (``npm start``), for any changes in your scss files to be compiled to `app.css`.

### JavaScript Compilation

All JavaScript files in the `src/assets/js` folder, along ith Foundation and its dependencies, are bundled into one file called `app.js`. The files are imported using module dependency with [webpack](https://webpack.js.org/) as the module bundler.

If you're unfamiliar with modules and module bundling, check out [this resource for node style require/exports](http://openmymind.net/2012/2/3/Node-Require-and-Exports/) and [this resource to understand ES6 modules](http://exploringjs.com/es6/ch_modules.html).

Foundation modules are loaded in the `src/assets/js/app.js` file. By default all components are loaded. You can also pick and choose which modules to include. Just follow the instructions in the file.
