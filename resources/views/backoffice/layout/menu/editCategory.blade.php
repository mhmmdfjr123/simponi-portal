<!-- Default Ajax Form -->
<script type="text/javascript">
    require(['jquery', 'px-libs/toastr', 'px-bootstrap/button', 'px-bootstrap/alert', 'px/plugins/px-validate'], function($, toastr) {
        var $ajaxForm = $("#ajax-form");

        $ajaxForm.pxValidate({
            meta : "validate"
        });
        $ajaxForm.ajaxForm({
            beforeSubmit : function() {
                $('fieldset').attr('disabled', true);
                $(".fbox-footer button[type=submit]").button('loading');
            },
            error : function(jqXHR, statusText, errorThrown) {
                alertError(statusText + ": " + errorThrown);
            },
            dataType:  'json',
            success : function(response, statusText, xhr, $form) {
                $('fieldset').attr('disabled', false);
                $(".fbox-footer button[type=submit]").button('reset');

                if (statusText == "success") {
                    if(response.status == 'ok'){
                        toastr.success(response.message, 'Sukses.');
                        loadListMenuCat('edit', response.data);
                        //console.dir(response.data);
                    }else{
                        toastr.error(response.message, 'Oppss.');
                    }

                    $.facebox.close();
                } else {
                    alertError();
                }
            }
        });
    });
</script>

<div class='fbox-header'>
    <h4>{{ $pageTitle }}</h4>
</div>
<div class='fbox-container'>
    <form id="ajax-form" name="ajax-form" class="form" action="{{ url('backoffice/layout/menu/submit-cat') }}" enctype="multipart/form-data" method="post" role="form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="id" value="{{ $obj->id }}" />

        <fieldset>

            <div class='fbox-content'>
                <!-- Content -->
                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" name="name" value="{{ $obj->name }}" maxlength="25" class="form-control required" />
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="desc" maxlength="255" class="form-control">{{ $obj->desc }}</textarea>
                </div>
                <!-- End of Content -->
            </div>
            <div class='fbox-footer'>
                <div class="btn-group">
                    <button type="submit" name="save" value="save" class="btn btn-primary btn-sm" data-loading-text="Loading...">Simpan</button>
                    <a class="btn btn-default btn-sm" href='javascript:void(0)' onclick='$.facebox.close()'>Batal</a>
                </div>
            </div>

        </fieldset>
    </form>
</div>
