<table id="table_id" class="display responsive">
    <thead>
        <tr>
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
            $t = new Grei\TanggalMerah();
            foreach ($absen as $absen) { ?>
                <tr>
                    <td><?= $absen->in_time ?></td>
                    <td>
                        <?php
                        $d = $absen->in_date;
                        $result = preg_replace("/[^A-Za-z0-9]/", "", $d);
                        $t->set_date($result);
                        if ($t->is_holiday() > 0) {
                            echo '<label class="text-danger">' . $absen->in_date  . '</label>';
                        } else {
                            echo '<label>' . $absen->in_date  . '</label>';
                        }
                        ?>
                    </td>
                    <td><?= $absen->out_time ?></td>
                    <td><?php
                        $d = $absen->out_date;
                        $result = preg_replace("/[^A-Za-z0-9]/", "", $d);
                        $t->set_date($result);
                        if ($t->is_holiday() > 0) {
                            echo '<label class="text-danger">' . $absen->out_date  . '</label>';
                        } else {
                            echo '<label>' . $absen->out_date  . '</label>';
                        }
                        ?></td>
                    <td><?= $absen->over_time ?></td>
                <?php }
        } else { ?>
                <tr>
                    <td>data tidak ada</td>
                </tr>
            <?php } ?>

    </tbody>
</table>