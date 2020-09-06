

<?php $__env->startSection('head'); ?>
<title><?php echo e(site_name()); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-5">
        <div class="text-center">
            <h2>Popular Hashtags</h2>
            <div class="mt-4">
                <ul class="list-inline">
                    <?php $__currentLoopData = collect(hashtags())->shuffle()->take(33); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-inline-item py-1 px-2 rounded bg-light mb-3 border">
                        <a href="<?php echo e(hashtag_url($item)); ?>">#<?php echo e($item); ?></a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="bg-light">
        <div class="container py-5">
            <div class="row">
                <div class="col-12 mb-4 text-center">
                    <h2>Popular Posts</h2>
                </div>
                <?php
                    $tag = collect(hashtags())->shuffle()->take(1)[0];
                ?>
                <?php $__currentLoopData = collect(get_data($tag))->chunk(5)->toArray(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = collect($items)->shuffle()->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($key == 1): ?>
                            <div class="col-md-4 mb-3">
                                <!--ads/responsive-->
                            </div>
                        <?php endif; ?>
                        <?php
                            $data = collect($item)->collapse()->all();
                        ?>
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <img src="<?php echo e($data['image']); ?>" class="card-img-top" alt="<?php echo e($data['caption']); ?>">
                                <div class="card-body">
                                    <p class="card-text small text-muted" style="max-height: 5rem; overflow: auto;"><?php echo e($data['caption']); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4 mb-3">
                        <!--ads/responsive-->
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\insta-flight\views/home.blade.php ENDPATH**/ ?>