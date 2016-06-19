module.exports = function(grunt) {
  // Project configuration.
  grunt.initConfig({

    less: {
      development: {
        options: {
          paths: ['htdocs/assets/css']
        },
        files: {
          'htdocs/assets/css/mad.dev.css': 'app/less/mad.less',
          'htdocs/assets/css/bootstrap.dev.css': 'app/less/bootstrap.less'
        }
      },
      production: {
        options: {
          compress: true,
          paths: ['assets/css'],
//          plugins: [
//            new (require('less-plugin-autoprefix'))({browsers: ["last 2 versions"]}),
//            new (require('less-plugin-clean-css'))(cleanCssOptions)
//          ],
//          modifyVars: {
//            imgPath: '"http://mycdn.com/path/to/images"',
//            bgColor: 'red'
//          }
        },
        files: {
          'htdocs/assets/css/mad.css': 'app/less/mad.less',
          'htdocs/assets/css/bootstrap.css': 'app/less/bootstrap.less'
        }
      }
    },
    
    pug: {
      compile: {
        options: {
          pretty: true,
        },
        files: {
          'htdocs/index.html': 'app/views/index.pug',
          'htdocs/howto.html': 'app/views/howto.pug',
          'htdocs/examples.html': 'app/views/examples.pug',
          'htdocs/preprocessing.html': 'app/views/preprocessing.pug',
          'htdocs/package_manager.html': 'app/views/package_manager.pug'
        }
      }
    },

    watch: {
      grunt: { files: ['Gruntfile.js'] },
      less: {
        files: 'app/less/**/*.less',
        tasks: ['less']
      },
      pug: {
        files: 'app/views/**/*.pug',
        tasks: ['pug']
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-pug');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-watch');

  grunt.registerTask('build', 'do all the stuff', [ 'less', 'pug' ]);
  grunt.registerTask('default','Convert Pug templates into html templates', [ 'less', 'pug', 'watch' ]);

};
