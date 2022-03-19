<!-- Sticky top -->
<div style="margin-top:90px; background-color:#F9FAFA;" class="container fixed-top">
    <p>Welcome <br> <b> <?= $biodata->nama ?> </b></p>
    <div class="container-md-3">
        <div style="border:none; height:30px; padding-top:6px; letter-spacing: 2px;" class="alert alert-secondary" role="alert">
            <i class='d-flex align-items-center justify-content-center bx bx-time'> <label id="time"></label> </i>
        </div>
        <a style="position:relative;width:100%" class="fixed-top btn btn-danger btn-sm mb-2" href="#">
            <span class="bx bx-street-view"></span> I - PATROL
        </a>
    </div>
</div>
<!-- End Sticky Top -->

<div style="margin-top:100px; padding-top:40mm" class="container-md mt-5">
    <div class="row">
        <div class="graph-wr">

            <br>
            <br>
            <br>
            <input type="text" id="rfidcard" class=" mb-5">

            <img src="<?= base_url("assets/img/rfidanimasi.png") ?>" alt="">

            <div class="alert alert-info">
                <label for="" id="demo">
                    <?php
                    $jam_mulai = date('Y-m-d H:i:s');
                    $jam_berakhir = date('Y-m-d H:i:s', time() + (60 * 60));

                    $data = [
                        'area'      => "VLC",
                        'mulai'     => $jam_mulai,
                        'selesai'   => $jam_berakhir
                    ];
                    $d = $this->db->get_where("time_patroli", ['area' => "VLC"]);
                    if ($d->num_rows() <= 0) {
                        // $this->db->insert("time_patroli", $data);
                    } else if ($d->num_rows() >= 1) {
                        $get_time = $d->row();
                        $format1 = $get_time->selesai;
                        $format2  = new DateTime($format1);
                        $jam_akhir =  $format2->format('M d , Y H:i:s');
                        echo "jam selesai patroli " . $jam_akhir;
                    }

                    ?>
                </label>

                <p id="patrol_time">

                </p>
            </div>
        </div>
    </div>
</div>


<script>
    $(function() {
        $("#rfidcard").focus();
        var field = document.getElementById("rfidcard");
        setTimeout(function() {
            $("#rfidcard").focus()
            setTimeout(function() {
                field.setAttribute('style', 'display:none;');
            }, 50);
        }, 50);

        $('body').mousemove(function() {
            $("#rfidcard").focus()
        })

        $("#rfidcard").keyup(function() {
            var card = document.getElementById("rfidcard").value
            console.log(card);
        })

        // 1. JavaScript
        // var countDownDate = new Date("Sep 5, 2018 15:37:25").getTime();
        // 2. PHP
        var cek = "<?= $d->num_rows() ?>";
        console.log(cek);
        var countDownDate = <?php echo strtotime($jam_akhir) ?> * 1000;
        var now = <?php echo time() ?> * 1000;

        console.log(countDownDate);

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get todays date and time
            // 1. JavaScript
            // var now = new Date().getTime();
            // 2. PHP
            now = now + 1000;

            // Find the distance between now an the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);


            if (parseInt(cek) > 0) {
                // Output the result in an element with id="demo"
                document.getElementById("patrol_time").innerHTML = hours + "j " +
                    minutes + "m " + seconds + "s ";
                // If the count down is over, write some text 
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("patrol_time").innerHTML = "EXPIRED";
                }
            }

        }, 1000);




    })
</script>