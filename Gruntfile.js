module.exports = function(grunt) {
	
	grunt.initConfig({
		clean: {
			dist: ["dist"],
			css: ["dist/theme-cellulose/style.css", "dist/theme-cellulose/style.min.css"],
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
					sourcemap: "auto",
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
				},
				{
					from: /\/\*{3}[^\*]+\*+\/\n/g,
					to: ""
				},
				{
					from: /\/\* Progress Bar \*\/\n/,
					to: ""
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
		cssmin: {
			css: {
				files: {
					"dist/theme-cellulose/style.min.css": "dist/theme-cellulose/style.css"
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
	
	grunt.registerTask("css", ["clean:css", "sass:css", "replace:css", "autoprefixer:css", "cssmin:css"]);
	grunt.registerTask("js", ["clean:js", "concat:js", "uglify:js"]);
	grunt.registerTask("dist", ["clean:dist", "copy:php", "css", "js"]);
	
	grunt.registerTask("default", ["dist"]);
	
};
