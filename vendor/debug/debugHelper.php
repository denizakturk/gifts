<?php

if (!function_exists('dump')) {
    function dump($data, $andExit = false)
    {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';

        if ($andExit) {
            exit;
        }
    }
}