<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('assets/css/') ?>bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js" integrity="sha512-OvBgP9A2JBgiRad/mM36mkzXSXaJE9BEIENnVEmeZdITvwT09xnxLtT4twkCa8m/loMbPHsvPl0T8lRGVBwjlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Jquery CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <title>Dashboard</title>
</head>

<body>
    <div class="row">
        <div class="col-md-12">
            <div class="mt-5 container col-lg-8">
                <div class="card">
                    <div class="card-header">
                        Rata - Rata Usia Security
                    </div>
                    <div class="card-body">
                        <div>
                            <div id="chart">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-2">
                    <div class="card-body">
                        <div>
                            <div id="kta">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    var options = {
        chart: {
            type: 'bar'
        },
        series: [{
            name: 'Total MP',
            data: [
                <?php foreach ($usia->result() as $us) : ?>
                    <?= $us->jumlah . "," ?>
                <?php endforeach ?>
            ]
        }],
        xaxis: {
            categories: ["18-20 tahun", "21-25 tahun", "26 - 30 tahun", "31 - 40 tahun", "41 - 50 tahun", "51 - 60 tahun"]
        }
    }
    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();



    var options2 = {
        series: [{
            name: 'AKTIF',
            data: [44, 55, 41, 37, 22, 43, 21]
        }, {
            name: 'TIDAK AKTIF',
            data: [53, 32, 33, 52, 13, 43, 32]
        }],
        chart: {
            type: 'bar',
            height: 350,
            stacked: true,
        },
        plotOptions: {
            bar: {
                horizontal: true,
            },
        },
        stroke: {
            width: 1,
            colors: ['#fff']
        },
        title: {
            text: 'Informasi KTA Anggota'
        },
        xaxis: {
            categories: ["HO", "VLC", , "DOR", "PLANT 1", "PLANT 2", "PLANT 4 A1", "PLANT 4 A2", "PLANT 5"],
            labels: {
                formatter: function(val) {
                    return val
                }
            }
        },
        yaxis: {
            title: {
                text: undefined
            },
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return val
                }
            }
        },
        fill: {
            opacity: 1
        },
        legend: {
            position: 'top',
            horizontalAlign: 'left',
            offsetX: 40
        }
    };

    var chart2 = new ApexCharts(document.querySelector("#kta"), options2);
    chart2.render();
</script>

</html>