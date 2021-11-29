export function setStatusClass() {
  let adminMenuMain = document.querySelector('#admin-menu-main');

  if (adminMenuMain) {
    const menuStatus = {
      available: 'Available',
      soldOut: 'Sold Out'
    };

    let menuStatusElement = document.getElementsByClassName('menu-status');

    Array.prototype.forEach.call(menuStatusElement, function(el) {
      switch (el.dataset.menuStatus) {
        case menuStatus.available:
          el.className += ' text-success';
          break;

        case menuStatus.soldOut:
          el.className += ' text-danger';
          break;
      }
    });
  }
}
