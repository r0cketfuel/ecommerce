document.addEventListener("DOMContentLoaded", () => {

    const items = [...document.getElementsByClassName("tab")];
    for(let i=0;i<items.length;i++)
        items[i].addEventListener("click", function() { tabChange(i); return false });
    
    const content = document.querySelectorAll(".tab-content");
    content[0].style.display = "inline-block";

});

//===================//
// Cambio de pestaña //
//===================//
function tabChange(tabIndex)
{
	//Tabs
	let tabActiveLink	= document.querySelector(".tab.active");
	let tabLink			= document.querySelectorAll(".tab");

    //Content divs
    const content       = document.querySelectorAll(".tab-content");

	tabActiveLink.classList.remove("active");
    tabLink[tabIndex].classList.add("active");

    for(let i=0;i<content.length;i++)
        content[i].style.display = "none";

    content[tabIndex].style.display = "inline-block";
}