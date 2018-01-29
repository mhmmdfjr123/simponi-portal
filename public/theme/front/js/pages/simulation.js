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
                        numstartchecked = (parseInt($(this).val()) < parseInt(targetvalue)),
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
                /*if (value > 99) {
                    $(this).val(tmpvalue);
                }*/
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
                /*if (value > 99) {
                    $(this).val(tmpvalue);
                }*/
            } else {
                warning.remove();
            }
        });
    });    
}
//Author: Romy Adzani A

var formatCurrency = function (a) {
        return a.replace(/(?!^)(?=(?:\d{3})+(?:\.|$))/gm, '.');
    },
    presentValue = function (rate, nper, pmt, fv) {
        if (nper < 1) {
            return 0;       
        }
        return (rate > 0.0) ? (-(Math.pow((1 + rate), -nper) * ((fv * rate) - pmt + (Math.pow((1 + rate), nper) * pmt))) / rate) : (-(fv + (pmt * nper)));
    },
    periodicPayment = function (rate, nper, pv, fv, type) {
        if (rate > 0.0) {
            // Interest rate exists
            var q = Math.pow((1 + rate), nper);
            return -(rate * (fv + (q * pv))) / ((-1 + q) * (1 + (rate * type)));
        } else if (nper > 0.0) {
            // No interest rate, but number of payments exists
            return -(fv + pv) / nper;
        }
        return 0;
    };

$('input.numeric')/*.keydown(function () {
    $(this).val($(this).val().replace(/\./g, ''));
})*/.keyup(function() {
    if ($(this).val().length > 0) {
        $(this).attr('data-value', $(this).val())/*.val(formatCurrency($(this).val()))*/;
    } else {
        $(this).attr('data-value', 0);
    }
});

$('input.percentage').keyup(function () {
    if ($(this).val().length > 0) {
        $(this).attr('data-value', (parseFloat($(this).val()) / 100));
    } else {
        $(this).attr('data-value', 0);
    }
});

$('input[name="topupRadio"]').click(function () {
    if ($(this).parent().is(':first-child')) {
        $('input#starting-balance').attr('disabled', true).removeAttr('required');
    } else {
        $('input#starting-balance').removeAttr('disabled').attr('required', true);
    }
});

$('input[name="billingRadio"]').click(function () {
    var text = ($(this).parent().index() < 1) ? 'Bulan' : 'Tahun';
    $('.billing label').text('Iuran Per ' + text);
    $('.billing input').attr('placeholder', 'Masukkan Iuran Per ' + text).removeAttr('disabled');
    $('#billing-increment').removeAttr('disabled');
});

$('input, select').focus(function () {
    $(this).closest('.form-group').children('.validation-warning').remove();
});

$('input.numeric').numeric();
$('.validatenow').validateNow();

//For Simulation Rev (Based on needs)
$('input[data-target]').keyup(function () {
    var target = $(this).data('target').split(',');
    for (var i in target) {
        $(target[i]).click();
    }
});
$('select[data-target]').change(function () {
    var target = $(this).data('target').split(',');
    for (var i in target) {
        $(target[i]).click();
    }
});
$('#duration').click(function () {
    var retirementage = parseInt($('#retirement-age').attr('data-value')),
        age = parseInt($('#age').attr('data-value')),
        duration = retirementage - age;
    $(this).val(duration + ' tahun').attr('data-value', duration);
});
$('#duration-after').click(function () {
    var lifeexpectancy = parseInt($('#life-expectancy').attr('data-value')),
        retirementage = parseInt($('#retirement-age').attr('data-value')),
        duration = lifeexpectancy - retirementage;
    $(this).val(duration + ' tahun').attr('data-value', duration);
});
$('#living-cost-after').click(function () {
    var livingcost = parseInt($('#living-cost').attr('data-value')),
        inflationrate = parseFloat($('#inflation-rate').attr('data-value')),
        duration = parseInt($('#duration').attr('data-value'));
    for (var i = 1; i <= duration; i++) {
        livingcost += (livingcost * inflationrate);
    }
    $(this).val(formatCurrency(parseInt(livingcost).toString())).attr('data-value', livingcost);
});
$('#living-cost-total').click(function () {
    var livingcostafter = parseFloat($('#living-cost-after').attr('data-value')),
        inflationrate = parseFloat($('#inflation-rate').attr('data-value')),
        netrateinvestation = ((1 + 0.075) / (1 + inflationrate)) - 1;
        durationafter = parseInt($('#duration-after').attr('data-value')),
        pv = presentValue((netrateinvestation / 12), (durationafter * 12), -livingcostafter, 0);
    $(this).val(formatCurrency(parseInt(pv).toString())).attr('data-value', pv);
});

