module.exports = function(grunt) {
	
	grunt.initConfig({
		clean: {
			dist: ["dist"],
			css: ["dist/theme-cellulose/css", "dist/theme-cellulose/style.css"],
			js: ["dist/theme-cellulose/js"],
			fonts: ["dist/theme-cellulose/fonts"]
		},
		copy: {
			php: {
				files: {
					
				}
			},
			materialize: {
				files: {
					"dist/theme-cellulose/css/materialize.css": "materialize/materialize.css",
					"dist/theme-cellulose/css/materialize.min.css": "materialize/materialize.min.css"
				}
			},
			fonts: {
				files: [{
					expand: true,
					flatten: true,
					filter: "isFile",
					src: "fonts/material-design-icons/**",
					dest: "dist/theme-cellulose/fonts/material-design-icons/"
				},
				{
					expand: true,
					flatten: true,
					filter: "isFile",
					src: "fonts/roboto/**",
					dest: "dist/theme-cellulose/fonts/roboto/"
				}]
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
	grunt.loadNpmTasks("grunt-contrib-concat");
	grunt.loadNpmTasks("grunt-contrib-less");
	grunt.loadNpmTasks("grunt-cssbeautifier");
	grunt.loadNpmTasks("grunt-contrib-uglify");
	
	grunt.registerTask("css", ["clean:css", "copy:materialize", "less:css", "cssbeautifier:css"]);
	grunt.registerTask("js", ["clean:js", "concat:js", "uglify:js"]);
	grunt.registerTask("fonts", ["clean:fonts", "copy:fonts"]);
	grunt.registerTask("dist", ["clean:dist", "copy:php", "css", "js", "copy:fonts"]);
	
	grunt.registerTask("default", ["dist"]);
	
};
