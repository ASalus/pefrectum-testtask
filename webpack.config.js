const path = require('path');

module.exports = {
	entry: './assets/js/app.js',
	output: {
		filename: 'output.js',
		path: path.resolve(__dirname, 'assets/js'),
	},
};