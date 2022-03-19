<?php


$t = new Grei\TanggalMerah();
// $bulan = "02";
$tahun = date('Y'); //Mengambil tahun saat ini
// $bulan = date('m'); //Mengambil bulan saat ini
$tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
?>
<!-- <table class="table table-bordered table-striped" border="1"> -->
<table id="example" class="mt-5 small table table-bordered table-striped">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Petugas</th>
            <th>Start</th>
            <th>Jam Mulai</th>
            <th>End</th>
            <th>Jam Selesai</th>
            <th width="15%">Durasi</th>
            <th>Persentasi</th>

        </tr>
    </thead>
    <tbody>
        <?php

        for ($i = 1; $i < $tanggal + 1; $i++) {
            if ($i < 9) {
                $i = "0" . $i;
            } else {
                $i;
            }
            $tgl = $tahun . "-" . $bulan . "-" .  $i; ?>
            <tr>
                <td style='text-align:center;margin:auto'>
                    <p><?= $tahun . "-" . $bulan . "-" .  $i ?></p>
                </td>
                <td>
                    <?php
                    foreach ($data as $dt) {
                        $min_data = $this->db->query("select max(id) as min from hasil_patroli where id_durasi = '" . $dt->id_durasi . "' and tgl_kirim_patroli= '" . $tgl . "' ")->row();
                        $lokasi = $this->db->query("select nama from hasil_patroli where id ='" . $min_data->min . "'  ");
                        if ($lokasi->num_rows() > 0) {
                            $ja = $lokasi->row();
                            $kalimat_kecil = strtolower($ja->nama);
                            $kalimat_new = ucwords($kalimat_kecil);
                            echo "<li style='list-style-type:square'>" . $kalimat_new  . "</li>";
                        }
                    }
                    ?>
                </td>
                <td>

                    <?php
                    foreach ($data as $dt) {
                        $min_data = $this->db->query("select min(id) as min from hasil_patroli where id_durasi = '" . $dt->id_durasi . "' and tgl_kirim_patroli= '" . $tgl . "' ")->row();
                        $lokasi = $this->db->query("select lokasi from hasil_patroli where id ='" . $min_data->min . "' ");
                        if ($lokasi->num_rows() > 0) {
                            $ja = $lokasi->row();
                            $kalimat_kecil = strtolower($ja->lokasi);
                            $kalimat_new = ucwords($kalimat_kecil);
                            echo "<li style='list-style-type:square'>" . $kalimat_new  . "</li>";
                        }
                    }
                    ?>
                </td>
                <td>

                    <?php
                    foreach ($data as $dt) {
                        //ambil data max
                        $min_data = $this->db->query("select min(id) as min from hasil_patroli where id_durasi = '" . $dt->id_durasi . "' and tgl_kirim_patroli= '" . $tgl . "' ")->row();
                        $jam_awal = $this->db->query("select jam from hasil_patroli where id ='" . $min_data->min . "' ");
                        if ($jam_awal->num_rows() > 0) {
                            $ja = $jam_awal->row();
                            echo "<li style='list-style-type:square'>" . $ja->jam . "</li>";
                        }
                    }
                    ?>
                </td>
                <td>
                    <?php
                    foreach ($data as $dt) {
                        $max_data = $this->db->query("select max(id) as max from hasil_patroli where id_durasi = '" . $dt->id_durasi . "' and tgl_kirim_patroli= '" . $tgl . "' ")->row();
                        $lokasi = $this->db->query("select lokasi from hasil_patroli where id ='" . $max_data->max . "' ");
                        if ($lokasi->num_rows() > 0) {
                            $ja = $lokasi->row();
                            $kalimat_kecil = strtolower($ja->lokasi);
                            $kalimat_new = ucwords($kalimat_kecil);
                            echo "<li style='list-style-type:square'>" . $kalimat_new  . "</li>";
                        }
                    }
                    ?>
                </td>

                <td>

                    <?php
                    foreach ($data as $dt) {
                        //ambil data max
                        $max_data = $this->db->query("select max(id) as max from hasil_patroli where id_durasi = '" . $dt->id_durasi . "' and tgl_kirim_patroli= '" . $tgl . "' ")->row();
                        $jam_awal = $this->db->query("select jam from hasil_patroli where id ='" . $max_data->max . "' ");
                        if ($jam_awal->num_rows() > 0) {
                            $ja = $jam_awal->row();
                            echo "<li style='list-style-type:square'>" .  $ja->jam . "</li>";
                        }
                    }
                    ?>
                </td>
                <td>
                    <?php
                    $time = $this->db->query("SELECT durasi_patroli.durasi , durasi_patroli.id_durasi FROM hasil_patroli  JOIN  durasi_patroli 
                WHERE   durasi_patroli.id_durasi = hasil_patroli.id_durasi AND tgl_kirim_patroli = '" . $tgl . "' AND area_kerja = '" . $area . "'
                GROUP BY durasi_patroli.id_durasi ORDER BY durasi_patroli.id ASC  ");

                    foreach ($time->result() as $drs) {
                        echo "<li style='list-style-type:square'>" . $drs->durasi . "</li>";
                    }
                    ?>
                </td>
                <td>
                    <?php
                    $persentasi = $this->db->query("SELECT durasi_patroli.durasi , durasi_patroli.id_durasi , durasi_patroli.persentasi FROM hasil_patroli  JOIN  durasi_patroli WHERE   durasi_patroli.id_durasi = hasil_patroli.id_durasi AND tgl_kirim_patroli = '" . $tgl . "' AND area_kerja = '" . $area . "' GROUP BY durasi_patroli.id_durasi ORDER BY durasi_patroli.id ASC ");
                    foreach ($persentasi->result() as $drs) {
                        echo "<li style='list-style-type:square'>" . $drs->persentasi . "</li>";
                    }
                    ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
    $(function() {
        // $('#example').DataTable({
        //     scrollY: "500px",
        //     // scrollX: true,
        //     scrollCollapse: true,
        //     paging: false,
        //     fixedColumns: {
        //         left: 1,
        //         // right: 1
        //     }
        // });
    })
</script>