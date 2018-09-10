Hash File: A simple utility for getting the hash of a file
============================================

This module is a super simple utility for getting the hash of a file 

### Supported Hash Types

* MD4
* MD5
* SHA1
* SHA256

## Installation
```
npm install hash_file
```

or

```
git clone https://github.com/secoif/hash_file
```

## Usage 

```javascript
var hash_file = require('hash_file')

// get md5
hash_file('./README.md', 'md5', function(err, hash) {
  console.log('md5: ', hash)
})

// get sha1 
hash_file('./README.md', 'sha1', function(err, hash) {
  console.log('sha1: ', hash)
})
// get sha256 
hash_file('./README.md', 'sha256', function(err, hash) {
  console.log('sha256: ', hash)
})
```

## Running the tests

```shell
npm install --dev
npm test
```

## Credits

Original Module Author - Gregor Schwab greg@synaptic-labs.net ([dotmaster](http://github.com/dotmaster))

## License 

(The MIT License)

Copyright (c) 2011 Gregor Schwab &lt;dev@synaptic-labs.net&gt;

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
'Software'), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED 'AS IS', WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
