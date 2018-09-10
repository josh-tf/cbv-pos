# grunt-script-link-tags [![Build Status](https://travis-ci.org/andrewjmead/grunt-script-link-tags.png)](https://travis-ci.org/andrewjmead/grunt-script-link-tags)

> Auto-generate `<script>` and `<link>` tags for your HTML files.

## Community

If you have any problems setting up or using `grunt-script-link-tags`, open an issue. I would be happy to help.

**This is an active repository** that takes user suggestions, feeback and pull requests seriously. Happy grunting!

## Getting Started
This plugin requires Grunt `~0.4.0`

If you haven't used [Grunt](http://gruntjs.com/) before, be sure to check out the [Getting Started](http://gruntjs.com/getting-started) guide, as it explains how to create a [Gruntfile](http://gruntjs.com/sample-gruntfile) as well as install and use Grunt plugins. Once you're familiar with that process, you may install this plugin with this command:

	npm install grunt-script-link-tags --save-dev

Once the plugin has been installed, it may be enabled inside your Gruntfile with this line of JavaScript:

	grunt.loadNpmTasks('grunt-script-link-tags');

## The "tags" task

### Overview
In your project's Gruntfile, add a section named `tags` to the data object passed into `grunt.initConfig()`.

	grunt.initConfig({
		tags: {
		    build: {
		        options: {
			        scriptTemplate: '<script src="{{ path }}"></script>',
					linkTemplate: '<link href="{{ path }}"/>',
		            openTag: '<!-- start template tags -->',
		            closeTag: '<!-- end template tags -->'
		        },
		        src: [
		            'site/js/**/*.js',
		            '!site/js/vendor/**/*.js'
		        ],
		        dest: 'site/index.html'
		    }
		}
	});


### Options

#### options.scriptTemplate

Type: `String`

Default value: `<script type="text/javascript" src="{{ path }}"></script>`

If a matched file has a `.js` extension, it will compile the `options.scriptTemplate` template with the file path.

#### options.linkTemplate

Type: `String`

Default value: `<link rel="stylesheet" type="text/css" href="{{ path }}"/>`

If a matched file has a `.css` extension, it will compile the `options.linkTemplate` template with the file path.

#### options.openTag
Type: `String`

Default value: `<!-- start auto template tags -->`

Specify where in the destination file to start adding script and link tags.

#### options.closeTag
Type: `String`

Default value: `<!-- end auto template tags -->`

Specify where in the destination file to stop adding script and link tags.

### Usage Examples

#### Default Options

The following is the default configuration. `tags` will generate script and link tags for all matching `src` files and using the default `scriptTemplate` and `linkTemplate` defined above. it will then add these tags to `site/index.html` between the default `openTag` and `closeTag`.

	grunt.initConfig({
		tags: {
		    build: {
		        src: [
		            'site/js/**/*.js',
		            '!site/js/vendor/**/*.js'
		        ],
		        dest: 'site/index.html'
		    }
		}
	});

#### Custom Options

You can override all default options. In the following multi-task, we have two tasks, one for compiling scripts `buildScripts`, and another for compiling link tags, `buildLinks`.

`buildScripts` overrides `scriptTemplate`, letting your define you own template with extra attributes. It also override `openTag` and `closeTag`, specifying that they are for scripts.

`buildLinks` overrides `linkTemplate` to add a `media` attribute to it's link tags. Like `buildScripts`, it overrides `openTag` and `closeTag` to specify it's auto-generated css.

	grunt.initConfig({
		tags: {
		    buildScripts: {
		        options: {
			        scriptTemplate: '<script type="text/javascript" src="{{ path }}"></script>',
		            openTag: '<!-- start script template tags -->',
		            closeTag: '<!-- end script template tags -->'
		        },
		        src: [
		            'site/js/**/*.js',
		            '!site/js/vendor/**/*.js'
		        ],
		        dest: 'site/index.html'
		    },
		    buildLinks: {
		        options: {
					linkTemplate: '<link rel="stylesheet" type="text/css" href="{{ path }}" media="screen"/>',
		            openTag: '<!-- start css template tags -->',
		            closeTag: '<!-- end css template tags -->'
		        },
		        src: [
		            'site/css/**/*.css'
		        ],
		        dest: 'site/index.html'
		    }
		}
	});

## Run Tests

    > npm install
    > npm test

## Contributing
In lieu of a formal guide, take care to maintain the existing coding style. Add unit tests for any new or changed functionality.

## Release History
 * 2014-15-10   v1.0.0   All added tags now match indentation of start tag thanks to [rahilwazir](https://github.com/rahilwazir). Added type/rel attributes to script/link defaults.
 * 2013-30-11   v0.0.5   First version!

---

Task submitted by [Andrew Mead](http://www.andrewjmead.com)
