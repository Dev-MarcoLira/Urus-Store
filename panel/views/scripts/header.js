const accountLink = document.querySelector("a#account");

accountLink.addEventListener('click', (e)=>{
  const accountList = document.querySelector("div#login ul");
  accountList.classList.toggle('disabled');
})