<nav class="navbar navbar-expand-lg navbar-dark bg-bruvs shadow-sm fixed-top">
    <div class="container-fluid">
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="offcanvas" href="#offcanvasSidebar" role="button"
                    aria-controls="offcanvasSidebar">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        x="0px" y="0px" viewBox="0 0 384 384"  class="text-white"
                        xml:space="preserve" style="height: 1.5rem;width: 1.5rem;enable-background:new 0 0 384 384;" fill="#fff">
                        <g>
                            <rect y="288.9" width="190" height="31.2"></rect>
                            <rect y="169.8" width="330" height="31.2"></rect>
                            <rect y="63.9" width="190" height="31.2"></rect>
                        </g>
                    </svg>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav mx-auto">
            <li class="nav-item">
                <a class="navbar-brand font-cinzel text-decoration-none fw-semi-bold fs-4 m-0"
                    href="<?php echo e(route('home')); ?>">
                    <img src="<?php echo e(asset('images/webp/logo-header.webp')); ?>" alt="Caliburger" height="35">
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ms-md-auto">
            <li class="nav-item">
                <cart-button-component></cart-button-component>
            </li>
        </ul>
    </div>
</nav>
<?php /**PATH C:\Users\Administrator\Desktop\Caliburger_QR\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>