const amount = document.querySelector('#amount')
const isLimited = document.querySelector('#limited')
const isInfinity = document.querySelector('#infinity')
const buttonsCheckbox = document.querySelectorAll('.botao_checkbox')
const discountSelect = document.querySelector('select#discount')
const expiryDate = document.querySelector('input[name=expiryDate]')

buttonsCheckbox.forEach(button =>{

    button.addEventListener('click', e =>{

        const checkbox = button.nextSibling.nextSibling

        if(checkbox.getAttribute('checked')){

            button.classList.remove('checked')
            checkbox.removeAttribute('checked')
        }else{

            button.classList.add('checked')
            checkbox.setAttribute('checked', 'true')
        }

    })

})

isLimited.addEventListener('click', e=>{
    amount.classList.add('active')
})

isInfinity.addEventListener('click', e=>{
    amount.classList.remove('active')
})

amount.addEventListener('change', e=>{
    const value = amount.value

    if(!value)
        amount.value = 1
})

amount.addEventListener('keyup', e=>{
    const value = amount.value

    if(!value)
        amount.value = 1
})

discountSelect.addEventListener('change', e=>{

    const value = discountSelect.value

    if(value){

        expiryDate.classList.add('active')
        expiryDate.setAttribute('required', '')

    }else{
        
        expiryDate.classList.remove('active')
        expiryDate.value = ""
        expiryDate.removeAttribute('required')
    }
})

expiryDate.addEventListener("change", function() {
    var dataAtual = new Date();
    var dataSelecionada = new Date(expiryDate.value);
    
    if (dataSelecionada < dataAtual) {
        alert("Data Inválida!");
        expiryDate.value = ""; 
    }
});