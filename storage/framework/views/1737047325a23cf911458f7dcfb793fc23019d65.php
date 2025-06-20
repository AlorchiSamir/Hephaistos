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
        <a class="btn btn-primary" onclick="window.habitManager.openHabitFormAddOrEditPopup()" icon="fa fa-plus">Ajouter</a>
        <div id='grid_habits' class='shadow' style='height: 650px;'></div>

        <script>

            window.HabitsDataGrid = {
                dataGridInstance: null,
                init() {
                    this.dataGridInstance = $("#grid_habits").dxDataGrid({
                        <?php echo app('translator')->get('devextreme.dataGrid'); ?>
                        dataSource: HephaistosUtils.createCustomStore({
                            loadUrl: '<?php echo route('habits.json'); ?>',
                            updateUrl: '<?php echo route('habits.update'); ?>'
                        }),
                        editing:
                        {
                           allowUpdating: true,
                           mode: 'cell'
                        },
                        columns:
                            [
                                {
                                    caption: "#",
                                    dataField: "id",
                                    width: 100,
                                    alignment: "left",
                                },
                                {
                                    caption: "Nom",
                                    dataField: "name",
                                    alignment: "center",
                                },
                                {
                                    caption: "Description",
                                    dataField: "description",
                                    alignment: "center",
                                },
                                {
                                    caption: "Premier jour",
                                    dataField: "first_day",
                                    alignment: "center",
                                },
                            ],
                        showBorders: true,
                        loadPanel:
                            {
                                enabled: true
                            },

                        summary:
                            {
                                totalItems:
                                    [{
                                        column: "Fichier",
                                        summaryType: "count",
                                        customizeText: function (data) {
                                            return "Total: " + data.value + " importations";
                                        }
                                    }],
                            },

                        sorting:
                            {
                                mode: "multiple"
                            },

                        headerFilter:
                            {
                                visible: true,
                                allowSearch: true
                            },

                        searchPanel:
                            {
                                visible: true,
                                width: 240,
                                placeholder: "Rechercher..."
                            },


                        hoverStateEnabled: true,
                        scrolling:
                            {
                                mode: "virtual"
                            },

                        onContentReady: function (e) {
                            e.component.option("loadPanel.enabled", false);
                        },
                    }).dxDataGrid('instance');
                },
                update()
                {
                    var datagrid = $('#grid_habits').dxDataGrid('instance');
                    datagrid.refresh();
                }
            };

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


<?php /**PATH /mnt/c/Projets/perso/hephaistos/resources/views/habits/index.blade.php ENDPATH**/ ?>