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
					dest: "dist/theme-cellulose/",
					filter: "isFile"
				}]
			}
		},
		concat: {
			js: {
				src: [
              	"js/materialize/jquery.easing.1.3.js",
              	"js/materialize/animation.js",
              	"js/materialize/velocity.min.js",
              	"js/materialize/hammer.min.js",
              	"js/materialize/jquery.hammer.js",
              	"js/materialize/global.js",
       	        "js/materialize/collapsible.js",
      	        "js/materialize/dropdown.js",
				"js/materialize/leanModal.js",
      	        "js/materialize/materialbox.js",
              	"js/materialize/parallax.js",
              	"js/materialize/tooltip.js",
              	"js/materialize/waves.js",
              	"js/materialize/toasts.js",
                "js/materialize/sideNav.js",
                "js/materialize/scrollspy.js",
                "js/materialize/forms.js",
                "js/materialize/slider.js",
                "js/materialize/cards.js",
                "js/materialize/pushpin.js",
                "js/materialize/buttons.js",
                "js/materialize/transitions.js",
                "js/materialize/scrollFire.js",
                "js/materialize/date_picker/picker.js",
                "js/materialize/date_picker/picker.date.js",
                "js/materialize/character_counter.js",
								"js/masonry/imagesloaded.pkgd.js",
								"js/masonry/masonry.pkgd.js",
								"js/colorthief/color-thief.min.js",
								"js/color-functions.js",
								"js/cellulose.js",
             ],
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
			},
			js: {
				src: ["dist/theme-cellulose/js/scripts.js"],
				overwrite: true,
				replacements: [{
					from: /\/\/ Velocity has conflicts when loaded with jQuery, this will check for it[^i]*( |\n)*if[^\}]*( |\n)*\}( |\n)*else[^\}]*\}/,
					to: "var Vel = jQuery.Velocity;"
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
	grunt.registerTask("js", ["clean:js", "concat:js", "replace:js", "uglify:js"]);
	grunt.registerTask("dist", ["clean:dist", "copy:php", "css", "js"]);

	grunt.registerTask("default", ["dist"]);

};
