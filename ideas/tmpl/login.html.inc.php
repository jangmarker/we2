<?php include(__DIR__ . '/header.inc.php') ?>

    <div id="content" class="i-full">
        <i-card>
            <h2 is="i-card-h">Login</h2>
            <?php if (array_key_exists('error', $data)) { ?>
                <p class="error">Error: <?= $data['error'] ?></p>
            <?php } else if (array_key_exists('msg', $data)) { ?>
                <p class="okay"><?= $data['msg']?></p>
            <?php } ?>
                <form action="" method="post">
                 <p><label for="username">User name:</label> <input id="username" name="username" type="text"></p>
                 <p><label for="password">Password:</label> <input id="password" name="password" type="password"></p>
                    <input type="hidden" name="target" value="<?= $data['target'] ?>">
                 <input type="submit" value="Login">
                </form>
        </i-card>
    </div>

<?php include(__DIR__ . '/footer.inc.php') ?>