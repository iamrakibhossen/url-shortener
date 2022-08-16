<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">

        <script>
            window.loggedIn = <?php echo json_encode( Auth::check() , 15, 512) ?>;
            window.user = <?php echo json_encode( Auth::user(), JSON_PRETTY_PRINT, 512) ?>;
        </script>
        
    </head>
    <body class="bg-white">
        
        <div id="app">

            <main-component />

        </div>

        <script src="<?php echo e(asset('js/app.js')); ?>"></script>

    </body>
</html>
<?php /**PATH H:\urlshortner\resources\views/welcome.blade.php ENDPATH**/ ?>