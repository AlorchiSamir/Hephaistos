<div id="habitday-form"></div>

<script>
    window.habitdayForm = {
        formInstance: null,
        formData: {!! json_encode($habits) !!},
        init() {
            this.formInstance = $("#habitday-form").dxForm({
                formData: this.formData,
                readOnly: '{!! isset($readOnly) ? $readOnly : false !!}',
                labelLocation: 'left',
                items: [
                    {
                        itemType: 'group',
                        colCount: 1,
                        items: [
                            @foreach($habits as $habit)
                            {
                                dataField: '{{ $habit->name }}',
                                label: '{{ $habit->name}}',
                                width: 100,
                                editorType: 'dxCheckBox',
                                editorOptions: {
                                    displayExpr: '{{ $habit->name }}',
                                    valueExpr: '{{ $habit->name }}',
                                }
                            },
                            @endforeach
                        ]
                    }
                ]
            }).dxForm('instance');
        }
    }

    $(function () {
        window.habitdayForm.init();
    })
</script>
