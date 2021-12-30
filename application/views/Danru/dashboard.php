<style>
    .graph-wr {
        height: 350px;
        max-height: 600px;
        max-width: 100%;
        position: relative;
        width: 1650px;
        font-weight: 55mm;
    }
</style>
<!-- Sticky top -->
<div style="margin-top:90px; background-color:#F9FAFA;" class="container fixed-top">
    <p>Welcome <br> <b> <?= $biodata->nama ?> </b></p>
    <div class="container-md-3">
        <div style="border:none; height:30px; padding-top:6px;  letter-spacing: 2px;" class="alert alert-secondary" role="alert">
            <i class='d-flex align-items-center justify-content-center bx bx-time'> <label style="font-weight:bold;" id="time"></label> </i>
        </div>
    </div>
</div>
<!-- End Sticky Top -->

<div style="margin-top:100px; padding-top:40mm; background-color:#F9FAFA;" class="container-md mt-5">
    <div class="row">
        <div class="container-md-3">
            <a style="width:100%" class="btn btn-danger btn-sm mb-2" href="<?= base_url('Danru/Patrol/urutan/1') ?>">
                <span class="bx bx-street-view"></span> Jalankan Patroli
            </a>
            <div style="background-color:#6f9390; height:50px;" class=" alert alert" role="alert">
                <label style="background-color:#6f9390; font-size:13px; font-weight:solid" type="button" data-bs-toggle="modal" data-bs-target="#pengumuman" class="text-white  d-flex align-items-center justify-content-center">
                    <i class='bx bx-calendar'>APEL BERSAMA | 15 JANUARI 2022 | 07:00</i></label>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="pengumuman" tabindex="-1" aria-labelledby="pengumumanLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="pengumumanLabel"><b>APEL BERSAMA ADM</b></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container-sm-3">
                                <div>
                                    <span>Masak sayur diaduk semalaman
                                        Mengaduknya pakai hati
                                        Salam sapa tak lupa kuucapkan
                                        Jangan lupa APEL Bersama besok pagi!!!
                                    </span>
                                </div>
                                <h5> Aturan Peserta APEL :</h5>
                                <div>
                                    <ul>
                                        <li>Simak materinya</li>
                                        <li>Duduk siap</li>
                                        <li>Menyalakan kamera</li>
                                        <li>Format nama zoom "Area_Nama_NPK" contoh "P4_Alfa_123456"</li>
                                    </ul>
                                </div>
                                <h5><b>Aturan penggunaan seragam:</b></h5>
                                <div>
                                    <ul style="list-style-type: none;">
                                        <li>Semua anggota menggunakan seragam lama</li>
                                    </ul>
                                </div>
                                <div>
                                    <h5>Via Zoom</h5>
                                    <ul>
                                        <li>Meeting ID: 884 324 6264</li>
                                        <li>Passcode: 12345</li>
                                        <li><a href="https://us02web.zoom.us/j/8843246264?pwd=NFY2SHIvSlR4emNqaTZHaGxVZFJ0QT09">JOIN US</a></li>
                                    </ul>
                                </div>
                                <div>
                                    <p>Jangan lupa meriahkan yaa.. </p>
                                </div>
                                <div>
                                    <p><b>Salam Sahabat</b></p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--  -->
        </div>
        <div class="graph-wr">
            <canvas id="myChart"></canvas>
        </div>
    </div>
    <div class="row">
        <div class="container-md-3">
            <div style="border:none; height:30px; padding-top:6px;  letter-spacing: 2px;" class="alert alert-danger" role="alert">
                <i class='d-flex align-items-center justify-content-center'> <label style="font-weight:bold;">INDEKS MASSA TUBUH</label> </i>
            </div>
            <div>
                <canvas style="margin-top: -70px;" id="halfChart" width="400" height="400"></canvas>
            </div>
        </div>





    </div>
</div>

