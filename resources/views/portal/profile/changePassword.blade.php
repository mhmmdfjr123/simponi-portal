<!-- Default Ajax Form -->
<script src="{{ asset('theme/backoffice/ext/vendor/encryption/jsencrypt.min.js') }}"></script>
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
                var enc = new JSEncrypt();
                enc.setPublicKey($('#public-key').val());

                // Encrypt
                var $oldPassword = $('#old-password');
                var $password = $('#password');
                var $passwordConfirm = $('#password-confirm');
                $oldPassword.val(enc.encrypt($oldPassword.val()));
                $password.val(enc.encrypt($password.val()));
                $passwordConfirm.val(enc.encrypt($passwordConfirm.val()));

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

                        if (statusText === "success") {
                            if(response.status === 'ok'){
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
                    <input type="password" name="old-password" id="old-password" maxlength="30" class="form-control" />
                </div>
                <div class="form-group form-message-light">
                    <label>Password Baru</label>
                    <input type="password" name="password" id="password" maxlength="30" class="form-control bniPasswordValidator" />
                </div>
                <div class="form-group form-message-light">
                    <label>Ketik Ulang Password Baru</label>
                    <input type="password" name="password-confirm" id="password-confirm" maxlength="30" class="form-control" />
                </div>
                <!-- End of Content -->
            </div>
            <div class='fbox-footer'>
                <div class="btn-group">
                    <button type="submit" name="save" value="save" class="btn btn-primary btn-sm" data-loading-text="Loading...">Simpan</button>
                    <a class="btn btn-default btn-sm" href='javascript:void(0)' onclick='jQuery.facebox.close()'>Batal</a>
                </div>
            </div>

            <input type="hidden" id="public-key" value="{{ $publicKey }}">
        </fieldset>
    </form>
</div>
