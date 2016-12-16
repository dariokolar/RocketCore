/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For the complete reference:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for a single toolbar row.
	config.toolbarGroups = [
		{ name: 'basicstyles', groups: [ 'basicstyles' ] },
		{ name: 'editing',     groups: [ 'selection' ] },
		{ name: 'links' },
	];

	// The default plugins included in the basic setup define some buttons that
	// we don't want too have in a basic editor. We remove them here.
	config.removeButtons = 'Cut,Copy,Paste,PasteText,Replace,BGColor,Anchor,Underline,Strike,Subscript,Superscript,Find,Undo,Redo,Styles,FontSize,Flash';

	// Let's have it basic on dialogs as well.
	config.extraPlugins='dialogadvtab';
	/*config.removeDialogTabs = 'link:advanced';*/
	config.removeDialogTabs = 'link:upload';
	config.allowedContent = true;
	config.oembed_maxWidth = '560';
	config.oembed_maxHeight = '315';
	config.oembed_WrapperClass = 'embededContent';
	config.entities_latin = false; // jinak to bude nahrazovat diakritiku za entity
	config.format_tags = 'h1;h2;h3;p';
	config.contentsCss = ['/styly/classes.css', '/styly/default.css', '/styly/editor.css', '/styly/perex.css']; //tady muze byt i vice souboru.
	config.bodyClass = 'editor';
	config.forcePasteAsPlainText = true;
};
