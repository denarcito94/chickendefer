let listProducts = [];
let listCart = document.querySelector("#cart-list");
function getItemForm(e) {
  e.preventDefault();
  const $target = e.target;

  if ($target.id.value <= 0 || !$target.id.value)
    return alert("Ingresa un cantida valida");

  let p = {
    id: $target.id.value,
    name: $target.name.value,
    count: $target.count.value,
    price: $target.price.value,
  };
  addCart(p);

  $target.reset();
}

function printView() {
  if (!listProducts.length >= 1) {
    cleanCart();
    return;
  }

  listCart.innerHTML = "";
  let items = "";
  listProducts.map((p, i) => {
    items += `<li index="${i}" class="list-group-item d-flex justify-content-between">
								<span class="text-dark">${p.name}</span>
								<span class="text-dark">${p.price} Bs.</span>
								<span class="text-dark">${p.count}</span>
								<span class="text-dark">${parseInt(p.count * p.price)}Bs.</span>
                <button onclick="deleteItemCart(this, ${i})" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
							</li>`;
  });

  listCart.innerHTML = items;
  let total = 0;
  listProducts.forEach((i) => {
    total += parseInt(i.count * i.price);
  });

  document.querySelector("#total").textContent = `Total a pagar : ${total}Bs.`;
  document.querySelector(
    "#count-products"
  ).textContent = `Total de Productos : ${listProducts.length}`;
}
function cleanCart() {
  listProducts = [];
  listCart.innerHTML = `<li class="list-group-item">Carrito Vacio :(</li>`;
  document.querySelector("#total").textContent = `Total a pagar : ${0}Bs.`;
  document.querySelector(
    "#count-products"
  ).textContent = `Total de Productos : ${listProducts.length}`;
}

function deleteItemCart(e, i) {
  let parent = e.parentNode;

  listProducts.splice(i, 1);
  parent.remove();
  printView();
}

function addCart(p = null) {
  if (!p) return console.error("Expected parameter object product");

  let total = 0;
  listProducts.push(p);
  let productMap = listProducts.map((i) => {
    return [i.id, i];
  });

  let productMapArr = new Map(productMap);
  let uniques = [...productMapArr.values()];
  listProducts = uniques;
  listProducts.forEach((i) => {
    total += parseInt(i.price * i.count);
  });
  document.querySelector("#total").textContent = `Total a pagar : ${total}Bs.`;
  document.querySelector(
    "#count-products"
  ).textContent = `Total de Productos : ${listProducts.length}`;
  printView();
}
