/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	//

    config.extraPlugins = 'fileexplorer';

	config.toolbarGroups = [
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'forms' },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'links' },
        '/',
        { name: 'fileTool' },
		{ name: 'insert' },
		{ name: 'styles' },
		{ name: 'colors' }
	];
	// The default plugins included in the basic setup define some buttons that
	// are not needed in a basic editor. They are removed here.
	config.removeButtons = 'Cut,Copy,Paste,Undo,Redo,Anchor,Underline,Strike,Subscript,Superscript,Flash,oembed,Iframe,Slideshow';

	// Dialog windows are also simplified.
	config.removeDialogTabs = 'link:advanced';
    config.font_names =
        'Arial/Arial, Helvetica, sans-serif;' +
        'Calibri/Calibri, Helvetica, sans-serif;' +
        'Times New Roman/Times New Roman, Times, serif;' +
        'Verdana;'+
        'Georgia';
    config.font_defaultLabel = 'Calibri';
    config.fontSize_sizes = '8/8pt;9/9pt;10/10pt;11/11pt;12/12pt/14/14pt;16/16pt;20/20pt;24/24pt;32/32pt;48/48pt;';
};
