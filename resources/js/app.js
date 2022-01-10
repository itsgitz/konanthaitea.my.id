require('./bootstrap');

//Bootstrap css
require('bootstrap');

//Fontawesome
require('@fortawesome/fontawesome-free/js/all.js');

//Additional/Custom javascript
import { runOrders } from './orders/orders';
import { runMenu } from './menus/main';
import { runStocks } from './stocks/main';
import { runCarts } from './carts/main';

window.onload = function() {
  runOrders();
  runMenu();
  runStocks();
  runCarts();
}
