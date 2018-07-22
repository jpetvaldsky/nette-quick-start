

$(function() {
    $('.media-uploader').each(function(){
        var mediaHandlerID = $(this).attr('id');
        var optValues = {
            debug: true, //hodí se pro lazení
            multiple: false,
            request: {
                params: {
                    'container': mediaHandlerID,
                    'hash': $('#'+mediaHandlerID+'Hash').val(),
                    'id': $('#'+mediaHandlerID+'ID').val()
                },
                endpoint: '/api/upload-media'
            },
            chunking: {
                enabled: true,
                partSize: 1500000,
                success: {
                    params: {
                        'container': mediaHandlerID,
                        'hash': $('#'+mediaHandlerID+'Hash').val(),
                        'id': $('#'+mediaHandlerID+'ID').val()
                    },
                    endpoint: '/api/upload-media-chunksdone'
                }
            },
            retry: {
                enableAuto: true
            }
        };
        //console.log(optValues);
        $(this).fineUploader(optValues).on('complete', function (event, id, name, responseJSON) {
            console.log("---- UPLOAD COMPLETED -----",responseJSON.uuid);
            $(this).data('uuid',responseJSON.uuid);
            $('#'+$(this).attr('id')+'Hash').val(responseJSON.uuid);
            console.log($(this).data('uuid')); 
        });
    });
});