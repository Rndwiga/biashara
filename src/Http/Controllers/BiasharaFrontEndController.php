<?php

namespace Tyondo\Biashara\Http\Controllers;

use Illuminate\Http\Request;

class BiasharaFrontEndController extends Controller
{
    /**
     * Display index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(config('biashara.views.pages.home.index'));
    }

    /**
     * Display about page
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        return view(config('biashara.views.pages.about.index'));
    }


    /**
     * Display contact page
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        return view(config('biashara.views.pages.contact.index'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeContact(Request $request)
    {
        //
    }
}
