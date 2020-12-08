$(document).ready(function () {

    $('.rich-textarea').summernote({
        maxHeight: 200,
        callbacks: {
            onImageUpload: function (files) {
                uploadImage(files[0], $(this));
            },
            onPaste: function (e) {
                var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                e.preventDefault();
                setTimeout(function () {
                    document.execCommand('insertText', false, bufferText);
                }, 10);
            },
        },
        toolbar: [
            ["font", ["bold", "underline", "clear"]],
            ["color", ["color"]],
            ["para", ["ul", "ol", "paragraph"]],
            ["insert", ["link", "picture"]],
            ["view", ["fullscreen"]]
        ],
        dialogsInBody: true
    });

});

function uploadImage(image, editor) {
    var data = new FormData();
    data.append("image", image);
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    $.ajax({
        url: "/admin/summernote/image-upload",
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "POST",
        success: function (url) {
            var image = $("<img>").attr("src", url);
            editor.summernote("insertNode", image[0]);
        },
        error: function (data) {
            console.log(data);
        }
    });
}
