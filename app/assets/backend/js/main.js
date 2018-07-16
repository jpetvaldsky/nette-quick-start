$(function() {
    $('.media-uploader').fineUploader({
        debug: true, //hodí se pro lazení
        multiple: false,
        request: {
            endpoint: '/api/upload-media'
        },
        chunking: {
            enabled: true,
            partSize: 1500000,
            success: {
                endpoint: '/api/upload-media-chunksdone'
            }
        },
        retry: {
            enableAuto: true
        }
    }).on('complete', function (event, id, name, responseJSON) {
        console.log("---- UPLOAD COMPLETED -----",responseJSON.uuid);
        $(this).data('uuid',responseJSON.uuid);
        $('#'+$(this).attr('id')+'ID').val(responseJSON.uuid);
        console.log($(this).data('uuid'));
    });
});