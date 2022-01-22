
<!-- Sticky top -->
<div style="margin-top:90px; background-color:#F9FAFA;" class="container fixed-top">
    <p>Welcome <br> <b> <?= $biodata->nama ?> </b></p>   
    <div class="container-md-3">
        <div style="border:none; height:30px; padding-top:6px;  letter-spacing: 2px;" class="alert alert-secondary" role="alert">
        <i class='d-flex align-items-center justify-content-center bx bx-time'> <label style="font-weight:bold;" id="time"></label> </i>
        </div>
        <a style="" class="btn btn-danger btn-sm mb-2" href="<?= base_url('Danru/Patrol/') ?>">
                <span class="bx bx-street-view"></span> I - PATROL
            </a>
        <div style="background-color:#6f9390; height:50px;" class="alert alert" role="alert">
            <label style="background-color:#6f9390; font-size:13px; font-weight:solid" type="button"  data-bs-toggle="modal" data-bs-target="#pengumuman" 
            class="text-white  d-flex align-items-center justify-content-center">
                <i class='bx bx-calendar'> APEL BERSAMA | 18 JANUARI 2022 | 07:00 </i>
            </label>
        </div>
        <div style="background-color:#F9FAFA" >
            <div style="border:none; height:30px; padding-top:6px;  letter-spacing: 2px; " class="alert alert-danger" role="alert">
                <i class='d-flex align-items-center justify-content-center'> <label style="font-weight:bold;">INDEKS MASSA TUBUH</label> </i>
            </div>
            <div >
                <canvas style="margin-top: -70px;"  id="halfChart" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
</div>
<!-- End Sticky Top -->



<script>
    const data = {
        labels: ["UnderWeight", "Normal", "OverWeight", "Obese"],
        datasets: [{
            label: 'Indeks Massa Tubuh',
            data: [11,11,11,11],
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
