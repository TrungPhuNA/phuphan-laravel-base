<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 1/22/25
 */

return [
    'prefix_title' => 'Base Laravel',
    'image_default' => 'https://123code.net/images/preloader.png',
    'admin' => [
        'check_permission'   => env("APP_CHECK_PERMISSION", true),
        'email_supper_admin' => env('EMAIL_SUPPER_ADMIN', null),
        'menu_setting' => [
            "common" => [
                [
                    "name" => "General",
                    "icon" => "settings",
                    "route" => "admin.setting.update.info",
                    "desc" => "View and update your general settings and activate license"
                ],
                [
                    "name" => "Email",
                    "icon" => "mail",
                    "route" => "admin.setting.email.index",
                    "desc" => "Setting config email"
                ],
            ],
            "others" => [
                [
                    "name" => "General",
                    "icon" => "settings",
                    "route" => "",
                    "desc" => "View and update your general settings and activate license"
                ],
                [
                    "name" => "Email",
                    "icon" => "mail",
                    "route" => "",
                    "desc" => "Setting config email"
                ],
            ],
        ],
        'menu_sidebar'       => [
            [
                'name' => 'Page',
                'type' => 1
            ],
            [
                'name'     => 'Dashboards',
                'icon'     => 'sliders',
                'route'    => 'admin.dashboard',
                'sub_menu' => [],
                'type'     => 2
            ],
            [
                'name'     => 'Blog',
                'icon'     => 'file',
                'id'       => 'blog',
                'sub_menu' => [
                    [
                        'name'  => 'Tags',
                        'route' => 'admin.blog.tag.index'
                    ],
                    [
                        'name'  => 'Menu',
                        'route' => 'admin.blog.menu.index'
                    ],
                    [
                        'name'  => 'Bài viết',
                        'route' => 'admin.blog.article.index'
                    ],
                ],
                'type'     => 2
            ],
            [
                'name'     => 'Ecommerce',
                'icon'     => 'database',
                'id'       => 'ecommerce',
                'sub_menu' => [
                    [
                        'name'  => 'Brand',
                        'route' => 'admin.ecommerce.brand.index'
                    ],
                    [
                        'name'  => 'Label',
                        'route' => 'admin.ecommerce.label.index'
                    ],
                    [
                        'name'  => 'Category',
                        'route' => 'admin.ecommerce.category.index'
                    ],
                    [
                        'name'  => 'Product',
                        'route' => 'admin.ecommerce.product.index'
                    ],
                ],
                'type'     => 2
            ],
            [
                'name'     => 'Ads',
                'icon'     => 'bar-chart',
                'id'       => 'setting',
                'sub_menu' => [
                    [
                        'name'  => 'Setting ads',
                        'route' => 'admin.setting.ads.index'
                    ]
                ],
                'type'     => 2
            ],
            [
                'name'     => 'Phân quyền',
                'icon'     => 'shield',
                'id'       => 'acl',
                'sub_menu' => [
                    [
                        'name'  => 'Tài khoản',
                        'route' => 'admin.acl.account.index'
                    ],
                    [
                        'name'  => 'Nhóm quyền',
                        'route' => 'admin.acl.role.index'
                    ],
                    [
                        'name'  => 'Permission',
                        'route' => 'admin.acl.permission.index'
                    ],
                ],
                'type'     => 2
            ],
            [
                'name'     => 'Setting',
                'icon'     => 'settings',
                'route'    => 'admin.setting.info',
                'sub_menu' => [],
                'type'     => 2
            ],
            [
                'name'     => 'Platform Administration',
                'icon'     => 'shield',
                'route'    => 'admin.system.general',
                'sub_menu' => [],
                'type'     => 2
            ],
        ]
    ]
];