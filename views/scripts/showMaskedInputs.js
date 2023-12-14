const cep = document.querySelector('#cep')
const cepValue = cep.value;
const phone = document.querySelector('#phone')
const phoneValue = phone.value;

if(phoneValue.length == 11){
    const phoneMasked = "(" + phoneValue.slice(0, 2) + ")" + phoneValue.slice(2, 7) + "-" + phoneValue.slice(7, 11)

    phone.value = phoneMasked
}else{}

if(cepValue.length == 8){
    const cepMasked = cepValue.slice(0, 5) + "-" + cepValue.slice(5, 8)

    cep.value = cepMasked
}else{}