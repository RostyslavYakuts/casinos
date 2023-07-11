(function ($) {


    console.log(ucLocalizedScript);
    var $current = $('.js-current-page');
    var $total = $('.js-total-pages');
    var $runBtn = $('.js-run-upload');
    var $uploadForm = $('#casino_upload_form');


    $uploadForm.on('submit',function (e) {
        e.preventDefault();
        console.log('Run');
        var page = $('#starting-page').val();

        if (!page) {
            page = 1;
        }

        $runBtn.prop('disabled', true);

        uploadCasinosAjax(page);
    });

    function uploadCasinosAjax(page) {
        return $.ajax({
            type: 'POST',
            url: ucLocalizedScript.ajax_url,
            data: {
                nonce: ucLocalizedScript.nonce,
                page: page,
                action: ucLocalizedScript.action
            },
            success: function(res) {
                if (res.data.page) {
                    $current.text(res.data.page);
                    $total.text(res.data.total_pages);
                    var hotlink_protection = res.data.hotlink_protection;
                    if( hotlink_protection !== 'not protected' ){
                        $('#hotlink_protected_warning').text(hotlink_protection);
                    }

                    if ( res.data.page < res.data.total_pages ) {
                        uploadCasinosAjax(++res.data.page);
                    }
                } else {
                    $runBtn.prop('disabled', false);
                }
            },
            error: function () {
                $runBtn.prop('disabled', false);
            }
        });
    }

})(jQuery);