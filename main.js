const puntero = document.querySelector('.puntero');

document.addEventListener('mousemove', (e) => {
    puntero.style.left = (e.clientX - puntero.offsetWidth / 2) + 'px';
    puntero.style.top = (e.clientY - puntero.offsetHeight / 2) + 'px';
});

document.addEventListener('mouseenter', () => {
    puntero.style.display = 'block';
});

document.addEventListener('mouseleave', () => {
    puntero.style.display = 'none';
});



//ojito
document.addEventListener('DOMContentLoaded', function () {
    const passwordField = document.getElementById('pass');
    const toggleButton = document.getElementById('toggle-password');
  
    toggleButton.addEventListener('click', function () {
      if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleButton.classList.remove('fa-eye-slash');
        toggleButton.classList.add('fa-eye');
        toggleButton.style.color = '#8c8388';
      } else {
        passwordField.type = 'password';
        toggleButton.classList.remove('fa-eye');
        toggleButton.classList.add('fa-eye-slash');
        toggleButton.style.color = '#8c8388';
      }
    });
  });

  // ---------------------------------------------------------------

  function mostrarVistaPrevia() {
    var archivoInput = document.getElementById('fil_foto');
    var vistaPrevia = document.getElementById('vista_previa');
    var archivo = archivoInput.files[0];
  
    if (archivo) {
      var lector = new FileReader();
  
      lector.onload = function (e) {
        vistaPrevia.src = e.target.result;
        vistaPrevia.style.cursor = 'pointer';
        vistaPrevia.onclick = function () {
          abrirImagenEnVentana(e.target.result);
        };
      };
  
      lector.readAsDataURL(archivo);
    }
  }
  
  function abrirImagenEnVentana(url) {
    var ventanaNueva = window.open('', 'Imagen en Grande', 'width=800, height=600');
    if (ventanaNueva) {
      ventanaNueva.document.write('<img src="' + url + '" alt="Imagen en Grande" style="max-width: 100%; max-height: 100%;">');
    } else {
      alert('El navegador bloqueó la ventana emergente. Habilita las ventanas emergentes para ver la imagen en grande.');
    }
  }