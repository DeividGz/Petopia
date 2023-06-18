const id = document.getElementById("id_produto");
const quantidade = document.getElementById("qt");

function showQuantity() {
  let cart = readStorage("cart");
  let avaliable = 0;
  i = 0;
  while (i < cart.length) {
    if (cart[i].id == id.innerHTML) {
      avaliable = cart[i].quantity;
      break;
    }
    i++;
  }
  quantidade.innerHTML = avaliable;
}
showQuantity();
