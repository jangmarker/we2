<?php include(__DIR__ . '/header.inc.php') ?>

<div id="content" class="i-columns">
    <?php
        if (array_key_exists('error', $data)) {
            var_dump($data['error']);
            die();
        }
    ?>
    <div id="column_left">
        <i-card>
            <h2 is="i-card-h"><?=$data['idea_id']?>: <?=$data['shorttitle']?> </h2>
            <?=$data['description']?>
            <div class="vote_buttons">
                <?php if ($data['userHasVoted'] == true) { ?>
                    <span class="fa fa-thumbs-up"/>: <?=$data['upVote']?>
                    <span class="fa fa-thumbs-down"/>: <?=$data['downVote']?>
                <?php } else { ?>
                    Vote:
                    <button name="vote_down" class="inlinebutton button_vote_down" onclick="vote(<?=$data['idea_id']?>, -1)"><span class="fa fa-thumbs-down"/></button>
                    <button name="vote_up" class="inlinebutton button_vote_up" onclick="vote(<?=$data['idea_id']?>, 1)"><span class="fa fa-thumbs-up" /></button>
                <?php } ?>
            </div>
        </i-card>
        <i-card>
            <h2 is="i-card-h">Recent comments</h2>
                <?php foreach ($data['comments'] as $comment) { ?>
                    <i-comment>
                        <i-comment-content>
                            <?= $comment['comment'] ?>
                        </i-comment-content>
                        <i-comment-meta>
                            by <?= $comment['username'] ?> at <?= $comment['date'] ?>
                        </i-comment-meta>
                    </i-comment>
                <?php } ?>
            <textarea placeholder="You can use #aspect and idea <nr>" class="newcomment" id="newcomment_area"></textarea>
            <button onclick="newcomment(<?=$data['idea_id']?>, document.getElementById('newcomment_area').value)">Create</button>
        </i-card>

        <i-card>
            <h2 is="i-card-h">
                <label for="aspectDiscussion">Discussion about</label>
                    <a is="i-aspect-reference">
                        <select id="aspectDiscussion" name="aspectDiscussion" size="1" onchange="changeAspectDiscussion(event)">
                            <?php foreach ($data['aspects'] as $aspect) { ?>
                                <option
                                    value="index.php?resourceName=idea&id=<?=$data['idea_id']?>&aspect=<?=urlencode($aspect['aspectname'])?>"
                                    <?=($data['selectedAspect']['name'] == $aspect['aspectname'])?'selected':''?>>
                                    <?=$aspect['aspectname']?>
                                </option>
                            <?php } ?>
                        </select>
                    </a>
            </h2>
            <?php foreach ($data['selectedAspect']['comments'] as $comment) { ?>
                <i-comment>
                    <i-comment-content>
                        <?= $comment['comment'] ?>
                    </i-comment-content>
                    <i-comment-meta>
                        by <?= $comment['username'] ?> at <?= $comment['date'] ?>
                    </i-comment-meta>
                </i-comment>
            <?php } ?>
        </i-card>
    </div>
    <div id="column_right">
        <i-card>
            <h2 is="i-card-h">Written by</h2>
            <?=$data['user_name']?><br>
            <?=$data['faculty_name']?>
        </i-card>
        <i-card>
            <h2 is="i-card-h">Tags</h2>
            <?php foreach ($data['tags'] as $aspect) { ?>
                <a is="i-tag" href="index.php?resourceName=search&id=<?=urlencode($aspect['tagname'])?>"><?=$aspect['tagname']?></a>
            <?php } ?>
        </i-card>
        <i-card>
            <h2 is="i-card-h">Related: <a is="i-idea-reference">idea 001</a></h2>
            Host cool things on cool servers
            <hr>
            <i-comment class="lastcomment">
                <i-comment-content>
                    <a is="i-aspect-reference" href="#Hosting">#Hosting</a> is a complicated problem, maybe <a is="i-idea-reference">idea 001</a> can help us?
                </i-comment-content>
                <i-comment-meta>
                    by Jan Marker at 6pm on 2015-04-03
                </i-comment-meta>
            </i-comment>
        </i-card>
        <i-card>
            <h2 is="i-card-h">Aspects</h2>
            <?php foreach ($data['aspects'] as $aspect) { ?>
                <a is="i-aspect-reference" href="index.php?resourceName=search&id=<?=urlencode($aspect['aspectname'])?>"><?=$aspect['aspectname']?></a>
            <?php } ?>
        </i-card>
    </div>
</div>

<?php include(__DIR__ . '/footer.inc.php') ?>