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
            <div class="row">
                <?php foreach ($events->result() as $ev) : ?>
                    <div class="ml-4 card text-white 
                    <?php if ($ev->tanggal == date('Y-m-d')) { ?>
                        bg-success
                    <?php } else { ?>
                        bg-primary
                    <?php } ?>
                 mb-3" style="max-width: 10rem;">
                        <div class="card-body">
                            <label for=""><?php if ($ev->tanggal == date('Y-m-d')) {
                                                echo "Hari ini";
                                            } else {
                                                echo "Kemarin";
                                            } ?></label>
                            <h3 class="text-white">SHIFT <?= $ev->shift ?></h3>
                            <label for="">Target : <?= $ev->counting ?> / <?= $ev->total_patroli ?></label><br>
                            <?php
                            //jika tanggal sekarang dan kurang dari jam 6 sore 
                            //maka patroli shift 1 di tanggal hari ini di munculkan 
                            $now = strtotime(date('H:i:s'));
                            // $now = strtotime(date('19:00:00'));
                            $batas_shift1 = strtotime(date('18:00:00'));
                            $batas_shift2 = strtotime(date('06:00:00'));
                            if ($ev->tanggal == date('Y-m-d') && $ev->shift == 1) {
                                if ($now < $batas_shift2) {
                                    //jika sekarang kurang dari jam 6 pagi 
                                    echo "";
                                } else if ($now  >= $batas_shift1) {
                                    //jika sekarang lebih dari jam 18 sore maka shift 2
                                    echo "";
                                    $cek = $this->db->query("select id_events from report_patrol where id_events ='" . $ev->id . "' ");
                                    if ($cek->num_rows() > 0) {
                                        redirect(base_url("Danru/Patrol_v2/sendPatrol/" . $ev->area));
                                    }
                                } else if ($now  >= $batas_shift2 && $now < $batas_shift1) {
                                    //jika sekarang lebih dari jam 6 pagi 
                                    echo  '<a href="javascript:mulaiPatroli(' . $ev->id . ')"> <label class="badge badge-primary">MULAI PATROLI</label></a>';
                                }
                            } else if ($ev->tanggal == date('Y-m-d') && $ev->shift == 2) {
                                if ($now < $batas_shift2) {
                                    //jika sekarang kurang dari jam 6 pagi 
                                    echo '';
                                } else if ($now  >= $batas_shift1) {
                                    //jika sekarang lebih dari jam 18 sore maka shift 2
                                    echo '<a href="javascript:mulaiPatroli(' . $ev->id . ')"> <label class="badge badge-primary">MULAI PATROLI</label></a>';
                                    $shift = 2;
                                } else if ($now  > $batas_shift2) {
                                    //jika sekarang lebih dari jam 6 pagi 
                                    echo  '';
                                }
                            } else if ($ev->tanggal == $kemarin && $ev->shift == 2) {
                                if ($now < $batas_shift2) {
                                    //jika sekarang kurang dari jam 6 pagi 
                                    echo '<a href="javascript:mulaiPatroli(' . $ev->id . ')"> <label class="badge badge-danger">MULAI PATROLI</label></a>';
                                } else if ($now  > $batas_shift1) {
                                    //jika sekarang lebih dari jam 18 sore maka shift 2
                                    echo '';
                                    $shift = 2;
                                } else if ($now  > $batas_shift2) {
                                    //jika sekarang lebih dari jam 6 pagi 
                                    echo  '';
                                }
                            }


                            //jika tanggal sekarang dan kurang dari jam 6 pagi 
                            //maka patroli shift 2 kemarin di munculkan 


                            ?>
                        </div>
                    </div>
                <?php endforeach ?>

            </div>
        </div>
    </div>
</div>


<script>
    $(function() {

    })

    function mulaiPatroli(id) {
        Swal.fire({
            title: "Mulai Patroli ?",
            // text: " !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Iya ",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= base_url('Danru/Patrol_v2/listLokasi/') ?>" + id;
            }
        });
    }
</script>