@extends('layout.navbar')

@section('container')
    <div class="header">
        <h3 style="color: #9D7942;">Monthly Finance</h3>
    </div>

    <div class="row d-flex justify-content-center mt-100">
        <div class="col-md-6">
            <div id="canvasjsChartContainer" style="height: 370px; width: 100%;"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="chart-wrapper">
                <div class="chart-container">
                    <!-- Bar Chart -->
                    <canvas id="barChart"></canvas>
                </div>
                <div class="chart-container">
                    <!-- Pie Chart -->
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script>
        window.onload = function() {
            var chart = new CanvasJS.Chart("canvasjsChartContainer", {
                animationEnabled: true,
                theme: "light2",
                title: {
                    text: "Total Number of Transactions"
                },
                axisX: {
                    valueFormatString: "DD MMM",
                    intervalType: "day"
                },
                axisY: {
                    title: "Number of Transactions",
                    includeZero: true
                },
                data: [{
                    type: "line", // Mengganti tipe grafik menjadi "line"
                    color: "#6599FF",
                    xValueType: "dateTime",
                    xValueFormatString: "DD MMM",
                    yValueFormatString: "#,##0 Transactions",
                    dataPoints: <?php echo json_encode($penjualanData); ?>
                }]
            });
            chart.render();
        }
        // Ambil nama produk dari data yang dikirimkan dari controller
        const produkLabels = {!! json_encode($menu->pluck('name')) !!};
        const produkData = {!! json_encode($penjualanProduk) !!};
        
        // Data untuk Bar Chart
        const barChartData = {
            labels: produkLabels,
            datasets: [{
                backgroundColor: ["red", "green", "blue", "orange", "brown"],
                data: produkData,
            }],
        };

        // Data untuk Pie Chart
        const pieChartData = {
            labels: produkLabels,
            datasets: [{
                backgroundColor: ["red", "green", "blue", "orange", "brown"],
                data: produkData,
            }],
        };

        // Opsi untuk Bar Chart
        const barChartOptions = {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true 
                    }
                }]
            },
            legend: {
                display: false
            },
            title: {
                display: true,
                text: "Bar Chart Example",
            },
        };

        // Opsi untuk Pie Chart
        const pieChartOptions = {
            legend: {
                display: true
            },
            title: {
                display: true,
                text: "Pie Chart Example",
            },
        };


        // Inisialisasi Bar Chart
        const barChartCtx = document.getElementById("barChart").getContext("2d");
        new Chart(barChartCtx, {
            type: "bar",
            data: barChartData,
            options: barChartOptions,
        });
        // Inisialisasi Pie Chart
        const pieChartCtx = document.getElementById("pieChart").getContext("2d");
        new Chart(pieChartCtx, {
            type: "pie",
            data: pieChartData,
            options: pieChartOptions,
        });
    </script>
@endsection
