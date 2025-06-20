<?php echo $__env->make('scripts.popupCreate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('scripts.popupDelete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>
    window.habitManager = {
        openHabitFormAddOrEditPopup(id=0){
            if(id){
                let URL = '<?php echo route('habits.form', ['habit' => '__ID__']); ?>'.replace('__ID__', id);
                popupCreate(URL,'<?php echo app('translator')->get("tasks.Edit_task"); ?>', this.submit, 700, '90%');
            }
            else{
                popupCreate('<?php echo route('habits.form'); ?>','<?php echo app('translator')->get("tasks.Add_new_task"); ?>', this.submit, 700, '90%');
            }
        },
        submit(){
            let habitFormInstance = window.habitForm.formInstance;
            if(!habitFormInstance.validate().isValid) return;

            let values = habitFormInstance.option('formData');

            $.ajax({
                url: '<?php echo route('habits.store'); ?>',
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
                    alert('<?php echo app('translator')->get('Error'); ?> - ' + xhr.status + ': ' + xhr.statusText);
                }
            })
        }
    }
</script>
<?php /**PATH /mnt/c/Projets/perso/hephaistos/resources/views/habits/scripts/habitManager.blade.php ENDPATH**/ ?>