//
// Written By Andrew Mead
// github.com/andrewjmead
//
'use strict';

module.exports = function (grunt) {
    var path = require('path');
    var os = require('os');
    var EOL = os.EOL; // end of line for operating system

    /**
     * Normalize the files paths for window (\) and unix (/)
     * 
     * @function normalizePaths
     * @return {String} 
     */
     function normalizePaths (path) {
        return path.replace(/\\/g, '/');
     }

    /**
     * @constructor create a new instance of tags task
     */
    function Tags (options) {
        this.options = this.processOptions(options);
    }

    /**
     * process options, overriding defaults
     */
    Tags.prototype.processOptions = function (options) {
        var processedOptions = {};

        processedOptions.scriptTemplate = options.scriptTemplate || '<script type="text/javascript" src="{{ path }}"></script>';
        processedOptions.linkTemplate = options.linkTemplate || '<link rel="stylesheet" type="text/css" href="{{ path }}"/>';

        processedOptions.openTag = options.openTag || '<!-- start auto template tags -->';
        processedOptions.closeTag = options.closeTag || '<!-- end auto template tags -->';

        /**
         * @kludge should not have to hack around for templates
         */
        processedOptions.scriptTemplate = processedOptions.scriptTemplate.replace('{{', '<%=').replace('}}', '%>');
        processedOptions.linkTemplate = processedOptions.linkTemplate.replace('{{', '<%=').replace('}}', '%>');
        
        /**
         * copy ignorePath property
         */
        processedOptions.ignorePath = options.ignorePath;
        
        /**
         * get the openTag line from content
         */
        processedOptions.getIndentWithTag = new RegExp("([\\s\\t]+)?" + processedOptions.openTag);

        /**
         * replace newlines with empty string from @this.getIndentWithTag
         */
        processedOptions.replaceNewLines = new RegExp(EOL, "g");

        /**
         * indent size @this.openTag
         */
        processedOptions.indent = '';

        return processedOptions;
    };

    /**
     * this is the main method that process and modified files, adding tags along the way!
     *
     * @method processFile
     */
    Tags.prototype.processFile = function (destFile, srcFiles) {
        var that = this;
        var tagsText = '';
        var fileContents = grunt.file.read(destFile);
        var filePath = path.dirname(destFile);
        var matches = fileContents.match(this.options.getIndentWithTag);

        /**
         * get the indent along with this.options.openTag
         */
        if (matches && matches[1]) {
            /**
             * get the indent size by replacing this.options.openTag with empty string
             */
            this.options.indent = matches[1].replace(this.options.replaceNewLines, '');
        }

        this.validateTemplateTags(destFile, fileContents);

        srcFiles.forEach(function (srcFile) {
            // calculate the src files path relative to destination path
        	var normalizedPath = normalizePaths(path.relative(filePath, srcFile));
        	if (that.options.ignorePath) {
        		normalizedPath = normalizedPath.replace(that.options.ignorePath, '');
        	}
            tagsText += that.options.indent + that.generateTag(normalizedPath);
        });

        var res = this.addTags(fileContents, tagsText);

        grunt.file.write(destFile, res);
    };

    /**
     * validate the given file contents contain valid template tags
     */
    Tags.prototype.validateTemplateTags = function (fileName, fileContents) {
        // get locations of template tags
        // used to verify that the destination file contains valid template tags
        var openTagLocation = fileContents.indexOf(this.options.openTag);
        var closeTagLocation = fileContents.indexOf(this.options.closeTag);

        // verify template tags exist and in logic order
        if (closeTagLocation < openTagLocation || openTagLocation === -1 || closeTagLocation === -1) {
            grunt.fail.fatal('invalid template tags in ' + fileName);
        }
    };

    /**
     * generate a template tag for provided file
     */
    Tags.prototype.generateTag = function (relativePath) {
        var ext = path.extname(relativePath);
        var data = {
            data: {
                path: relativePath
            }
        };

        if (ext === '.js') {
            return grunt.template.process(this.options.scriptTemplate, data) + EOL;
        } else if (ext === '.css') {
            return grunt.template.process(this.options.linkTemplate, data) + EOL;
        } else {
            return ''
        }
    };

    /**
     * add the tags to the correct part of the destination file
     */
    Tags.prototype.addTags = function (fileContents, tagsText) {
        var beginning = fileContents.split(this.options.openTag)[0];
        var end = fileContents.split(this.options.closeTag)[1];

        return beginning +
               this.options.openTag + EOL +
               tagsText +
               this.options.indent + this.options.closeTag +
               end;
    };

    //
    // register tags grunt task
    //
    grunt.registerMultiTask('tags', 'Dynamically add script and link tags to html file', function () {
        var that = this;
        var tags = new Tags(that.options());

        // for each destination file
        this.files.forEach(function (file) {
            tags.processFile(file.dest, file.src);
        });
    });
};
