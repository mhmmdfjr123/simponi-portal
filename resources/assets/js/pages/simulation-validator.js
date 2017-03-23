//Author: Romy Adzani A
// jQuery dependent
/*
Example:

HTML(Bootstrap template):
<form id="your-form">
    <div class="form-group">
        <label>Your Label</label>
        <input class="form-control" type="text" required />
    </div>
</form>

JS:
var check = $("#your-form").validate(); //will return boolean
*/

$.fn.validate = function () {
    var checked = true;
    this.find('[required]').each(function () {
        var formgroup = $(this).closest('.form-group'),
            warning = formgroup.children('.validation-warning');
            existingwarning = (warning.length > 0);

        if ($(this).is('select')) {
            var tmpchecked = ($(this).children('option:selected').index() > 0);
            checked = checked && tmpchecked;
            tmpchecked ? (existingwarning && warning.remove()) : (!existingwarning && formgroup.append('<small class="validation-warning">Opsi di atas harus dipilih</small>'));
        } else if ($(this).is('input')) {
            if ($(this).is('[type="radio"]') || $(this).is('[type="checkbox"]')) {
                var tmpchecked = $(this).is(':checked') || ($(this).closest('label').siblings().find(':checked').length > 0);
                checked = checked && tmpchecked;
                tmpchecked ? (existingwarning && warning.remove()) : (!existingwarning && formgroup.append('<small class="validation-warning">Pilihan tidak boleh kosong</small>'));
            } else {
                var tmpchecked = ($(this).val().length > 0);
                checked = checked && tmpchecked;
                tmpchecked ? (existingwarning && warning.remove()) : (!existingwarning && formgroup.append('<small class="validation-warning">Kolom tidak boleh kosong</small>'));
                warning = formgroup.children('.validation-warning');
                existingwarning = (warning.length > 0);
                if (tmpchecked && $(this).is('[type="email"]')) {
                    var tmpemail = $(this).split('@'),
                        tmpemailchecked = ((tmpemail.length > 1) ? (tmpemail[1].indexOf('.') >= 0) : false);
                    checked = checked && tmpemailchecked;
                    tmpemailchecked ? (existingwarning && warning.remove()) : (!existingwarning && formgroup.append('<small class="validation-warning">Email tidak valid</small>'));
                }
                if (tmpchecked && $(this).is('.numstart')) {
                    var targetvalue = $($(this).data('numstart-target')).val(),
                        numstartchecked = ($(this).val() < targetvalue),
                        message = $(this).data('numstart-message');
                    checked = checked && numstartchecked;
                    numstartchecked ? (existingwarning && warning.remove()) : (!existingwarning && formgroup.append('<small class="validation-warning">' + message + '</small>'));
                }
                if (tmpchecked && $(this).is('[data-min-value]')) {
                    var targetvalue = parseInt($(this).data('min-value')),
                        minvaluechecked = ($(this).val() >= targetvalue),
                        message = $(this).data('message');
                    checked = checked && minvaluechecked;
                    minvaluechecked ? (existingwarning && warning.remove()) : (!existingwarning && formgroup.append('<small class="validation-warning">' + message + '</small>'));
                }
                if (tmpchecked && $(this).is('[data-max-value]')) {
                    var targetvalue = parseInt($(this).data('max-value')),
                        maxvaluechecked = ($(this).val() <= targetvalue),
                        message = $(this).data('message');
                    checked = checked && maxvaluechecked;
                    maxvaluechecked ? (existingwarning && warning.remove()) : (!existingwarning && formgroup.append('<small class="validation-warning">' + message + '</small>'));
                }
            }
        }
    });
    return checked;
};
$.fn.validateNow = function () {
    this.each(function () {
        var tmpvalue = null;
        $(this).keydown(function () {
            $(this).closest('.form-group').children('.validation-warning').remove();
            tmpvalue = $(this).val();
        }).keyup(function () {
            var value = $(this).val(),
                minvalue = $(this).data('min-value'),
                minvalue = (typeof minvalue == "undefined") ? 0 : parseInt(minvalue),
                maxvalue = $(this).data('max-value'),
                maxvalue = (typeof maxvalue == "undefined") ? 0 : parseInt(maxvalue),
                checked = (value >= minvalue) && ((maxvalue > 0) ? (value <= maxvalue) : true);
            if (!checked && (value.length > 0)) {
                var message = $(this).data('message'),
                    formgroup = $(this).closest('.form-group'),
                    warning = formgroup.children('.validation-warning'),
                    existingwarning = (warning.length > 0);
                existingwarning ? warning.text(message) : formgroup.append('<small class="validation-warning">' + message + '</small>');
                if (value > 99) {
                    $(this).val(tmpvalue);
                }
            }
        }).blur(function () {
            var value = $(this).val(),
                minvalue = $(this).data('min-value'),
                minvalue = (typeof minvalue == "undefined") ? 0 : parseInt(minvalue),
                maxvalue = $(this).data('max-value'),
                maxvalue = (typeof maxvalue == "undefined") ? 0 : parseInt(maxvalue),
                checked = (value >= minvalue) && ((maxvalue > 0) ? (value <= maxvalue) : true),
                formgroup = $(this).closest('.form-group'),
                warning = formgroup.children('.validation-warning'),
                existingwarning = (warning.length > 0);
            if (!checked && (value.length > 0)) {
                var message = $(this).data('message');
                existingwarning ? warning.text(message) : formgroup.append('<small class="validation-warning">' + message + '</small>');
                if (value > 99) {
                    $(this).val(tmpvalue);
                }
            } else {
                warning.remove();
            }
        });
    });    
}