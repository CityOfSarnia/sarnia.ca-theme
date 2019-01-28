wp.hooks.addFilter(
	'blocks.registerBlockType',
	'sarnia.ca-theme',
	function( settings, name ) {
		if ( name === 'core/file' ) {
			return lodash.assign( {}, settings, {
				supports: lodash.assign( {}, settings.supports, {
					// disable the align-UI completely ...
					align: false, 
					// ... or only allow specific alignments
					// align: ['center,'full'], 
				} ),
			} );
		}
		return settings;
	}
);
