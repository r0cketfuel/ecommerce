document.addEventListener("DOMContentLoaded", () => {

    document.getElementById('search_form').addEventListener('submit', function (event) {
                    
        const searchInput = document.getElementById('busqueda').value.trim();

        if(searchInput === '')
            event.preventDefault();
    });
});