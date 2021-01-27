$(document).ready(function () {
    $(".nav-treeview .nav-link, .nav-link").each(function () {
        var location2 = window.location.protocol + '//' + window.location.host + window.location.pathname;
        var link = this.href;
        if(link == location2){
            $(this).addClass('active');
            $(this).parent().parent().parent().addClass('menu-is-opening menu-open');

        }
    });

    $('.delete-btn').click(function () {
        var res = confirm('Подтвердите действия');
        if(!res){
            return false;
        }
    });

    $('.change-role').click(function () {
        var res = confirm('Поменять роль?');
        if(!res){
            return false;
        }
    });

    tinymce.init({
        selector: '.editor',
        plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        toolbar_mode: 'floating',
        relative_urls : false,
        file_picker_callback : elFinderBrowser
    });

    function elFinderBrowser (callback, value, meta) {
        tinymce.activeEditor.windowManager.openUrl({
            title: 'File Manager',
            url: '/elfinder/tinymce5',
            /**
             * On message will be triggered by the child window
             *
             * @param dialogApi
             * @param details
             * @see https://www.tiny.cloud/docs/ui-components/urldialog/#configurationoptions
             */
            onMessage: function (dialogApi, details) {
                if (details.mceAction === 'fileSelected') {
                    const file = details.data.file;

                    // Make file info
                    const info = file.name;

                    // Provide file and text for the link dialog
                    if (meta.filetype === 'file') {
                        callback(file.url, {text: info, title: info});
                    }

                    // Provide image and alt text for the image dialog
                    if (meta.filetype === 'image') {
                        callback(file.url, {alt: info});
                    }

                    // Provide alternative source and posted for the media dialog
                    if (meta.filetype === 'media') {
                        callback(file.url);
                    }

                    dialogApi.close();
                }
            }
        });
    }

    $(document).ready(function() {
        $('select[name=changeRole]').change(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var url = '/admin_panel/user/changeRole/';
            var role = $('#role-name option:selected').text();
            var user = $('#role-name').val();
            console.log(role,user)
            // $.post(url,
            //     {
            //         data: {
            //             "role": role
            //         }
            //     }
            //     , function (response) {
            //         //window.location.reload();
            //     });
            // return false;
        });
    });
})
