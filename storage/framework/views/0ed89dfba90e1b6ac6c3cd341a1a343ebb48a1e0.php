<?php
$items = [
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
        'icon' => 'dashboard',
        'active' => Route::currentRouteName() == 'admin.dashboard',
        'is_blank' => false,
    ],
    [
        'name' => 'User Manager',
        'route' => route('admin.users'),
        'icon' => 'manage_accounts',
        'active' => Route::currentRouteName() == 'admin.users',
        'is_blank' => false,
    ],
    [
        'name' => 'Customers',
        'route' => route('admin.customers'),
        'icon' => 'group',
        'active' => Route::currentRouteName() == 'admin.customers',
        'is_blank' => false,
    ],
    [
        'name' => 'Orders',
        'route' => route('admin.orders'),
        'icon' => 'inbox',
        'active' => Route::currentRouteName() == 'admin.orders',
        'is_blank' => false,
    ],
    [
        'name' => 'Categories',
        'route' => route('admin.categories'),
        'icon' => 'category',
        'active' => Route::currentRouteName() == 'admin.categories',
        'is_blank' => false,
    ],
    [
        'name' => 'Menu Items',
        'route' => route('admin.items'),
        'icon' => 'fastfood',
        'active' => Route::currentRouteName() == 'admin.items',
        'is_blank' => false,
    ],
    [
        'name' => 'Services',
        'route' => route('admin.services'),
        'icon' => 'fastfood',
        'active' => Route::currentRouteName() == 'admin.services',
        'is_blank' => false,
    ],
    [
        'name' => 'Banners',
        'route' => route('admin.banners'),
        'icon' => 'imagesmode',
        'active' => Route::currentRouteName() == 'admin.banners',
        'is_blank' => false,
    ],
    [
        'name' => 'Delivery Areas',
        'route' => route('admin.areas'),
        'icon' => 'two_wheeler',
        'active' => Route::currentRouteName() == 'admin.areas',
        'is_blank' => false,
    ],
    [
        'name' => 'Payment Methods',
        'route' => route('admin.payment_methods'),
        'icon' => 'credit_card',
        'active' => Route::currentRouteName() == 'admin.payment_methods',
        'is_blank' => false,
    ],
    [
        'name' => 'Coupons',
        'route' => route('admin.coupons'),
        'icon' => 'confirmation_number',
        'active' => Route::currentRouteName() == 'admin.coupons',
        'is_blank' => false,
    ],
    [
        'name' => 'Settings',
        'route' => route('admin.settings'),
        'icon' => 'settings',
        'active' => Route::currentRouteName() == 'admin.settings',
        'is_blank' => false,
    ],
    [
        'name' => 'Web Mail',
        'route' => 'https://webmail-box2376.bluehost.com/',
        'icon' => 'mail',
        'active' => false,
        'is_blank' => true,
    ],
    // [
    //     'name' => 'Push Notification',
    //     'route' => route('admin.push-notifications'),
    //     'icon' => 'notifications',
    //     'active' => Route::currentRouteName() == 'admin.push-notifications',
    //     'is_blank' => false,
    // ],
];

?>
<?php echo $__env->make('admin.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\Users\Administrator\Desktop\Caliburger_QR\resources\views/admin/layouts/sidebar-items.blade.php ENDPATH**/ ?>