module.exports = {
	build: {
		cwd: '.',
		expand: true,
		src: [
			'admin/**/*.php',
			'includes/*.php',
			'languages/insert-code-lite.pot',
			'public/**/*.php',
			'*.php',
			'license.txt',
			'README.md',
		],
		dest: '../build/<%= package.name %>/'
	},
	svn: {
		cwd: '.',
		expand: true,
		src: [
			'admin/**/*.php',
			'includes/*.php',
			'languages/insert-code-lite.pot',
			'public/**/*.php',
			'*.php',
			'license.txt',
			'README.txt',
		],
		dest: '../svn/trunk/'
	},
}
