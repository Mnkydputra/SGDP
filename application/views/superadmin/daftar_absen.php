<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>In</th>
            <th>Out</th>
            <th>Keterangan</th>
            <th>Opsi</th>
        </tr>
    </thead>
    <tbody>
        <?php

        $no = 1;
        $t = new Grei\TanggalMerah();

        $tahun = date('Y'); //Mengambil tahun saat ini
        // $bulan = date('m'); //Mengambil bulan saat ini
        $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
        for ($i = 1; $i < $tanggal + 1; $i++) {
            if ($i < 9) {
                $i = "0" . $i;
            } else {
                $i;
            }
            $d = $tahun . "-" . $bulan . "-" . $i; ?>
            <tr>
                <td><?= $d ?></td>
                <?php
                $dr = $tahun . '-' . $bulan . '-' . $i;
                $cek = $this->db->get_where($tabel, ['in_date' => $dr, 'npk' => $npk]);
                if ($cek->num_rows() > 0) {
                    foreach ($cek->result() as $r) {
                        echo "<td>" . $r->in_time . "</td>";
                        echo "<td>" . $r->out_time . "</td>";
                        echo "<td>" . $r->ket . "</td>";
                        echo '<td>
                        <a target="_blank" href=' . base_url("Superadmin/Presensi/form_edit/" . $r->id . "/" . $tabel)  . ' >ubah</a>
                        </td>';
                    }
                } else {
                    echo "<td> - </td>";
                    echo "<td> - </td>";
                    echo "<td> - </td>";
                    echo "<td> - </td>";
                }
                ?>
            </tr>
        <?php }
        ?>

    </tbody>
</table>