var validatePhone = function (id) {
  var input = document.querySelector(id);
  var form = input.closest('form');
  var container = input.parentElement;
  var errorBlock = input.nextElementSibling;
  var errorMap = ["Некоректний номер", "Некоректний код країни", "Мало символів", "Забагато символів", "Некоректний номер"];

  var iti = window.intlTelInput(input, {
    //initialCountry: "auto",
    /*geoIpLookup: function(callback) {
      $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
        var countryCode = (resp && resp.country) ? resp.country : "";
        callback(countryCode);
      });
    },*/
    hiddenInput: "phone",
    utilsScript: "intlTelInput/utils.js",
    preferredCountries: ["us", "ua"]
    // any initialisation options go here
  });

  var preventDefault = function (e) {
    e.preventDefault();
  };

  var reset = function() {
    container.classList.remove("has-error");
    errorBlock.innerHTML = "";
    form.removeEventListener("submit", preventDefault);
  };

  // on blur: validate
  input.addEventListener('blur', function() {
    reset();
    if (input.value.trim()) {
      if (iti.isValidNumber()) {

      } else {
        form.addEventListener("submit", preventDefault);
        container.classList.add("has-error");
        var errorCode = iti.getValidationError();
        errorBlock.innerHTML = errorMap[errorCode];
      }
    }
  });

  // on keyup / change flag: reset
  input.addEventListener('change', reset);
  input.addEventListener('keyup', reset);
};
