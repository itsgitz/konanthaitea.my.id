import { clientOrdersMain } from './client/main';
import { clientShowOrder } from './client/show';
import { adminOrdersMain } from './admin/main';
import { adminShowOrder } from './admin/show';

export function runOrders() {
  //Client area code
  clientOrdersMain();
  clientShowOrder();

  //Admin area code
  adminOrdersMain();
  adminShowOrder();
}
