<?php include(__DIR__ . '/header.inc.php') ?>

    <div id="content" class="i-full">
        <i-card>
            <h2 is="i-card-h">About us</h2>
            <table>
                <tr><td>CEO</td><td>Jan Marker</td></tr>
                <tr><td>Address</td><td>somewhere</td></tr>
            </table>
        </i-card>

        <i-card>
            <h2 is="i-card-h">Contact</h2>
            <p>Write us at the address above or send us a message:</p>
            <form method="POST" action="">
                <p>
                    <label for="contact-email">e-Mail</label><br>
                    <input type="email" name="contact-email" id="contact-email" required>
                </p>
                <p>
                    <label for="contact-message">Message</label><br>
                    <textarea type="text" name="contact-message" id="contact-message" required></textarea>
                </p>
                <input type="submit">

                <?php if (array_key_exists('msg', $data)) { ?>
                    <p class="okay"><?= $data['msg'] ?></p>
                <?php }?>
            </form>
        </i-card>
    </div>

<?php include(__DIR__ . '/footer.inc.php') ?>