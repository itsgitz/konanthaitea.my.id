import { setStatusClass } from './index';
import { editMenuQuantity } from './edit';
import { addMenuRecipeItems } from './show';

export function runMenu() {
  editMenuQuantity();
  setStatusClass();
  addMenuRecipeItems();
}
