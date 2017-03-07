<!-- Default Ajax Form -->
<script type="text/javascript">
    $(function () {
        var $ajaxFormChangeEmail = $("#ajax-form-change-email");
        $ajaxFormChangeEmail.validate();
        $ajaxFormChangeEmail.submit(function(e){
            if($(this).valid()){
                $('input.form-control').attr('readonly', true);
                $('#btn-change-email').button('loading');
            }
        });
    });
</script>

<div class='fbox-header'>
    <h4>Ganti Email</h4>
</div>
<div class='fbox-container'>
    <form id="ajax-form-change-email" name="ajax-form-change-email" class="form" action="{{ route('branch-account-change-email', [$encryptedId]) }}" method="post" role="form">
        {{ csrf_field() }}

        <fieldset>

            <div class='fbox-content'>

                <!-- Content -->
                <div class="form-group form-message-light">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" autocomplete="off" required />
                </div>
                <!-- End of Content -->
            </div>
            <div class='fbox-footer'>
                <div class="btn-group">
                    <button type="submit" name="save" value="save" class="btn btn-primary btn-sm" id="btn-change-email" data-loading-text="Loading...">Simpan</button>
                    <a class="btn btn-default btn-sm" href='javascript:void(0)' onclick='jQuery.facebox.close()'>Batal</a>
                </div>
            </div>

        </fieldset>
    </form>
</div>
