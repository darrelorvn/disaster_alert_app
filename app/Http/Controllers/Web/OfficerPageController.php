<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class OfficerPageController extends Controller
{
    public function home()
{
    return view('pages.officer.home');
}
public function manageData()
{
    return view('pages.officer.manage-data');
}
public function profile()
{
    return view('pages.officer.profile');
}
}
