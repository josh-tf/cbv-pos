var fs = require('fs')
  , path = require('path')
  , request = require('request')
  , hashFile = require('hash_file')
  , spawn = require('child_process').spawn
  , freeport = require('freeport')
  , EventEmitter = require('events').EventEmitter
  , util = require('util')
  , chromeDriver = require('./chrome-driver')

var override = process.env.SELENIUM_VERSION ? process.env.SELENIUM_VERSION.split(':') : []
  , version = override[0] || '2.44.0'
  , majorMinorVersion = version.split('.').slice(0, 2).join('.')
  , expectedSha = override[1] || 'deb2a8d4f6b5da90fd38d1915459ced2e53eb201'
  , filename = 'selenium-server-standalone-' + version + '.jar'
  , url = 'http://selenium-release.storage.googleapis.com/' + majorMinorVersion + '/' + filename
  , outfile = path.join(path.dirname(__filename), '..', 'tmp', filename)

function download(cb) {
  var real = function() {
    console.log('Downloading Selenium ' + version)
    var i = 0
    var requestOptions = {url: url};
    if (process.env.http_proxy != null) {
      requestOptions.proxy = process.env.http_proxy;
    }
    request(requestOptions)
      .on('end', function() {
        process.stdout.write('\n')
        cb()
      })
      .on('data', function() {
        if (i == 8000) {
          process.stdout.write('\n')
          i = 0
        }
        if (i % 100 === 0) process.stdout.write('.')
        i++
      })
      .pipe(fs.createWriteStream(outfile))
  }

  fs.stat(outfile, function(er, stat) {
    if (er) return real()
    hashFile(outfile, 'sha1', function(er, actualSha) {
      if (er) return cb(er)
      if (actualSha != expectedSha) return real()
      cb()
    })
  })
}

function run(options, cb) {
  freeport(function(er, port) {
    if (er) throw er
    console.log('Starting Selenium ' + version + ' on port ' + port)
    var child

    if( options.chrome ){
      child = spawn('java', [
        '-jar', outfile,
        '-Dwebdriver.chrome.driver='+ options.chrome,
        '-port', port,
      ])
    } else {
      child = spawn('java', [
        '-jar', outfile,
        '-port', port,
      ])
    }
    child.host = '127.0.0.1'
    child.port = port
    handleData(child, cb);
  })
}

function handleData(child, cb) {
  var sentinal = 'Started org.openqa.jetty.jetty.Server'
  var badExit = function() { cb(new Error('Could not start Selenium.')) }
  var onData = function(data) {
    if (data.toString().indexOf(sentinal) !== -1) {
      child.removeListener('exit', badExit)
      cb(null, child)
    }
  };

  child.stdout.on('data', onData);
  // For some reason Selenium 2.44.0 writes to stderr instead of stdout?!
  child.stderr.on('data', onData);

  child.on('exit', badExit)
}

function FakeProcess(port) {
  EventEmitter.call(this)
  this.host = '127.0.0.1'
  this.port = port
}
util.inherits(FakeProcess, EventEmitter)
FakeProcess.prototype.kill = function() {
  this.emit('exit')
}

module.exports = function(options, cb) {
  if( !cb && typeof options === 'function' ){
    cb = options
    options = { chrome: false }
  }

  if (process.env.SELENIUM_LAUNCHER_PORT) {
    return process.nextTick(
      cb.bind(null, null, new FakeProcess(process.env.SELENIUM_LAUNCHER_PORT)))
  }

  download(function(er) {
    if (er) return cb(er)
    chromeDriver(options, function(err, chromeOutfile){
      if (er) return cb(er)
      if( chromeOutfile ){
        options.chrome = chromeOutfile
      }
      run(options, cb)
    })
  })
}
