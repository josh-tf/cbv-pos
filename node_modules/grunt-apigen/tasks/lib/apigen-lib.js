/*
 * grunt-apigen
 * https://github.com/Cibulka/grunt-apigen
 *
 * Copyright (c) 2015 Petr Cibulka
 * Licensed under the MIT license.
 */
 
'use strict';

var ChildProcess = require('child_process'),
	Util = require('util'),
	Path = require('path'),
	Fs = require('fs')
;

exports.init = function(grunt) {
	
	var done = null,
		exports = {},
		options = {},
		apigenCommand = ''
	;
	
	exports.setup = function(runner, optionsDefault) {
		
		options = runner.options(optionsDefault);
		
		done = runner.async();
		
		// Basic commands
		apigenCommand = options.apigenPath + "apigen generate --source " + options.source + " --destination " + options.destination;
		
		// Quiet
		if (options.quiet === true) {
			apigenCommand += " --quiet";
		}
		
	};

	exports.checkApigen = function() {
		
		var childProcess = ChildProcess.exec(options.apigenPath + 'apigen --version', function(error, stdout, stderr) {
	
			if (error !== null) {
				grunt.log.writeln(error);
			}
			grunt.log.writeln(stderr);
			
		});
		
		childProcess.on('exit', function(code) {
			if(code > 0) {
				grunt.log.error(Util.format('The \'apigen -version\' command returned the error code \'%d\' !', code));
				grunt.log.error('Please check if you have Apigen installed.');
				return done(false);
			}
			this.run();
		}.bind(this));	
		
	};
	
	exports.run = function() {
		
		var exceptionEncountered = false;
		
		var childProcess = ChildProcess.exec(apigenCommand, function(error, stdout, stderr) {

			if(error !== null) {
				grunt.log.writeln(error);
			}
			grunt.log.writeln(stdout);
			grunt.log.writeln(stderr);

			if(stderr.toString().indexOf('[Exception]') > 0) {
				exceptionEncountered = true;
			}
			
		});		

		childProcess.on('close', function(code) {

			if (code > 0) {
				grunt.log.error(Util.format('Exited with code: %d.', code));
				return done(false);
			}

			if(exceptionEncountered) {
				grunt.log.error(Util.format('Apigen exception has been encountered !'));
				return done(false);
			}
			
			grunt.verbose.ok(Util.format('Exited with code: %d.', code));
			done();
		
		});
		
	};
	
	return exports;
	
};
