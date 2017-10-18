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
    | Shopping Cart Configurations
    |--------------------------------------------------------------------------
    */
    'order_number_prefix' => 'CAH',
    /*
|--------------------------------------------------------------------------
| Shopping Cart Menu
|--------------------------------------------------------------------------
*/
    'navigation' => [
        [
            'group' => 'Orders',
            'class' => 'fa fa-list fa-lg',
            'links' => [
                [
                    'title' => 'Orders',
                    'class' => 'fa fa-table fa-plus',
                    'route' => 'biashara.order.orders'
                ],
                [
                    'title' => 'list Orders',
                    'class' => 'fa fa-table fa-plus',
                    'route' => 'biashara.order.list'
                ],
                [
                    'title' => 'Draft Orders',
                    'class' => 'fa fa-table fa-list',
                    'route' => 'biashara.order.draft'
                ],
            ]
        ]
    ],
    /*
    |--------------------------------------------------------------------------
    | Business Name & Slogan
    |--------------------------------------------------------------------------
    */
    'name' => 'Click Away Hardware',
    'slogan' => 'Your Construction. Your hardware.',

    'views' => [
        'v1' => [
            'partials' =>  [
                'meta' => 'biashara::v1.partials.meta',
                'gAnalytics' => 'biashara::v1.partials.GoogleAnalytics'
            ],
            'pages' => [
                'products' => [
                    'create' => 'biashara::v1.pages.products.create'
                ]
            ]
        ],
        'backend' => [
            'orders' => 'biashara::backend.user.orders',
            'order-list' => 'biashara::backend.user.order-list',
            'order-draft' => 'biashara::backend.user.order-draft',
        ],
        'layouts' => [
            'shop' => 'biashara::v1.layouts.shop',
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
                    'redsoil'=>'biashara::frontend.pages.home.modal.redsoil',
                    'sand'=>'biashara::frontend.pages.home.modal.sand',
                    'stones'=>'biashara::frontend.pages.home.modal.stones',
                ]
            ]
        ],
    ],

];
