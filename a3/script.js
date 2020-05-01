/* Insert your javascript here */
document.addEventListener('DOMContentLoaded', function () {

  const main_secs = document.querySelectorAll(".main-section");
  const nav_links = document.querySelectorAll(".nav-item a");

  const makeActive = (item) => nav_links[item].classList.add("active");
  const removeActive = (item) => nav_links[item].classList.remove("active");
  const removeAllActive = () => [...main_secs.keys()].forEach((item) => removeActive(item));

  const sectionMargin = 200;

  let currentActive = 0;

  window.onscroll = () => {

    var current = main_secs.length - [...main_secs].reverse().findIndex((section) => window.scrollY >= section.offsetTop - sectionMargin) - 1

    if (current !== currentActive) {
      removeAllActive();
      currentActive = current;
      makeActive(current);
    }
  };
});

function getKey(object, value) {
  return Object.keys(object).find(key => object[key] === value);
}

const days = { 'MON': 'Monday', 'TUE': 'Tuesday', 'WED': 'Wednesday', 'THU': 'Thursday', 'FRI': 'Friday', 'SAT': 'Saturday', 'SUN': 'Sunday' };
const weekDays = ['MON','TUE', 'WED','THU','FRI'];
const movieID = { 'ACT': 'Avengers: Endgame', 'RMC': 'Top End Wedding', 'ANM': 'Dumbo', 'AHF': 'The Happy Prince' };
const timeConvert = { 'T12': '12pm', 'T15': '3pm', 'T18': '6pm', 'T21': '9pm' };
const seatPrice = { 'STA': 19.80, 'STP': 17.50, 'STC': 15.30, 'FCA': 30.00, 'FCP': 27.00, 'FCC': 24.00 };
const seatDiscount = { 'STA': 14.00, 'STP': 12.50, 'STC': 11.00, 'FCA': 24.00, 'FCP': 22.50, 'FCC': 21.00 };
var currentMovieID;
var currentMovieName;
var showtime;
var dayShort;

function toggleSynopsis(whichID) {
  var whichMovie = document.getElementById("synopsis" + whichID);
  var synopsisDisplay = whichMovie.style.display;

  for (var i = 0; i < Object.keys(movieID).length; i++) {
    if (Object.keys(movieID)[i] == whichID) {
      if (synopsisDisplay == 'block') {
        whichMovie.style.display = 'none';
      }
      else {
        whichMovie.style.display = 'block';
      }
    }
    else {
      var whichMovie2 = document.getElementById("synopsis" + Object.keys(movieID)[i]);
      whichMovie2.style.display = 'none';
    }
  }
  currentMovieID = whichID;
  currentMovieName = movieID[whichID];
}

const bookingBtn = [...document.querySelectorAll(".booking-btn")];
const bookingSth = document.querySelectorAll(".booking-btn");
const bookSection = document.getElementById("Booking-collapse");
bookingBtn.forEach((btnElement) => btnElement.addEventListener('click', toggleBooking));

function toggleBooking() {
  showtime = this.innerHTML;
  document.getElementById('auto-info').innerHTML = currentMovieName + " - " + showtime;
  bookSection.style.display = 'block';
  document.getElementById('movie-id').value = currentMovieID;
  for (var i = 0; i < Object.values(days).length; i++) {
    if (showtime.includes(Object.values(days)[i])) {
      document.getElementById('movie-day').value = Object.keys(days)[i];
    }
  }
  for (var i = 0; i < Object.values(timeConvert).length; i++) {
    if (showtime.includes(Object.values(timeConvert)[i])) {
      document.getElementById('movie-hour').value = Object.keys(timeConvert)[i];
    }
  }
  calcPrice();
  console.log(document.getElementById('movie-id').value + " " + document.getElementById('movie-day').value + " " + document.getElementById('movie-hour').value);
}

const closeBook = document.getElementById("close-booking");
closeBook.addEventListener('click', closeBooking);

function closeBooking() {
  bookSection.style.display = 'none';
  console.log(document.getElementById('movie-id').value + " " + document.getElementById('movie-day').value + " " + document.getElementById('movie-hour').value);
}

var selections = [...document.querySelectorAll(".seat-select")];
selections.forEach(addList);

function addList(selection) {
  for (var i = 1; i <= 10; i++) {
    var options = document.createElement('option');
    options.text = options.value = i;
    selection.add(options);
  }
}
selections.forEach((seatItem) => seatItem.addEventListener('change', calcPrice));

function calcPrice() {
  var totalPrice = 0;
  for (let i = 0; i < selections.length; i++) {
      if (document.getElementById('movie-day').value == 'MON' || document.getElementById('movie-day').value == 'WED' ||
      (weekDays.includes(document.getElementById('movie-day').value) && document.getElementById('movie-hour').value == 'T12')) {
        totalPrice += seatDiscount[selections[i].id.slice(-3)] * selections[i].value;
      }
      else {
        totalPrice += seatPrice[selections[i].id.slice(-3)] * selections[i].value;
      }
  }
  document.getElementById('total').innerHTML = "Total $ "+totalPrice.toFixed(2);
}
function checkCustName(){
  var custNameDisplay = document.getElementById('cust-name');
  var pattern = /^[a-zA-Z\'\.\-]+[\s]*([a-zA-Z\'\.\-]+[\s]*)+$/;
  //var pattern = /^[a-zA-Z\'\.\-]+[ ]*[a-zA-Z]+$/;
  if (pattern.test(custNameDisplay.value)){
    disableSubmitButton(false);
    custNameDisplay.style.border = 'none';
    console.log('correct.');
  }
  else{
    disableSubmitButton(true);
    custNameDisplay.style.border = '2px solid red';
    console.log('invalid.');
  }
}
function disableSubmitButton(value){ //true, false only
  var submitButton = document.getElementById('order');
  if (value == true){
    submitButton.disabled = value;
  }
  else if (value == false){
    submitButton.disabled = value;
  }
  else{
    console.log("Incorrect value for function toggleSubmitButton()");
  }
}