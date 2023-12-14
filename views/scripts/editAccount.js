const dataInput = document.querySelector("input[type=date]");

dataInput.addEventListener("change", function() {
    var dataAtual = new Date();
    var inicioDoSeculo = new Date(dataAtual.getFullYear() - 100, 0, 1)
    var dataSelecionada = new Date(dataInput.value);
    
    if (dataSelecionada > dataAtual || dataSelecionada < inicioDoSeculo) {
        alert("Data Inválida!");
        dataInput.value = ""; 
    }
});