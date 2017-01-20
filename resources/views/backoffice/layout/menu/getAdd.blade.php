<!-- Default Ajax Form -->
<script type="text/javascript">
    $(document).ready(function() {
        $("#ajax-form").validate({
            meta : "validate"
        });
        $("#ajax-form").ajaxForm({
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
                        $.growl.notice({ message: response.message });

                        loadListMenu();
                    }else{
                        $.growl.error({ message: response.message });
                    }

                    jQuery.facebox.close();
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
    <form id="ajax-form" name="ajax-form" class="form" action="{{ url('backoffice/layout/menu/submit') }}" enctype="multipart/form-data" method="post" role="form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="menu_category_id" value="{{ $catId }}" />
        <input type="hidden" name="menu_type" value="{{ $menuType }}" />

        <fieldset>

            <div class='fbox-content'>
                <!-- Content -->
                <div class="form-group">
                    <label>Nama Menu</label>
                    <input type="text" name="menu_name" maxlength="25" class="form-control required" />
                </div>
                @if($menuType == 'URL')
                    <div class="form-group">
                        <label>Target URL</label>
                        <input type="text" name="menu_type_param" maxlength="500" class="form-control required" />
                    </div>
                @elseif($menuType == 'PA')
                    <div class="form-group">
                        <label>Target Halaman</label>
                        <select name="menu_type_param" class="form-control required">
                            <option value="">- Pilih Halaman -</option>
                            @foreach($listPage as $page)
                                <option value="{{ $page->id }}">{{ $page->title }}</option>
                            @endforeach
                        </select>
                    </div>
                @elseif($menuType == 'PO')
                    <div class="form-group">
                        <label>Target Kategori</label>
                        <select name="menu_type_param" class="form-control">
                            <option value="">- Semua Kategori -</option>
                            @foreach($listCategory as $cat)
                                <option value="{{ $cat['data']->id }}" style="padding-left: <?php echo (($cat['level']-1)*20).'px' ?>;">{{ $cat['data']->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @elseif($menuType == 'S')
                    <div class="form-group">
                        <label>Pilih Halaman Spesial</label>
                        <select name="menu_type_param" class="form-control required">
                            <option value="">- Pilih Satu -</option>
                            @foreach($listData as $key => $row)
                                <option value="{{ $key }}">{{ $row['title'] }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
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
