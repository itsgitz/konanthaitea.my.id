require('./bootstrap');

//Bootstrap css
require('bootstrap');

//Fontawesome
require('@fortawesome/fontawesome-free/js/all.js');

//Additional/Custom javascript
import { ordersMain } from './orders/main';
import { showOrder } from './orders/show';


window.onload = function() { 
  ordersMain();
  showOrder();
}

