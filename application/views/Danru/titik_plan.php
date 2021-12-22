<select name="tikor" style="border:2px solid #ccc;width:100%;" id="tikor">
    <?php foreach ($tikor as $tk) : ?>
        <option value="<?= $tk->id ?>"><?= $tk->lokasi ?></option>
    <?php endforeach ?>
</select>