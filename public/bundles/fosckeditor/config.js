

/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
    config.extraPlugins = 'widgetselection, button, toolbar, notification, dialogui, dialog, clipboard, lineutils, widget, bootstrapBuilder';
    config.allowedContent = true;
    config.contentsCss = 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css';
    config.mj_variables_bootstrap_css_path = 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css';
    config.mj_variables_bootstrap_js_path = 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js';
    config.mj_variables_bootstrap_popper_js_path = 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js';
    config.bootstrapBuilder_container_extra_large = 1140;
    config.bootstrapBuilder_container_large = 960;
    config.bootstrapBuilder_container_medium = 720;
    config.bootstrapBuilder_container_small = 540;
    config.bootstrapBuilder_grid_columns = 12;
    config.bootstrapBuilder_ckfinder_version = 3;
    config.bootstrapBuilder_ckfinder_path = '/bundles/ckfinder/ckfinder.js';
    config.filebrowserUploadUrl = '/bundles/ckfinder/ckfinder.html';
    config.filebrowserBrowseUrl = '/bundles/ckfinder/ckfinder.html';
    config.language = 'fr';
    config.height = 1000


};
config.toolbar = [
    { name: 'insert', items: [ 'BootstrapBuilder', 'Source' ] }
];

CKEDITOR.replace( 'editor1', {
    filebrowserBrowseUrl: '/bundles/ckfinder/ckfinder.html',
    filebrowserImageBrowseUrl: '/bundles/ckfinder/ckfinder.html?Type=Images',
    filebrowserUploadUrl: '/bundles/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserImageUploadUrl: '/bundles/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
    filebrowserWindowWidth : '1000',
    filebrowserWindowHeight : '700'
});

