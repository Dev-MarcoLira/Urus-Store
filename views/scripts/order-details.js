const initDate = document.querySelector('#initial-date')
const finalDate = document.querySelector('#final-date')

const date = new Date(initDate.innerHTML)
const newDate = new Date(date.getTime() + 7*24*3600*1000)

initDate.innerHTML = date.getDate() + "/" + Number(date.getMonth()+1) + "/" + date.getFullYear()
finalDate.innerHTML = newDate.getDate() + "/" + Number(newDate.getMonth()+1) + "/" + newDate.getFullYear()