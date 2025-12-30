<?php

class FlashMessages
{
    public static function add(string $type, string $message): void
    {
        $_SESSION['flash'][] = compact('type', 'message');
    }

    public static function success(string $msg): void { self::add('success', $msg); }
    public static function error(string $msg): void { self::add('danger', $msg); }

    public static function display(): void
    {
        if (empty($_SESSION['flash'])) return;

        foreach ($_SESSION['flash'] as $flash) {
            echo "<div class='alert alert-{$flash['type']}'>{$flash['message']}</div>";
        }

        unset($_SESSION['flash']);
    }
}
