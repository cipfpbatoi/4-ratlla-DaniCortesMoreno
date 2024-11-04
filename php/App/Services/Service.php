<?php

namespace Joc4enRatlla\Services;
/**
 * Summary of Service
 * @author Dani
 * @package Joc4enRatlla\Services;
 */
class Service {
    /**
     * Summary of loadView
     * @param mixed $view
     * @param mixed $data
     * @return void
     */
    public static function loadView($view, $data = [])
    {
        $viewPath = str_replace('.', '/', $view);
        extract($data);

        include  $_SERVER['DOCUMENT_ROOT'] . "/../Views/$viewPath.view.php";

    }
}

?>