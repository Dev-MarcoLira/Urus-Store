const prevButton = document.querySelector(".left-arrow");
const nextButton = document.querySelector(".right-arrow");
const slidesContainer = document.querySelector("#trending .products");
const slide = document.querySelector(".slider");

/*const spanTime = document.querySelector('#time span')
const time = new Date(spanTime.innerHTML)
*/

nextButton.addEventListener("click", () => {
    //alert('Direita')
    const slideWidth = slide.clientWidth;
    slidesContainer.scrollLeft += 400;
});

prevButton.addEventListener("click", () => {
    //alert('Esquerda')
    const slideWidth = slide.clientWidth;
    slidesContainer.scrollLeft -= 400;
});