<script>
    const data = {
        labels: ["UnderWeight", "Normal", "OverWeight", "Obese"],
        datasets: [{
            label: 'Indeks Massa Tubuh',
            data: [11, 11, 11, 11],
            backgroundColor: [
                'rgba(3, 167, 255)',
                'rgba(5, 145, 0)',
                'rgba(255, 128, 0)',
                'rgba(255, 0, 0)'
            ],
            borderColor: [
                'sdadas',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)'
            ],
            needleValue: <?= $biodata->imt ?>,
            borderColor: 'white',
            borderWidth: 2,
            cutout: '25%',
            circumference: 180,
            rotation: 270,
            borderRadius: 5
        }]
    };


    //const gauge needle block
    const gaugeNeedle = {
        id: 'gaugeNeedle',
        afterDatasetDraw(chart, args, options) {
            const {
                ctx,
                config,
                data,
                chartArea: {
                    top,
                    bottom,
                    left,
                    right,
                    width,
                    height
                }
            } = chart;
            ctx.save();
            // console.log(data);
            const needleValue = data.datasets[0].needleValue;
            const dataTotal = data.datasets[0].data.reduce((a, b) => a + b, 0);
            const angle = Math.PI + (1 / dataTotal * needleValue * Math.PI);
            // console.log(dataTotal);

            const cx = width / 2;
            const cy = chart._metasets[0].data[0].y;
            console.log(ctx.canvas.offsetTop);


            //needle translate
            ctx.translate(cx, cy);
            ctx.rotate(angle);
            ctx.beginPath();
            ctx.moveTo(0, -2);
            ctx.lineTo(140, 0);
            // ctx.lineTo(height + ctx.canvas.offsetTop - 70, 0);
            ctx.lineTo(0, 2);
            ctx.fillStyle = '#444';
            ctx.fill();
            //noodle doth 
            ctx.translate(-cx, -cy);
            ctx.beginPath();
            ctx.arc(cx, cy, 5, 0, 10);
            ctx.fill();
            ctx.restore();

            ctx.font = '50px Helvetica';
            ctx.fillStyle = '#444';
            ctx.fillText(needleValue, cx, cy + 5 - 10);
            ctx.textAlign = 'center';
            ctx.restore();
        }
    }
    // config 
    const config = {
        type: 'doughnut',
        data,
        options: {
            plugins: {
                legend: {
                    display: false,
                    render: 'lables',
                    arc: true,
                    position: 'border'
                },
                labels: {
                    render: 'lables',
                    arc: true,
                    position: 'border'
                },
            }
        },
        plugins: [gaugeNeedle]
    };

    // render init block
    const me = new Chart(
        document.getElementById('halfChart'),
        config
    );
</script>

<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'radar',
        data: {
            labels: ['Kemampuan', 'Kedisiplinan', 'Kepribadian', 'Kinerja', 'Kepemimpinan'],
            datasets: [{
                label: 'Kemampuan',
                data: [5],
                pointBackgroundColor: [
                    'rgba(54, 162, 235, 1)',
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                ],
                borderWidth: 3
            }, {
                label: 'Kedisiplinan',
                data: [5, 4],
                pointBackgroundColor: [
                    'rgba(54, 162, 235, 1)',

                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',

                ],
                borderWidth: 3
            }, {
                label: 'Kepribadian',
                data: [5, 4, 4],
                pointBackgroundColor: [
                    'rgba(54, 162, 235, 1)',

                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',

                ],
                borderWidth: 3
            }, {
                label: 'Kinerja',
                data: [5, 4, 4, 3],
                pointBackgroundColor: [
                    'rgba(54, 162, 235, 1)',

                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',

                ],
                borderWidth: 3
            }, {
                label: 'Kepemimpinan',
                data: [5, 4, 4, 3, 2],
                pointBackgroundColor: [
                    'rgba(54, 162, 235, 1)',

                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',

                ],
                borderWidth: 3
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: false,
                    display: false,
                },
            },
            plugins: {
                legend: {
                    display: false,
                    weight: 700
                }
            },

        }
    });
</script>