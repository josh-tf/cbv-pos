var fs = require('fs');
var path = require('path');

var potentialFilenames = ['LICENSE', 'README', 'README.md', 'README.markdown','license.txt'];

var licenseFromString = function(str){
    if (str.indexOf('MIT') > -1) {
        return 'MIT*';
    } else if (str.indexOf('BSD') > -1) {
        return 'BSD*';
    } else if (str.indexOf('Apache License') > -1) {
        return 'Apache*';
    } else if (str.indexOf('DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE') > -1) {
        return 'WTF*';
    }  
}

module.exports = function(packagePath){
    var files = fs.readdirSync(packagePath);
    for (var i = 0; i < potentialFilenames.length; i++){
        for (var j = 0; j < files.length; ++j) {
            // Do a case-insensitive match to find files named
            // Readme.md or other variations
            if (potentialFilenames[i].toLowerCase() === files[j].toLowerCase()) {
                return licenseFromString(fs.readFileSync(path.resolve(packagePath, files[j]), 'utf8'));
            }
        }
    }
    return null;
}
