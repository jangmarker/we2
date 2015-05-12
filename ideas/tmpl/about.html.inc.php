<?php include(__DIR__ . '/header.inc.php') ?>

    <div id="content" class="i-full">
        <i-card>
            <h2 is="i-card-h">About us</h2>
            <table>
                <tr><td>CEO</td><td>Jan Marker</td></tr>
                <tr><td>Address</td><td>Fictional Street 2<br>00000 Super Town</td></tr>
                <tr><td>E-Mail</td><td><a href="mailto:jangerrit@weiler-marker.com">jangerrit@weiler-marker.com</a></td></tr>
            </table>
            <p>
                <a rel="nofollow" href="http://www.e-recht24.de/impressum-generator.html">http://www.e-recht24.de</a>
            </p>
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

        <i-card>
            <h2 is="i-card-h">Haftungsausschluss (Disclaimer)</h2>
            <p><strong>Haftung für Inhalte</strong></p> <p>Als Diensteanbieter sind wir gemäß § 7 Abs.1 TMG für eigene Inhalte auf diesen Seiten nach den allgemeinen Gesetzen verantwortlich. Nach §§ 8 bis 10 TMG sind wir als Diensteanbieter jedoch nicht verpflichtet, übermittelte oder gespeicherte fremde Informationen zu überwachen oder nach Umständen zu forschen, die auf eine rechtswidrige Tätigkeit hinweisen. Verpflichtungen zur Entfernung oder Sperrung der Nutzung von Informationen nach den allgemeinen Gesetzen bleiben hiervon unberührt. Eine diesbezügliche Haftung ist jedoch erst ab dem Zeitpunkt der Kenntnis einer konkreten Rechtsverletzung möglich. Bei Bekanntwerden von entsprechenden Rechtsverletzungen werden wir diese Inhalte umgehend entfernen.</p> <p><strong>Haftung für Links</strong></p> <p>Unser Angebot enthält Links zu externen Webseiten Dritter, auf deren Inhalte wir keinen Einfluss haben. Deshalb können wir für diese fremden Inhalte auch keine Gewähr übernehmen. Für die Inhalte der verlinkten Seiten ist stets der jeweilige Anbieter oder Betreiber der Seiten verantwortlich. Die verlinkten Seiten wurden zum Zeitpunkt der Verlinkung auf mögliche Rechtsverstöße überprüft. Rechtswidrige Inhalte waren zum Zeitpunkt der Verlinkung nicht erkennbar. Eine permanente inhaltliche Kontrolle der verlinkten Seiten ist jedoch ohne konkrete Anhaltspunkte einer Rechtsverletzung nicht zumutbar. Bei Bekanntwerden von Rechtsverletzungen werden wir derartige Links umgehend entfernen.</p> <p><strong>Urheberrecht</strong></p> <p>Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten unterliegen dem deutschen Urheberrecht. Die Vervielfältigung, Bearbeitung, Verbreitung und jede Art der Verwertung außerhalb der Grenzen des Urheberrechtes bedürfen der schriftlichen Zustimmung des jeweiligen Autors bzw. Erstellers. Downloads und Kopien dieser Seite sind nur für den privaten, nicht kommerziellen Gebrauch gestattet. Soweit die Inhalte auf dieser Seite nicht vom Betreiber erstellt wurden, werden die Urheberrechte Dritter beachtet. Insbesondere werden Inhalte Dritter als solche gekennzeichnet. Sollten Sie trotzdem auf eine Urheberrechtsverletzung aufmerksam werden, bitten wir um einen entsprechenden Hinweis. Bei Bekanntwerden von Rechtsverletzungen werden wir derartige Inhalte umgehend entfernen.</p><p> </p>
        </i-card>
    </div>

<?php include(__DIR__ . '/footer.inc.php') ?>