const { addProduct, getAllProducts } = require('./modules/product');
const form = document.getElementById('productForm');
const tableBody = document.querySelector('#productTable tbody');

form.addEventListener('submit', (e) => {
  e.preventDefault();
  const name = document.getElementById('name').value;
  const price = parseFloat(document.getElementById('price').value);
  const category = document.getElementById('category').value;

  addProduct(name, price, category);
  loadProducts();
  form.reset();
});

function loadProducts() {
  tableBody.innerHTML = '';
  const products = getAllProducts();
  products.forEach(p => {
    const tr = document.createElement('tr');
    tr.innerHTML = `<td>${p.name}</td><td>${p.price}</td><td>${p.category}</td>`;
    tableBody.appendChild(tr);
  });
}

window.onload = loadProducts;
