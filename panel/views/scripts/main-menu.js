const burger = document.querySelector('#menu-trigger')
const overlay = document.querySelector('#overlay')
const menuExit = document.querySelector('#menu-exit')

burger.addEventListener('click', e=>{
    overlay.classList.add('active')
    burger.classList.add('disable')

})

menuExit.addEventListener('click', e=>{
    overlay.classList.remove('active')
    burger.classList.remove('disable')

})