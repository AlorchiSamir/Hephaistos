<x-layout>

    @section('content')
        <div class='dg-border'>
            <div class='dg-display'>
                <div id='gridContainer' style='height: 650px;'></div>
            </div>
        </div>
        <script>

            window.DaysDataGrid = {
                init() {
                    $('#gridContainer').dxDataGrid({
                        @lang('devextreme.dataGrid')
                        dataSource: '{!! route('log.json') !!}',
                        keyExpr: 'id',
                        height: "100%",
                        grouping: {
                            autoExpandAll: true,
                        },
                        paging: {
                            pageSize: 30,
                        },
                        columns: [
                            {
                                caption: "Protocole",
                                dataField: "nbr_rows",
                                alignment: "center",
                                cssClass: "mini-progress",
                                width: 200,
                                cellTemplate: function (container, options, data)
                                {
                                    $("<div style='cursor: pointer'><span>Habitudes : </span>").append("<div class='progress mt-1'><div id='import_" + options.data.id + "' data-id='" + options.data.id + "' class='progress-bar bg-success' role='progressbar' aria-valuenow='" + options.data.protocole.total_habits + "' aria-valuemin='0' aria-valuemax='" + options.value + "'style='width: " + options.data.protocole.currentPrc + "%;'>" + options.data.protocole.nbr_habits + " / " + options.data.protocole.total_habits + "</div> </div>")
                                        .appendTo(container).click(function () {
                                        window.location.href=options.data.url.view;
                                    }) ;
                                }
                            },
                            {
                                caption: "Entrée",
                                dataField: "nbr_rows",
                                alignment: "center",
                                width: 200,
                                cellTemplate: function (container, options, data)
                                {
                                    if(options.data.log.exist)
                                    {
                                        $("<div style='cursor: pointer'>").append("<i style='color:green' class='fas fa-check-circle'></i>")
                                            .appendTo(container).click(function () {
                                            window.location.href=options.data.log.url;
                                        }) ;
                                    }
                                    else
                                    {
                                        $("<div style='cursor: pointer'>").append("<i style='color:red' class='fas fa-times-circle'></i>")
                                            .appendTo(container).click(function () {
                                            window.location.href=options.data.log.url;
                                        }) ;
                                    }
                                }
                            },
                            'Journal',
                            {
                                dataField: 'day',
                                caption: 'Jour',
                                alignment: "center",
                                groupIndex: 0,

                            }
                        ],
                    });
                }
            };

            $(function () {
                window.DaysDataGrid.init();
            });
        </script>
    @endsection

</x-layout>

