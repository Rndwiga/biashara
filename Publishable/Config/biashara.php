<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Tyondo Biashara Config File
    |--------------------------------------------------------------------------
    |
    | This option determines where all the compiled Blade templates will be
    | stored for your application. Typically, this is within the storage
    | directory. However, as usual, you are free to change this value.
    |
    */
    /*
    |--------------------------------------------------------------------------
    | Business Name & Slogan
    |--------------------------------------------------------------------------
    */
    'name' => 'Click Away Biashara',
    'slogan' => 'Your biashara. Your place.',

    'views' => [
      'layouts' => [
          'master' => 'biashara::frontend.layouts.master',
          'includes'=>[
              'footer'=>'biashara::frontend.layouts.includes.footer',
              'header'=>'biashara::frontend.layouts.includes.header',
              'header-users-access'=>'biashara::frontend.layouts.includes.header-users',
              'navigation'=>'biashara::frontend.layouts.includes.navigation',
              'newsletter'=>'biashara::frontend.layouts.includes.newsletter',
              'scripts'=>'biashara::frontend.layouts.includes.scripts',
              'partial'=>[
                  'footer-copy'=>'biashara::frontend.layouts.includes.partial.footer-copy',
                  'footer-info'=>'biashara::frontend.layouts.includes.partial.footer-info',
              ]
          ],
      ],
      'pages'=>[
           'about'=>[
                'index'=>'biashara::frontend.pages.about.index',
                'partials'=>[
                  'team'=>'biashara::frontend.pages.about.partials.team',
                  'team-advert'=>'biashara::frontend.pages.about.team-advert'
                ],
              ],
          'contact'=>[
              'index'=>'biashara::frontend.pages.contact.index',
          ],
          'home'=>[
              'index'=>'biashara::frontend.pages.home.index',
              'list-categories'=>'biashara::frontend.pages.home.list-categories',
              'new-products'=>'biashara::frontend.pages.home.new-products',
              'special-deals'=>'biashara::frontend.pages.home.special-deals',
              'top-brand'=>'biashara::frontend.pages.home.top-brand',
              'modal'=>[
                  'template'=>'biashara::frontend.pages.home.modal.template',
                  'machinery'=>'biashara::frontend.pages.home.modal.machinery',
              ]
          ]
      ],
    ],

];
