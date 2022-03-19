<form action="">
    <?php
    if ($status == "0") { ?>
        <button class="mt-4 btn btn-success">Report Kondisi</button>
    <?php } else { ?>

        <textarea placeholder="Keterangan Temuan" name="keterangan" id="temuan" class="mt-2" cols="30" rows="4"></textarea>
        <input type="file" id="lampiran" name="file">
        <button class="mt-4 btn btn-success">Report Kondisi</button>
    <?php }
    ?>
</form>