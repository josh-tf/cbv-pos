module.exports = function (grunt) {

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		wiredep: {
			task: {
				ignorePath: '../../../public/',
				src: ['application/views/partial/header.php']
			}
		},
		bower_concat: {
			all: {
				mainFiles: {
					'bootstrap-table': ["src/bootstrap-table.js", "src/bootstrap-table.css", "dist/extensions/export/bootstrap-table-export.js", "dist/extensions/mobile/bootstrap-table-mobile.js", "dist/extensions/sticky-header/bootstrap-table-sticky-header.js", "dist/extensions/sticky-header/bootstrap-table-sticky-header.css"]
				},
				dest: {
					'js': 'tmp/cbv-pos_bower.js',
					'css': 'tmp/cbv-pos_bower.css'
				}
			}
		},
		bowercopy: {
			options: {
				report: false
			},
			targetdisttrumbowyg: {
				options: {
					srcPrefix: 'public/bower_components/trumbowyg',
					destPrefix: 'public/dist'
				},
				files: {
					'trumbowyg': 'dist/ui/trumbowyg.css'
				}
			},
			targetdistjqueryui: {
				options: {
					srcPrefix: 'public/bower_components/jquery-ui',
					destPrefix: 'public/dist'
				},
				files: {
					'jquery-ui': 'themes/base/jquery-ui.min.css'
				}
			},
			targetdistbootswatch: {
				options: {
					srcPrefix: 'public/bower_components/bootswatch',
					destPrefix: 'public/dist'
				},
				files: {
					bootswatch: '*/'
				}
			},
			targetlicense: {
				options: {
					srcPrefix: './'
				},
				files: {
					'public/license': 'LICENSE'
				}
			}
		},
		cssmin: {
			target: {
				files: {
					'public/dist/<%= pkg.name %>.min.css': ['tmp/cbv-pos_bower.css', 'public/css/*.css', '!public/css/login.css', '!public/css/invoice_email.css', '!public/css/barcode_font.css']
				}
			}
		},
		concat: {
			js: {
				options: {
					separator: ';'
				},
				files: {
					'tmp/<%= pkg.name %>.js': ['tmp/cbv-pos_bower.js', 'public/js/jquery*', 'public/js/*.js']
				}
			}
		},
		uglify: {
			options: {
				banner: '/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yyyy") %> */\n'
			},
			dist: {
				files: {
					'public/dist/<%= pkg.name %>.min.js': ['tmp/<%= pkg.name %>.js']
				}
			}
		},
		jshint: {
			files: ['Gruntfile.js', 'public/js/*.js'],
			options: {
				// options here to override JSHint defaults
				globals: {
					jQuery: true,
					console: true,
					module: true,
					document: true
				}
			}
		},
		tags: {
			css_header: {
				options: {
					scriptTemplate: '<link rel="stylesheet" type="text/css" href="{{ path }}" />',
					openTag: '<!-- start css template tags -->',
					closeTag: '<!-- end css template tags -->',
					ignorePath: '../../../public/'
				},
				src: ['public/css/*.css', '!public/css/login.css', '!public/css/invoice_email.css', '!public/css/barcode_font.css'],
				dest: 'application/views/partial/header.php',
			},
			mincss_header: {
				options: {
					scriptTemplate: '<link rel="stylesheet" type="text/css" href="{{ path }}" />',
					openTag: '<!-- start mincss template tags -->',
					closeTag: '<!-- end mincss template tags -->',
					ignorePath: '../../../public/'
				},
				// jquery-ui must be first or at least before cbv-pos.min.css
				src: ['public/dist/jquery-ui/*.css', 'public/dist/trumbowyg/*.css', 'public/dist/*.css'],
				dest: 'application/views/partial/header.php',
			},
			css_login: {
				options: {
					scriptTemplate: '<link rel="stylesheet" type="text/css" href="{{ path }}" />',
					openTag: '<!-- start css template tags -->',
					closeTag: '<!-- end css template tags -->',
					ignorePath: '../../public/'
				},
				src: ['public/css/login.css'],
				dest: 'application/views/login.php'
			},
			js: {
				options: {
					scriptTemplate: '<script type="text/javascript" src="{{ path }}"></script>',
					openTag: '<!-- start js template tags -->',
					closeTag: '<!-- end js template tags -->',
					ignorePath: '../../../public/'
				},
				src: ['public/js/jquery*', 'public/js/*.js', 'public/js/trumbowyg/*.js'],
				dest: 'application/views/partial/header.php'
			},
			minjs: {
				options: {
					scriptTemplate: '<script type="text/javascript" src="{{ path }}"></script>',
					openTag: '<!-- start minjs template tags -->',
					closeTag: '<!-- end minjs template tags -->',
					ignorePath: '../../../public/'
				},
				src: ['public/dist/*min.js'],
				dest: 'application/views/partial/header.php'
			}
		},
		mochaWebdriver: {
			options: {
				timeout: 1000 * 60 * 3
			},
			test: {
				options: {
					usePhantom: true,
					usePromises: true
				},
				src: ['test/**/*.js']
			}
		},
		watch: {
			files: ['<%= jshint.files %>'],
			tasks: ['jshint']
		},
		cachebreaker: {
			dev: {
				options: {
					match: [{
						'cbv-pos.min.js': 'public/dist/cbv-pos.min.js',
						'cbv-pos.min.css': 'public/dist/cbv-pos.min.css'
					}],
					replacement: 'md5'
				},
				files: {
					src: ['application/views/partial/header.php', 'application/views/login.php']
				}
			}
		},
		clean: {
			license: ['public/bower_components/**/bower.json']
		},
		license: {
			all: {
				// Target-specific file lists and/or options go here.
				options: {
					// Target-specific options go here.
					directory: 'public/bower_components',
					output: 'public/license/bower.LICENSES'
				}
			}
		},
		'bower-licensechecker': {
			options: {
				/*directory: 'path/to/bower',*/
				acceptable: ['MIT', 'BSD', 'LICENSE.md'],
				printTotal: true,
				warn: {
					nonBower: true,
					noLicense: true,
					allGood: true,
					noGood: true
				},
				log: {
					outFile: 'public/license/.licenses',
					nonBower: true,
					noLicense: true,
					allGood: true,
					noGood: true,
				}
			}
		},
		apigen: {
			generate: {
				options: {
					apigenPath: 'vendor/bin/',
					source: 'application',
					destination: 'docs'
				}
			}
		},
		compress: {
			main: {
				options: {
					mode: 'zip',
					archive: 'dist/cbv-pos-dist.zip'
				},
				files: [{
					src: ['public/**', 'vendor/**', 'application/**', '!/public/images/menubar/png/', '!/public/dist/bootswatch/', '/public/dist/bootswatch/*/*.css', 'database/**', '*.txt', '*.md', 'LICENSE', 'docker*', 'Dockerfile', '**/.htaccess', '*.csv']
				}]
			}
		}
	});

	require('load-grunt-tasks')(grunt);
	grunt.loadNpmTasks('grunt-mocha-webdriver');
	grunt.loadNpmTasks('grunt-composer');
	grunt.loadNpmTasks('grunt-apigen');
	grunt.loadNpmTasks('grunt-contrib-compress');

	grunt.registerTask('default', ['wiredep', 'bower_concat', 'bowercopy', 'concat', 'uglify', 'cssmin', 'cachebreaker', 'tags']);
	grunt.registerTask('update', ['composer:update', 'bower:update']);
	grunt.registerTask('genlicense', ['clean:license', 'license', 'bower-licensechecker']);
	grunt.registerTask('package', ['default', 'compress']);
	grunt.registerTask('packages', ['composer:update']);
	grunt.registerTask('gendocs', ['apigen:generate']);

};