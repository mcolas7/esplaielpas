"use strict";

init();


function init() {

  const avui = new Date();

  let data_naixement = document.getElementById('data_naixement');

  data_naixement.setAttribute("max", calcularData(avui));

  let dni = document.getElementById('dni');

  dni.addEventListener('change', comprovarDNI(dni.value));

  

}

function calcularData (data) {
	let dataFormat = data.getFullYear()-16;
 
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

function comprovarDNI (dni) {
    $.ajax({
      url: 'tutors/create/existeix',
      method: 'POST',
      data: {
        dni: dni
      }
    }).done(function(res){
      alert(res);
    }).fail(function(res) {
      alert(res);
    });
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