import buble from 'rollup-plugin-buble';

export default {
	entry: 'ressources/assets/js/*.js',
	format: 'cjs',
	plugins: [buble()],
	dest: 'public/js/notifier.js'
};