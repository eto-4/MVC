<?php

class HomeController
{
    public function index(): void
    {
        require APP_ROOT . '/views/layouts/header.php';
        require APP_ROOT . '/views/home/index.php';
        require APP_ROOT . '/views/layouts/footer.php';
    }
}