<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function index()
    {
        dd("Return the Report Home Page");
    }
    public function sales()
    {

        /**
         * Display sales report.
         */
        // should show the sales statistics
        dd("Sales Statistics should be display here");
    }
    /**
     * Display order report.
     */
    public function orders()
    {
        dd("Report Order history");
    }
    /**
     * Display product report.
     */
    public function products()
    {
        dd("Display product reports");
    }
    /**
     * Display customer/user report.
     */
    public function customers()
    {
        dd("Display featured customers");
    }
    /**
     * Display category report.
     */
    public function categories()
    {
        dd("Display categories reports");
    }
}
