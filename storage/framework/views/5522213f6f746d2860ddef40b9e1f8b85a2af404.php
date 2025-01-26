    <?php if($message = Session::get('success')): ?>

        <div class="alert alert-success alert-dismissible position-relative overflow-hidden fade show shadow "
            style="pointer-events: auto;" role="alert">
            <?php echo e($message); ?>

            <a href="#" class="float-end text-decoration-none" data-bs-dismiss="alert" aria-label="Close">Close</a>
        </div>
    <?php endif; ?>


    <?php if($message = Session::get('error')): ?>

        <div class="alert alert-danger alert-dismissible position-relative overflow-hidden fade show shadow "
            style="pointer-events: auto;" role="alert">
            <?php echo e($message); ?>

            <a href="#" class="float-end text-decoration-none" data-bs-dismiss="alert" aria-label="Close">Close</a>
        </div>
    <?php endif; ?>


    <?php if($message = Session::get('warning')): ?>

        <div class="alert alert-warning alert-dismissible position-relative overflow-hidden fade show shadow "
            style="pointer-events: auto;" role="alert">
            <?php echo e($message); ?>

            <a href="#" class="float-end text-decoration-none" data-bs-dismiss="alert" aria-label="Close">Close</a>
        </div>
    <?php endif; ?>


    <?php if($message = Session::get('info')): ?>
        <div class="alert alert-info alert-dismissible position-relative overflow-hidden fade show shadow "
            style="pointer-events: auto;" role="alert">
            <?php echo e($message); ?>

            <a href="#" class="float-end text-decoration-none" data-bs-dismiss="alert" aria-label="Close">Close</a>
        </div>
    <?php endif; ?>

<?php /**PATH /home/caliisbw/special-bites.com/resources/views/alerts/show.blade.php ENDPATH**/ ?>