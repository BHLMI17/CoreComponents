<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'CoreComponents'); ?></title>

    <link rel="stylesheet" href="/css/samistyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <script src="/js/script.js"></script>
</head>

<body>

    
    <?php echo $__env->make('layouts.partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>
<script>
    // Function to switch themes
    function toggleTheme() {
        const htmlElement = document.documentElement; // This is the <html> tag
        const currentTheme = htmlElement.getAttribute('data-theme');
        
        // If it's light, make it dark. If it's dark, make it light.
        const newTheme = (currentTheme === 'light') ? 'dark' : 'light';
        
        htmlElement.setAttribute('data-theme', newTheme);
        
        // Save the choice so it persists on other pages
        localStorage.setItem('theme', newTheme);
    }

    // Function to apply the saved theme immediately when a new page loads
    (function initTheme() {
        const savedTheme = localStorage.getItem('theme') || 'dark'; // Default to dark
        document.documentElement.setAttribute('data-theme', savedTheme);
    })();
</script>
</body>
</html><?php /**PATH C:\Projects\CoreComponents\resources\views/layouts/main.blade.php ENDPATH**/ ?>