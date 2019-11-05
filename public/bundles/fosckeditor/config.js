

/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
    config.extraPlugins = 'bootstrapBuilder';
    config.contentsCss = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css';
    config.mj_variables_bootstrap_css_path = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css';
    config.mj_variables_bootstrap_js_path = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js';
    config.allowedContent = true;
    config.bootstrapBuilder_container_large_desktop = 1170;
    config.bootstrapBuilder_container_desktop = 970;
    config.bootstrapBuilder_container_tablet = 750;
    config.bootstrapBuilder_grid_columns = 12;
    config.bootstrapBuilder_ckfinder_version = 3;
    config.bootstrapBuilder_ckfinder_path = '/bundles/ckfinder/ckfinder.js';
    config.filebrowserUploadUrl = '/bundles/ckfinder/ckfinder.html';
    config.filebrowserBrowseUrl = '/bundles/ckfinder/ckfinder.html';



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