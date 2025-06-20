<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.layout','data' => []] + (isset($attributes) ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php $__env->startSection('content'); ?>
    <div class="log-editor"></div>
    <div>
       <div id="valid-button" class="btn"></div>
    </div>

    <script>

        window.LogFormDataGrid = {
            dataGridInstance: null,
            init() {
                this.dataGridInstance = $('.log-editor').dxHtmlEditor({
                    height: 725,
                    value: '<?php echo $day->log; ?>',
                    toolbar: {
                        items: [
                            'undo', 'redo', 'separator',
                            {
                                name: 'size',
                                acceptedValues: ['8pt', '10pt', '12pt', '14pt', '18pt', '24pt', '36pt'],
                            },
                            {
                                name: 'font',
                                acceptedValues: ['Arial', 'Courier New', 'Georgia', 'Impact', 'Lucida Console', 'Tahoma', 'Times New Roman', 'Verdana'],
                            },
                            'separator', 'bold', 'italic', 'strike', 'underline', 'separator',
                            'alignLeft', 'alignCenter', 'alignRight', 'alignJustify', 'separator',
                            'orderedList', 'bulletList', 'separator',
                            {
                                name: 'header',
                                acceptedValues: [false, 1, 2, 3, 4, 5],
                            }, 'separator',
                            'color', 'background', 'separator',
                            'link', 'image', 'separator',
                            'clear', 'codeBlock', 'blockquote', 'separator',
                            'insertTable', 'deleteTable',
                            'insertRowAbove', 'insertRowBelow', 'deleteRow',
                            'insertColumnLeft', 'insertColumnRight', 'deleteColumn',
                        ],
                    },
                    mediaResizing: {
                        enabled: true,
                    },
                }).dxHtmlEditor('instance');
            }
        };

        window.ValidButtonDataGrid = {
            dataGridInstance: null,
            init(){
                this.dataGridInstance = $('#valid-button').dxButton({
                    stylingMode: 'contained',
                    text: 'Envoyer',
                    type: 'default',
                    width: 250,
                    useSubmitBehavior: true,
                    onClick() {
                        submit();
                    },
                });
            },


        };

        function submit(){

            var value = window.LogFormDataGrid.dataGridInstance.option("value");

            $.ajax({
                url: '<?php echo route('log.store'); ?>',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        log : value,
                        day_id : <?php echo e($day->id); ?>

                    },
                    success (response)
                    {
                        if ( response.error )
                        {
                            console.error(response.message);
                            return;
                        }
                        else
                        {
                            window.location.href = "<?php echo e(route('log.index')); ?>";
                        }
                    },
                    error (xhr)
                    {
                        alert('<?php echo app('translator')->get('Error'); ?> - ' + xhr.status + ': ' + xhr.statusText);
                    }
                })
        }

        $(function () {
            window.LogFormDataGrid.init();
            window.ValidButtonDataGrid.init();
        });


    </script>
    <?php $__env->stopSection(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php /**PATH /mnt/c/Projets/perso/hephaistos/resources/views/log/form.blade.php ENDPATH**/ ?>