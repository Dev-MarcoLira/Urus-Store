const cepInput = document.querySelector('input[name=cep]')
const estadoInput = document.querySelector('input[name=estado]')
const cidadeInput = document.querySelector('input[name=cidade]')
const bairroInput = document.querySelector('input[name=bairro]')
const complementoInput = document.querySelector('input[name=complemento]')
const numeroInput = document.querySelector('input[name=numero]')
const enderecoInput = document.querySelector('input[name=endereco]')
const phoneInput = document.querySelector('#phone')

phoneInput.addEventListener('keyup', e=>{
    
    const value = phone.value

    let phoneNoMask = value.replace('(', '')
    phoneNoMask = value.replace(')', '')
    phoneNoMask = value.replace('', '')

    const length = phoneNoMask.length

    if(length == 11)
        phoneInput.value = "(" + value.slice(0, 2) + ")" + value.slice(2, 7) + "-" + value.slice(7, 11)

})

cepInput.addEventListener('keyup', e=>{

    const cepWithoutMask = cep.value.replace('-', '')

    if(isNaN(cepWithoutMask)){
        cep.value = '';

    }else{

        const length = cep.value.length

        if(!length){

            estadoInput.value = ''
            cidadeInput.value = ''
            bairroInput.value = ''
            enderecoInput.value = ''

        }else if(length == 5){
            cep.value += '-'
        }else if(length == 9){
            fetchAddressData()
        }
    }
})

function fetchAddressData(){

    fetch('https://brasilapi.com.br/api/cep/v1/'+cepInput.value)
        .then(response => response.json())
        .then(json => insertAddressFields(json))
        .catch(e=>console.error(e.message))
}

function insertAddressFields(addressData){

    estadoInput.value = addressData['state']
    cidadeInput.value = addressData['city']
    bairroInput.value = addressData['neighborhood']
    enderecoInput.value = addressData['street']
}