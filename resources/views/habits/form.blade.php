<div id="habit-form"></div>

<script>
    window.habitForm = {
        formInstance: null,
        formData: {!! json_encode($habit) !!},
        init() {
            this.formInstance = $("#habit-form").dxForm({
                formData: this.formData,
                readOnly: '{!! isset($readOnly) ? $readOnly : false !!}',
                labelLocation: 'left',
                items: [
                    {
                        itemType: 'group',
                        colCount: 1,
                        items: [

                            {
                                dataField: 'name',
                                colSpan: 2,
                                label: {text: 'Nom'},
                                isRequired: true,
                            },
                            {
                                dataField: 'description',
                                colSpan: 5,
                                label: {text: 'Description'},
                                isRequired: true,
                                editorType: 'dxTextArea',
                                editorOptions: {
                                    placeholder: 'Description',
                                    height: 150,
                                }
                            },
                            {
                                dataField: 'xp',
                                colSpan: 2,
                                label: {text: 'Experience'},
                                isRequired: true,
                            },
                            {
                                dataField: 'countable',
                                label: 'countable',
                                width: 100,
                                editorType: 'dxCheckBox',
                                editorOptions: {
                                    displayExpr: 'countable',
                                    valueExpr: 'countable',
                                }
                            }
                        ]
                    }
                ]
            }).dxForm('instance');
        }
    }

    $(function () {
        window.habitForm.init();
    })
</script>
