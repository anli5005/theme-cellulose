module.exports = function(grunt) {
	
	grunt.initConfig({
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
						return noIconFont.replace(/@font-face(.|\n)*font-family:.*"Roboto";[^}]+\}\n*/g, "");
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
				src: ["js/waves.js"],
				dest: "dist/theme-cellulose/js/scripts.js",
			}
		},
		sass: {
			css: {
				options: {
					sourcemap: "none",
					style: "expanded"
				},
				files: {
					"dist/theme-cellulose/style.css": "scss/style.scss"
				}
			}
		},
		replace: {
			css: {
				src: ["dist/theme-cellulose/style.css"],
				overwrite: true,
				replacements: [{
					from: "/* NEWLINE */\n",
					to: "\n"
				},
				{
					from: "/* NEWLINE (2) */\n",
					to: "\n\n"
				}]
			}
		},
		autoprefixer: {
			css: {
				options: {
					browsers: ["last 2 versions"]
				},
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
	grunt.loadNpmTasks("grunt-contrib-sass");
	grunt.loadNpmTasks("grunt-text-replace");
	grunt.loadNpmTasks("grunt-autoprefixer");
	grunt.loadNpmTasks("grunt-contrib-uglify");
	
	grunt.registerTask("css", ["clean:css", "copy:materialize", "cssmin:materialize", "sass:css", "replace:css", "autoprefixer:css"]);
	grunt.registerTask("js", ["clean:js", "concat:js", "uglify:js"]);
	grunt.registerTask("dist", ["clean:dist", "copy:php", "css", "js"]);
	
	grunt.registerTask("default", ["dist"]);
	
};
