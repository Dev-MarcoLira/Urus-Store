let slideIndex = 1;
const rightDot = document.querySelectorAll('span.right')
const leftDot = document.querySelectorAll('span.left')

rightDot.forEach(dot => {
    dot.addEventListener('click', event=>{
      plusSlides(1)
        
    })
})

leftDot.forEach(dot => {
    dot.addEventListener('click', event=>{
      plusSlides(-1)
        
    })
})

showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.querySelectorAll(".img img");

  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}

  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}