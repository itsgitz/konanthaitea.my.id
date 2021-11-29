export function editMenuQuantity() {
  let editMenu = document.querySelector('#admin-menu-edit');

  if (editMenu) {
    let addMenuQuantityButton = document.querySelector('#add-menu-quantity-button');
    let reduceMenuQuantityButton = document.querySelector('#reduce-menu-quantity-button');
    let addBox = document.querySelector('#add-box');
    let reduceBox = document.querySelector('#reduce-box');
    let editAdd = document.querySelector('#edit-add');
    let editReduce = document.querySelector('#edit-reduce');

    addMenuQuantityButton.onclick = function() {
      addBox.classList.remove('d-none');
      reduceBox.classList.add('d-none');
      editReduce.value = '';
    }

    reduceMenuQuantityButton.onclick = function() {
      reduceBox.classList.remove('d-none');
      addBox.classList.add('d-none');
      editAdd.value = '';
    }
  }
}
