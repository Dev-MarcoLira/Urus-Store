const cpf = document.querySelector('#cpf')
const cpfValue = cpf.value;

cpf.addEventListener('keypress', (e) => {
      
    const length = cpf.value.length

    if(length == 3){
        cpf.value += '.'
    }else if(length == 7){
        cpf.value += '.'
    }else if(length == 11){
        cpf.value += '-'
    }
})

if(cpfValue.length == 11){
    const cpfMasked = cpfValue.slice(0, 3) + "." + cpfValue.slice(3, 6) + "." + cpfValue.slice(6, 9) + "-" + cpfValue.slice(9, 11)

    cpf.value = cpfMasked
}else{}