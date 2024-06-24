document.addEventListener("DOMContentLoaded", () => {

    const select = document.getElementById("sortBy");
    if (select)
        select.addEventListener("change", () => { cardSort(select.value); return false });
});

function cardSort(value) {
    let productCards = document.getElementsByClassName("product-card");
    let precio = document.getElementsByClassName("precio");

    let temp = [[], []];

    for (let i = 0; i < precio.length; ++i)
        temp[0].push(i + 1);

    for (let i = 0; i < precio.length; ++i) {
        tmpPrecio = precio[i].innerHTML.replace("$", "").replace(/\./g, "").replace(",", ".");
        tmpPrecio = Number(tmpPrecio);

        temp[1].push(tmpPrecio);
    }

    temp = sortItems(temp, value);
    for (let i = 0; i < productCards.length; ++i)
        productCards[(temp[0][i]) - 1].style.order = i + 1;
}

//========================//
// ORDENAMIENTO DEL ARRAY //
//========================//
function sortItems(array, sortBy) {
    let swapped = true;
    do {
        swapped = false;
        for (let j = 0; j < array[1].length; j++) {
            if (sortBy == 1) {
                if (array[1][j] > array[1][j + 1]) {
                    let temp = array[1][j];
                    array[1][j] = array[1][j + 1];
                    array[1][j + 1] = temp;

                    temp = array[0][j];
                    array[0][j] = array[0][j + 1];
                    array[0][j + 1] = temp;

                    swapped = true;
                }
            }
            else {
                if (array[1][j] < array[1][j + 1]) {
                    let temp = array[1][j];
                    array[1][j] = array[1][j + 1];
                    array[1][j + 1] = temp;

                    temp = array[0][j];
                    array[0][j] = array[0][j + 1];
                    array[0][j + 1] = temp;

                    swapped = true;
                }
            }
        }
    }
    while (swapped);

    return array;
}