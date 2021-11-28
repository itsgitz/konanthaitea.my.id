require('./bootstrap');

//Bootstrap css
require('bootstrap');

//Fontawesome
require('@fortawesome/fontawesome-free/js/all.js');

//Additional/Custom javascript
import { runOrders } from './orders/orders';
import { editMenuQuantity } from './menus/main';

window.onload = function() {
  runOrders();
  editMenuQuantity();
}
