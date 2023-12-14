function verificaForcaSenha() {

    const v1 = document.querySelector('input[id=password]');
    const v2 = document.querySelector('input[id=password2]')
    var numeros = /([0-9])/;
    var alfabeto = /([a-zA-Z])/;
    var chEspeciais = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
  
    if ($('#password').val().length < 6) {
      $('#password-status').html("<span style='color:red'>Fraco, insira no mínimo 6 caracteres</span>");
    } else {
      if ($('#password').val().match(numeros) && $('#password').val().match(alfabeto) && $('#password').val().match(chEspeciais)) {
        $('#password-status').html("<span style='color:green'><b>Forte</b></span>");
      } else {
        $('#password-status').html("<span style='color:orange'>Médio, Utilize Numeros Letras e Caracteres Especiais</span>");
      }
    }
  
    if (v2.value === v1.value) {
      v2.setCustomValidity('');
  
    } else {
      v2.setCustomValidity('As senhas não conferem');
  
    }
  }