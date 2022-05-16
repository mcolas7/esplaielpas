"use strict";

init();


function init() {

  const avui = new Date();

  let data_naixement = document.getElementById('data_naixement');

  data_naixement.setAttribute("max", calcularData(avui, 6));
  data_naixement.setAttribute("min", calcularData(avui, 18));

	let alergies = document.getElementById("alergies");

    let divAlergia = document.getElementById("divAlergia");


    if (alergies.value == '0') {
        divAlergia.setAttribute('hidden', '');
    }
  
	alergies.addEventListener("change", mostrarTextareaAlergies);

}


function mostrarTextareaAlergies () {
    let alergies = document.getElementById('alergies').value;
    let divAlergia = document.getElementById("divAlergia");
    let alergia = document.getElementById('alergia');

    if (alergies === '1') {
        divAlergia.removeAttribute('hidden');
        document.getElementById('alergia').focus();
        alergia.setAttribute('required','');

    } else {
        divAlergia.setAttribute('hidden', '');
        alergia.removeAttribute('required');
    }
}

function calcularData (data, anys) {
	let dataFormat = data.getFullYear()-anys;
 
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