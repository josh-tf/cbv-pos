'use strict';

module.exports = function(grunt) {

    // default test task
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        tags: {
            options: {
                //
            },
            test: {
                options: {
                    scriptTemplate: '<script type="text/javascript" src="{{ path }}"></script>',
                    linkTemplate: '<link rel="stylesheet" href="{{path}}"/>',
                    openTag: '<!-- start auto template tags -->',
                    closeTag: '<!-- end auto template tags -->'
                },
                src: [
                    'tests/build/**/*.js',
                    'tests/build/**/*.css'
                ],
                dest: 'tests/results/all-tags.html'
            },
            testIndenting: {
                src: [
                    'tests/build/**/*.js',
                    'tests/build/**/*.css'
                ],
                dest: 'tests/results/indented-tags.html'
            }
        },
        copy: {
            main: {
                expand: true,
                cwd: 'tests/template/',
                src: '**',
                dest: 'tests/results/'
            }
        },
        clean: {
            src: ['tests/results/']
        },
        nodeunit: {
            all: ['tests/tags.test.js']
        }
    });

    // Actually load this plugin's task(s).
    grunt.loadTasks('tasks');

    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-nodeunit');

    // Test tasks cleans folder, runs tags task, then runs nodeunit
    grunt.registerTask('test', [
        'clean',
        'copy:main',
        'tags:test',
        'tags:testIndenting',
        'nodeunit',
        'clean'
    ]);
};
