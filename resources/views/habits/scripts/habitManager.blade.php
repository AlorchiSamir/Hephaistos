@include('scripts.popupCreate')
@include('scripts.popupDelete')

<script>
    window.habitManager = {
        openHabitFormAddOrEditPopup(id=0){
            if(id){
                let URL = '{!! route('habits.form', ['habit' => '__ID__']) !!}'.replace('__ID__', id);
                popupCreate(URL,'@lang("tasks.Edit_task")', this.submit, 700, '90%');
            }
            else{
                popupCreate('{!! route('habits.form') !!}','@lang("tasks.Add_new_task")', this.submit, 700, '90%');
            }
        },
        submit(){
            let habitFormInstance = window.habitForm.formInstance;
            if(!habitFormInstance.validate().isValid) return;

            let values = habitFormInstance.option('formData');

            $.ajax({
                url: '{!! route('habits.store') !!}',
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

                    if ( window.HabitsDataGrid.dataGridInstance )
                    {
                        window.HabitsDataGrid.dataGridInstance.refresh();
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
