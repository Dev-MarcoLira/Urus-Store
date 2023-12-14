const cep = document.querySelector('#cep')
const cepValue = cep.innerText;

const cpf = document.querySelector('#cpf')
const cpfValue = cpf.innerText;

if(cpfValue.length == 11){
    const cpfMasked = cpfValue.slice(0, 3) + "." + cpfValue.slice(3, 6) + "." + cpfValue.slice(6, 9) + "-" + cpfValue.slice(9, 11)

    cpf.innerText = cpfMasked
}else{}

if(cepValue.length == 8){
    const cepMasked = cepValue.slice(0, 5) + "-" + cepValue.slice(5, 8)

    cep.innerText = cepMasked
}else{}