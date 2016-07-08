<?php

namespace App\Http\Controllers;

use Cookie;

class DashboardController extends Controller
{
    public function index()
    {
        $pusherKey = config('broadcasting.connections.pusher.key');
        $pusherCluster = config('broadcasting.connections.pusher.options.cluster');
        $pusherEncrypted = config('broadcasting.connections.pusher.options.encrypted');

        return view('dashboard')->with(compact('pusherKey', 'pusherCluster', 'pusherEncrypted'));
    }
}
