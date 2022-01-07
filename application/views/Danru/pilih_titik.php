<select class="form-control text-dark" name="titik" id="titik_lokasi">
    <?php foreach ($data as $tk) : ?>
        <?php if ($tk->status == "NOK") { ?>
            <option style="background:crimson;color:#fff" value="<?= $tk->id ?>"><?= $tk->lokasi ?></option>
        <?php } else { ?>
            <option style="background:greenyellow" value="<?= $tk->id ?>"><?= $tk->lokasi ?></option>
        <?php } ?>
    <?php endforeach ?>
</select>