const decrement = document.querySelectorAll('.decrement-amount')
const increment = document.querySelectorAll('.increment-amount')
const inputAmount = document.querySelectorAll('.product-amount input[type=number]')
const checkboxes = document.querySelectorAll('.checkbox')
const selectSpan = document.querySelector('#select-everything')
const paymentSpan = document.querySelector('#pay')
const deleteSpan = document.querySelector('#deleteItens')
const checkboxForm = document.querySelector('#delete form')
const closeSpan = document.querySelector('#close')
const addressText = document.querySelector('#full-address')


if(addressText.innerText.length >= 32){
    const address = addressText.innerText.slice(0, 32)
    addressText.innerText = address + '...'
}

capivaraPeruana()


checkboxes.forEach(checkbox => {

    checkbox.addEventListener('click', event=>{

        checkbox.classList.toggle('checked')

        const checkboxInput = checkbox.previousSibling.previousSibling
        const div = checkbox.parentNode

        if(checkbox.classList.contains('checked')){
            checkboxInput.checked = true;
            div.classList.add('checked')
            
            checkboxForm.innerHTML += `
            
                <input type='hidden' name='productsIds[]' value='${checkboxInput.value}'>
            
            `    

        }else{

            const deleteItens = document.querySelectorAll('#delete form input[type=hidden]')
            div.classList.remove('checked')

            checkboxInput.checked = false;
            deleteItens.forEach(id =>{
                if(id.value == checkboxInput.value){
                    id.remove()
                }
            })
        }

        

        capivaraPeruana()
    })

})


inputAmount.forEach(input =>{

    input.addEventListener('keyup', event =>{

        const form = input.form
        const min = input.min
        const max = input.max
        const value = Number(input.value)
        const key = Number(event.key)

        if(value){
            if((key >= min & key <= max) & (value >= min & value <= max)){
                if(key.toString().match(/^[1-9]+$/) != null){
                    form.submit()
                }
            }else{
                input.value = min
                form.submit()
            }
        }else{}
    })

})

inputAmount.forEach(input =>{

    input.addEventListener('change', event =>{

        const form = input.form
        const min = input.min
        const max = input.max
        const value = Number(input.value)
        const key = event.key

        if(value){

            if((key >= min & key <= max) & (value >= min & value <= max)){
                if(key.toString().match(/^[1-9]+$/) != null){
                    form.submit()
                }
            }else{
                input.value = min
                form.submit()
            }
        }else{
            input.value = min
            form.submit()
        }
    })

})



decrement.forEach((button) => {

    button.addEventListener('click', e => {

        const div = e.target.nextSibling
        const input = div.nextSibling
        
        const min = input.min
        const max = input.max
        const form = input.form

        const value = Number(input.value)

        if(value > min & value <= max){
            input.value--

            form.submit()
        }
    })
})

increment.forEach((button) => {

    button.addEventListener('click', e => {

        const div = e.target.previousSibling
        const input = div.previousSibling

        const max = input.max
        const min = input.min
        const form = input.form
        
        const value = Number(input.value)

        if(value < max & value >= min){
            input.value++

            form.submit()
        }
    })

})

selectSpan.addEventListener('click', event=>{

    selectSpan.toggleAttribute('select')
    
    checkboxes.forEach(cb =>{
        
        const cbInput = cb.previousElementSibling
        const deleteItens = document.querySelectorAll('#delete form input[type=hidden]')
        const div = cb.parentElement
        if(selectSpan.hasAttribute('select')){
            cb.classList.add('checked')
            div.classList.add('checked')

            if(!cbInput.checked){
                checkboxForm.innerHTML += `
                    <input type='hidden' name='productsIds[]' value='${cbInput.value}'>
                `
            }

            cbInput.checked = true

        }else{

            cb.classList.remove('checked')
            div.classList.remove('checked')
            cbInput.checked = false

            deleteItens.forEach(id=>{
                id.remove()
            })
            
        }

    })
})

function capivaraPeruana(){

    const prices = document.querySelectorAll('.product .price')
    let amount = 0
    
    prices.forEach(price =>{
        
        const quantity = price.nextSibling.nextSibling.amount.value
        amount += Number(price.innerText.slice(2)) * quantity
    })
    
    const totalPrice = document.querySelector('#total-price')
    totalPrice.innerText = 'R$' + amount

}

paymentSpan.addEventListener('click', event=>{

    const amountTxt = document.querySelector('#total-price').innerText
    const amount = Number(amountTxt.slice(2))

    if(amount){
        const modal = document.querySelector('#modal')

        modal.classList.add('active')
    }else{
        console.log('Selecione ao menos um produto!')
    }

})

closeSpan.addEventListener('click', e=>{
    const modal = document.querySelector('#modal')

    modal.classList.remove('active')
})

deleteSpan.addEventListener('click', event=>{

    const checkboxInput = document.querySelector('input[name=delete]')

    checkboxForm.setAttribute('action', fullPath+'cart/delete')

    checkboxInput.click()

})