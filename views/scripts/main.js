const slidesContainerRecommended = document.querySelector("#catalog1 .card-wrapper");
const slidesContainerBestSellers = document.querySelector("#catalog2 .card-wrapper");
const slide = document.querySelector(".card-item");

const prevButtonRecommended = document.querySelector("#catalog1 .left-arrow");
const nextButtonRecommended = document.querySelector("#catalog1 .right-arrow");
const prevButtonBestSellers = document.querySelector("#catalog2 .left-arrow");
const nextButtonBestSellers = document.querySelector("#catalog2 .right-arrow");

const names = document.querySelectorAll('.name')

const banners = document.querySelectorAll('#images img')
let index = 0

setInterval(function(){

  if(index >= 3)
    index = 0

  banners.forEach(banner => {
    banner.classList.remove('active')
  })

  banners[index].classList.add('active')

  index++;

}, 3500)


nextButtonRecommended.addEventListener("click", () => {
  //alert('Direita')
  const slideWidth = slide.clientWidth;
  slidesContainerRecommended.scrollLeft += slideWidth;
});
prevButtonRecommended.addEventListener("click", () => {
  //alert('Esquerda')
  const slideWidth = slide.clientWidth;
  slidesContainerRecommended.scrollLeft -= slideWidth;
});

nextButtonBestSellers.addEventListener("click", () => {
  //alert('Direita')
  const slideWidth = slide.clientWidth;
  slidesContainerBestSellers.scrollLeft += slideWidth;
});

prevButtonBestSellers.addEventListener("click", () => {
  //alert('Esquerda')
  const slideWidth = slide.clientWidth;
  slidesContainerBestSellers.scrollLeft -= slideWidth;
});

names.forEach(name => {
  
  const value = name.innerText

  if(value.length > 25){
    name.innerText = value.slice(0, 24) + '...'
  }

})