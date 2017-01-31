$('input[name="billingRadio"]').click(function() {
    var text = ($(this).parent().index() < 1) ? 'Bulan' : 'Tahun';
    $('.billing label').text('Iuran Per ' + text);
    $('.billing input').attr('placeholder', 'Masukkan Iuran Per ' + text);
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
        var age = parseInt($('#age option:selected').attr('data-value'));
        var retirementage = parseInt($('#retirement-age option:selected').attr('data-value'));
        var durationmonth = (60 - age) * 12;
        var fiveagestartingbalance = [];
        var fiveagebilling = [];
        var fiveagedevelopment = [];
        var fiveagefund = [];
        var year = 0;
        var isannualstartingbalance = $('input[name="topupRadio"]:checked').parent().is(':last-child');
        var startingbalance = parseFloat($('#starting-balance').attr('data-value'));
        var isannualbilling = $('input[name="billingRadio"]:checked').parent().is(':last-child');
        var billing = parseFloat($('.billing input.currency').attr('data-value'));
        var billingincrement = parseFloat($('#billing-increment').attr('data-value'));
        var interestrate = parseFloat($('#interest-rate option:selected').attr('data-value'));
        var administrationfee = parseFloat($('#administration-fee').attr('data-value'));
        var managementfee = parseFloat($('#management-fee').attr('data-value'));
        var accumulatedfund = startingbalance + billing + ((startingbalance + billing) * ((interestrate/100)/12));
        var isnewyear = false;
        for (var i = 2; i <= durationmonth; i++) {
            accumulatedfund = (isannualstartingbalance && isnewyear) ? (accumulatedfund + startingbalance) : accumulatedfund;
            accumulatedfund = isannualbilling ? (isnewyear ? (accumulatedfund + billing + ((accumulatedfund + billing) * ((interestrate/100)/12))) : (accumulatedfund + (accumulatedfund * ((interestrate/100)/12)))) : (accumulatedfund + billing + ((accumulatedfund + billing) * ((interestrate/100)/12)));
            isnewyear = (i % 12 == 0);
            if (isnewyear) {
                accumulatedfund -= administrationfee + (accumulatedfund * (managementfee/100));
                if (i == (durationmonth - ((4 - fiveagefund.length) * 60))) {
                    startingbalance = isannualstartingbalance ? startingbalance : 0;
                    fiveagestartingbalance.push(startingbalance);
                    fiveagebilling.push(billing);
                    fiveagedevelopment.push(accumulatedfund - (startingbalance + billing));
                    fiveagefund.push(accumulatedfund);
                }
                billing += (billing * (billingincrement/100));
            }
        }
        console.log(fiveagestartingbalance, fiveagebilling, fiveagedevelopment, fiveagefund);
        myChart = new Chart(ctx, {
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