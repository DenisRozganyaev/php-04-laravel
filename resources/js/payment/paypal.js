import '../bootstrap'

function getFields() {
    return $('#checkout-form').serializeArray().reduce((obj, item) => {
        obj[item.name] = item.value
        return obj
    }, {});
}

function isEmptyFields() {
    const fields = getFields()

    return Object.values(fields).some((val) => val.length < 1)
}

paypal.Buttons({

    onInit: function (data, actions) {
        actions.disable()

        $('#checkout-form').change(() => {
            if (!isEmptyFields()) {
                actions.enable()
            }
        })
    },

    onClick: function (data, actions) {
        if (isEmptyFields()) {
            alert('Please fill the form')
            return;
        }
    },

    style: {
        color: 'blue',
        shape: 'pill',
        label: 'pay',
        height: 40
    },

    // Call your server to set up the transaction
    createOrder: function (data, actions) {
        return axios.post('/ajax/paypal/order/create/', getFields())
            .then(function (res) {
                return res.data.vendor_order_id;
            })
    },

    // Call your server to finalize the transaction
    onApprove: function (data, actions) {
        console.log('data', data)
        return axios.post(`/ajax/paypal/order/${data.orderID}/capture/`)
            .then(function (res) {
                console.log('capture response', res)
            }).catch((orderData) => {
                var errorDetail = Array.isArray(res.data.data.details) && res.data.details[0];

                if (errorDetail && errorDetail.issue === 'INSTRUMENT_DECLINED') {
                    return actions.restart(); // Recoverable state, per:
                    // https://developer.paypal.com/docs/checkout/integration-features/funding-failure/
                }

                if (errorDetail) {
                    var msg = 'Sorry, your transaction could not be processed.';
                    if (errorDetail.description) msg += '\n\n' + errorDetail.description;
                    if (res.data.debug_id) msg += ' (' + res.data.debug_id + ')';
                    return alert(msg); // Show a failure message (try to avoid alerts in production environments)
                }

                // Successful capture! For demo purposes:
                console.log('Capture result', res.data, JSON.stringify(res.data, null, 2));
                var transaction = res.data.purchase_units[0].payments.captures[0];
                alert('Transaction ' + transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');

            })
    }

}).render('#paypal-button-container');
