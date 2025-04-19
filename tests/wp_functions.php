<?php

function home_url(string $path = '', string $scheme = null): string
{
    $scheme = $scheme ?: 'http';

    return "$scheme://localhost/$path";
}
