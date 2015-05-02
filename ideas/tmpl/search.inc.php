<?php include(__DIR__ . '/header.inc.php') ?>

<div id="content" class="i-three_columns">
    <?php foreach ($data['results'] as $result) { ?>
    <i-card>
        <a href="index.php?resourceName=idea&id=<?=$result['idea_id']?>">
            <h2 is="i-card-h"><?=$result['title']?></h2>
            <?=$result['description']?>
        </a>
    </i-card>
    <?php } ?>
</div>

<?php include(__DIR__ . '/footer.inc.php') ?>