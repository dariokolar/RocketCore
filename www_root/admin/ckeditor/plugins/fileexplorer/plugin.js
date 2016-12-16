CKEDITOR.plugins.add( 'fileexplorer', {
    icons: 'abbr',
    init: function (editor) {
        editor.ui.addButton( 'Fileexplorer', {
            label: 'Nahrát nový obrázek',
            command: 'OpenWindow',
            toolbar: 'fileTool',
            icon: CKEDITOR.plugins.getPath('fileexplorer') + '/icons/image.png'
        });

        var cmd = editor.addCommand('OpenWindow', { exec: showMyDialog });
    }
});
function showMyDialog(e) {
   console.log(e);
    openFileManager2(e)

}
