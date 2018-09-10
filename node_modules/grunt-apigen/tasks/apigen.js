/*
 * grunt-apigen
 * https://github.com/Cibulka/grunt-apigen
 *
 * Copyright (c) 2015 Petr Cibulka
 * Licensed under the MIT license.
 */

'use strict';

module.exports = function(grunt) {

  var apigen = require('./lib/apigen-lib').init(grunt);

  grunt.registerMultiTask('apigen', 'Grunt task for generating Apigen documentation.', function() {

    var optionsDefault = {
	  apigenPath: 'vendor/bin/',
	  source: './',
	  destination: './apigen-docs',
	  quiet: false
    };

    apigen.setup(this, optionsDefault);
    
    apigen.checkApigen();

  });

};
