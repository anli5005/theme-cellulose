module.exports = function(grunt) {
	
	grunt.initConfig({ // TODO: Replace "$." with "jQuery." in materialize.js
		clean: {
			dist: ["dist"],
			css: ["dist/theme-cellulose/css", "dist/theme-cellulose/style.css"],
			js: ["dist/theme-cellulose/js"],
		},
		copy: {
			php: {
				files: [{
					expand: true,
					flatten: true,
					src: "php/**",
					dest: "dist/theme-cellulose/"
				}]
			},
			materialize: {
				files: {
					"dist/theme-cellulose/css/materialize.css": "materialize/materialize.css",
				},
				options: {
					process: function(content, path) {
						var noIcons = content.replace(/.*mdi.*\{[^\}]*\}\n?\n?/g, "").replace("/* Start Icons */\n", "");
						var noIconFont = noIcons.replace(/@font-face(.|\n)*font-family:.*"Material-Design-Icons";[^}]+\}[^}]+\} }[^}]+\} \}\n*/, "");
						return noIconFont.replace(/@font-face(.|\n)*font-family:.*"Roboto";[^}]+\} \}\n*/, "").replace("fonts/", "font/");
					}
				}
			}
		},
		cssmin: {
			materialize: {
				files: {
					"dist/theme-cellulose/css/materialize.min.css": "dist/theme-cellulose/css/materialize.css"
				}
			}
		},
		concat: {
			js: {
				src: ["js/materialize.js"],
				dest: "dist/theme-cellulose/js/scripts.js"
			}
		},
		less: {
			css: {
				options: {
					plugins: [
						new (require('less-plugin-autoprefix'))({browsers: ["last 2 versions"]})
					]
				},
				files: {
					"dist/theme-cellulose/style.css": "less/style.less"
				}
			}
		},
		cssbeautifier: {
			css: {
				files: {
					"dist/theme-cellulose/style.css": "dist/theme-cellulose/style.css"
				}
			}
		},
		uglify: {
			js: {
				files: {
					"dist/theme-cellulose/js/scripts.min.js": "dist/theme-cellulose/js/scripts.js"
				}
			}
		}
	});
	
	grunt.loadNpmTasks("grunt-contrib-clean");
	grunt.loadNpmTasks("grunt-contrib-copy");
	grunt.loadNpmTasks("grunt-contrib-cssmin");
	grunt.loadNpmTasks("grunt-contrib-concat");
	grunt.loadNpmTasks("grunt-contrib-less");
	grunt.loadNpmTasks("grunt-cssbeautifier");
	grunt.loadNpmTasks("grunt-contrib-uglify");
	
	grunt.registerTask("css", ["clean:css", "copy:materialize", "cssmin:materialize", "less:css", "cssbeautifier:css"]);
	grunt.registerTask("js", ["clean:js", "concat:js", "uglify:js"]);
	grunt.registerTask("dist", ["clean:dist", "copy:php", "css", "js"]);
	
	grunt.registerTask("default", ["dist"]);
	
};
