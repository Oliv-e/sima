import $ from 'jquery';

$(document).ready(function () {
    $('#dropzone-file').on('change', function (e) {
        const fileName = e.target.files[0]?.name;
        if (fileName) {
            $('#file-name-preview').text('File dipilih: ' + fileName);
        } else {
            $('#file-name-preview').text('');
        }
    });
});
