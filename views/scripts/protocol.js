const chatOptions = document.querySelector('#burger')
const labels = document.querySelectorAll('.label')
const chatTrigger = document.querySelector('#chat-trigger')

chatTrigger.addEventListener('click', e=>{

    const left = document.querySelectorAll('.left')
    
    left.forEach(div =>{

        div.classList.toggle('active')

    })
})

document.querySelector('#options img').addEventListener('click', e=>{
    chatOptions.classList.toggle('active')
})

labels.forEach(label =>{
    
    label.addEventListener('click', e => {

    label.classList.toggle('active')

    const chat = label.nextSibling.nextSibling

    chat.classList.toggle('active')

    })

})

document.querySelector('p#enviar').addEventListener('click', e =>{
    const form = document.querySelector('.baixo form')
    const message = document.querySelector('input[name=message]')
    
    if(message.value)
    form.submit()

})