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
                if (tmpchecked && $(this).is('[type="email"]')) {
                    var tmpemail = $(this).split('@'),
                        tmpemailchecked = ((tmpemail.length > 1) ? (tmpemail[1].indexOf('.') >= 0) : false);
                    checked = checked && tmpemailchecked;
                    tmpemailchecked ? (existingwarning && warning.remove()) : (!existingwarning && formgroup.append('<small class="validation-warning">Email tidak valid</small>'));
                }
                tmpchecked ? (existingwarning && warning.remove()) : (!existingwarning && formgroup.append('<small class="validation-warning">Kolom tidak boleh kosong</small>'));
            }
        }
    });
    return checked;
};