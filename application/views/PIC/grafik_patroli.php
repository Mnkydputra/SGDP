<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hello, world!</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body>

    <body>
        <br>
        <div class="mt-5 container col-lg-8">

            <div class="card">
                <div class="card-header">
                    Grafik Patroli per Tanggal 23 Januari 2020
                </div>
                <div class="card-body">
                    <div>
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </body>
    <script>
        const data = {
            labels: [
                'Head Office ',
                'Dormitori ',
                'Part Center ',
                'VLC ',
                'Plan 1 ',
                'Plan 2',
                'Plan 3',
                'Plan 4 - ASSY 1 ',
                'Plan 4 - ASSY 2 ',
                'Plan 5 ',
            ],
            datasets: [{
                label: 'Grafik Patroli',
                data: [Math.floor(<?= $ho ?>), Math.floor(<?= $dor ?>), Math.floor(<?= $pc ?>), Math.floor(<?= $pc ?>), Math.floor(<?= $vlc ?>), Math.floor(<?= $p1 ?>), Math.floor(<?= $p2 ?>), Math.floor(<?= $p3 ?>), Math.floor(<?= $p4A1 ?>), Math.floor(<?= $p4A2 ?>), Math.floor(<?= $p5 ?>)],
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
            }]
        };
        const config = {
            type: 'line',
            data: data,
            options: {
                // animations: {
                //     tension: {
                //         duration: 1000,
                //         easing: 'linear',
                //         from: 1,
                //         to: 0,
                //         loop: true
                //     }
                // },
                scales: {
                    y: { // defining min and max so hiding the dataset does not change scale range
                        min: 0,
                        max: 6
                    }
                }
            }
        };
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
</body>

</html>