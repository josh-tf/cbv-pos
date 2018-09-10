var fs = require('fs')

var hash_file = function(fileName, method, callback) {
  // method is optional
  if (arguments.length == 2 && typeof method == 'function') {
    callback = method
    method = 'md5'
  }

  switch (method) {
    case 'md4':
    case 'md5':
    case 'sha1':
    case 'sha256':
      break
    default:
      return callback(new Error('unsupported method:' + method))
  }


var shasum = require('crypto').createHash(method)

var stream = fs.ReadStream(fileName, {
  bufferSize: 4024 * 1024
})

stream.on('data', function(data) {
  shasum.update(data)
})

  stream.on('error', function(err) {
    callback(err)
  })

  stream.on('end', function() {
    var digest = shasum.digest('hex')
    callback(null, digest)
  })
}

module.exports = hash_file
