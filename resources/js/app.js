require('./bootstrap');

//Bootstrap css
require('bootstrap');

//Fontawesome
require('@fortawesome/fontawesome-free/js/all.js');

//Additional/Custom javascript
import { runOrders } from './orders/orders';

window.onload = function() { 
  runOrders();
}

