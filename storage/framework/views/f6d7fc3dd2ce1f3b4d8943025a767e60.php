<?php $__env->startSection('title', 'Product Listing'); ?>

<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="/css/seanstyles.css">
<link rel="stylesheet" href="<?php echo e(asset('css/productoverview.css')); ?>">




<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
    <div class="success-toast card" id="listing-toast" style="position: fixed; top: 20px; right: 20px; z-index: 2000;">
        <i class="fa-solid fa-circle-check"></i>
        <span><?php echo e(session('success')); ?></span>
    </div>
    <script>setTimeout(() => { document.getElementById('listing-toast')?.remove(); }, 4000);</script>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


<section class="filter-section" style="padding: 20px 0;">
    <div class="about-glass-card" style="padding: 15px 55px; margin: 0 auto 30px auto; max-width: 800px; border-radius: 15px;">
        <form method="GET" action="<?php echo e(route('products.list')); ?>" class="filter-form" style="display: flex; align-items: flex-end; gap: 15px;">
   
            <div style="flex: 1;">
                <label style="display: block; margin-bottom: 5px; font-size: 0.7rem; text-transform: uppercase; color: var(--text-sub); text-align: center;">Category</label>
                <select name="type" style="width: 100%; padding: 10px; background: var(--inner-bg); border: 1px solid var(--border-color); border-radius: 6px; color: #fff;">
                    <option value="">All</option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($t); ?>" <?php echo e(request('type') === $t ? 'selected' : ''); ?>><?php echo e(ucfirst($t)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </select>
            </div>

            <div style="flex: 1.2;">
                <label style="display: block; margin-bottom: 5px; font-size: 0.7rem; text-transform: uppercase; color: var(--text-sub); text-align: center;">Price Range</label>
                <div style="display: flex; gap: 5px;">
                    <input type="number" name="min_price" placeholder="Min" value="<?php echo e(request('min_price')); ?>" 
                           style="width: 50%; padding: 10px; background: var(--inner-bg); border: 1px solid var(--border-color); border-radius: 6px; color: #fff;">
                    <input type="number" name="max_price" placeholder="Max" value="<?php echo e(request('max_price')); ?>" 
                           style="width: 50%; padding: 10px; background: var(--inner-bg); border: 1px solid var(--border-color); border-radius: 6px; color: #fff;">
                </div>
            </div>

            <div style="flex: 1;">
                <label style="display: block; margin-bottom: 5px; font-size: 0.7rem; text-transform: uppercase; color: var(--text-sub); text-align: center;">Sort By</label>
                <select name="sort" style="width: 100%; padding: 10px; background: var(--inner-bg); border: 1px solid var(--border-color); border-radius: 6px; color: #fff;">
                    <option value="newest" <?php echo e(request('sort') == 'newest' ? 'selected' : ''); ?>>Newest</option>
                    <option value="price_asc" <?php echo e(request('sort') == 'price_asc' ? 'selected' : ''); ?>>Price: Low</option>
                    <option value="price_desc" <?php echo e(request('sort') == 'price_desc' ? 'selected' : ''); ?>>Price: High</option>
                </select>
            </div>

            <div style="display: flex; gap: 8px;">
                <button type="submit" class="btn-gradient-add" style="height: 40px; padding: 0 15px; font-size: 0.85rem;">Apply</button>
                <a href="<?php echo e(route('products.list')); ?>" class="btn-cancel-review" style="height: 40px; padding: 0 15px; font-size: 0.85rem; text-decoration: none; display: flex; align-items: center; background: rgba(255,255,255,0.05); border-radius: 8px;">Reset</a>
            </div>
        </form>
    </div>
</section>


