<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.layout','data' => []] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

<?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <div class="card miniform">
            <div class="card-header">
                <div><?php echo e($day->day); ?></div>
            </div>
            <div class="card-body">
                <div style="width: 50%; float: left; margin-top: 10px">
                    <div>
                        <?php if(!is_null($day->log)): ?>
                            <?php echo $day->log; ?>

                        <?php else: ?>
                            <a class='btn btn-primary' href="<?php echo e(route('log.form', ['day' => $day->id])); ?>">Ajouter une entrée du journal</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <br>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php /**PATH /mnt/c/Projets/perso/hephaistos/resources/views/log/index.blade.php ENDPATH**/ ?>