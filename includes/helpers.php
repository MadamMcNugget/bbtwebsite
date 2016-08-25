<?php

/**
 * Renders template.
 *
 * @param array $data
 */
function render($views, $data = array())
{
    $path = __DIR__ . '/../views/' . $views . '.php';
    if (file_exists($path))
    {
        extract($data);
        require($path);
    }
}
