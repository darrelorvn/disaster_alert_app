<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class UserPageController extends Controller
{
    public function home()
{
    return view('pages.user.home');
}
public function map()
{
    return view('pages.user.map-evacuation');
}
public function report()
{
    return view('pages.user.report-disaster');
}
public function safety()
{
    return view('pages.user.safety-guide');
}
public function profile()
{
    return view('pages.user.profile');
}
}
