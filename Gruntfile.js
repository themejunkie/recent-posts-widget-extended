module.exports = function(grunt) {

	// Load all Grunt tasks
	require('jit-grunt')(grunt, {
		makepot: 'grunt-wp-i18n'
	});

	grunt.initConfig({

		pkg: grunt.file.readJSON('package.json'),

		makepot: {
			target: {
				options: {
					domainPath: '/languages/',           // Where to save the POT file.
					potFilename: '<%= pkg.name %>.pot',  // Name of the POT file.
					type: 'wp-plugin',                   // Type of project (wp-plugin or wp-theme).
					updateTimestamp: true,               // Whether the POT-Creation-Date should be updated without other changes.
					processPot: function( pot, options ) {
						pot.headers['report-msgid-bugs-to'] = 'http://satrya.me/';
						pot.headers['plural-forms'] = 'nplurals=2; plural=n != 1;';
						pot.headers['last-translator'] = 'Satrya (satrya@satrya.me)\n';
						pot.headers['language-team'] = 'Satrya (satrya@satrya.me)\n';
						pot.headers['x-poedit-basepath'] = '..\n';
						pot.headers['x-poedit-language'] = 'English\n';
						pot.headers['x-poedit-country'] = 'UNITED STATES\n';
						pot.headers['x-poedit-sourcecharset'] = 'utf-8\n';
						pot.headers['x-poedit-searchpath-0'] = '.\n';
						pot.headers['x-poedit-keywordslist'] = '__;_e;__ngettext:1,2;_n:1,2;__ngettext_noop:1,2;_n_noop:1,2;_c;_nc:4c,1,2;_x:1,2c;_ex:1,2c;_nx:4c,1,2;_nx_noop:4c,1,2;\n';
						pot.headers['x-textdomain-support'] = 'yes\n';
						return pot;
					}
				}
			}
		},

	});

};