 <table border="1" id="table_id" class="display responsive">
     <thead>
         <tr>
             <th>No</th>
             <th>Tanggal</th>
             <th>CLock In</th>
             <th>Date In</th>
             <th>Clock Out</th>
             <th>Date Out</th>
             <th>Over Time</th>
         </tr>
     </thead>
     <tbody>
         <?php

            if ($absen) {
                $no = 1;
                $t = new Grei\TanggalMerah();

                $tahun = date('Y'); //Mengambil tahun saat ini
                // $bulan = date('m'); //Mengambil bulan saat ini
                $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                for ($i = 1; $i < $tanggal + 1; $i++) { ?>
                 <tr>
                     <td><?= $no++ ?></td>
                     <td>
                         <?php
                            $d = $tahun . "-" . $bulan . "-" . $i;
                            $result = preg_replace("/[^A-Za-z0-9]/", "", $d);
                            $t->set_date($result);
                            if ($t->is_holiday() > 0) {
                                echo '<label class="text-danger" style="color:red">' . $d  . '</label>';
                            } else {
                                echo '<label>' . $d  . '</label>';
                            }
                            ?>
                     </td>
                     <?php
                        $dr = $tahun . '-' . $bulan . '-' . $i;
                        $cek = $this->db->get_where($tabel, ['in_date' => $dr, 'id_absen' => $this->session->userdata('id_akun')]);
                        if ($cek->num_rows() > 0) {
                            foreach ($cek->result() as $r) {
                                echo "<td>" . $r->in_time . "</td>";
                                echo "<td>" . $r->in_date . "</td>";
                                echo "<td>" . $r->out_time . "</td>";
                                echo "<td>" . $r->out_date . "</td>";
                                echo "<td>" . $r->over_time . "</td>";
                            }
                            // echo "<td>tanggal ada</td>";
                        } else {
                            // echo $absen[$i]->in_time;
                            echo "<td> - </td>";
                            echo "<td> - </td>";
                            echo "<td> - </td>";
                            echo "<td> - </td>";
                            echo "<td> - </td>";
                        }
                        ?>
                 </tr>
         <?php }
            } else {
                echo "<td>Tidak ada data</td>";
            }
            ?>



     </tbody>
 </table>