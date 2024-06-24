document.addEventListener("DOMContentLoaded", () => {

    const mp = new MercadoPago("TEST-01299bbb-5dcb-40e8-96ce-7bc7c1152707");

    function createSelectOptions(elem, options, labelsAndKeys = { label: "name", value: "id" }) {
        const { label, value } = labelsAndKeys;

        elem.options.length = 0;

        const tempOptions = document.createDocumentFragment();

        options.forEach(option => {
            const optValue = option[value];
            const optLabel = option[label];

            const opt = document.createElement('option');
            opt.value = optValue;
            opt.textContent = optLabel;

            tempOptions.appendChild(opt);
        });

        elem.appendChild(tempOptions);
    }

    // Get Identification Types
    (async function getIdentificationTypes() {
        try {
            const identificationTypes = await mp.getIdentificationTypes();
            const docTypeElement = document.getElementById('form-checkout__identificationType');

            createSelectOptions(docTypeElement, identificationTypes)
        } catch (e) {
            return console.error('Error getting identificationTypes: ', e);
        }
    })()
});