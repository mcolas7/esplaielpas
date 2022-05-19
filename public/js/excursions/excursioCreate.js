"use strict";

init();


function init() {

  const avui = new Date();

  let data_inici = document.getElementById('data_inici');
  let hora_inici = document.getElementById('hora_inici');
  let data_fi = document.getElementById('data_fi');
  let hora_fi = document.getElementById('hora_fi');

  data_inici.setAttribute("min", donarFormatData(avui));
  hora_inici.value = donarFormatHora(avui);
  
  data_fi.setAttribute("min", donarFormatData(avui));
  hora_fi.value = donarFormatHora(avui);

  data_inici.addEventListener('change', function () {
    hora_inici.removeAttribute("min");

    data_fi.removeAttribute("min");
    data_fi.setAttribute("min", data_inici.value);

    if (data_inici.value == donarFormatData(avui)) {
      hora_inici.setAttribute("min", donarFormatHora(avui));
      hora_fi.setAttribute("min", donarFormatHora(avui));

    } else {
      calcularHoraArribada();
    }

  });

  hora_inici.addEventListener('change', calcularHoraArribada);

  data_fi.addEventListener('change', calcularHoraArribada);
  
}


function donarFormatData (data) {
	let dataFormat = data.getFullYear();
 
	if (data.getMonth()+1 >= 10) {
		dataFormat += "-"+(data.getMonth() + 1);
	} else {
		dataFormat += "-0"+(data.getMonth() + 1);
	}

	if (data.getDate() >= 10) {
		dataFormat += "-"+data.getDate();
	} else {
		dataFormat += "-0"+data.getDate();
	}

	return dataFormat;
}

function donarFormatHora (data) {
	let horaActual;

	if (data.getHours() >= 10) {
		horaActual = data.getHours();
	} else {
		horaActual = "0"+data.getHours();
	}

	if (data.getMinutes() >= 10) {
		horaActual += ":"+data.getMinutes();
	} else {
		horaActual += ":0"+data.getMinutes();
	}

	return horaActual;
}

function calcularHoraArribada () {
  hora_fi.removeAttribute("min");

  if (data_inici.value == data_fi.value) {
    
    hora_fi.setAttribute("min", hora_inici.value);
  }
}

// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
    'use strict'
  
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')
  
    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
      .forEach(function (form) {
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }
  
          form.classList.add('was-validated')
        }, false)
      })
  })()