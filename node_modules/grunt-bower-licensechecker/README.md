Bower License Checker
==============================
[Grunt](http://gruntjs.com) plugin to test licenses in [Bower](http://bower.io) components folder agains list provided.
May display log while running or save in output file.

Getting Started
------------------------------
This plugin requires Grunt `~0.4.5`

If you haven't used [Grunt](http://gruntjs.com/) before, be sure to check out the [Getting Started](http://gruntjs.com/getting-started) guide, as it explains how to create a [Gruntfile](http://gruntjs.com/sample-gruntfile) as well as install and use Grunt plugins. Once you're familiar with that process, you may install this plugin with this command:

```shell
npm install grunt-bower-licensechecker --save-dev
```

Once the plugin has been installed, it may be enabled inside your Gruntfile with this line of JavaScript:

```js
grunt.loadNpmTasks('grunt-bower-licensechecker');
```

License Checker API
------------------------------
### Overview

In your project's Gruntfile, add a section named licensechecker to the data object passed into grunt.initConfig().

```js
'bower-licensechecker': {
  options: {
    directory: 'path/to/bower',
    acceptable: [ 'MIT', 'BSD' ],
    printTotal: true,
    warn: {
      nonBower: true,
      noLicense: true,
      allGood: true,
      noGood: true
    },
    log: {
      outFile: '.licenses',
      nonBower: true,
      noLicense: true,
      allGood: true,
      noGood: true,
    }
  }
},
```

### Options

#### options.directory
    Type: `String`
    Default value: `bower_components`
    Acceptable Values: `null`, `String`
Path to Bower directory. If `null` it will look for [.bowerrc](http://bower.io/docs/config) and get path from Bower config.


#### options.acceptable
    Type: `Array{String}`
    Default value: `[]`
    Acceptable Values: `Array of Strings`

Array of licenses to test against.


#### options.printTotal
    Type: `Boolean`
    Default value: `false`
    Acceptable Values: `true`, `false`
If `true`, prints total summary for Good, Bad, Not specified Licenses and if it's considered Non-Bower component.

#### options.warn
    Type: `Object`
    Default value: `null`
    Acceptable Values: `Object`, `null`, `false`

If `{}` or `true`, it will print generic state of the performed check using `grunt.log.ok` or `grunt.log.warn`. Otherwise, nothing is going to be printed.

Boolean Options:
*    `nonBower`: Prints list of Non-Bower components detected in specified folder (in case `bower.json` doesn't exist)
*    `noLicense`: Prints list of Bower components witout license in `bower.json`
*    `allGood`: Prints list of Bower components that match license list at `options.acceptable`
*    `noGood`: Prints list of Bower components that don't match license list at `options.acceptable`



#### options.log
    Type: `Object`
    Default value: `null`
    Acceptable Values: `Object`, `null`, `false`
    Required param: `outFile`

`outFile` must be specified in order for output file to be made. If no other options are provided the output file will be empty.

Boolean Options:
*    `nonBower`: Writes list of Non-Bower components detected in specified folder (in case `bower.json` doesn't exist)
*    `noLicense`: Writes list of Bower components witout license in `bower.json`
*    `allGood`: Writes list of Bower components that match license list at `options.acceptable`
*    `noGood`: Writes list of Bower components that don't match license list at `options.acceptable`

Contributing
------------------------------
In lieu of a formal styleguide, take care to maintain the existing coding style. Add unit tests for any new or changed functionality. Lint and test your code using [Grunt](http://gruntjs.com/).


