<?php

namespace App\Http\Controllers;

class SiteController extends Controller
{
    /**
     * Main page of the website
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function index()
    {
        return view('welcome');
    }
}
