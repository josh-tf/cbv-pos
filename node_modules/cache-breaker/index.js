"use strict";

var path = require("path");
var _    = require("lodash");

/**
 * Default Options
 */
var defaults = {
    position: "append",
    replacement: "time"
};

/**
 * @param {string} src
 * @param {string|array} matcher
 * @param {object} [config]
 * @returns {string}
 */
exports.breakCache = function (src, matcher, config) {

    var opts = mergeOptions(_.cloneDeep(defaults), config);

    function replacer(src, match) {
        var replacement = _getReplacement(opts.replacement, opts);
        var replacer    = _getReplacer(opts.position, replacement);
        var regex       = _getRegex(match, opts.position);
        return src.replace(regex, replacer);
    }

    if (Array.isArray(matcher)) {
        matcher.forEach(function (match) {
            src = replacer(src, match);
        });
    } else {
        return replacer(src, matcher);
    }

    return src;
};

/**
 * @param {string|function} replacement
 * @param config
 * @returns {*}
 */
function _getReplacement(replacement, config) {

    if (replacement === "time") {
        return new Date().getTime().toString();
    }

    if (replacement === "md5") {
        if (typeof config.src === "string") {
            return md5(config.src, config.length || 10);
        } else {
            if (config.src.path) {
                var content = getFileContents(config.src.path);
                if (content) {
                    return md5(content, config.length || 10);
                }
            }
        }
    }

    return replacement;
}

/**
 * @param {string} matcher
 * @param {string} position
 * @returns {RegExp}
 */
function _getRegex(matcher, position) {

    function fullMatcher() {
        return new RegExp("(('|\")(.+?)?)("+matcher+")([\\w\\?=]*)('|\")", "g");
    }

    function prepareString(seg) {
        var result = seg.replace(/\./g, "\\.");
        return "(" + result + ")";
    }

    /**
     * @type {{overwrite: overwrite, filename: fullMatcher, append: fullMatcher}}
     */
    var regexs = {
        overwrite: function () {

            var split  = matcher.split("*");
            var before = prepareString(split[0]);
            var after  = prepareString(split[1]);

            return new RegExp(before + "(?:.+?)" + after, "g");
        },
        filename: fullMatcher,
        append: fullMatcher
    };

    if (regexs[position]) {
        return regexs[position]();
    }
}

/**
 * @param {string} type
 * @returns {string|function}
 * @param {string|function} replacement
 * @private
 */
function _getReplacer(type, replacement) {

    function replace (string) {
        return string.replace("%time%", replacement);
    }

    var templates = {
        append: replace("$1$4?rel=%time%$6"),
        filename: function () {
            var start = arguments[1];
            var end   = arguments[6];
            var match = arguments[4];
            var file  = path.basename(match).split(".");
            var ext   = file.pop();
            return replace(start + file.join(".") + ".%time%." + ext + end);
        },
        overwrite: replace("$1%time%$2")
    };

    return templates[type];
}
exports._getReplacer = _getReplacer;

/**
 * @param filepath
 * @returns {*}
 */
function getFileContents(filepath) {
    var path = require("path");
    var fs   = require("fs");
    filepath = path.resolve(filepath);
    return fs.readFileSync(filepath, 'utf-8');
}

/**
 * @param {object} defaults
 * @param {object} config
 * @returns {object}
 */
function mergeOptions(defaults, config) {
    return _.merge(defaults, config);
}

/**
 * @param src
 */
function md5(src, length) {
    var crypto = require('crypto');
    var hash   = crypto.createHash('md5').update(src, 'utf8').digest('hex');
    return hash.slice(0, length);
}