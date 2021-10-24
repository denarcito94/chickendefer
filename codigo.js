function inicio() {
  $('.botoncompra').click(anade);
  $('#carrito').load('pcarrito.php');
}
function anade() {
  var idnumero = $(this).val();
  var cantidad = $('#num' + idnumero).val();

  $('#carrito').load('pcarrito.php?p=' + $(this).val() + '&cant=' + cantidad);
}

function setActiveLink() {
  const urlHash = location.hash || '#go';
  const links = document.querySelectorAll('.menu a');
  links.forEach(l => {
    l.classList.remove('active');
  });

  document.querySelector(urlHash).classList.add('active');
}

function onlyNumber(target) {
  if (!target) return console.warn('Expected a target');

  if (/\D/g.test(target.value)) target.value = target.value.replace(/\D/g, '');
}

$(document).ready(function () {
  setActiveLink();

  // inicio();
  // anade();

  window.addEventListener('hashchange', setActiveLink);
});
