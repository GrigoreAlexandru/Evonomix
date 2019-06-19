<?php

namespace App\Http\Controllers;

use App\ScheduleContent;


class WelcomeController extends Controller
{
    public function index()
    {
        $contents = ScheduleContent::orderBy('created_at', 'DESC')->paginate(3*3);
        return view('index', compact('contents'));
    }
}
