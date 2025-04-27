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
            <input type="checkbox" name="utm_short_links[<?= $link->code ?>]" value="1">
            <?= $link->name ?>
        </label>
    </p>
<?php endforeach ?>