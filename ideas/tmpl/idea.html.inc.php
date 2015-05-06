<?php include(__DIR__ . '/header.inc.php') ?>

<div id="content" class="i-columns">
    <div id="column_left">
        <i-card>
            <h2 is="i-card-h"><?=$data['idea_id']?>: <?=$data['shorttitle']?> </h2>
            <?=$data['description']?>
            <div class="vote_buttons">
                Vote:
                <button name="vote_down" class="inlinebutton button_vote_down" onclick="vote(<?=$data['idea_id']?>, -1)"><span class="fa fa-thumbs-down"/></button>
                <button name="vote_up" class="inlinebutton button_vote_up" onclick="vote(<?=$data['idea_id']?>, 1)"><span class="fa fa-thumbs-up" /></button>
            </div>
        </i-card>
        <i-card>
            <h2 is="i-card-h">Recent comments</h2>
            <i-comment>
                <i-comment-content>
                    <a is="i-aspect-reference" href="#Hosting">#Hosting</a> is a complicated problem, maybe <a is="i-idea-reference">idea 001</a> can help us?
                </i-comment-content>
                <i-comment-meta>
                    by Jan Marker at 6pm on 2015-04-03
                </i-comment-meta>
            </i-comment>
            <i-comment class="lastcomment">
                <i-comment-content>
                    The answer to <a is="i-aspect-reference">#Life</a> is 42
                </i-comment-content>
                <i-comment-meta>
                    by Jan Marker at 6pm on 2015-04-05
                </i-comment-meta>
            </i-comment>
            <button class="morebutton">More...</button>
            <textarea placeholder="You can use #aspect and idea <nr>" class="newcomment">

            </textarea>
        </i-card>

        <i-card>
            <h2 is="i-card-h">Discussion about <a is="i-aspect-reference">#Hosting</a></h2>
            <i-comment class="lastcomment">
                <i-comment-content>
                    <a is="i-aspect-reference" href="#Hosting">#Hosting</a> is a complicated problem, maybe <a is="i-idea-reference">idea 001</a> can help us?
                </i-comment-content>
                <i-comment-meta>
                    by Jan Marker at 6pm on 2015-04-03
                </i-comment-meta>
            </i-comment>
            <hr>
            <i-comment class="lastcomment">
                <i-comment-content>
                    I don't think that <a is="i-idea-reference">idea 001</a> can be useful.
                </i-comment-content>
                <i-comment-meta>
                    by Jan Marker at 6pm on 2015-04-04
                </i-comment-meta>
        </i-comment>
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
            <a is="i-tag">informatics</a>,
            <a is="i-tag">computer</a>,
            <a is="i-tag">linux</a>,
            <a is="i-tag">operations</a>
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
            <a is="i-aspect-reference">#Hosting</a>,
            <a is="i-aspect-reference">#Life</a>
        </i-card>
    </div>
</div>

<?php include(__DIR__ . '/footer.inc.php') ?>