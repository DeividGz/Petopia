const frete = document.getElementById("frete");
const comissao = document.getElementById("comissao");
const itemsCart = document.querySelector("#items-cart");

window.onload = () => {
  renderCart();
};

function calcular() {
  let total = readStorage("total");
  // console.log(total);
  frete.value = (total * 0.05).toFixed(2);
  comissao.value = (total * 0.03).toFixed(2);
}
calcular();

function renderCart() {
  let cart = readStorage("cart");
  cart.map((item) => {
    if (item.quantity > 0) {
      itemsCart.innerHTML += `
            <tr>
              <td>${item.name}</td>
              <td>R$${item.value}</td>
              <td>${item.quantity}</td>
              <td>R$${item.value * item.quantity}</td>
            </tr>
            `;
    }
  });
}

function clean() {
  recordStorage("cart", []);
  recordStorage("total", []);
}

// Obter o valor armazenado no localStorage
var data = localStorage.getItem("cart");

$.ajax({
  url: "compra.php",
  method: "POST",
  data: { data: JSON.stringify(data) },
  success: function (response) {
    console.log(response);
    console.log(data);

    Cookies.set("cart", data, { expires: 1 });
  },
});

// Enviar o valor para o servidor PHP usando uma solicitação AJAX
// var xhttp = new XMLHttpRequest();
// xhttp.onreadystatechange = function() {
//   if (this.readyState === 4 && this.status === 200) {
//     // A solicitação foi concluída com sucesso
//     console.log('Dados enviados para o PHP.');
//   }
// };
// xhttp.open("POST", "compra.php", true);
// xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
// xhttp.send("data=" + data);
