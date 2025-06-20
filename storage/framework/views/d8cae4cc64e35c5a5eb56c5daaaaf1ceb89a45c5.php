<div id="popupCreate"></div>
<div id="loadpanel"></div>

<script>
    var loadPanel = $('#loadpanel').dxLoadPanel({
        shadingColor: 'rgba(0, 0, 0, 0.4)',
        position: {
            of: '#app'
        },
        visible: false,
        showIndicator: true,
    }).dxLoadPanel('instance');

    /**
     *
     * @param  url L'url de la vue a afficher dans le popup
     * @param  title Le Titre de la popup
     * @param  onSubmit la function à appeler quand on appuie sur le bouton enregister
     * @param  width [OPTIONAL] le width de la popup ( ex: 1000, 'auto' )
     * @param  height [OPTIONAL] le height de la popup ( ex: 500, 'auto')
     * @param  customButtons [OPTIONAL] un tableau comprenant des buttons de popup voir exemple ligne 57
     * @param  popupId [OPTIONAL] L'id de la popup que l'in crée ( si pas de valeur, default = popupCreate )
     * @param  followingFunctions [OPTIONAL] un function que l'on doit appeler apres que le onSubmit soit terminé
     */
    function popupCreate (url,title, onSubmit, width=400, height='auto', customButtons = null, popupId = 'popupCreate', followingFunctions = null)
    {
        loadPanel.show();

        $.get(url).done(function (response) {
            loadPanel.hide();

            $('#' + popupId).dxPopup({
                width: width,
                height: height,
                visible: true,
                showTitle: true,
                title: title,
                closeOnOutsideClick: false,
                contentTemplate(){
                    let scrollView = $('<div />');
                    scrollView.append(response);
                    scrollView.dxScrollView({
                        width: '100%',
                        height: '100%',
                    });
                    return scrollView;
                } ,
                toolbarItems: getButtons(onSubmit, customButtons, popupId, followingFunctions),

            });
        });
    }

    function popupCreateHide (popupId='popupCreate')
    {
        $('#' + popupId).dxPopup('instance').hide();

        setTimeout(function () {
            $('#' + popupId).dxPopup('dispose');
        }, 1000);
    }

    function getButtons(onSubmit, customButtons, popupId, followingFunctions)
    {
        let buttons = [{
            widget: "dxButton",
            toolbar: "bottom",
            location: "after",
            options: {
                text: "<?php echo app('translator')->get('Save'); ?>",
                onClick: function(e) {
                    $.when(onSubmit()).then(function(){
                        if(followingFunctions !== null) followingFunctions()
                    })
                },
            }
        }, {
            widget: "dxButton",
            toolbar: "bottom",
            location: "after",
            options: {
                text: "<?php echo app('translator')->get('Cancel'); ?>",
                onClick: function(e) {
                    popupCreateHide(popupId)
                }
            }
        }];

        if(customButtons){
            buttons = customButtons.concat(buttons);
        }

        return buttons;
    }
</script>

<style>
    .dx-popup-content{
        z-index: 1;
    }
</style><?php /**PATH /mnt/c/Projets/perso/hephaistos/resources/views/scripts/popupCreate.blade.php ENDPATH**/ ?>