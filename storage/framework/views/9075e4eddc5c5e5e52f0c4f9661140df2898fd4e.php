<?php
$items = [
    [
        'name' => 'Our Menu',
        'route' => route('home'),
        'icon' => 'fastfood',
        'active' => Route::currentRouteName() == 'home',
        'is_blank' => false,
    ],
    [
        'name' => 'Bag',
        'route' => route('cart'),
        'icon' => 'local_mall',
        'active' => Route::currentRouteName() == 'cart',
        'is_blank' => false,
    ],
    [
        'name' => 'Contact',
        'route' => route('contact'),
        'icon' => 'pin_drop',
        'active' => Route::currentRouteName() == 'contact',
        'is_blank' => false,
    ],
    [
        'name' => 'About Us',
        'route' => route('about'),
        'icon' => 'info',
        'active' => Route::currentRouteName() == 'about',
        'is_blank' => false,
    ],
];

?>
<?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Administrator\Desktop\Caliburger&QR\resources\views/layouts/sidebar-items.blade.php ENDPATH**/ ?>