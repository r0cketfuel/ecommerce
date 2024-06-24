function openModal(modalId)
{
    const body  = document.querySelector('body#top');
    const modal = document.getElementById(modalId);

	modal.style.display     = "block";
	body.style.overflowY    = "hidden";
}

function closeModal(modalId)
{
    const body  = document.querySelector('body#top');
    const modal = document.getElementById(modalId);

	modal.style.display     = "none";
	body.style.overflowY    = "auto";
}