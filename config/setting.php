<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 1/22/25
 */

return [
    'prefix_title' => 'Base Laravel',

    'admin' => [
        'check_permission'   => env("APP_CHECK_PERMISSION", true),
        'email_supper_admin' => env('EMAIL_SUPPER_ADMIN', null),
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
        ]
    ]
];