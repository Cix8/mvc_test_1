<?php

function view(string $view, array $data)
{
    extract($data);
    ob_start();
    require_once __DIR__ . "/../app/views/post/".$view.".template.php";
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}
