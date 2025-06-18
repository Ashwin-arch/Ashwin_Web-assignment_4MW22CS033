const fs = require('fs');
const path = require('path');
const dbPath = path.join(__dirname, '..', 'db', 'data.json');

function readData() {
  if (!fs.existsSync(dbPath)) {
    fs.writeFileSync(dbPath, JSON.stringify({ products: [] }, null, 2));
  }
  const raw = fs.readFileSync(dbPath);
  return JSON.parse(raw);
}

function writeData(data) {
  fs.writeFileSync(dbPath, JSON.stringify(data, null, 2));
}

function addProduct(name, price, category) {
  const db = readData();
  db.products.push({
    id: Date.now(),
    name,
    price,
    category
  });
  writeData(db);
}

function getAllProducts() {
  const db = readData();
  return db.products;
}

module.exports = {
  addProduct,
  getAllProducts
};
