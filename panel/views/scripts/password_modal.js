const modal = document.getElementById("passwordModal");
const span = document.getElementById("passwordExit");
const button = document.querySelector('button#confirm')


const links = document.querySelectorAll('.link')
links.forEach(link => {
    link.addEventListener('click', e=>{
        const route = e.target.getAttribute('href')
        e.target.setAttribute('href', 'javascript:void(0);')

        button.setAttribute('redirect', route)
        modal.classList.add('active')
    })
})

span.onclick = function() {
    modal.classList.remove('active')
    resetLink()
}

button.addEventListener('click', async e=>{

    const passwd = document.querySelector('#passwordModal input').value

    await fetch(fullPath + "panel/api/admin/check-password", {
        method: "POST",
        headers: {
        "Content-Type": "application/json",
        },
        mode: "cors",
        body: JSON.stringify({ password: passwd }),
    })
        .then((response) => response.json())
        .then((response) => {

            if(response.status == 'ok'){

                const route = button.getAttribute('redirect')

                window.location = route

            }else{

                alert('A senha digitada é inválida!')
            }

        })
        .catch((error) => {
            console.log(error)
        });


})

function resetLink(){
    document.querySelectorAll('.link a')
    .forEach(link =>{

        if(link.getAttribute('href') == 'javascript:void(0);'){

            const route = button.getAttribute('redirect')

            link.setAttribute('href', route)
        }
        
    })
}