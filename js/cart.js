const itemsCart = document.querySelector("#items-cart");
const amount = document.querySelector("#amount");
const showCart = document.querySelector("#show-cart");
const emptyCart = document.querySelector("#empty-cart");
let empty = true;

window.onload = () => {
  let cart = readStorage("cart");
  for (let i = 0; i < cart.length; i++) {
    if (cart[i].quantity !== 0) {
      empty = false;
    }
    if (empty) {
      showCartOrEmptyMessage(false);
    } else {
      showCartOrEmptyMessage(true);
    }
  }
  renderCart();
};

function renderCart() {
  let cart = readStorage("cart");
  let purchaseAmount = 0;
  let outOfCartProducts = 0;
  cart.map((item) => {
    if (item.quantity > 0) {
      itemsCart.innerHTML += `
            <tr>
            <td>${item.name}</td>
            <td>R$${item.value}</td>
            <td>
                <div class="quantity">
                    <button onclick="updateCart('sum', ${item.id})">
                        <img src="./img/mais.svg" alt="Adicionar" />
                    </button>
                    <span>${item.quantity}</span>
                    <button onclick="updateCart('sub', ${item.id})">
                        <img src="./img/menos.svg" alt="Remover" />
                    </button>
                    <button onclick="updateCart('delete', ${item.id})">
                        <img src="./img/delete.svg" alt="Excluir" />
                    </button>
                </div>
            </td>
            <td>R$${item.value * item.quantity}</td>
            </tr>
            `;
    } else {
      outOfCartProducts++;
    }
    if (outOfCartProducts === cart.length) {
      showCartOrEmptyMessage(false);
    } else {
      showCartOrEmptyMessage(true);
    }
    purchaseAmount += item.value * item.quantity;
  });

  amount.textContent = purchaseAmount.toFixed(2);
  recordStorage("total", purchaseAmount);
}

function updateCart(operation, id) {
  let cart = readStorage("cart");
  changeStorage(operation, id);
  for (let i = 0; i < cart.length; i++) {
    if (cart[i].quantity !== 0) {
      empty = false;
    }
    if (empty) {
      showCartOrEmptyMessage(false);
    } else {
      showCartOrEmptyMessage(true);
      itemsCart.innerHTML = "";
      renderCart();
    }
  }
}

function showCartOrEmptyMessage(filled) {
  if (filled) {
    // true
    showCart.style.display = "block";
    emptyCart.style.display = "none";
  } else {
    // false
    showCart.style.display = "none";
    emptyCart.style.display = "block";
  }
}
