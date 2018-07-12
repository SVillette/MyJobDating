(function ($) {
    $(document).ready(function () {
        let accountTypeSelector = $('input[type=radio][name="user[accountType]"]')

        let companySelector = $('#user_company')
        let companyDiv = companySelector.parent().parent()
        companyDiv.hide()

        accountTypeSelector.on('change', (ev) => {
            let selectedItem = $(ev.currentTarget)
            if (selectedItem.val() === 'recruiter') {
                companySelector.prop('required', true)
                companyDiv.show()
            } else {
                companySelector.prop('required', false)
                companyDiv.hide()
            }
        })

    })
})(jQuery)
