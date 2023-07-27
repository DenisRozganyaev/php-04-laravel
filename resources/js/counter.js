import './bootstrap';

const productSelectors = {
    counter: {
        increaseBtn: 'button[data-action="increment"]',
        decreaseBtn: 'button[data-action="decrement"]',
        input: '.product-count'
    }
}

$(document).ready(function() {
    $(document).on('click', productSelectors.counter.decreaseBtn, function(e) {
        e.preventDefault()
        const $counter = $(this).parent().find(productSelectors.counter.input)
        let value = Number($counter.val())

        value--

        if (value > 0) {
            $counter.val(value)
            submitForm($(this))
        }
    })

    $(document).on('click', productSelectors.counter.increaseBtn, function(e) {
        e.preventDefault()
        const $counter = $(this).parent().find(productSelectors.counter.input)
        const max = Number($counter.attr('max'))
        let value = Number($counter.val())

        value++;

        if (value <= max) {
            $counter.val(value)
            submitForm($(this))
        }
    })

    $(document).on('change', '.counter-form .product-count', function(e) {
        $(this).parent().submit();
    })
})

function submitForm($btn) {
    if($btn.data('type') === 'submit') {
        $btn.parent().submit();
    }
}
