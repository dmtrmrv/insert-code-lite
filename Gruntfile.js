module.exports = function( grunt ) {
	grunt.initConfig( {
		pkg: grunt.file.readJSON( 'package.json' ),

		makepot: {
			target: {
				options: {
					type: 'wp-plugin',
				}
			}
		},
		watch: {
			scripts: {
				files: [ '**/*.php' ],
				tasks: 'makepot',
				options: {
					spawn: false,
				}
			}
		}

	} );

	grunt.loadNpmTasks( 'grunt-wp-i18n' );
	grunt.loadNpmTasks( 'grunt-contrib-watch' );

	grunt.registerTask( 'default', [ 'watch' ] );
};
