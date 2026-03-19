<?php $__env->startSection('title', 'Contact Us'); ?>

<?php $__env->startSection('content'); ?>


<link rel="stylesheet" href="<?php echo e(asset('css/productoverview.css')); ?>">

<div class="product-container">
    
    
    <div class="product-hero-card">
        
        
        <div class="product-image-area">
            <img class="contact-thumbnail" src="/images/contact-thumbnail.png" alt="Contact Us">
        </div>

        
        <div class="product-info-area">
            <span class="category-label">Get In Touch</span>
            <h1>Contact Us</h1>
            <p class="product-description" style="margin-bottom: 30px;">
                Have a question about our products or an existing order? Fill out the form below and our team will get back to you as soon as possible.
            </p>

            
            <form action="https://formspree.io/f/xkgljdwk" method="POST" style="display: flex; flex-direction: column; gap: 20px;">
                
                <div class="form-group">
                    <label style="color: var(--text-sub); font-size: 0.9rem; margin-bottom: 8px; display: block;">Full Name</label>
                    <input class="field-design" type="text" name="name" placeholder="Enter your name" required 
                           style="width: 70%; padding: 12px; background: var(--input-bg); border: 1px solid var(--input-border); border-radius: 8px; color: #fff;">
                </div>

                <div class="form-group">
                    <label style="color: var(--text-sub); font-size: 0.9rem; margin-bottom: 8px; display: block;">Email Address</label>
                    <input class="field-design" type="email" name="email" placeholder="email@example.com" required 
                           style="width: 70%; padding: 12px; background: var(--input-bg); border: 1px solid var(--input-border); border-radius: 8px; color: #fff;">
                </div>

                <div class="form-group">
                    <label style="color: var(--text-sub); font-size: 0.9rem; margin-bottom: 8px; display: block;">Message</label>
                    <textarea class="message-design" name="message" placeholder="How can we help?" rows="4" required 
                              style="width: 70%; padding: 12px; background: var(--input-bg); border: 1px solid var(--input-border); border-radius: 8px; color: #fff; font-family: inherit;"></textarea>
                </div>

                <button type="submit" class="btn-gradient-add" style="margin-top: 10px; border: none; cursor: pointer;">
                    <i class="fa-solid fa-paper-plane"></i> Send Message
                </button>
            </form>
        </div>
    </div>

    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
        <div class="card" style="padding: 25px; text-align: center; border-radius: 12px; background: var(--glass-bg); border: 1px solid var(--glass-border);">
            <i class="fa-solid fa-envelope" style="font-size: 2rem; color: #4a90e2; margin-bottom: 15px;"></i>
            <h3 style="margin-bottom: 10px;">Email Us</h3>
            <p style="color: var(--text-sub);">support@yourstore.com</p>
        </div>
        <div class="card" style="padding: 25px; text-align: center; border-radius: 12px; background: var(--glass-bg); border: 1px solid var(--glass-border);">
            <i class="fa-solid fa-location-dot" style="font-size: 2rem; color: #00C853; margin-bottom: 15px;"></i>
            <h3 style="margin-bottom: 10px;">Visit Us</h3>
            <p style="color: var(--text-sub);">123 Tech Lane, London, UK</p>
        </div>
    </div>
</div>

<footer id="footer" style="margin-top: 60px;"></footer>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Projects\CoreComponents\resources\views/pages/Contact.blade.php ENDPATH**/ ?>