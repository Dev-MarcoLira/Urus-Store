
function mascpf() {
  const botaoCpf = document.getElementById('cpf')
  var v3l = botaoCpf.value.length
  if (v3l == 3 || v3l == 7) {
    botaoCpf.value += '.'
  }
  else if (v3l == 11) {
    botaoCpf.value += '-'
  }
}


function valida() {

  const botaoCpf = document.getElementById('cpf')
  let cpfSemMascara = botaoCpf.value
  cpfSemMascara = cpfSemMascara.replaceAll(".", '')
  cpfSemMascara = cpfSemMascara.replace("-", '')

  if (valida_cpf(cpfSemMascara)) {
    botaoCpf.classList.add("certo")
    botaoCpf.classList.remove("errado")
    botaoCpf.setCustomValidity('');

  } else {
    botaoCpf.classList.add("errado")
    botaoCpf.classList.remove("certo")
    botaoCpf.setCustomValidity('Cpf Inválido');

  }

}

function valida_cpf(cpf) {
  var numeros, digitos, soma, i, resultado, digitos_iguais;
  digitos_iguais = 1;
  if (cpf.length < 11)
    return false;
  for (i = 0; i < cpf.length - 1; i++)
    if (cpf.charAt(i) != cpf.charAt(i + 1)) {
      digitos_iguais = 0;
      break;
    }
  if (!digitos_iguais) {
    numeros = cpf.substring(0, 9);
    digitos = cpf.substring(9);
    soma = 0;
    for (i = 10; i > 1; i--)
      soma += numeros.charAt(10 - i) * i;
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
      return false;
    numeros = cpf.substring(0, 10);
    soma = 0;
    for (i = 11; i > 1; i--)
      soma += numeros.charAt(11 - i) * i;
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
      return false;
    return true;
  }
  else
    return false;

}


function mascdata() {
  const data = document.getElementById('nasc1');
  var v4l = data.value.length;

  if (v4l == 2 || v4l == 5) {
    data.value += '/';
  }
}



