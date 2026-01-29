<?php
class AuthMiddleware
{
    public static function handle()
    {
        if (empty($_SESSION['user_id'])) {
            redirect('/auth/login');
        }
    }
}