//Activate bootstrap tooltip
$('[data-toggle="tooltip"]').tooltip();

// Simulation Chart
var ctx = $('canvas#simulation'),
    
    getYAxes = function () {
        return [{ ticks: { beginAtZero: true, callback: function (value) {
            var tmpvalue = parseInt(value);
            return 'Rp' + ((tmpvalue >= 1000) ? tmpvalue.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") : tmpvalue);
        } } }];
    },

    getTooltips = function () {
        return { callbacks: { label: function (value) {
            var tmpvalue = parseInt(value.yLabel);
            return 'Rp' + ((tmpvalue >= 1000) ? tmpvalue.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") : tmpvalue);
        } } };
    },

    //Get dataset style and dataset itself
    getDatasets = function (label, backgroundColor, borderColor, pointBackgroundColor, pointHoverBorderColor, data) {
        return { label: label, backgroundColor: backgroundColor, borderColor: borderColor, pointBackgroundColor: pointBackgroundColor, pointBorderColor: "#fff", pointHoverBackgroundColor: "#fff", pointHoverBorderColor: pointHoverBorderColor, data: data }
    },

    //Create chart JSON
    getChart = function (a) {
        return {
            type: 'line',
            data: {
                labels: a[0],
                datasets: [
                    getDatasets('Dana Awal', 'rgba(49,133,156,.2)', 'rgba(49,133,156,1)', 'rgba(49,133,156,1)', 'rgba(49,133,156,1)', a[1]),
                    getDatasets('Iuran', 'rgba(192,80,77,.2)', 'rgba(192,80,77,1)', 'rgba(192,80,77,1)', 'rgba(192,80,77,1)', a[2]),
                    getDatasets('Pengembangan', 'rgba(119,147,60,.2)', 'rgba(119,147,60,1)', 'rgba(119,147,60,1)', 'rgba(119,147,60,1)', a[3]),
                    getDatasets('Saldo Akhir', 'rgba(179,181,198,.2)', 'rgba(179,181,198,1)', 'rgba(179,181,198,1)', 'rgba(179,181,198,1)', a[4])
                ]
            },
            options: { scales: { xAxes: [{ scaleLabel: { display: true, labelString: 'Usia (dalam tahun)' } }], yAxes: getYAxes() }, tooltips: getTooltips() }
        }
    },

    //Initialize new chart
    myChart = (ctx.length > 0) ? new Chart(ctx, getChart([ [40, 45, 50, 55, 60], [0, 0, 0, 0, 0], [0, 0, 0, 0, 0], [0, 0, 0, 0, 0], [0, 0, 0, 0, 0] ])) : null;

$('.calculate').click(function () {
    var simulationform = $(this).closest('form'),
        datecontrol = $('.date-control > *'); //for future update of consumer record
    
    //For future update of consumer record (simulation can be used when birth date of consumer is fully set)
    /*datecontrol.children(':selected').each(function () {
        checked = checked && ($(this).index() > 0);
    });*/

    if (simulationform.validate()) { //see validator.js to see how to use
        
        if (simulationform.hasClass('rev')) {
            //PMT(ir, np, pv, fv) = (ir * (pv * Math.pow((ir + 1), np) + fv)) / ((ir + 1) * (Math.pow((ir + 1), np) - 1))
            var investationrate = parseFloat($('#investation-rate').attr('data-value')),
                duration = parseInt($('#duration').attr('data-value')),
                livingcosttotal = parseInt($('#living-cost-total').attr('data-value')),
                monthlyinvestation = periodicPayment((investationrate / 12), (duration * 12), 0, -livingcosttotal, 0),
                annualinvestation = periodicPayment(investationrate, duration, 0, -livingcosttotal, 0),
                lumpsum = presentValue(investationrate, duration, 0, -livingcosttotal);
                console.log(investationrate / 12);
                $('.narration').addClass('active').find('[data-info]').each(function () {
                    var infoelement = $($(this).data('info')),
                        text = infoelement.is('select') ? infoelement.find('option:selected').data('value') : infoelement.attr('data-value'),
                        text = ($(this).data('info') == '#inflation-rate') ? parseInt(parseFloat(text) * 100) : (($(this).data('info').indexOf('cost') >= 0) ? formatCurrency(parseInt(text).toString()) : text);
                    $(this).text(text);
                });
                var chartAnimateNumber = function (a) { return { number: a, numberStep: $.animateNumber.numberStepFactories.separator('.') } };
                $('#monthly-investation span').text('Rp').siblings('b').animateNumber(chartAnimateNumber(monthlyinvestation), 1800);
                $('#annual-investation span').text('Rp').siblings('b').animateNumber(chartAnimateNumber(annualinvestation), 1800);
                $('#lumpsum span').text('Rp').siblings('b').animateNumber(chartAnimateNumber(lumpsum), 1800);
        } else {
            //Lines below are for future update of consumer record
            /*var dob = new Date((datecontrol.eq(2).val()) + '-' + (datecontrol.eq(1).children(':selected').index()) + '-' + (datecontrol.eq(0).children(':selected').index()));
            var today = new Date();
            var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));*/

            var age = parseInt($('#age').attr('data-value')),
                retirementage = parseInt($('#retirement-age').attr('data-value')),
                durationmonth = (retirementage - age) * 12,
                datachart = [ [], [], [], [], [] ]; //each arrays contains 25 to 5 years before retirement age of data
                datachartperiod = (durationmonth < 120) ? 12 : 60;
                countlast = durationmonth / datachartperiod;
                countlast = (countlast > (durationmonth < 120 ? 9 : 4)) ? (durationmonth < 120 ? 9 : 4) : (countlast - 1);
                isannualstartingbalance = $('input[name="topupRadio"]:checked').parent().is(':last-child'),
                startingbalance = parseFloat($('#starting-balance').attr('data-value')),
                accumulatedstartingbalance = startingbalance,
                isannualbilling = $('input[name="billingRadio"]:checked').parent().is(':last-child'),
                billing = parseFloat($('.billing input.currency').attr('data-value')),
                accumulatedbilling = billing;
                billingincrement = parseFloat($('#billing-increment').attr('data-value')),
                interestrate = parseFloat($('#interest-rate').attr('data-value')),
                monthlyinterestrate = interestrate / 12;
                administrationfee = parseFloat($('#administration-fee').attr('data-value')),
                managementfee = parseFloat($('#management-fee').attr('data-value')),
                accumulatedfund = startingbalance + billing + ((startingbalance + billing) * monthlyinterestrate),
                isnewyear = false;
            for (var i = 2; i <= durationmonth; i++) {
                accumulatedstartingbalance = (isannualstartingbalance && isnewyear) ? (accumulatedstartingbalance + startingbalance) : accumulatedstartingbalance;
                accumulatedbilling = isannualbilling ? (isnewyear ? (accumulatedbilling + billing) : accumulatedbilling) : (accumulatedbilling + billing);
                accumulatedfund = (isannualstartingbalance && isnewyear) ? (accumulatedfund + startingbalance) : accumulatedfund;
                var tmpaccumulatedfund = accumulatedfund + billing;
                accumulatedfund = isannualbilling ? (isnewyear ? (tmpaccumulatedfund + (tmpaccumulatedfund * monthlyinterestrate)) : (accumulatedfund + (accumulatedfund * monthlyinterestrate))) : (tmpaccumulatedfund + (tmpaccumulatedfund * monthlyinterestrate));
                isnewyear = (i % 12 == 0);
                if (isnewyear) {
                    accumulatedfund -= administrationfee + (accumulatedfund * managementfee);
                    billing += (billing * billingincrement);
                    var tmpcountlast = countlast - datachart[0].length;
                    if (i == (durationmonth - (tmpcountlast * datachartperiod))) {
                        datachart[0].push(retirementage - (tmpcountlast * (durationmonth < 120 ? 1 : 5)));
                        datachart[1].push(accumulatedstartingbalance);
                        datachart[2].push(accumulatedbilling);
                        datachart[3].push(accumulatedfund - (accumulatedstartingbalance + accumulatedbilling));
                        datachart[4].push(accumulatedfund);
                        startingbalance = isannualstartingbalance ? startingbalance : 0;
                    }
                }
            }
            var chartAnimateNumber = function (a) { return { number: a, numberStep: $.animateNumber.numberStepFactories.separator('.') } };
            $('#total-funding span').text('Rp').siblings('b').animateNumber(chartAnimateNumber(parseInt(accumulatedstartingbalance + accumulatedbilling)), 1800);
            $('#total-development span').text('Rp').siblings('b').animateNumber(chartAnimateNumber(parseInt(accumulatedfund - (accumulatedstartingbalance + accumulatedbilling)), 1800);
            $('#total-fund span').text('Rp').siblings('b').animateNumber(chartAnimateNumber(parseInt(accumulatedfund)), 1800);
            $('iframe.chartjs-hidden-iframe').remove();
            ctx.after('<canvas id="simulation" class="col-xs-12" height="250"></canvas>').remove();
            ctx = $('canvas#simulation');
            setTimeout(function () { myChart = new Chart(ctx, getChart(datachart)); }, 500);
        }
        $('[href="#simulation"]').click();
    } else {
        $('[href="#simulation-form"]').click();
    }
});