<main class="product-listing-grid">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="about-glass-card" style="padding: 15px; display: flex; flex-direction: column; height: 85%; border-radius: 15px; position: relative;">
            
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->created_at->diffInDays() < 7): ?>
                <div class="product-badge badge-new">New</div>
            <?php elseif($product->reviews->avg('rating') >= 4.8): ?>
                <div class="product-badge badge-hot">Best Seller</div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <a href="<?php echo e(route('products.show', $product->id)); ?>" style="text-decoration: none; color: inherit; flex-grow: 1;">
                <div class="product-image-area" style="min-height: 180px; height: 180px; margin-bottom: 12px; background: var(--inner-bg); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <img src="<?php echo e($product->image_url); ?>" alt="<?php echo e($product->name); ?>" style="max-width: 90%; max-height: 140px; object-fit: contain;">
                </div>
                
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="color: #4a90e2; font-size: 0.65rem; text-transform: uppercase; font-weight: 700;"><?php echo e($product->type); ?></span>
                    <div style="color: #FFD700; font-size: 0.7rem;">
                        <i class="fa-solid fa-star"></i> 
                        <span style="color: var(--text-sub);"><?php echo e(number_format($product->reviews->avg('rating') ?: 0, 1)); ?></span>
                    </div>
                </div>

                <h3 style="margin: 8px 0 12px 0; font-size: 0.95rem; line-height: 1.4; height: 2.8em; overflow: hidden; font-weight: 600;"><?php echo e($product->name); ?></h3>
            </a>

            <div style="margin-top: auto; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 12px;">
                <p style="font-size: 1.2rem; font-weight: 800; color: #fff; margin-bottom: 12px;">£<?php echo e(number_format($product->price, 2)); ?></p>
                
                <div style="display: flex; flex-direction: column; gap: 8px;">
                    <button type="button" class="btn-bottleneck-glass" style="width: 100%; padding: 8px; font-size: 0.75rem;" 
                            onclick='openQuickView(<?php echo json_encode($product, 15, 512) ?>)'>
                        <i class="fa-solid fa-eye"></i> Quick View
                    </button>
                    
                    <form action="<?php echo e(route('basket.add')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                        <button type="submit" class="btn-gradient-add" style="width: 100%; padding: 10px; font-size: 0.8rem; display: flex; align-items: center; justify-content: center; gap: 8px;">
                            <i class="fa-solid fa-cart-shopping"></i> Add to Basket
                        </button>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div style="grid-column: 1 / -1; text-align: center; padding: 100px 0; opacity: 0.5;">
            <i class="fa-solid fa-box-open" style="font-size: 3rem; margin-bottom: 20px;"></i>
            <h3>No results found</h3>
            <p>Try adjusting your filters or search terms.</p>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</main>


<div id="quickview-modal" class="modal-overlay" onclick="closeQuickView(event)">
    <div class="modal-content card" onclick="event.stopPropagation()">
        <div style="flex: 1; background: var(--inner-bg); border-radius: 12px; display: flex; align-items: center; justify-content: center; padding: 20px;">
            <img id="qv-img" src="" style="max-width: 100%; max-height: 350px; object-fit: contain;">
        </div>

        <div style="flex: 1.2; text-align: left;">
            <span id="qv-type" class="category-label" style="font-size: 0.7rem;"></span>
            <h2 id="qv-name" style="margin: 10px 0; font-size: 1.8rem;"></h2>
            <div id="qv-price" class="price-display" style="font-size: 2rem; margin: 15px 0; color: #fff;"></div>
            
            <p id="qv-desc" style="font-size: 0.9rem; color: var(--text-sub); line-height: 1.6; margin-bottom: 25px; height: 120px; overflow-y: auto; padding-right: 10px;"></p>

            <div style="display: flex; gap: 12px;">
                <a id="qv-link" href="" class="btn-bottleneck-glass" style="flex: 1; text-decoration: none; display: flex; align-items: center; justify-content: center; font-size: 0.9rem;">Full Details</a>
                <form action="<?php echo e(route('basket.add')); ?>" method="POST" style="flex: 1.2;">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="product_id" id="qv-id" value="">
                    <button type="submit" class="btn-gradient-add" style="width: 100%; height: 50px;">Add to Basket</button>
                </form>
            </div>
        </div>
        
        <button onclick="document.getElementById('quickview-modal').classList.remove('show')" 
            style="position: absolute; top: 20px; right: 20px; background: none; border: none; color: #fff; cursor: pointer; font-size: 1.5rem; opacity: 0.5;">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
</div>

<script>
    function openQuickView(product) {
        document.getElementById('qv-img').src = product.image_url;
        document.getElementById('qv-name').innerText = product.name;
        document.getElementById('qv-type').innerText = product.type.toUpperCase();
        document.getElementById('qv-price').innerText = '£' + parseFloat(product.price).toFixed(2);
        document.getElementById('qv-desc').innerText = product.description;
        document.getElementById('qv-id').value = product.id;
        document.getElementById('qv-link').href = "/products/" + product.id;
        document.getElementById('quickview-modal').classList.add('show');
    }

    function closeQuickView(event) {
        document.getElementById('quickview-modal').classList.remove('show');
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Projects\CoreComponents\resources\views/pages/ProductListing.blade.php ENDPATH**/ ?>