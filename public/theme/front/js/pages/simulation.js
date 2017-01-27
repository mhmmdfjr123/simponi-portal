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
                data: [0, 0, 10, 20, 45]
            },
            {
                label: "Iuran",
                backgroundColor: "rgba(192,80,77,.2)",
                borderColor: "rgba(192,80,77,1)",
                pointBackgroundColor: "rgba(192,80,77,1)",
                pointBorderColor: "#fff",
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "rgba(192,80,77,1)",
                data: [4, 5, 6, 7, 10]
            },
            {
                label: "Pengembangan",
                backgroundColor: "rgba(119,147,60,.2)",
                borderColor: "rgba(119,147,60,1)",
                pointBackgroundColor: "rgba(119,147,60,1)",
                pointBorderColor: "#fff",
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "rgba(119,147,60,1)",
                data: [7, 12, 21, 35, 40]
            },
            {
                label: "Saldo Akhir",
                backgroundColor: "rgba(179,181,198,.2)",
                borderColor: "rgba(179,181,198,1)",
                pointBackgroundColor: "rgba(179,181,198,1)",
                pointBorderColor: "#fff",
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "rgba(179,181,198,1)",
                data: [11, 17, 27, 42, 45]
            }
        ]
    }
});