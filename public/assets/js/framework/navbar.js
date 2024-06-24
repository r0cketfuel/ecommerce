document.addEventListener("DOMContentLoaded", () => {
    const menuOpenBtn = document.getElementById("responsive-nav");
    if (menuOpenBtn) {
        menuOpenBtn.addEventListener("click", sidebarOpenClose);
    }

	const mainMenu = document.querySelectorAll(".main-menu-link");
	for(let i=0;i<mainMenu.length;i++)
		mainMenu[i].addEventListener('click', function() { mainMenuClick(i); return false });

	const subMenu = document.querySelectorAll(".submenu-link");
	for(let i=0;i<subMenu.length;i++)
		subMenu[i].addEventListener('click', function() { subMenuClick(i); return false });
    
});


//======================//
// Sidebar Open / Close //
//======================//
function sidebarOpenClose() {
    let navLinks = document.querySelector(".nav-links");

    let menuOpenBtn     = document.getElementsByClassName("font-awesome-icon-bars")[0];
    let menuCloseBtn    = document.getElementsByClassName("font-awesome-icon-close")[0];

    menuOpenBtn.onclick = function () {
        document.getElementById("top").style.overflowY = "hidden";
		navLinks.style.left = "0";
    }

    menuCloseBtn.onclick = function () {
		document.getElementById("top").style.overflowY = "scroll";
        navLinks.style.left = "-100%";
    }
}

//==========================//
// MAIN MENU CLICK FUNCTION //
//==========================//
function mainMenuClick(index)
{
	let navLinks = document.querySelectorAll(".main-menu");

	//CIERRA TODOS LOS MENUES ACTIVOS
	for(let i=0;i<navLinks.length;i++)
		if(i!=index)
			navLinks[i].classList.remove("active");

	navLinks[index].classList.toggle("active");
}

//========================//
// SUBMENU CLICK FUNCTION //
//========================//
function subMenuClick(index)
{
	let submenuLinks = document.querySelectorAll(".more");

	//CIERRA TODOS LOS SUBMENUES ACTIVOS
	for(let i=0;i<submenuLinks.length;i++)
		if(i!=index)
		submenuLinks[i].classList.remove("active");

	submenuLinks[index].classList.toggle("active");
}