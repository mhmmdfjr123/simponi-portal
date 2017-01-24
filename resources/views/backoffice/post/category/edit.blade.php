<!-- Default Ajax Form -->
<script type="text/javascript">
    require(['jquery', 'px-libs/toastr', 'px-bootstrap/button', 'px/plugins/px-validate', 'px-libs/select2.full'],
        function($, toastr) {

        var $ajaxForm = $("#ajax-form");

        $ajaxForm.validate({
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
                        loadList();
                    }else{
                        toastr.error(response.message, 'Oppss.');
                    }

                    jQuery.facebox.close();
                } else {
                    alertError();
                }
            }
        });

        $("#select2-parent").select2({
            allowClear: true,
            placeholder: "Pilih parent"
        });
    });

    function setAlias(obj) {
        var text = $(obj).val().toLowerCase().replace(/([^0-9^A-z])/gi, '-');
        $("#alias").val(text);
    }
</script>

<div class='fbox-header'>
    <h4>Ubah Kategori</h4>
</div>
<div class='fbox-container'>
    <form id="ajax-form" name="ajax-form" class="form" action="{{ url('backoffice/post/category/submit') }}" enctype="multipart/form-data" method="post" role="form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="id" value="{{ $obj->id }}" />
        <input type="hidden" name="alias_old" value="{{ $obj->alias }}" />

        <fieldset>

            <div class='fbox-content'>
                <!-- Content -->
                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" name="name" value="{{ $obj->name }}" onkeyup="setAlias(this);" onblur="setAlias(this);" maxlength="50" class="form-control required" />
                </div>
                <div class="form-group">
                    <label>Alias</label>
                    <input type="text" name="alias" value="{{ $obj->alias }}" id="alias" maxlength="50" class="form-control required" />
                    <p class="help-block">Sebagai permalink dari kategori.</p>
                </div>
                <div class="form-group">
                    <label>Parent</label>
                    <select name="parent" id="select2-parent" class="form-control">
                        <option value="">- Tidak ada Parent -</option>
                        @foreach($listParent as $parent)
                            <option value="{{ $parent['data']->id }}" <?php if($obj->parent == $parent['data']->id)echo 'selected="selected"' ?>><?php echo str_repeat("---", $parent['level']-1) ?> {{ $parent['data']->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="desc" maxlength="300" class="form-control">{{ $obj->desc }}</textarea>
                </div>
                <div class="form-group">
                    <label>Aktif?</label>
                    <div style="margin-top: 3px">
                        <label for="switcher-success" class="switcher switcher-success">
                            <input id="switcher-success" type="checkbox" name="status" value="Y" <?php if($obj->status == 'Y')echo 'checked="checked"' ?>>
                            <div class="switcher-indicator">
                                <div class="switcher-yes">YES</div>
                                <div class="switcher-no">NO</div>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Urutan</label>
                    <input type="text" name="order" value="{{ $obj->order }}" maxlength="3" value="0" class="form-control required number" />
                </div>
                <!-- End of Content -->
            </div>
            <div class='fbox-footer'>
                <div class="btn-group">
                    <button type="submit" name="save" value="save" class="btn btn-primary btn-sm" data-loading-text="Loading...">Simpan</button>
                    <a class="btn btn-default btn-sm" href='javascript:void(0)' onclick='jQuery.facebox.close()'>Batal</a>
                </div>
            </div>

        </fieldset>
    </form>
</div>
