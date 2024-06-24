document.addEventListener("DOMContentLoaded", () => {

    const subtotal          = document.getElementById("sub-total");
    const envio             = document.getElementById("envio");
    const descuentos        = document.getElementById("descuentos");
    const total             = document.getElementById("total");
    const couponApplyButton = document.getElementById("btn_coupon_submit");

    if(couponApplyButton)
        couponApplyButton.addEventListener("click", function() { couponSubmit(); return false });

    let shipmentOptions = document.querySelectorAll("input[type='radio'][name='radio_medioEnvio']");
    let dataFields      = document.getElementById("shipmentData");

    for(let i=0;i<shipmentOptions.length;++i)
        shipmentOptions[i].addEventListener('click', function() { shipment(shipmentOptions[i].value); return false });

function formatCurrency(number)
{
    return("$" + number.toFixed(2).replace(".",",").toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."))
}

function calculaTotal()
{
    let subtotalTemp, envioTemp, descuentosTemp;

    subtotalTemp = subtotal.innerHTML;
    subtotalTemp = subtotalTemp.replace('$','');
    subtotalTemp = subtotalTemp.replace(/\./g,'');
    subtotalTemp = subtotalTemp.replace(",",'.');

    envioTemp = envio.innerHTML;
    envioTemp = envioTemp.replace('$','');
    envioTemp = envioTemp.replace(/\./g,'');
    envioTemp = envioTemp.replace(",",'.');

    descuentosTemp = descuentos.innerHTML;
    descuentosTemp = descuentosTemp.replace('$','');
    descuentosTemp = descuentosTemp.replace(/\./g,'');
    descuentosTemp = descuentosTemp.replace(",",'.');

    total.innerHTML = formatCurrency(parseFloat(parseFloat(subtotalTemp) + parseFloat(envioTemp) - parseFloat(descuentosTemp)));
}

function shipment(value)
{
    const url           = "/shop/requests/costoEnvio";
    const parameters    = "medio_id=" + value;

    const response = ajax(url,parameters);

    response.then((data) => {
        if(data)
            envio.innerHTML = formatCurrency(parseFloat(data));
        else
            envio.innerHTML = formatCurrency(parseFloat(0));

            calculaTotal();
    });
}

function couponSubmit()
{
    const input_code    = document.getElementsByName("input_coupon")[0];
    const url           = "/shop/requests/aplicaCupon";
    const parameters    = "code=" + input_code.value;

    const response = ajax(url,parameters);
    
    response.then((data) => {

        if(data["success"]===true)
        {


            descuentos.innerHTML        = formatCurrency(parseInt(data["data"]["descuento"]));
            couponApplyButton.innerHTML = "Remover cupón";

            couponApplyButton.classList.remove("btn-secondary");
            couponApplyButton.classList.add("btn-danger");

            calculaTotal();
        }

    });
}

});