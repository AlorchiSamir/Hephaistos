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
        <?php echo $__env->make('habits.scripts.habitManager', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <a class="btn btn-primary" onclick="window.habitManager.openHabitFormAddOrEditPopup()" icon="fa fa-plus">ADD</a>
        <div id='grid_habitday_view' class='shadow' style='height: 650px'></div>

        <script>

            window.HabitsDataGrid = {
                init() {
                    $("#grid_habitday_view").dxDataGrid({
                        width: '50%',
                        dataSource: HephaistosUtils.createCustomStore({
                            loadUrl: '<?php echo route('habitday.view_json', ['day' => $day]); ?>',
                            updateUrl: '<?php echo route('habitday.update', ['day' => $day]); ?>'
                        }, 'id'),
                        paging: {
                            pageSize: 10
                        },
                        pager: {
                            showPageSizeSelector: true,
                            allowedPageSizes: [10],
                            showInfo: true
                        },
                        editing: {
                            allowUpdating: true,
                            mode: 'cell'
                        },
                        columns:
                            [
                                {
                                    caption: "Id",
                                    dataField: "id",
                                    alignment: "center",
                                    width: 100
                                },
                                {
                                    caption: "Nom",
                                    dataField: "name",
                                    alignment: "center",
                                    width: 500
                                },
                                {

                                    dataField: 'counter',
                                    caption: "Compteur",
                                    width: 50,
                                    cellTemplate: counter,
                                },
                                {
                                    dataField: 'gold',
                                    caption: "Gold",
                                    alignment: "center",
                                    fixed: true,
                                    fixedPosition: 'right',
                                    width: 100,
                                    editorType: 'dxCheckBox',
                                    editorOptions: {
                                        displayExpr: 'gold',
                                        valueExpr: 'gold',
                                    }
                                },
                                {
                                    dataField: 'active',
                                    caption: "Active",
                                    alignment: "center",
                                    fixed: true,
                                    fixedPosition: 'right',
                                    width: 100,
                                    editorType: 'dxCheckBox',
                                    editorOptions: {
                                        displayExpr: 'active',
                                        valueExpr: 'active',
                                    }
                                },
                            ],
                        showBorders: true,
                        searchPanel:
                            {
                                visible: true,
                                width: 240,
                                placeholder: "Rechercher..."
                            },
                        scrolling:
                            {
                                mode: "virtual"
                            },
                    }).dxDataGrid("instance");
                },



                   /* cellCheckbox(container, options){

                        let switchButton = $("<div/>").dxCheckBox({
                            value: options.value,
                        });

                        container.append(switchButton);
                    }*/

            };

            const counter = function (container, options){
                if(options.data.habit.countable)
                {
                    $('<div/>').dxNumberBox({
                        displayExpr: 'counter',
                        value: options.data.counter,
                    }).appendTo(container);
                }
            }

            $(function () {
                window.HabitsDataGrid.init();
            });
        </script>
    <?php $__env->stopSection(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>


<?php /**PATH /mnt/c/Projets/perso/hephaistos/resources/views/habitday/view.blade.php ENDPATH**/ ?>