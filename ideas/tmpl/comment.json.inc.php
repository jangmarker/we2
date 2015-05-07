{
    <?php
    foreach ($data as $key=>$value) {
        if ($key == 'user')
            continue;
        ?>
        "<?=$key?>": "<?=$value?>",
    <?php
    }
    ?>
    "empty": null
}