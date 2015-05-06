<?php include(__DIR__ . '/header.inc.php') ?>

    <div id="content" class="i-full">
        <i-card>
            <h2 is="i-card-h">New Idea</h2>
            <form method="post" action="index.php?resourceName=idea">
                <p><label for="shorttitle">Short title</label><br><input type="text" id="shortitle" name="shortitle"></p>
                <p><label for="description">Description</label><br><textarea type="text" id="description" name="description"></textarea></p>
                <p><label for="tags">Tags</label><br><input placeholder="tag1, tag2" type="text" id="tags" name="tags"></p>
                <input type="submit" value="Create">
            </form>
        </i-card>
    </div>

<?php include(__DIR__ . '/footer.inc.php') ?>