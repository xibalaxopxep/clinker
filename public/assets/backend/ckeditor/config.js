/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
    config.filebrowserBrowseUrl = '/assets/backend/kcfinder-3.20/browse.php?opener=ckeditor&type=files';
    config.filebrowserImageBrowseUrl = '/assets/backend/kcfinder-3.20/browse.php?opener=ckeditor&type=images';
    config.filebrowserFlashBrowseUrl = '/assets/backend/kcfinder-3.20/browse.php?opener=ckeditor&type=flash';
    config.filebrowserUploadUrl = '/assets/backend/kcfinder-3.20/upload.php?opener=ckeditor&type=files';
    config.filebrowserImageUploadUrl = '/assets/backend/kcfinder-3.20/upload.php?opener=ckeditor&type=images';
    config.filebrowserFlashUploadUrl = '/assets/backend/kcfinder-3.20/upload.php?opener=ckeditor&type=flash';
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
};
