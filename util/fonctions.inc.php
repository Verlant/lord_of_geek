<?php

/**
 * Affiche une liste d'erreur
 * @param array $msgErreurs
 */
function afficheErreurs(array $msgErreurs)
{
    echo '﻿<div class="erreur"><ul>';
    foreach ($msgErreurs as $erreur) {
?>
        <li><?php echo $erreur ?></li>
<?php
    }
    echo '</ul></div>';
}

/**
 * Affiche un message bleu
 * @param string $msg
 */
function afficheMessage(string $msg)
{
    echo '﻿<div class="message">' . $msg . '</div>';
}
