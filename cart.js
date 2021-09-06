// INIT VARS
let listProducts = [];
let listClient = [];
let client = null;
let listCart = document.querySelector("#cart-list");
let boxSearch = document.querySelector("#box-search");
// GET SELECT PRODUTS LIST
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
//  RENDER PRODUCTS IN CART
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

// RESET AND CLEAR DATA CART
function cleanCart() {
  listProducts = [];
  listClient = [];
  client = [];
  listCart.innerHTML = `<li class="list-group-item">Carrito Vacio :(</li>`;
  document.querySelector("#total").textContent = `Total a pagar : ${0}Bs.`;
  document.querySelector(
    "#count-products"
  ).textContent = `Total de Productos : ${listProducts.length}`;
  document.querySelector("#data-client").innerHTML = "<span>Sin cliente</span>";
}

// DELETE ITEM CART
function deleteItemCart(e, i) {
  let parent = e.parentNode;

  listProducts.splice(i, 1);
  parent.remove();
  printView();
}

// ADD ITEM CART
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

// SEARCH CLIENT BY NIT OR NAME
async function search() {
  let $input = document.querySelector("#search-client");

  let res = await axios.get(`php/ajax_client.php?q=${$input.value}`);
  let { data } = res;
  // console.log(data.body);
  let items = "";
  data.body.map((c, i) => {
    listClient.push(c);
    items += `<li onclick="selectClient(${i})" class="list-group-item mb-3 shadow-sm animate__animated animate__fadeInLeft animate__faster">
      <b>NIT: ${c.nit} - Nombres: ${c.names} ${c.last_name} - Direccion: ${c.address} - Telefono ${c.phone}</b>
      </li>`;
  });

  document.querySelector("#client-list").innerHTML = items;
}

// OPEN BOX SEARCH CLIENT
function openSearchClient() {
  boxSearch.classList.remove("d-none");
}
// CLOSE BOX SEARCH CLIENT
function closeSearchClient() {
  boxSearch.classList.add("d-none");
  document.querySelector("#client-list").innerHTML = "";
  listClient = [];
}

// SELECT CLIENT LIST AND RENDER IN CART
function selectClient(index) {
  if (index < 0) return console.error("Expected Object Client");

  client = listClient[index];

  document.querySelector("#data-client").innerHTML = `
    <span><b>Cliente:</b> ${client.nit} - ${
    client.names + " " + client.last_name
  }</span>
    <span><b>Direccion:</b> ${client.address}</span>
    <span><b>Telefono:</b> ${client.phone}</span>
  `;
  closeSearchClient();
}
// HANDLER INPUT TYPE NUMBER
function handlerInputNumber(e) {
  let $target = e.target;
  if ($target.value < 0) return ($target.value = 0);

  $target.value = $target.value.replace(/[a-z]/gi, "");
}

// PROCESS CART AND SEND DATA
function processCart() {
  let total = 0;
  listProducts.forEach((i) => {
    total += parseInt(i.price * i.count);
  });

  let data = {
    total,
    products: listProducts,
    client,
  };

  if (!data.client) return alertify.error("No has seleccionado un cliente");
  if (!data.products || data.products.length < 1)
    return alertify.error("El pedido no tiene productos para procesar");

  $.ajax({
    type: "POST",
    url: "./php/ajax_pedido.php",
    data: { ...data },
    dataType: "json",
  })
    .done(function (res) {
      console.log(res);
      if (res.statusCode >= 400) return alertify.error(res.body);

      alertify.success(res.body);
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
      console.error(
        "The following error occured: " + textStatus + " " + errorThrown
      );
    });
}
