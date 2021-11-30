export function addMenuRecipeItems() {
  let adminMenuShow = document.querySelector('#admin-menu-show');

  if (adminMenuShow) {
    let addRecipeItemsButton = document.querySelector('#add-menu-recipe-items-button');
    let closeAddMenuBox = document.querySelector('#close-add-menu-box');
    let addMenuRecipeBox = document.querySelector('#add-menu-recipe-box');

    if (addRecipeItemsButton) {
      addRecipeItemsButton.onclick = function() {
        addMenuRecipeBox.classList.remove('d-none');
      }

      closeAddMenuBox.onclick = function() {
        addMenuRecipeBox.classList.add('d-none');
      }
    }
  }
}
