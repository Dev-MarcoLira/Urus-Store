const accountLink = document.querySelector("a#account");
const accountLinkImg = document.querySelector("a#account");
const imgBox = document.querySelector(".find .img-box");
const formSearch = document.querySelector(".search-container input[type=submit]")

accountLink.addEventListener('click', (e)=>{
  const accountList = document.querySelector("div#login ul");
  accountList.classList.toggle('disabled');
})

imgBox.addEventListener('click', (e)=>{

  formSearch.click();

})

window.addEventListener('click', (e) =>{
  const accountList = document.querySelector("div#login ul");

  if(e.target.localName !== 'img'){
    accountList.classList.add('disabled');
  }else{
    if(!(e.target.attributes[0].nodeValue == fullPath+"views/images/icons/login-icon.png")){
      accountList.classList.add('disabled');
    }
  }
})