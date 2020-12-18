'use strict';
const gulp = require('gulp');
const gif = require('gulp-if');
const concat = require('gulp-concat');
const minify = require('gulp-minify');
const cssmin = require('gulp-clean-css');
const babel = require('gulp-babel');

const config = {
	root: 'E:/PROJECTS/GUSTAVO/wp-content/themes/dongustavo',
	css : [
		'/front/libs/**/*.css',
		'/fonts.css',
		'/style_old.css',
		'/media.css'
	],
	js: [
		'/front/libs/**/*.js',
		'/front/js/core/*.js',
		'/front/js/components/*.js',
		'/front/js/common.js'
	]
}
const jsFiles = config['js'].map(value => config['root'] + value);
const cssFiles = config['css'].map(value => config['root'] + value);
const isMinify = true;

function concatJS() {
	return gulp
		.src(jsFiles)
		.pipe(babel())
		.pipe(concat('main.js'))
		.pipe(gif(isMinify, minify({
			ext:{
				src:'-debug.js',
				min:'.js'
			}})))
		.pipe(gulp.dest(config['root'] + '/'));
}

function concatCss() {
	return gulp
		.src(cssFiles)
		.pipe(concat('style.css'))
		.pipe(gif(isMinify, cssmin({
			level: {
				2: {
					mergeAdjacentRules: true, // controls adjacent rules merging; defaults to true
					mergeIntoShorthands: true, // controls merging properties into shorthands; defaults to true
					mergeMedia: true, // controls `@media` merging; defaults to true
					mergeNonAdjacentRules: true, // controls non-adjacent rule merging; defaults to true
					mergeSemantically: false, // controls semantic merging; defaults to false
					overrideProperties: false, // controls property overriding based on understandability; defaults to true
					removeEmpty: true, // controls removing empty rules and nested blocks; defaults to `true`
					reduceNonAdjacentRules: false, // controls non-adjacent rule reducing; defaults to true
					removeDuplicateFontRules: true, // controls duplicate `@font-face` removing; defaults to true
					removeDuplicateMediaBlocks: true, // controls duplicate `@media` removing; defaults to true
					removeDuplicateRules: true, // controls duplicate rules removing; defaults to true
					removeUnusedAtRules: false, // controls unused at rule removing; defaults to false (available since 4.1.0)
					restructureRules: false, // controls rule restructuring; defaults to false
					skipProperties: [] // controls which properties won't be optimized, defaults to `[]` which means all will be optimized (since 4.1.0)
				}
			}
		})))
		.pipe(gulp.dest(config['root'] + '/'));
}
gulp.task('compile:js', gulp.series(concatJS))
gulp.task('compile:css', gulp.series(concatCss))
gulp.task('build', gulp.series(concatCss, concatJS))