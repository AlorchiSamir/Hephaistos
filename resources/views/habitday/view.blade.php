<x-layout>
    @section('content')
        @include('habits.scripts.habitManager')
        <a class="btn btn-primary" onclick="window.habitManager.openHabitFormAddOrEditPopup()" icon="fa fa-plus">ADD</a>
        <div id='grid_habitday_view' class='shadow' style='height: 650px'></div>

        <script>

            window.HabitsDataGrid = {
                init() {
                    $("#grid_habitday_view").dxDataGrid({
                        width: '50%',
                        dataSource: HephaistosUtils.createCustomStore({
                            loadUrl: '{!! route('habitday.view_json', ['day' => $day]) !!}',
                            updateUrl: '{!! route('habitday.update', ['day' => $day]) !!}'
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
    @endsection
</x-layout>


