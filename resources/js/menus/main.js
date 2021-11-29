import { setStatusClass } from './index';
import { editMenuQuantity } from './edit';

export function runMenu() {
  editMenuQuantity();
  setStatusClass();
}
