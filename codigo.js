let listProduct = [];
function inicio() {
  $(".botoncompra").click(anade);
  $("#carrito").load("pcarrito.php");
}
function anade() {
  var idnumero = $(this).val();
  var cantidad = $("#num" + idnumero).val();

  $("#carrito").load("pcarrito.php?p=" + $(this).val() + "&cant=" + cantidad);
}

function getItemForm(e) {
  e.preventDefault();
  const $target = e.target;
  let p = {
    id: $target.id.value,
    name: $target.name.value,
    count: $target.count.value,
    price: $target.price.value,
  };
  addCart(p);
}

function addCart(p = null) {
  if (!p) return console.error("Expected parameter object product");

  console.log(p);
}

function setActiveLink() {
  const urlHash = location.hash || "#go";
  const links = document.querySelectorAll(".menu a");
  links.forEach((l) => {
    l.classList.remove("active");
  });

  document.querySelector(urlHash).classList.add("active");
}
$(document).ready(function () {
  setActiveLink();

  // inicio();
  // anade();

  window.addEventListener("hashchange", setActiveLink);
});
