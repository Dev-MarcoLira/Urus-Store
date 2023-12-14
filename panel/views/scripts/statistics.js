const xValues = ["JANEIRO", "FEVEREIRO", "MARÇO", "ABRIL", "MAIO", "JUNHO", "JULHO", "AGOSTO", "SETEMBRO","OUTUBRO","NOVEMBRO","DEZEMBRO"];
const yValues = []

document.querySelectorAll('.data > div')
.forEach(amount => {
    yValues.push(amount.innerHTML)
})

new Chart("myChart", {
type: "line",
data: {
    labels: xValues,
    datasets: [{
    backgroundColor:"rgba(0,0,255,1.0)",
    pointBackgroundColor:"rgba(208, 0, 212, 1)",
    borderColor: "rgba(208, 0, 212, 1)",
    fill: false,
    data: yValues
    }]

},
options:{
    legend: {display: false},
    scales: {
    xAxes: [{
        gridLines: {
            color: "rgba(40, 40, 40, 1)",
            lineWidth: "2"
        }
    }],
    yAxes: [{
        gridLines: {
            color: "rgba(40, 40, 40 , 1)",
            lineWidth: "2"
        }   
    }]
    }
}

});