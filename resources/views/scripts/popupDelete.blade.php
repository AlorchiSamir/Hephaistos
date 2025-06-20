<div id="popupDelete"></div>
<div id="loadpanel"></div>

<script>
    function popupDelete(text, onSubmit) {
        $('#popupDelete').dxPopup({
            width: 400,
            height: 'auto',
            visible: true,
            showTitle: false,
            closeOnOutsideClick: false,
            contentTemplate() {
                return $("<div style='text-align: center'>").append(text)
            },
            toolbarItems: [{
                widget: "dxButton",
                toolbar: "bottom",
                location: "center",
                options: {
                    text: "@lang('Delete')",
                    onClick: function (e) {
                        onSubmit()
                    },
                }
            }, {
                widget: "dxButton",
                toolbar: "bottom",
                location: "center",
                options: {
                    text: "@lang('Cancel')",
                    onClick: function (e) {
                        popupDeleteHide()
                    }
                }
            }]

        });
    }

    function popupDeleteHide() {
        $('#popupDelete').dxPopup('instance').hide();
    }

</script>