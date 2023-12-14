const productModal = document.querySelector('#product-modal')
const productTrigger = document.querySelectorAll('button.product-modal-trigger')

productModal.addEventListener('click', e =>{

    productModal.classList.remove('active')

})

productTrigger.forEach(button => {
    
    button.addEventListener('click', e => {

        productModal.classList.add('active')

        getProductsViaAPI(button)

    })
})


async function getProductsViaAPI(button){

    const paymentId = button.getAttribute('id')
    let response

    await fetch(fullPath + "panel/api/get-order-items", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        mode: "cors",
        body: JSON.stringify([paymentId])
    })

        .then(response => response.json())

        .then(products =>{

            renderModal(products.products)

        })

        .catch(error =>{
            console.error(error)
        })

        return response

}

function renderModal(products){
    
    productModal.innerHTML = ''

    products.forEach(product =>{
        
        const name = product.name
        const quantity = product.quantity
        const total = product.total
        const id = product.id

        productModal.innerHTML += `
        
            <div class="product-single">
                <img src="uploads/products/${id}/image1.jpg" alt="logo do produto">

                <div class="info">
                    <p class='name'>${name}</p>
                    <p>Quantidade: ${quantity}</p>
                    <p>Total: R$${total}</p>
                </div>
            </div>

        `
    })

}