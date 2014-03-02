module.exports = function(grunt) {

  grunt.initConfig({
  	// LESS COMPILE
    less: {
      	development: {
        	options: {
          		compress: true,
          		yuicompress: true,
          		optimization: 2
        },
        files: {
          "src/css/bootstrap.css": "src/bootstrap/less/bootstrap.less"
        }
      }
    },
    // CONCAT JS
    concat: {
    	options: {
        	separator: ';'
	    },
    	dist: {
      		src: [
	          'src/bootstrap/js/transition.js',
	          'src/bootstrap/js/alert.js',
	          'src/bootstrap/js/button.js',
	          'src/bootstrap/js/carousel.js',
	          'src/bootstrap/js/collapse.js',
	          'src/bootstrap/js/dropdown.js',
	          'src/bootstrap/js/modal.js',
	          'src/bootstrap/js/tooltip.js',
	          'src/bootstrap/js/popover.js',
	          'src/bootstrap/js/scrollspy.js',
	          'src/bootstrap/js/tab.js',
	          'src/bootstrap/js/affix.js'
	        ],
      		dest: 'src/js/bootstrap.js'
    	}
  	},
  	// WATCH
    watch: {
      	less: {
	        files: ['src/bootstrap/less/*.less'],
	        tasks: ['less'],
	        options: {
	          	nospawn: true
	        }
      	},
      	js: {
	        files: ['src/bootstrap/js/*.js'],
	        tasks: ['concat'],
	        options: {
	          	nospawn: true
	        }
      	}
    },
    

});
 
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-concat');
 
  grunt.registerTask('default', ['watch']);
};