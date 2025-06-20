<?php
return [
    "dataGrid" => "
        allowColumnReordering: true,
        allowColumnResizing: false,
        columnAutoWidth: true,
        columnResizingMode: \"widget\",
        scrolling: {
            mode: \"virtual\"
        },
        filterRow: { visible: false },
        columnHidingEnabled: true,
        showBorders: false,
        hoverStateEnabled: true,
        sorting: {
            mode: \"multiple\"
        },
        columnChooser: {
            enabled: true
        },
        searchPanel: {
            visible: true,
        },
        headerFilter: {
            visible: true,
            allowSearch: true
        },
        groupPanel: {
            visible: true
        },
        export: {
                enabled: true,
                allowExportSelectedData: true
            },
        height: contentHeight,
    ",
    "dataGrid_lite" => "
        allowColumnReordering: true,
        allowColumnResizing: true,
        columnAutoWidth: true,
        allowColumnResizing: true,
        columnResizingMode: \"widget\",
        scrolling: {
            mode: \"virtual\"
        },
        showBorders: false,
        hoverStateEnabled: true,
        sorting: {
            mode: \"multiple\"
        },
        headerFilter: {
            visible: true
        },
        height: contentHeight,
    ",
    "dataGrid_storing_local" => 'stateStoring: {
                enabled: true,
                type: "localStorage",
                storageKey: ":key"
            },',
    "datagrid_storing" => 'stateStoring: {
                enabled: true,
                type: "localStorage",
                storageKey: ":key"
            },',
];
