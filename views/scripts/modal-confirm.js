const modalConfirm = document.getElementById("modal-confirm");
const buttons = document.querySelectorAll(".confirm-modal-trigger");
const spanConfirm = document.getElementById("exit");
const confirmButton = document.querySelector('#confirm')

confirmButton.addEventListener('click', e => {
    const route = modalConfirm.getAttribute('redirect')

    window.location = route
})

buttons.forEach(btn=>{
    btn.addEventListener('click', e =>{

        modalConfirm.classList.add('active')

        const link = e.target

        const route = link.getAttribute('href')

        link.setAttribute('href', 'javascript:void(0);')
        modalConfirm.setAttribute('redirect', route)

    })
})

spanConfirm.onclick = function() {
    modalConfirm.classList.remove('active')

    resetLink()

}

window.onclick = function(event) {
  if (event.target == modalConfirm) {

    modalConfirm.classList.remove('active')

    resetLink()
  }
}

function resetLink(){
    document.querySelectorAll('.confirm-modal-trigger')
        .forEach(link =>{

            if(link.getAttribute('href') == 'javascript:void(0);'){

                const route = modalConfirm.getAttribute('redirect')

                link.setAttribute('href', route)
            }
            
        })
}