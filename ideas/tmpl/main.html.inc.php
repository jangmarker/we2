<?php include(__DIR__ . '/header.inc.php') ?>

<div id="content" class="i-full">
    <i-card>
        <h2 is="i-card-h">About <?=$data['ideaCount'] ?> ideas...</h2>
        <i-bubble-field>
            <i-bubble class="large">
                <p>
                    <a href="index.php?resourceName=search&id=<?=$data['tagCount'][0]['tagname']?>">
                        <?=$data['tagCount'][0]['ideaCount']?> in <?=$data['tagCount'][0]['tagname']?>
                    </a>
                </p>
            </i-bubble>
            <i-bubble class="middle">
                <p>
                    <a href="index.php?resourceName=search&id=<?=$data['tagCount'][0]['tagname']?>">
                      <?=$data['tagCount'][1]['ideaCount']?> in <?=$data['tagCount'][1]['tagname']?>
                    </a>
                </p>
            </i-bubble>
            <i-bubble class="small">
                <p>
                    <a href="index.php?resourceName=search&id=<?=$data['tagCount'][0]['tagname']?>">
                       <?=$data['tagCount'][2]['ideaCount']?> in <?=$data['tagCount'][2]['tagname']?>
                    </a>
                </p>
            </i-bubble>
            <i-bubble class="middle">
                <p>
                    <a href="?resourceName=new_idea"><span class="fa fa-plus fa-2x"></span><br>Add yours...</a>
                </p>
            </i-bubble>
        </i-bubble-field>
    </i-card>
    <i-card id="main_about">
        <a href="index.php?resourceName=about">
            <h2 is="i-card-h">About us & Contact</h2>
            We are a 1-person-team which develops software for a web engineering class.
        </a>
    </i-card>
</div>

<?php include(__DIR__ . '/footer.inc.php') ?>