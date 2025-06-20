window.HephaistosUtils = {
    CSRFToken: null,
    defaultShowConfirmation: true,
    defaultShowToast: true,
    /**
     * Get the CSRF token in the page if not set.
     *
     * @internal
     * @return boolean
     */
    _checkCSRFToken () {
        if ( this.CSRFToken )
            return true;

        const token = $('meta[name="csrf-token"]').attr('content');

        if ( !token )
            return false;

        this.CSRFToken = token;

        return true;
    },
    /**
     * Send an error report.
     *
     * @internal
     * @param serverMessage Message from the server.
     * @param localMessage Message locally set by the script.
     * @param data Raw data.
     * @param showToast Display toast or not.
     */
    _sendError (serverMessage, localMessage, data, showToast = true) {
        console.log('Sending the error report ...');

        const thisUtils = this;

        thisUtils._checkCSRFToken();

        $.ajax({
            url: '/ajax-transaction-error',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': thisUtils.CSRFToken
            },
            data: {
                server_message: serverMessage,
                local_message: localMessage,
                data: data
            },
            success (response, textStatus, jqXHR) {
                if ( response.error )
                {
                    console.error("%s\nText status: %s", response.message, textStatus);

                    if ( showToast )
                    {
                        DevExpress.ui.notify('Impossible d\'envoyer le rapport !', 'error', 1500);
                    }
                }
                else
                {
                    if ( showToast )
                    {
                        DevExpress.ui.notify('Rapport envoyé !', 'success', 1500);
                    }
                }
            },
            error (jqXHR, textStatus, errorThrown) {
                console.error(textStatus, errorThrown);

                if ( showToast )
                {
                    DevExpress.ui.notify('Impossible d\'envoyer le rapport !', 'error', 1500);
                }
            }
        });
    },
    /**
     * Fire the ajax transaction error report. This can be silent or with confirmation.
     *
     * @param serverMessage Message from the server.
     * @param localMessage Message locally set by the script.
     * @param data Raw data.
     * @param showConfirmation Display or not the confirmation dialog.
     * @param showToast Display toast or not.
     */
    fireAjaxTransactionErrorReport (serverMessage, localMessage = '', data = null, showConfirmation = true, showToast = true) {
        /* NOTE: On affiche le message dans la console. */
        console.error("Ajax transaction error !\nServer message : %s\nLocal message: %s\n", serverMessage, localMessage);

        if ( showToast )
        {
            DevExpress.ui.notify('Erreur du serveur !', 'error', 1500);
        }

        const thisUtils = this;

        if ( showConfirmation )
        {
            const result = DevExpress.ui.dialog.confirm('<i>Envoyer un rapport ?</i>', 'Une erreur est survenue !');

            result.done(function (dialogResult) {
                if ( !dialogResult )
                    return;

                thisUtils._sendError(serverMessage, localMessage, data);
            });
        }
        else
        {
            thisUtils._sendError(serverMessage, localMessage, data, showToast);
        }
    },
    /**
     * Creates and return a custom store compatible with our controllers taking cares of Json response.
     *
     * @param routes A string of an unique route responding to all CRUD methods or an array with splitted routes.
     * @param storeKey The key parameter of the store. Default 'id'.
     * @param additionalMethods Additional method to pass to the store. Default null.
     * @return DevExpress.data.CustomStore
     */
    createCustomStore (routes, storeKey = 'id', additionalMethods = null) {

        const isObject = typeof routes === 'object';

        const thisUtils = this;

        thisUtils._checkCSRFToken();

        let options = {
            key: storeKey,
            load () {
                const URL = isObject ? routes.loadUrl : routes;

                return $.ajax({
                    url: URL,
                    method: 'GET',
                    error (jqXHR, textStatus, errorThrown) {
                        thisUtils.fireAjaxTransactionErrorReport(
                            textStatus + ( typeof errorThrown === 'string' ? ' | ' + errorThrown : ''),
                            'DevExtreme custom store at load operation with URL: ' + URL + '.',
                            errorThrown,
                            thisUtils.defaultShowConfirmation,
                            thisUtils.defaultShowToast
                        );
                    },
                    dataType: 'json'
                });
            },
            insert (values) {
                const URL = isObject ? routes.insertUrl : routes;

                return $.ajax({
                    url: URL,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': thisUtils.CSRFToken
                    },
                    data: {
                        values: values
                    },
                    success (response, textStatus, jqXHR) {
                        if ( response.error )
                        {
                            thisUtils.fireAjaxTransactionErrorReport(
                                response.message + "\nText status: " + textStatus,
                                'DevExtreme custom store at insert operation with URL: ' + URL + '.',
                                response.data,
                                thisUtils.defaultShowConfirmation,
                                thisUtils.defaultShowToast
                            );

                            return;
                        }
                    },
                    error (jqXHR, textStatus, errorThrown) {
                        thisUtils.fireAjaxTransactionErrorReport(
                            textStatus + ( typeof errorThrown === 'string' ? ' | ' + errorThrown : ''),
                            'DevExtreme custom store at insert operation with URL: ' + URL + '.',
                            errorThrown,
                            thisUtils.defaultShowConfirmation,
                            thisUtils.defaultShowToast
                        );
                    },
                    dataType: 'json'
                });
            },
            update (key, values) {
                const URL = isObject ? routes.updateUrl : routes;

                console.log('eee');

                return $.ajax({
                    url: URL,
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': thisUtils.CSRFToken
                    },
                    data: {
                        id: key,
                        values: values
                    },
                    success (response, textStatus, jqXHR) {
                        if ( response.error )
                        {
                            console.log(response.error);
                            thisUtils.fireAjaxTransactionErrorReport(
                                response.message + "\nText status: " + textStatus,
                                'DevExtreme custom store at update operation with URL: ' + URL + '.',
                                response.data,
                                thisUtils.defaultShowConfirmation,
                                thisUtils.defaultShowToast
                            );

                            return;
                        }
                    },
                    error (jqXHR, textStatus, errorThrown) {
                        console.log(errorThrown);
                        thisUtils.fireAjaxTransactionErrorReport(
                            textStatus + ( typeof errorThrown === 'string' ? ' | ' + errorThrown : ''),
                            'DevExtreme custom store at update operation with URL: ' + URL + '.',
                            errorThrown,
                            thisUtils.defaultShowConfirmation,
                            thisUtils.defaultShowToast
                        );
                    },
                    dataType: 'json'
                });
            },
            remove (key) {
                const URL = isObject ? routes.deleteUrl : routes;

                return $.ajax({
                    url: URL,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': thisUtils.CSRFToken
                    },
                    data: {
                        id: key
                    },
                    success (response, textStatus, jqXHR) {
                        if ( response.error )
                        {
                            thisUtils.fireAjaxTransactionErrorReport(
                                response.message + "\nText status: " + textStatus,
                                'DevExtreme custom store at remove operation with URL: ' + URL + '.',
                                response.data,
                                thisUtils.defaultShowConfirmation,
                                thisUtils.defaultShowToast
                            );

                            return;
                        }
                    },
                    error (jqXHR, textStatus, errorThrown) {
                        thisUtils.fireAjaxTransactionErrorReport(
                            textStatus + ( typeof errorThrown === 'string' ? ' | ' + errorThrown : ''),
                            'DevExtreme custom store at remove operation with URL: ' + URL + '.',
                            errorThrown,
                            thisUtils.defaultShowConfirmation,
                            thisUtils.defaultShowToast
                        );
                    },
                    dataType: 'json'
                });
            },
            onBeforeSend (method, ajaxOptions) {
                ajaxOptions.xhrFields = {
                    withCredentials: true
                };
            }
        };

        if ( additionalMethods )
            options = Object.assign(options, additionalMethods)

        return new DevExpress.data.CustomStore(options);
    },
    /**
     * Returns a callable function from a string.
     *
     * @internal
     * @param location a string containing the javascript path to the function.
     * @return CallableFunction
     */
    getJavascriptFunction (location) {
        if ( typeof location !== 'string' || location.length <= 0 )
        {
            /* NOTE: Do not print an error here ! */
            return null;
        }

        const path = location.split('.');

        let method = window;

        for ( let index = 0; index < path.length; index++ )
        {
            const segment = path[index];

            if ( !method[segment] )
            {
                console.error("[AltioreUtils::getJavascriptFunction()] Javascript function %s() is not present in the document !", location);

                return null;
            }

            method = method[segment];
        }

        return method;
    },
};

console.log('Altiore JavaScript utils library read !');
