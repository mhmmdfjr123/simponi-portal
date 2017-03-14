<!-- Default Ajax Form -->
<script type="text/javascript">
    $(function () {
        var $ajaxFormCompanyRegistration = $("#ajax-form-company-registration");
        $ajaxFormCompanyRegistration.validate();
        $ajaxFormCompanyRegistration.submit(function(e){
            if($(this).valid()){
                $('input.form-control').attr('readonly', true);
                $('#btn-register').button('loading');
            }
        });
    });
</script>

<div class='fbox-header'>
    <h4>Pendaftaran Akun Perusahaan</h4>
</div>
<div class='fbox-container'>
    <form id="ajax-form-company-registration" name="ajax-form-company-registration" class="form" action="{{ route('branch-company-registration') }}" method="post" role="form">
        {{ csrf_field() }}

        <fieldset>

            <div class='fbox-content'>

                <!-- Content -->
                <div class="form-group form-message-light">
                    <label>Email PIC</label>
                    <input type="text" name="personInChargeEmail" class="form-control" required />
                </div>
                <div class="form-group form-message-light">
                    <label>Telepon PIC</label>
                    <input type="text" name="personInChargePhone" class="form-control" required />
                </div>
                <!-- End of Content -->
            </div>
            <div class='fbox-footer'>
                <div class="btn-group">
                    <button type="submit" name="save" value="save" class="btn btn-primary btn-sm" id="btn-register" data-loading-text="Mohon tunggu...">Daftar</button>
                    <a class="btn btn-default btn-sm" href='javascript:void(0)' onclick='jQuery.facebox.close()'>Batal</a>
                </div>
            </div>

        </fieldset>
    </form>
</div>
