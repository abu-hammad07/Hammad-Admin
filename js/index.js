const phoneInputField = document.querySelector("#phone");
const phoneInput = window.intlTelInput(phoneInputField, {
  utilsScript:
    "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
});

//  =============sidebar================

// ===========institute form valdetoin===========

// var InstituteForm = document.getElementById("InstituteForm");

// function insForm() {
//   var insName = document.getElementById("insName").value
//   var insLo = document.getElementById("insLo").value

//   if (insName == "") {
//     var InstituteForm = document.getElementById("InstituteForm").innerHTML = "** please fill The Name";
//     return false;

//   }

//   else if (insLo == "") {
//     var InsLocation = document.getElementById("InsLocation").innerHTML = "** please fill The Location";
//     return false;

//   }

// }

document.getElementById("selectAllBtn").addEventListener("click", function () {
  var checkboxes = document.querySelectorAll("input[type='checkbox']");
  for (var i = 0; i < checkboxes; i++) {
    checkboxes[i].checked = true;
  }
});

