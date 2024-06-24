//======================================//
// FUNCION QUE REALIZA LA PETICION AJAX //
//======================================//
async function ajax(url = "", parameters = {})
{
    let token = document.querySelector("meta[name='csrf-token']").getAttribute("content");

    const response = await fetch(url,
    {
        method:         "POST",
        cache:          "no-cache",
        credentials:    "same-origin",
        headers: 
        {
                        "Content-Type": "application/x-www-form-urlencoded",
                        "X-CSRF-TOKEN": token,
        },
        redirect:       "follow",
        referrerPolicy: "strict-origin-when-cross-origin",
        body:           parameters
    });
    
    return response.json();
}