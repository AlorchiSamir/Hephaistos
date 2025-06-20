@include('scripts.popupCreate')
@include('scripts.popupDelete')

<script>
    window.habitdayManager = {
        openHabitdayFormAddOrEditPopup(id=0){
            if(id){
                let URL = '{!! route('habitday.form', ['day' => '__ID__']) !!}'.replace('__ID__', id);
                popupCreate(URL,'@lang("tasks.Edit_task")', this.submit, 700, '90%');
            }
            else{
                popupCreate('{!! route('habitday.form') !!}','@lang("tasks.Add_new_task")', this.submit, 700, '90%');
            }
        },
        submit(){
            let habitdayFormInstance = window.habitdayForm.formInstance;
            if(!habitdayFormInstance.validate().isValid) return;

            let values = habitdayFormInstance.option('formData');

            $.ajax({
                url: '{!! route('habitday.store') !!}',
                method: 'POST',
                data: values,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success (response)
                {
                    if (response.error)
                    {
                        console.error(response.message);
                        return;
                    }else{
                        popupCreateHide();
                    }

                    if ( window.HabitdayDataGrid.dataGridInstance )
                    {
                        window.HabitdayDataGrid.dataGridInstance.refresh();
                    }


                },
                error (xhr)
                {
                    alert('@lang('Error') - ' + xhr.status + ': ' + xhr.statusText);
                }
            })
        }
    }
</script>
