$('input.currency').numeric().keydown(function() {
    $(this).val($(this).val().replace(/\./g, ''));
}).keyup(function() {
    if ($(this).val().length > 0) {
        $(this).attr('data-value', $(this).val()).val($(this).val().replace(/(?!^)(?=(?:\d{3})+(?:\.|$))/gm, '.'));
    } else {
        $(this).attr('data-value', 0);
    }
});

$('input.percentage').numeric().keyup(function() {
    if ($(this).val().length > 0) {
        $(this).attr('data-value', (parseFloat($(this).val()) / 100));
    } else {
        $(this).attr('data-value', 0);
    }
});

$('input[name="topupRadio"]').click(function() {
    if (!$(this).parent().is(':first-child')) {
        $('input#starting-balance').removeAttr('disabled');
    }
});

$('input[name="billingRadio"]').click(function() {
    var text = ($(this).parent().index() < 1) ? 'Bulan' : 'Tahun';
    $('.billing label').text('Iuran Per ' + text);
    $('.billing input').attr('placeholder', 'Masukkan Iuran Per ' + text).removeAttr('disabled');
});

// Simulation Chart
var ctx = $('canvas#simulation');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["40", "45", "50", "55", "60"],
        datasets: [
            {
                label: "Dana Awal",
                backgroundColor: "rgba(49,133,156,.2)",
                borderColor: "rgba(49,133,156,1)",
                pointBackgroundColor: "rgba(49,133,156,1)",
                pointBorderColor: "#fff",
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "rgba(49,133,156,1)",
                data: [0, 0, 0, 0, 0]
            },
            {
                label: "Iuran",
                backgroundColor: "rgba(192,80,77,.2)",
                borderColor: "rgba(192,80,77,1)",
                pointBackgroundColor: "rgba(192,80,77,1)",
                pointBorderColor: "#fff",
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "rgba(192,80,77,1)",
                data: [0, 0, 0, 0, 0]
            },
            {
                label: "Pengembangan",
                backgroundColor: "rgba(119,147,60,.2)",
                borderColor: "rgba(119,147,60,1)",
                pointBackgroundColor: "rgba(119,147,60,1)",
                pointBorderColor: "#fff",
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "rgba(119,147,60,1)",
                data: [0, 0, 0, 0, 0]
            },
            {
                label: "Saldo Akhir",
                backgroundColor: "rgba(179,181,198,.2)",
                borderColor: "rgba(179,181,198,1)",
                pointBackgroundColor: "rgba(179,181,198,1)",
                pointBorderColor: "#fff",
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "rgba(179,181,198,1)",
                data: [0, 0, 0, 0, 0]
            }
        ]
    }
});

$('.calculate').click(function() {
    var datecontrol = $('.date-control > *');
    var checked = true;
    datecontrol.children(':selected').each(function() {
        checked = checked && ($(this).index() > 0);
    });
    if (checked) {
        /*var dob = new Date((datecontrol.eq(2).val()) + '-' + (datecontrol.eq(1).children(':selected').index()) + '-' + (datecontrol.eq(0).children(':selected').index()));
        var today = new Date();
        var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));*/
        var age = parseInt($('#age option:selected').attr('data-value')),
            retirementage = parseInt($('#retirement-age option:selected').attr('data-value')),
            durationmonth = (retirementage - age) * 12,
            fiveagestartingbalance = [],
            fiveagebilling = [],
            fiveagedevelopment = [],
            fiveagefund = [],
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
                if (i == (durationmonth - ((4 - fiveagefund.length) * 60))) {
                    startingbalance = isannualstartingbalance ? startingbalance : 0;
                    fiveagestartingbalance.push(accumulatedstartingbalance);
                    fiveagebilling.push(accumulatedbilling);
                    fiveagedevelopment.push(accumulatedfund - (accumulatedstartingbalance + accumulatedbilling));
                    fiveagefund.push(accumulatedfund);
                }
            }
        }
        $('#total-funding b').text(parseInt(accumulatedstartingbalance + accumulatedbilling).toString().replace(/(?!^)(?=(?:\d{3})+(?:\.|$))/gm, '.'));
        $('#total-development b').text(parseInt(fiveagedevelopment[fiveagedevelopment.length - 1]).toString().replace(/(?!^)(?=(?:\d{3})+(?:\.|$))/gm, '.'));
        $('#total-balance b').text(parseInt(accumulatedfund).toString().replace(/(?!^)(?=(?:\d{3})+(?:\.|$))/gm, '.'));
        myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [(retirementage - 20), (retirementage - 15), (retirementage - 10), (retirementage - 5), retirementage],
                datasets: [
                    {
                        label: "Dana Awal",
                        backgroundColor: "rgba(49,133,156,.2)",
                        borderColor: "rgba(49,133,156,1)",
                        pointBackgroundColor: "rgba(49,133,156,1)",
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "rgba(49,133,156,1)",
                        data: fiveagestartingbalance
                    },
                    {
                        label: "Iuran",
                        backgroundColor: "rgba(192,80,77,.2)",
                        borderColor: "rgba(192,80,77,1)",
                        pointBackgroundColor: "rgba(192,80,77,1)",
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "rgba(192,80,77,1)",
                        data: fiveagebilling
                    },
                    {
                        label: "Pengembangan",
                        backgroundColor: "rgba(119,147,60,.2)",
                        borderColor: "rgba(119,147,60,1)",
                        pointBackgroundColor: "rgba(119,147,60,1)",
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "rgba(119,147,60,1)",
                        data: fiveagedevelopment
                    },
                    {
                        label: "Saldo Akhir",
                        backgroundColor: "rgba(179,181,198,.2)",
                        borderColor: "rgba(179,181,198,1)",
                        pointBackgroundColor: "rgba(179,181,198,1)",
                        pointBorderColor: "#fff",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: "rgba(179,181,198,1)",
                        data: fiveagefund
                    }
                ]
            }
        });
    } else {
        console.log('Mohon isi lengkap');
    }
});