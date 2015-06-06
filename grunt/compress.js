module.exports = {
	build: {
		options: {
			archive: '../build/<%= package.name %>.zip'
		},
		expand: true,
		cwd: '.',
		src: [
			'**/*',
			'!**/assets/**',
			'!**/grunt/**',
			'!**/node_modules/**',
			'!.DS_Store',
			'!**/.DS_Store',
			'!.gitignore',
			'!Gruntfile.js',
			'!package.json',
			'!README.txt',
			'!*.sublime-project',
			'!*.sublime-workspace',

		],
	}
}
