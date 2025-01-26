
<?php $__env->startSection('title', 'User Manager'); ?>
<?php $__env->startSection('page_name', 'User Manager'); ?>

<?php $__env->startSection('content'); ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex mb-3">
                <a class="btn btn-primary px-4 ms-auto" href="<?php echo e(route('admin.users.create')); ?>">Create New User</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($user->name); ?></td>
                                <td><a class="link-primary" href="mailto:<?php echo e($user->email); ?>"><?php echo e($user->email); ?></a></td>
                                <td>
                                    <form action="<?php echo e(route('admin.users.destroy', $user)); ?>" method="POST"
                                        onSubmit="return confirm('Are you sure?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-link p-0 m-0 text-danger">Delete</button>
                                    </form>
                                </td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php echo e($users->links()); ?>


            </div>

        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/caliisbw/public_html/resources/views/admin/users/index.blade.php ENDPATH**/ ?>