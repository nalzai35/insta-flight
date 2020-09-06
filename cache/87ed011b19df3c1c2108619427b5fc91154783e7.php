<!doctype html>
<html>

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <style>body{font-family: 'Open Sans', sans-serif;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;}</style>
  <?php echo $__env->yieldContent('head'); ?>
  <?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>

<body>
  <!--ads/responsive-->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a href="<?php echo e(home_url()); ?>" class="navbar-brand"><?php echo e(site_name()); ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <?php $__currentLoopData = pages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li class="nav-item"><a class="nav-link" href="/pages/<?php echo e($page . '.html'); ?>"><?php echo e(ucwords(str_replace('-', ' ', $page))); ?></a></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
    </div>
  </nav>

  <?php echo $__env->yieldContent('content'); ?>

  <!--ads/responsive-->

  <footer class="footer border-top bg-light py-3">
    <div class="container">
      <ul class="list-inline m-0 text-center">
        <?php $__currentLoopData = pages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li class="list-inline-item">
            <a class="text-muted" href="/pages/<?php echo e($page . '.html'); ?>"><?php echo e(ucwords(str_replace('-', ' ', $page))); ?></a>
          </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js">
  </script>

  <?php echo $__env->make('bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

</html><?php /**PATH C:\laragon\www\insta-flight\views/layouts.blade.php ENDPATH**/ ?>