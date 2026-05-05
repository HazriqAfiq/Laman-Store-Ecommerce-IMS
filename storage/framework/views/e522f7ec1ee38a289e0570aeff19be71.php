<?php if($paginator->hasPages()): ?>
    <nav role="navigation" aria-label="<?php echo e(__('Pagination Navigation')); ?>" class="flex items-center gap-6">
        
        <?php if($paginator->onFirstPage()): ?>
            <span class="w-12 h-12 flex items-center justify-center rounded-full border border-gray-100 text-gray-200 cursor-not-allowed">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </span>
        <?php else: ?>
            <a href="<?php echo e($paginator->previousPageUrl()); ?>" 
               class="w-12 h-12 flex items-center justify-center rounded-full border border-gray-200 text-gray-400 hover:border-black hover:text-black transition-all duration-500 ajax-link"
               rel="prev">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </a>
        <?php endif; ?>

        
        <div class="flex items-center gap-3">
            <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                <?php if(is_string($element)): ?>
                    <span class="text-gray-300 text-[10px] font-bold uppercase tracking-widest px-2"><?php echo e($element); ?></span>
                <?php endif; ?>

                
                <?php if(is_array($element)): ?>
                    <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($page == $paginator->currentPage()): ?>
                            <span class="w-12 h-12 flex items-center justify-center rounded-full bg-black text-white text-[10px] font-black tracking-widest shadow-xl shadow-black/10">
                                <?php echo e($page); ?>

                            </span>
                        <?php else: ?>
                            <a href="<?php echo e($url); ?>" 
                               class="w-12 h-12 flex items-center justify-center rounded-full border border-gray-100 text-gray-400 text-[10px] font-bold tracking-widest hover:border-black hover:text-black transition-all duration-500 ajax-link">
                                <?php echo e($page); ?>

                            </a>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <?php if($paginator->hasMorePages()): ?>
            <a href="<?php echo e($paginator->nextPageUrl()); ?>" 
               class="w-12 h-12 flex items-center justify-center rounded-full border border-gray-200 text-gray-400 hover:border-black hover:text-black transition-all duration-500 ajax-link"
               rel="next">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>
        <?php else: ?>
            <span class="w-12 h-12 flex items-center justify-center rounded-full border border-gray-100 text-gray-200 cursor-not-allowed">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </span>
        <?php endif; ?>
    </nav>
<?php endif; ?>
<?php /**PATH C:\Users\USER\Documents\Project Code\rpims\resources\views/vendor/pagination/simple-luxury.blade.php ENDPATH**/ ?>