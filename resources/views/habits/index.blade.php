<x-layout>
    @section('content')
        @include('habits.scripts.habitManager')
        <a class="btn btn-primary" onclick="window.habitManager.openHabitFormAddOrEditPopup()" icon="fa fa-plus">Ajouter</a>
        <div id='grid_habits' class='shadow' style='height: 650px;'></div>

        <script>

            window.HabitsDataGrid = {
                dataGridInstance: null,
                init() {
                    this.dataGridInstance = $("#grid_habits").dxDataGrid({
                        @lang('devextreme.dataGrid')
                        dataSource: HephaistosUtils.createCustomStore({
                            loadUrl: '{!! route('habits.json') !!}',
                            updateUrl: '{!! route('habits.update') !!}'
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
    @endsection
</x-layout>


