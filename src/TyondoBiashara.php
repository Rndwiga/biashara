<?php

namespace Tyondo\Biashara;


class TyondoBiashara
{

    //Loading Package routes
    public static function routes(){
        include(__DIR__.'/../Publishable/Routes/web.php');
    }
}