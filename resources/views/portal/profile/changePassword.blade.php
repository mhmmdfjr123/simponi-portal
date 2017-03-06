<!-- Default Ajax Form -->
<script type="text/javascript">
    $(function () {
        createPasswordValidatorMessage();
        var $ajaxFormChangePassword = $("#ajax-form-change-password");

        $ajaxFormChangePassword.validate({
            rules: {
                'password-confirm': {
                    required: true,
                    equalTo: "#password"
                },
                'old-password': {
                    required: true
                }
            },
            onkeyup: function(element) {
                this.element(element);
            }
        });

        $ajaxFormChangePassword.submit(function (e) {
            if ($ajaxFormChangePassword.valid()) {
                $.ajax({
                    url: $ajaxFormChangePassword.attr('action'),
                    method: $ajaxFormChangePassword.attr('method'),
                    data: $ajaxFormChangePassword.serialize(),
                    beforeSend : function() {
                        $('fieldset').attr('disabled', true);
                        $(".fbox-footer button[type=submit]").button('loading');
                    },
                    error : function(jqXHR, statusText, errorThrown) {
                        alertError(statusText + ": " + errorThrown);
                    },
                    dataType:  'json',
                    success : function(response, statusText, jqXHR) {
                        $('fieldset').attr('disabled', false);
                        $(".fbox-footer button[type=submit]").button('reset');

                        if (statusText == "success") {
                            if(response.status == 'ok'){
                                alertPopUp('Berhasil', response.message, 'Tutup');
                            }else{
                                $('#change-password-alert-error').show();
                                $('#change-password-alert-error-text').text(response.message);

                                resetFormChangePassword();
                            }
                        } else {
                            alertError();
                        }
                    }
                });
            }

            e.preventDefault();
        });
    });

    function resetFormChangePassword() {
        $("input[type=password]").val('');
    }
</script>

<div class='fbox-header'>
    <h4>Ubah Password</h4>
</div>
<div class='fbox-container'>
    <form id="ajax-form-change-password" name="ajax-form-change-password" class="form" action="{{ route('portal-change-password') }}" method="post" role="form">
        {{ csrf_field() }}

        <fieldset>

            <div class='fbox-content'>
                <div class="alert alert-danger" id="change-password-alert-error" style="display: none">
                    <button class="close" data-dismiss="alert" type="button"><i class="fa fa-times"></i></button>
                    <span id="change-password-alert-error-text"></span>
                </div>
                <!-- Content -->
                <div class="form-group form-message-light">
                    <label>Password Lama</label>
                    <input type="password" name="old-password" maxlength="30" class="form-control" />
                </div>
                <div class="form-group form-message-light">
                    <label>Password Baru</label>
                    <input type="password" name="password" id="password" maxlength="30" class="form-control bniPasswordValidator" />
                </div>
                <div class="form-group form-message-light">
                    <label>Ketik Ulang Password Baru</label>
                    <input type="password" name="password-confirm" maxlength="30" class="form-control" />
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
