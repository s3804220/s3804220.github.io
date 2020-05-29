function checkCustInfo(){
  var submitButton = document.getElementById('order');
  var nameInput = document.getElementById('name');
  var mobileInput = document.getElementById('mobile')
  var addressInput =  document.getElementById('address');

  var namePattern = /^[a-zA-Z\'\.\-]+[\s]?([a-zA-Z\'\.\-]+[\s]?)+$/;
  var mobilePattern = /^(\(04\)|04|\+61[\s]?4)[\s]?(\d[\s]?){8}$/;

  if (namePattern.test(nameInput.value) && mobilePattern.test(mobileInput.value) && addressInput.value != ''){
    submitButton.disabled = false;
  }
}
function displayThank(){
  alert('Thank you for shopping with us!');
}