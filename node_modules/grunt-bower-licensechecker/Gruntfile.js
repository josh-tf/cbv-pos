/*
 * grunt-bower-licensechecker
 * https://github.com/max-gram/grunt-bower-licensechecker
 *
 * Copyright © 2015 Max Gram
 * Licensed under the MIT license.
 */

'use strict';

module.exports = function(grunt) {
  // Load all grunt tasks
  require('load-grunt-tasks')(grunt);

  grunt.initConfig({
    // Syntax
    'jshint': {
      all: [
        'Gruntfile.js',
        'tasks/*.js',
        '<%= nodeunit.tests %>'
      ],
      options: {
        jshintrc: '.jshintrc'
      }
    },

    // Settings
    'bower-licensechecker': {
      options: {
        directory: 'path/to/bower',
        acceptable: [ 'MIT', 'BSD' ],
        printTotal: true,
        // warn:{
        //   nonBower: true,
        //   noLicense: true,
        //   allGood: true,
        //   noGood: true
        // },
        // log: {
        //   outFile: '.licenses',
        //   nonBower: true,
        //   noLicense: true,
        //   allGood: true,
        //   noGood: true,
        // },
      }
    },

    // Unit tests.
    'nodeunit': {
      tests: ['test/*_test.js']
    },

  });

  grunt.loadTasks('tasks');

  grunt.registerTask( 'dev', ['jshint', 'bower-licensechecker'] );
  grunt.registerTask( 'default', 'bower-licensechecker' );
};
