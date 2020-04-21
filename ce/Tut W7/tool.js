var prices = {
    p1: 18.5,
    p2: 3.5
}


function plus(whichID) {
    console.log('plus button click');
    var whichQty = document.getElementById(whichID + "-qty");
    var whichSubtotal = document.getElementById(whichID + "-subtotal");
    whichQty.value = Number(whichQty.value) + 1;
    var price = whichQty.value * prices[whichID];
    console.log(whichQty.name + ' quantity is: ' + whichQty.value);
    console.log(whichSubtotal.attributes["name"].value + ' subtotal is: $' + price);
    whichSubtotal.innerHTML = 'Total: $' + price.toFixed(2);
}

function minus(whichID) {
    console.log('minus button click');
    var whichQty = document.getElementById(whichID + "-qty");
    var whichSubtotal = document.getElementById(whichID + "-subtotal");
    if (whichQty.value > 0) {
        whichQty.value = Number(whichQty.value) - 1;
    }
    var price = whichQty.value * prices[whichID];
    console.log(whichQty.name + ' quantity is: ' + whichQty.value);
    console.log(whichSubtotal.attributes["name"].value + ' subtotal is: $' + price);
    whichSubtotal.innerHTML = 'Total: $' + price.toFixed(2);
}

function updateQuantity(whichID) {
    console.log('Update Quantity Function');
    var whichQty = document.getElementById(whichID + "-qty");
    var whichSubtotal = document.getElementById(whichID + "-subtotal");
    var re = new RegExp("^[0-9]+$");
    if (!re.test(whichQty.value)) {
        alert('wrong quantity');
        return;
    }
    var price = whichQty.value * prices[whichID];
    console.log(whichQty.name + ' quantity is: ' + whichQty.value);
    console.log(whichSubtotal.attributes["name"].value + ' subtotal is: $' + price);
    whichSubtotal.innerHTML = 'Total: $' + price.toFixed(2);
}

function grandTotal() {
    var grandTotal = 0;
    for (pid in prices) {
        var whichQty = document.getElementById(pid + "-qty");
        grandTotal += prices[pid] * whichQty.value;
    }
    alert(grandTotal); // should display the grand total!
}