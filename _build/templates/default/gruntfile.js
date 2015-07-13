module.exports = function(grunt) {
	// Project configuration.		
	var initConfig = {
		pkg: grunt.file.readJSON('package.json'),
		dirs: { /* just defining some properties */
			theme: '../../../',
			assets: 'assets/components/quickstartbuttons/',
			css: 'css/',
            scss: 'scss/',
		},
        sass: {
            options: {
                outputStyle: 'expanded',
                sourceMap: false,
            },
            dist: {
                files: {
                    '<%= dirs.theme %><%= dirs.assets %><%= dirs.css %>mgr.css': '<%= dirs.scss %>mgr.scss',
                    '<%= dirs.theme %><%= dirs.assets %><%= dirs.css %>mgr23.css': '<%= dirs.scss %>mgr23.scss'
                }
            }
        },
        autoprefixer: {
          options: {
          },
          autoprefix:{
              files: {
                  '<%= dirs.theme %><%= dirs.assets %><%= dirs.css %>mgr.css': '<%= dirs.theme %><%= dirs.assets %><%= dirs.css %>mgr.css',
                  '<%= dirs.theme %><%= dirs.assets %><%= dirs.css %>mgr23.css': '<%= dirs.theme %><%= dirs.assets %><%= dirs.css %>mgr23.css'
              }
          }
        },
        watch: {
            scss: {
				files: ['<%= dirs.scss %>/**/*'],
				tasks: ['sass:dist', 'autoprefixer', 'growl:sass']
            }
        },
		growl: {
			sass: {
				message: "Sass files created.",
				title: "grunt"
			},
			build: {
				title: "grunt",
				message: "Build complete."
			},
			prefixes: {
				title: "grunt",
				message: "CSS prefixes added."
			},
			watch: {
				title: "grunt",
				message: "Watching. Grunt has its eye on you."
			}
		}
	};

	grunt.initConfig(initConfig);
    
    grunt.loadNpmTasks('grunt-growl');
    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-autoprefixer');
    grunt.loadNpmTasks('grunt-contrib-watch');
    
    grunt.registerTask('default', ['growl:watch', 'watch']);
	grunt.registerTask('build', ['sass', 'autoprefixer', 'growl:sass']);
};
