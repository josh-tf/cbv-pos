/*
 * grunt-bower-licensechecker
 * https://github.com/max-gram/grunt-bower-licensechecker
 *
 * Copyright © 2015 Max Gram
 * Licensed under the MIT license.
 */

'use strict';

module.exports = function( grunt ) {
  grunt.file.defaultEncoding = 'utf8';
  grunt.task.registerTask( 'bower-licensechecker', 'Checks Bower licenses', function() {
    var o = this.options() || {};

    // Read the path from Bower config
    if( !o.directory && grunt.file.isFile( '.bowerrc' ) ){
      o.directory = grunt.file.readJSON('.bowerrc').directory;
    }

    var
    licenseGood = [],
    licenseBad = [],
    licenseEmpty = [],
    noBowerJson = [],
    acceptableList = o.acceptable || [],
    rootDir = process.cwd() + '/',
    bowerDir = rootDir + (o.directory || 'bower_components') + '/',

    compareAcceptable = function(license){
      for( var i in acceptableList ) {
        if(license.indexOf(acceptableList[i]) !== -1){
          return true;
        }
      }
      return false;
    },
    getLicense = function(dir){
      var libLicense,
          packageName = String(dir).replace(bowerDir, ''),
          obj = { package: packageName, dir: dir, license: null};

      try{
        // Has bower.json so the assumption is it's Bower Component
        libLicense = grunt.file.readJSON(dir + '/bower.json').license;
        obj.license = libLicense;

        if(typeof libLicense === 'undefined'){
          // No License
          licenseEmpty.push( obj );

        }else if(typeof libLicense === 'string'){
          // Singe license
          compareAcceptable(libLicense) ? licenseGood.push(obj) : licenseBad.push(obj);  // jshint ignore:line

        }else if(libLicense instanceof Array){
          // Multiple licenses
          for( var i in libLicense ) {
            compareAcceptable(libLicense[i]) ? licenseGood.push(obj) : licenseBad.push(obj);  // jshint ignore:line
          }
        }
      }catch(e){
        // Non-Bower Component
        noBowerJson.push( obj );
      }
    },
    prepLog = function(arr, opt){
      var o = opt || {title: ''};
      var mArr = [o.title];

      for( var i in arr ) {
        var msg = arr[i].package + (arr[i].license ? ' > ':'') + (arr[i].license || '');
        mArr.push(msg);
      }
      return mArr;
    },
    printMessage = function(msg, opt){
      var o = opt || {};

      if (typeof o.error === 'undefined') {
        grunt.log.writeln(msg);
      } else {
        if (o.error) {
          grunt.log.error(msg);
        } else {
          grunt.log.ok(msg);
        }
      }
    },
    printWarn = function(arr, opt){
      var o = opt || {firstIsTitle: true, error: true};
      for( var i in arr ) {
        if(o.firstIsTitle && i == 0){ // jshint ignore:line
          printMessage( arr[i] );
        } else {
          printMessage( arr[i], {error: o.error} );
        }
      }
      grunt.log.writeln(''); //line break
    };


    if(!grunt.file.isDir(bowerDir)){
      grunt.fail.warn('Please make sure you have right path to bower components folder.');
    }
    grunt.file.expand(bowerDir + '*').forEach( getLicense );


    // Print warnings
    if(o.warn) {
      var log;
      if (licenseBad.length < 1 && licenseEmpty.length < 1 && noBowerJson.length < 1) {
        printMessage('All GOOD!', {error: false});
      } else {
        printMessage('SOME LICENSES ARE NOT OK!', {error: true});
        grunt.log.writeln(''); //line break

        if(licenseGood.length > 0 && o.warn.allGood){
          log = prepLog( licenseGood, {title: '=== [ ALL GOOD ] ==='} );
          printWarn(log, {firstIsTitle: true, error: false});
        }
        if(noBowerJson.length > 0 && o.warn.nonBower ){
          log = printWarn( prepLog(noBowerJson, {title: '=== [ NON-BOWER ] ==='}) );
        }
        if(licenseEmpty.length > 0 && o.warn.noLicense){
          log = printWarn( prepLog(licenseEmpty, {title: '=== [ NO LICENSE ] ==='}) );
        }
        if(licenseBad.length > 0 && o.warn.noGood){
          log = printWarn( prepLog(licenseBad, {title: '=== [ LICENSE NOT OK ] ==='}) );
        }
      }
    }

    // Print total
    if(o.printTotal){
      printMessage('=== [ TOTALS ] ===');
      printMessage('Licenses OK: ' + licenseGood.length, {error: false});
      printMessage('License NOT OK: ' + licenseBad.length, {error: true});
      printMessage('License NOT DEFINED: ' + licenseEmpty.length, {error: true});
      printMessage('Non-Bower Package: ' + noBowerJson.length, {error: true});
    }

    // Writting log into a file
    if(o.log && o.log.outFile){
      var out = '';

      if(licenseGood.length > 0 && o.log.allGood){
        out += prepLog(licenseGood, {title: '=== [ ALL GOOD ] ==='}).join('\n');
      }
      if(noBowerJson.length > 0 && o.log.nonBower ){
        out += prepLog(noBowerJson, {title: '\n\n=== [ NON-BOWER ] ==='}).join('\n');
      }
      if(licenseEmpty.length > 0 && o.log.noLicense){
        out += prepLog(licenseEmpty, {title: '\n\n=== [ NO LICENSE ] ==='}).join('\n');
      }
      if(licenseBad.length > 0 && o.log.noGood){
        out += prepLog(licenseBad, {title: '\n\n=== [ LICENSE NOT OK ] ==='}).join('\n');
      }

      grunt.file.write(o.log.outFile, out);
    }

  });
};
