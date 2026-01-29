<?php
class NotifyController
{
    public function index()
    {
        view('layouts/app', [
            'page' => 'pages/notifications',
            'pageTitle' => 'Уведомления',
        ]);
    }
}
