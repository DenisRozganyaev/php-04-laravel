const imagesSelectors = {
    wrapper: '.images-wrapper'
}
$(document).ready(() => {
    if (window.FileReader) {
        $('#images').change(function() {
            let counter = 0, file
            const template = '<div class="mb-4"><img src="_url_" style="width: 100%" /></div>'

            $(imagesSelectors.wrapper).html('')

            while(file = this.files[counter++]) {
                const reader = new FileReader()
                reader.onloadend = (function() {
                    return function(e) {
                        const img = template.replace('_url_', e.target.result)
                        $(imagesSelectors.wrapper).append(img)
                    }
                })(file)
                reader.readAsDataURL(file)
            }
        })

        $('#thumbnail').change(function() {
            const reader = new FileReader()
            reader.onloadend = (e) => {
                $('#thumbnail-preview')
                    .attr('src', e.target.result)
                    .show()
            }
            reader.readAsDataURL(this.files[0]);
        })
    }
});
