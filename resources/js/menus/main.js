export function editMenuQuantity() {
  let editMenu = document.querySelector('#edit-menu');

  if (editMenu) {
    //<input id="edit-quantity-input" class="form-control" type="number" min="1">
    let addMenuQuantityButton = document.querySelector('#add-menu-quantity-button');
    let reduceMenuQuantityButton = document.querySelector('#reduce-menu-quantity-button');
    let editAdd = document.querySelector('#edit-add');
    let editReduce = document.querySelector('#edit-reduce');

    addMenuQuantityButton.onclick = function() {
      editAdd.classList.remove('d-none');
      editReduce.classList.add('d-none');
    }

    reduceMenuQuantityButton.onclick = function() {
      editReduce.classList.remove('d-none');
      editAdd.classList.add('d-none');
    }
  }
}
