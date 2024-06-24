document.addEventListener("DOMContentLoaded", function ()
{
    const mp        = new MercadoPago("TEST-01299bbb-5dcb-40e8-96ce-7bc7c1152707");
    const monto     = document.getElementById("total").innerHTML.replace('$','').replace(/\./g,'').replace(",",'.');
    const _token    = document.querySelector("meta[name='csrf-token']").getAttribute("content");

    const tipo_documento    = document.getElementById("tipo_documento_id");
    const domicilio         = document.getElementById("domicilio");
    const domicilio_nro     = document.getElementById("domicilio_nro");
    const domicilio_piso    = document.getElementById("domicilio_piso");
    const domicilio_depto   = document.getElementById("domicilio_depto");


    const cardForm = mp.cardForm({
        amount: monto,
        iframe: true,
        form:
        {
            id: "form-checkout",
            cardNumber: {
                id: "form-checkout__cardNumber",
                placeholder: "",
            },
            expirationDate: {
                id: "form-checkout__expirationDate",
                placeholder: "",
            },
            securityCode: {
                id: "form-checkout__securityCode",
                placeholder: "",
            },
            cardholderName: {
                id: "form-checkout__cardholderName",
                placeholder: "",
            },
            issuer: {
                id: "form-checkout__issuer",
                placeholder: "",
            },
            installments: {
                id: "form-checkout__installments",
                placeholder: "",
            },
            identificationNumber: {
                id: "documento_nro",
                placeholder: "",
            },
            cardholderEmail: {
                id: "email",
                placeholder: "",
            },
            apellidos: {
                id: "apellidos",
                placeholder: "",
            },
            nombres: {
                id: "nombres",
                placeholder: "",
            },
            domicilio: {
                id: "domicilio",
                placeholder: "",
            },
            domicilio_nro: {
                id: "domicilio_nro",
                placeholder: "",
            },
            domicilio_piso: {
                id: "domicilio_piso",
                placeholder: "",
            },
            domicilio_depto: {
                id: "domicilio_depto",
                placeholder: "",
            },
        },

        callbacks:
        {
            onFormMounted: error => 
            {
                if(error)
                    return console.warn("Form Mounted handling error: ", error);
                
                console.log("Form mounted");
            },
            onSubmit: event =>
            {
                event.preventDefault();

                const 
                {
                    paymentMethodId:    payment_method_id,
                    issuerId:           issuer_id,
                    cardholderEmail:    email,
                    amount,
                    token,
                    installments,
                    identificationNumber,
                } = cardForm.getCardFormData();
                
                fetch("/shop/process_payment",
                {
                    method: "POST",
                    headers: 
                    {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": _token,
                    },
                    body: JSON.stringify(
                    {
                        token,
                        issuer_id,
                        payment_method_id,
                        transaction_amount:         Number(amount),
                        installments:               Number(installments),
                        description:                "Descripción del producto",
                        apellidos:                  apellidos.value,
                        nombres:                    nombres.value,
                        tipo_documento_id:          tipo_documento.value,
                        documento_nro:              documento_nro.value,
                        localidad:                  localidad.value,
                        codigo_postal:              codigo_postal.value,
                        domicilio:                  domicilio.value,
                        domicilio_nro:              domicilio_nro.value,
                        domicilio_piso:             domicilio_piso.value,
                        domicilio_depto:            domicilio_depto.value,
                        telefono_celular:           telefono_celular.value,
                        email,
                        payer:
                        {
                            email,
                            identification: 
                            {
                                type:           tipo_documento.value,
                                number:         identificationNumber,
                            },
                        },
                    }),
                })
                
                .then((response) => response.json())
                .then((data) => 
                {
                    if(data["success"] == true)
                    {
                        switch(data["data"]["payment"]["status"])
                        {
                            case "approved":    pagoAprobado();     break;
                            case "in_process":  pagoPendiente();    break;
                            
                            case "rejected":
                            {
                                switch(data["data"]["payment"]["status_detail"])
                                {
                                    case "cc_rejected_other_reason":                console.log("Pago rechazado: Sin razón específica");            break;
                                    case "cc_rejected_call_for_authorize":          console.log("Pago rechazado: Llamar para pedir autorización");  break;
                                    case "cc_rejected_insufficient_amount":         console.log("Pago rechazado: Fondos insuficientes");            break;
                                    case "cc_rejected_bad_filled_security_code":    console.log("Pago rechazado: Código de seguridad incorrecto");  break;
                                    case "cc_rejected_bad_filled_date":             console.log("Pago rechazado: Fecha de expiración");             break;
                                    case "cc_rejected_bad_filled_other":            console.log("Pago rechazado: Error en campo del formulario");   break;

                                    default: console.log("Pago rechazado: Código de error: " + data["data"]["payment"]["status_detail"]); pagoRechazado(); break;
                                }
                                break;
                            }

                            default: console.log("Estado desconocido"); break;
                        }
                    }
                });
            },
            onFetching: (resource) => 
            {
                console.log("Fetching resource: ", resource);

                // Animate progress bar
                const progressBar = document.querySelector(".progress-bar");
                progressBar.removeAttribute("value");

                return () => { progressBar.setAttribute("value", "0"); };
            },
            onError: (resource) => {
                console.log("Error: ", resource);
            }
        },
    });
});

function pagoAprobado()
{
    window.location.replace("/shop/success");
}

function pagoPendiente()
{
    window.location.replace("/shop/pending");
}

function pagoRechazado()
{
    window.location.replace("/shop/rejected");
}