# grunt-license-bower [![Build Status](https://secure.travis-ci.org/senssei/grunt-license-bower.png?branch=master)](http://travis-ci.org/senssei/grunt-license-bower)
[![NPM version](https://badge.fury.io/js/grunt-license-bower.svg)](http://badge.fury.io/js/grunt-license-bower)

[![Dependency Status](https://gemnasium.com/senssei/grunt-license-bower.svg)](https://gemnasium.com/senssei/grunt-license-bower) 

[![Code Climate](https://codeclimate.com/github/senssei/grunt-license-bower.png)](https://codeclimate.com/github/senssei/grunt-license-bower)


> Generate a list of licenses used within a project based on bower.json.


## Getting Started
This plugin requires Grunt `~0.4.1`

If you haven't used [Grunt](http://gruntjs.com/) before, be sure to check out the [Getting Started](http://gruntjs.com/getting-started) guide, as it explains how to create a [Gruntfile](http://gruntjs.com/sample-gruntfile) as well as install and use Grunt plugins. Once you're familiar with that process, you may install this plugin with this command:

```shell
npm install grunt-license-bower --save-dev
```

Once the plugin has been installed, it may be enabled inside your Gruntfile with this line of JavaScript:

```js
grunt.loadNpmTasks('grunt-license-bower');
```

or load grunt tasks automatically
  
```js
require('load-grunt-tasks')(grunt);
```

## The "license" task

### Overview
In your project's Gruntfile, add a section named `license` to the data object passed into `grunt.initConfig()`.

```js
grunt.initConfig({
	license: {
      your_target: {
      // Target-specific file lists and/or options go here.
        options: {
        // Target-specific options go here.
           directory: 'bower_components',
           output: 'LICENSES'
        },
      },
    },
})
```

### Options

#### options.directory
Type: `String`
Default Value: `bower_components`

The path in which installed components should be saved. If not specified this defaults to bower_components.

#### options.output
Type: `String`
Default Value: `LICENSES`

The path/filename to write the metadata to.

## Contributing
In lieu of a formal styleguide, take care to maintain the existing coding style. Add unit tests for any new or changed functionality. Lint and test your code using [Grunt](http://gruntjs.com/).

## License

Copyright (c) 2014 Rafał Warzycha  
Licensed under the MIT license.
