'use strict';

module.exports = function(grunt) {

    // Load grunt tasks automatically
    require('load-grunt-tasks')(grunt);

    // Time how long tasks take. Can help when optimizing build times
    require('time-grunt')(grunt);

    // Configurable paths for the application
    var appConfig = {
        app: require('./bower.json').appPath || 'app',
        dist: 'dist'
    };

    // Define the configuration for all the tasks
    grunt.initConfig({

        // Project settings
        cacambas: appConfig,

        // Watches files for changes and runs tasks based on the changed files
        watch: {
            //bower: {
            //  files: ['bower.json'],
            //  tasks: ['wiredep']
            //},
            js: {
                files: ['js/components/*/{,*/}*.js', 'js/components/{,*/}*.js'],
                tasks: ['newer:jshint:all'],
                options: {
                    livereload: '<%= connect.options.livereload %>'
                }
            },
            jsTest: {
                files: ['test/spec/{,*/}*.js'],
                tasks: ['newer:jshint:test', 'karma']
            },
            //compass: {
            //  files: ['css/sass/*/{,*/}*.{scss,sass}', 'css/sass/{,*/}*.{scss,sass}'],
            //  tasks: ['compass:server', 'autoprefixer']
            //},
            gruntfile: {
                files: ['Gruntfile.js']
            },
            livereload: {
                options: {
                    livereload: '<%= connect.options.livereload %>'
                },
                files: [
                    '<%= cacambas.app %>/{,*/}*.html',
                    'views/*/{,*/}*.html',
                    'views/modules/*/{,*/}*.html',
                    'css/{,*/}*.css',
                    '.tmp/styles/{,*/}*.css',
                    'images/{,*/}*.{png,jpg,jpeg,gif,webp,svg}'
                ]
            }
            //,sass: {
            //    files: 'css/sass/{,*/}*.{scss,sass}',
            //    tasks: ['sass:dev']
            //},
            //css: {
            //    files: ['css/sass/*.scss', 'css/sass/*/*.scss'],
            //    tasks: ['compass:dist'],
            ///    options: {
            //        // Start a live reload server on the default port 35729
            //        livereload: true,
            //        nospawn: false
            //    },
            //},
        },

        // Task for sass - not used yet
        sass: {
            dev: {
                options: {
                    style: 'expanded',
                    compass: true
                },
                files: {
                    'css/main.css': 'css/sass/main.scss'
                }
            },
            dist: {
                options: {
                    style: 'compressed',
                    compass: true
                },
                files: {
                    'css/main.css': 'css/sass/main.scss'
                }
            }
        },

        // The actual grunt server settings
        // Use when working only in frontend - require index.html for app
        connect: {
            options: {
                port: 9000,
                // Change this to '0.0.0.0' to access the server from outside.
                hostname: 'localhost',
                livereload: 35729
            },
            livereload: {
                options: {
                    open: true,
                    middleware: function(connect) {
                        return [
                            connect.static('.tmp'),
                            connect().use(
                                '/packages',
                                connect.static('./packages')
                            ),
                            connect.static(appConfig.app)
                        ];
                    }
                }
            },
            test: {
                options: {
                    port: 9001,
                    middleware: function(connect) {
                        return [
                            connect.static('.tmp'),
                            connect.static('test'),
                            connect().use(
                                '/packages',
                                connect.static('./packages')
                            ),
                            connect.static(appConfig.app)
                        ];
                    }
                }
            },
            dist: {
                options: {
                    open: true,
                    base: '<%= cacambas.dist %>'
                }
            }
        },


        // Make sure code styles are up to par and there are no obvious mistakes
        jshint: {
            options: {
                jshintrc: '.jshintrc',
                reporter: require('jshint-stylish')
            },
            all: {
                src: [
                    'Gruntfile.js',
                    'js/{,*/}*.js'
                ]
            },
            test: {
                options: {
                    jshintrc: 'test/.jshintrc'
                },
                src: ['test/spec/{,*/}*.js']
            }
        },


        // Empties folders to start fresh
        clean: {
            dist: {
                files: [{
                    dot: true,
                    src: [
                        '.tmp',
                        '<%= cacambas.dist %>/{,*/}*',
                        '!<%= cacambas.dist %>/.git*'
                    ]
                }]
            },
            server: '.tmp'
        },


        // Add vendor prefixed styles
        autoprefixer: {
            options: {
                browsers: ['last 1 version']
            },
            dist: {
                files: [{
                    expand: true,
                    cwd: '.tmp/css/',
                    src: '{,*/}*.css',
                    dest: '.tmp/css/'
                }]
            }
        },


        // Automatically inject Bower components into the app
        wiredep: {
            options: {
                cwd: '<%= cacambas.app %>'
            },
            app: {
                src: ['<%= cacambas.app %>/index.html'],
                ignorePath: /\.\.\//
            },
            sass: {
                src: ['<%= cacambas.app %>/css/{,*/}*.{scss,sass}'],
                ignorePath: /(\.\.\/){1,2}packages\//
            }
        },


        // Compiles Sass to CSS and generates necessary files if requested
        compass: {
            options: {
                sassDir: 'css/sass',
                cssDir: 'css',
                generatedImagesDir: 'images/generated',
                imagesDir: 'images',
                javascriptsDir: 'js',
                fontsDir: 'fonts',
                importPath: './packages',
                httpImagesPath: '/images',
                httpGeneratedImagesPath: '/images/generated',
                httpFontsPath: '/fonts',
                relativeAssets: false,
                assetCacheBuster: false,
                raw: 'Sass::Script::Number.precision = 10\n'
            },
            dist: {
                options: {
                    generatedImagesDir: '<%= cacambas.dist %>/images/generated'
                }
            },
            server: {
                options: {
                    debugInfo: true
                }
            }
        },


        // Renames files for browser caching purposes
        filerev: {
            dist: {
                src: [
                    '<%= cacambas.dist %>/js/{,*/}*.js',
                    '<%= cacambas.dist %>/css/{,*/}*.css',
                    '<%= cacambas.dist %>/images/{,*/}*.{png,jpg,jpeg,gif,webp,svg}',
                    '<%= cacambas.dist %>/fonts/*'
                ]
            }
        },


        // Reads HTML for usemin blocks to enable smart builds that automatically
        // concat, minify and revision files. Creates configurations in memory so
        // additional tasks can operate on them
        useminPrepare: {
            html: '<%= cacambas.app %>/index.html',
            options: {
                dest: '<%= cacambas.dist %>',
                flow: {
                    html: {
                        steps: {
                            js: ['concat', 'uglifyjs'],
                            css: ['cssmin']
                        },
                        post: {}
                    }
                }
            }
        },


        // Performs rewrites based on filerev and the useminPrepare configuration
        usemin: {
            html: ['<%= cacambas.dist %>/{,*/}*.html'],
            css: ['<%= cacambas.dist %>/css/{,*/}*.css'],
            options: {
                assetsDirs: ['<%= cacambas.dist %>', '<%= cacambas.dist %>/images']
            }
        },

        // The following *-min tasks will produce minified files in the dist folder
        // By default, your `index.html`'s <!-- Usemin block --> will take care of
        // minification. These next options are pre-configured if you do not wish
        // to use the Usemin blocks.
        // cssmin: {
        //   dist: {
        //     files: {
        //       '<%= cacambas.dist %>/styles/main.css': [
        //         '.tmp/styles/{,*/}*.css'
        //       ]
        //     }
        //   }
        // },
        // uglify: {
        //   dist: {
        //     files: {
        //       '<%= cacambas.dist %>/scripts/scripts.js': [
        //         '<%= cacambas.dist %>/scripts/scripts.js'
        //       ]
        //     }
        //   }
        // },
        // concat: {
        //   dist: {}
        // },

        imagemin: {
            dist: {
                files: [{
                    expand: true,
                    cwd: '<%= cacambas.app %>/images',
                    src: '{,*/}*.{png,jpg,jpeg,gif}',
                    dest: '<%= cacambas.dist %>/images'
                }]
            }
        },

        svgmin: {
            dist: {
                files: [{
                    expand: true,
                    cwd: '<%= cacambas.app %>/images',
                    src: '{,*/}*.svg',
                    dest: '<%= cacambas.dist %>/images'
                }]
            }
        },

        htmlmin: {
            dist: {
                options: {
                    collapseWhitespace: true,
                    conservativeCollapse: true,
                    collapseBooleanAttributes: true,
                    removeCommentsFromCDATA: true,
                    removeOptionalTags: true
                },
                files: [{
                    expand: true,
                    cwd: '<%= cacambas.dist %>',
                    src: ['*.html', 'views/{,*/}*.html'],
                    dest: '<%= cacambas.dist %>'
                }]
            }
        },

        // ngmin tries to make the code safe for minification automatically by
        // using the Angular long form for dependency injection. It doesn't work on
        // things like resolve or inject so those have to be done manually.
        ngmin: {
            dist: {
                files: [{
                    expand: true,
                    cwd: '.tmp/concat/scripts',
                    src: '*.js',
                    dest: '.tmp/concat/scripts'
                }]
            }
        },

        // Replace Google CDN references
        cdnify: {
            dist: {
                html: ['<%= cacambas.dist %>/*.html']
            }
        },

        // Copies remaining files to places other tasks can use
        copy: {
            dist: {
                files: [{
                    expand: true,
                    dot: true,
                    cwd: '<%= cacambas.app %>',
                    dest: '<%= cacambas.dist %>',
                    src: [
                        '*.{ico,png,txt}',
                        '.htaccess',
                        '*.html',
                        'views/{,*/}*.html',
                        'images/{,*/}*.{webp}',
                        'fonts/*'
                    ]
                }, {
                    expand: true,
                    cwd: '.tmp/images',
                    dest: '<%= cacambas.dist %>/images',
                    src: ['generated/*']
                }, {
                    expand: true,
                    cwd: '.',
                    src: 'bower_components/bootstrap-sass-official/assets/fonts/bootstrap/*',
                    dest: '<%= cacambas.dist %>'
                }]
            },
            styles: {
                expand: true,
                cwd: '<%= cacambas.app %>/styles',
                dest: '.tmp/styles/',
                src: '{,*/}*.css'
            }
        },

        // Run some tasks in parallel to speed up the build process
        concurrent: {
            server: [
                'compass:server'
            ],
            test: [
                'compass'
            ],
            dist: [
                'compass:dist',
                'imagemin',
                'svgmin'
            ]
        },

        // Test settings
        karma: {
            unit: {
                configFile: 'test/karma.conf.js',
                singleRun: true
            }
        }, 

        // Only used for Production
        uglify: {
            build: {
                files: {
                    'public/javascripts/frontend/all.min.js': ['public/javascripts/frontend/*.js'],
                    'public/javascripts/backend/all.min.js': ['public/javascripts/backend/*.js'],
                    'public/javascripts/admin/all.min.js': ['public/javascripts/admin/*.js']
                }
            }

        },

        
        // Only used for Production
        pngmin: {
            compile: {
                options: {
                    binary: '/usr/local/bin/pngquant',
                    concurrency: 8,
                    ext: '.png',
                    quality: '70-80',
                    speed: 10,
                    force: true,
                    iebug: true
                },
                files: [{
                    src: 'public/images/frontend/**/*.png',
                    dest: 'public/images/frontend/'
                }]
            }
        },

        // Only used for Production
        concat: {
            options: {
                separator: ';'
            },

            frontend_js: {
                src: ['public/javascripts/**/*.js'],
                dest: 'public/javascripts/frontend.js'
            }
        }

    });


    grunt.registerTask('serve', 'Compile then start a connect web server', function(target) {
        if (target === 'dist') {
            return grunt.task.run(['build', 'connect:dist:keepalive']);
        }

        grunt.task.run([
            'clean:server',
            //'wiredep',
            //'concurrent:server',
            //'autoprefixer',
            'connect:livereload',
            'watch'
        ]);
    });

    grunt.registerTask('server', 'DEPRECATED TASK. Use the "serve" task instead', function(target) {
        grunt.log.warn('The `server` task has been deprecated. Use `grunt serve` to start a server.');
        grunt.task.run(['serve:' + target]);
    });

    grunt.registerTask('test', [
        'clean:server',
        'concurrent:test',
        'autoprefixer',
        'connect:test',
        'karma'
    ]);

    grunt.registerTask('build', [
        'clean:dist',
        'wiredep',
        'useminPrepare',
        'concurrent:dist',
        'autoprefixer',
        'concat',
        'ngmin',
        'copy:dist',
        'cdnify',
        'cssmin',
        'uglify',
        'filerev',
        'usemin',
        'htmlmin'
    ]);

    grunt.registerTask('default', [
        'newer:jshint',
        'test',
        'build'
    ]);
};
