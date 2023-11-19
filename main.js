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

document.getElementById('vista_previa').style.display = 'none';
document.getElementById('mensaje_contenedor').style.display = 'none';

function mostrarVistaPrevia() {
  var archivoInput = document.getElementById('fil_foto');
  var vistaPrevia = document.getElementById('vista_previa');
  var mensajeContenedor = document.getElementById('mensaje_contenedor');
  var archivo = archivoInput.files[0];

  mensajeContenedor.style.display = 'none';

  if (archivo) {
      if (archivo.type.startsWith('image/')) {
          var lector = new FileReader();

          lector.onload = function (e) {
              vistaPrevia.src = e.target.result;
              mensajeContenedor.style.display = 'none';
              vistaPrevia.style.display = 'block';
          };

          lector.readAsDataURL(archivo);
      } else {
          mensajeContenedor.innerText = 'El archivo seleccionado no es una imagen válida.';
          mensajeContenedor.style.display = 'inline';
          vistaPrevia.style.display = 'none';
      }
  } else {
      vistaPrevia.style.display = 'none';
  }
}


function abrirImagenEnVentana() {
  var url = document.getElementById('vista_previa').src;
  if (url) {
      var imagenBlob = fetch(url).then(response => response.blob()).then(blob => {
          var nuevaVentana = window.open(URL.createObjectURL(blob), '_blank');
          if (!nuevaVentana) {
              alert('El navegador bloqueó la ventana emergente. Habilita las ventanas emergentes para ver la imagen en grande.');
          }
      });
  }
}