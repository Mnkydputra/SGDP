<style>
  .graph-wr{
    height: 350px;
    max-height: 600px;
    max-width: 100%;
    position: relative;
    width: 1650px;
    font-weight:55mm;
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

            <div style="margin-top:100px; padding-top:40mm; background-color:#F9FAFA;"class="container-md mt-5">
                <div class="row">
                    <div class="container-md-3">
                            <div style="background-color:#6f9390; font-size:12px; font-weight:solid" class=" alert alert" role="alert">
                            <label class="text-white  d-flex align-items-center justify-content-center"><i class='bx bx-calendar '> APEL BERSAMA | 15 JANUARI 2022 | 07:00</i></label>
                        </div>
                            </div>
                            <div class="graph-wr">
                            <canvas id="myChart" ></canvas>   
                            </div>    
                    </div>
                </div>
            

<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'radar',
        data: {
            labels: ['Kemampuan', 'Kedisiplinan', 'Kepribadian', 'Kinerja', 'Kepemimpinan'],
            datasets: [{
                label: 'Kemampuan',
                data: [5],
                pointBackgroundColor:[
                    'rgba(54, 162, 235, 1)',
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                ],
                borderWidth: 3
            },{
                label: 'Kedisiplinan',
                data: [5,4],
                pointBackgroundColor:[
                    'rgba(54, 162, 235, 1)',
                    
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    
                ],
                borderWidth: 3
            },{
                label: 'Kepribadian',
                data: [5,4,4],
                pointBackgroundColor:[
                    'rgba(54, 162, 235, 1)',
                    
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    
                ],
                borderWidth: 3
            },{
                label: 'Kinerja',
                data: [5,4,4,3],
                pointBackgroundColor:[
                    'rgba(54, 162, 235, 1)',
                    
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    
                ],
                borderWidth: 3
            },{
                label: 'Kepemimpinan',
                data: [5,4,4,3,2],
                pointBackgroundColor:[
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
                weight:700
            }
            },
            
        }
    });
  </script>     