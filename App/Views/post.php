<?php

use Spichka\Usl\Models\Link;

/**
 * @var Link[] $links
 */
?>

<p>Link list: </p>
<?php foreach ($links as $link) : ?>
    <p>
        <label>
            <input type="checkbox" name="utm_short_links[<?= $link->getCode() ?>]" value="1">
            <?= $link->getName() ?>
        </label>
    </p>
<?php endforeach ?>