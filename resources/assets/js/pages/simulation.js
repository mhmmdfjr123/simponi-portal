//Author: Romy Adzani A

$('input.currency').numeric().keydown(function () {
    $(this).val($(this).val().replace(/\./g, ''));
}).keyup(function() {
    if ($(this).val().length > 0) {
        $(this).attr('data-value', $(this).val()).val($(this).val().replace(/(?!^)(?=(?:\d{3})+(?:\.|$))/gm, '.'));
    } else {
        $(this).attr('data-value', 0);
    }
});

$('input.percentage').numeric().keyup(function () {
    if ($(this).val().length > 0) {
        $(this).attr('data-value', (parseFloat($(this).val()) / 100));
    } else {
        $(this).attr('data-value', 0);
    }
});

$('input[name="topupRadio"]').click(function () {
    if ($(this).parent().is(':first-child')) {
        $('input#starting-balance').attr('disabled', true);
    } else {
        $('input#starting-balance').removeAttr('disabled');
    }
});

$('input[name="billingRadio"]').click(function () {
    var text = ($(this).parent().index() < 1) ? 'Bulan' : 'Tahun';
    $('.billing label').text('Iuran Per ' + text);
    $('.billing input').attr('placeholder', 'Masukkan Iuran Per ' + text).removeAttr('disabled');
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
    myChart = new Chart(ctx, getChart([ [40, 45, 50, 55, 60], [0, 0, 0, 0, 0], [0, 0, 0, 0, 0], [0, 0, 0, 0, 0], [0, 0, 0, 0, 0] ]));

$('.calculate').click(function () {
    var datecontrol = $('.date-control > *'),
        checked = true; //for future update of consumer record
    
    //For future update of consumer record (simulation can be used when birth date of consumer is fully set)
    datecontrol.children(':selected').each(function () {
        checked = checked && ($(this).index() > 0);
    });

    if (checked) {
        
        //Lines below are for future update of consumer record
        /*var dob = new Date((datecontrol.eq(2).val()) + '-' + (datecontrol.eq(1).children(':selected').index()) + '-' + (datecontrol.eq(0).children(':selected').index()));
        var today = new Date();
        var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));*/

        var age = parseInt($('#age option:selected').attr('data-value')),
            retirementage = parseInt($('#retirement-age option:selected').attr('data-value')),
            durationmonth = (retirementage - age) * 12,
            datachart = [ [], [], [], [], [] ]; //each arrays contains 25 to 5 years before retirement age of data
            countlast = durationmonth / 60;
            countlast = (countlast > 4) ? 4 : (countlast - 1);
            isannualstartingbalance = $('input[name="topupRadio"]:checked').parent().is(':last-child'),
            startingbalance = parseFloat($('#starting-balance').attr('data-value')),
            accumulatedstartingbalance = startingbalance,
            isannualbilling = $('input[name="billingRadio"]:checked').parent().is(':last-child'),
            billing = parseFloat($('.billing input.currency').attr('data-value')),
            accumulatedbilling = billing;
            billingincrement = parseFloat($('#billing-increment').attr('data-value')),
            interestrate = parseFloat($('#interest-rate option:selected').attr('data-value')),
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
                if (i == (durationmonth - (tmpcountlast * 60))) {
                    datachart[0].push(retirementage - (tmpcountlast * 5));
                    datachart[1].push(accumulatedstartingbalance);
                    datachart[2].push(accumulatedbilling);
                    datachart[3].push(accumulatedfund - (accumulatedstartingbalance + accumulatedbilling));
                    datachart[4].push(accumulatedfund);
                    startingbalance = isannualstartingbalance ? startingbalance : 0;
                }
            }
        }
        var chartAnimateNumber = function (a) { return { number: a, numberStep: $.animateNumber.numberStepFactories.separator('.') } };
        $('#total-funding span').text('Rp').siblings('b').animateNumber(chartAnimateNumber(parseInt(accumulatedstartingbalance + accumulatedbilling)), 1500);
        $('#total-development span').text('Rp').siblings('b').animateNumber(chartAnimateNumber(parseInt(datachart[3][datachart[3].length - 1])), 1500);
        $('#total-fund span').text('Rp').siblings('b').animateNumber(chartAnimateNumber(parseInt(accumulatedfund)), 1500);
        $('iframe.chartjs-hidden-iframe').remove();
        ctx.after('<canvas id="simulation" class="col-xs-12" height="250"></canvas>').remove();
        ctx = $('canvas#simulation');
        myChart = new Chart(ctx, getChart(datachart));
    } else {
        console.log('Mohon isi lengkap');
    }
});