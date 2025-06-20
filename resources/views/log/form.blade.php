<x-layout>
    @section('content')
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
                    value: '{!! $day->log !!}',
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
                url: '{!! route('log.store') !!}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        log : value,
                        day_id : {{ $day->id }}
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
                            window.location.href = "{{ route('log.index') }}";
                        }
                    },
                    error (xhr)
                    {
                        alert('@lang('Error') - ' + xhr.status + ': ' + xhr.statusText);
                    }
                })
        }

        $(function () {
            window.LogFormDataGrid.init();
            window.ValidButtonDataGrid.init();
        });


    </script>
    @endsection
</x-layout>
