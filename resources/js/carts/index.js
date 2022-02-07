export function delivery() {
  let cartDeliveryElement = document.querySelector('#cart-delivery');

  if (cartDeliveryElement) {
    // Total order
    let totalOrderElement = document.querySelector('#total-order');

    // Address alert message
    let addressAlertElement = document.querySelector('#address-alert');
    let phoneAlertElement = document.querySelector('#phone-alert');

    if (addressAlertElement || phoneAlertElement) {
      cartDeliveryElement.value = 'Delivery';
    }

    // Total price
    let selectedValue = cartDeliveryElement.options[cartDeliveryElement.selectedIndex].value;
    let cartAddressBoxElement = document.querySelector('#cart-address-box');
    let cartAddressElement = document.querySelector('#cart-address');
    let cartPhoneElement = document.querySelector('#cart-phone');
    let totalPriceElement = document.querySelector('#total-price');
    let hiddenTotalPriceElement = document.querySelector('#hidden-total-price')
    let hiddentTotalOrderElement = document.querySelector('#hidden-total-order');

    // Delivery fee
    let deliveryFeeBoxElement = document.querySelector('#delivery-fee-box');
    let deliveryElement = document.querySelector('#delivery-fee');
    let deliveryFeeNum = 0;

    let kecamatanKelurahanElement = document.querySelector('#kecamatanKelurahan');
    let selectedValueKecamatanKelurahan = kecamatanKelurahanElement.options[kecamatanKelurahanElement.selectedIndex].value;
    let regionFee = selectedValueKecamatanKelurahan.split('|')[0];
    let regionName = selectedValueKecamatanKelurahan.split('|')[1];
    let estimasi = selectedValueKecamatanKelurahan.split('|')[2];

    let estimasiPickup = 10;

    let hiddenEstimasi = document.querySelector('#hidden-estimasi');

    let hiddenRegionElement = document.querySelector('#regionName');


    totalOrderElement.innerHTML = `Rp. ${convertToMoney(hiddentTotalOrderElement.value)},00`;

    let paymentMethod = document.querySelector('#cart-payment-method');
    let selectedPaymentMethod = paymentMethod.options[paymentMethod.selectedIndex].value;
    let norekBank = document.querySelector('#norek-bank');
    let norekVa = document.querySelector('#norek-va');

    let defaultAddressElement = document.querySelector('#default-address');
    let defaultAddress = defaultAddressElement.value.split('|')[0];
    let defaultPhone = defaultAddressElement.value.split('|')[1];

    // Onload
    if (selectedValue == 'Delivery') {
      cartAddressBoxElement.classList.remove('d-none');
      cartAddressElement.disabled = false;
      cartPhoneElement.disabled = false;
      kecamatanKelurahanElement.disabled = false;
      deliveryFeeBoxElement.classList.remove('d-none');

      deliveryElement.innerHTML = `Rp. ${convertToMoney(deliveryFeeNum)},00`;
      totalPriceElement.innerHTML = `Rp. ${convertToMoney(hiddentTotalOrderElement.value, deliveryFeeNum)},00`;

      if (selectedPaymentMethod == 'Bank Transfer') {
        norekBank.classList.remove('d-none');
        norekVa.classList.add('d-none');
      } else {
        norekBank.classList.add('d-none');
        norekVa.classList.remove('d-none');
      }

      if (defaultAddressElement.checked) {
        cartAddressElement.value = defaultAddress;
        cartPhoneElement.value = defaultPhone;
      } else {
        cartAddressElement.value = '';
        cartPhoneElement.value = '';
      }

      hiddenEstimasi.value = estimasi || estimasiPickup;

    } else {
      cartAddressBoxElement.classList.add('d-none');
      cartAddressElement.disabled = true;
      cartPhoneElement.disabled = true;
      kecamatanKelurahanElement.disabled = true;
      hiddenTotalPriceElement.value = hiddentTotalOrderElement.value;
      totalPriceElement.innerHTML = `Rp. ${convertToMoney(hiddentTotalOrderElement.value)},00`;

      norekBank.classList.add('d-none');
      norekVa.classList.add('d-none');

      hiddenEstimasi.value = estimasiPickup;
    }

    defaultAddressElement.addEventListener('change', function() {
      let defaultAddress = this.value.split('|')[0];
      let defaultPhone = this.value.split('|')[1];

      if (this.checked) {
        cartAddressElement.value = defaultAddress;
        cartPhoneElement.value = defaultPhone;
      } else {
        cartAddressElement.value = '';
        cartPhoneElement.value = '';
      }
    });

    // On change or selected
    cartDeliveryElement.addEventListener('change', function() {
      if (this.value == 'Delivery') {
        cartAddressBoxElement.classList.remove('d-none');
        cartAddressElement.disabled = false;
        cartPhoneElement.disabled = false;
        kecamatanKelurahanElement.disabled = false;
        deliveryFeeBoxElement.classList.remove('d-none');

        // deliveryElement.innerHTML = `Rp. ${convertToMoney(deliveryFeeNum)},00`;
        // totalPriceElement.innerHTML = `Rp. ${convertToMoney(hiddentTotalOrderElement.value, deliveryFeeNum)},00`
        // hiddenTotalPriceElement.value = parseInt(hiddentTotalOrderElement.value) + parseInt(deliveryFeeNum);
      } else {
        cartAddressBoxElement.classList.add('d-none');
        cartAddressElement.disabled = true;
        cartPhoneElement.disabled = true;
        kecamatanKelurahanElement.disabled = true;
        deliveryFeeBoxElement.classList.add('d-none');

        hiddenTotalPriceElement.value = hiddentTotalOrderElement.value;
        totalPriceElement.innerHTML = `Rp. ${convertToMoney(hiddentTotalOrderElement.value)},00`;
      }
    })

    kecamatanKelurahanElement.addEventListener('change', function() {
      //let deliveryFeeNum = this.value.split('|')[0] || 0;
      let estimasi = this.value.split('|')[2] || estimasiPickup;

      deliveryElement.innerHTML = `Rp. ${convertToMoney(deliveryFeeNum)},00`;
      totalPriceElement.innerHTML = `Rp. ${convertToMoney(hiddentTotalOrderElement.value, deliveryFeeNum)},00`
      hiddenTotalPriceElement.value = parseInt(hiddentTotalOrderElement.value) + parseInt(deliveryFeeNum);

      hiddenEstimasi.value = estimasi;
    });

    paymentMethod.addEventListener('change', function() {
      if (this.value == 'Bank Transfer') {
        norekBank.classList.remove('d-none');
        norekVa.classList.add('d-none');
      } else {
        norekBank.classList.add('d-none');
        norekVa.classList.remove('d-none');
      }
    });
  }
}

function convertToMoney(num, fee = 0) {
  let rupiah = Intl.NumberFormat('id-ID')

  let totalWithFee = parseInt(num) + parseInt(fee);
  let totalPriceMoneyFormat = rupiah.format(totalWithFee);

  return totalPriceMoneyFormat;
}
