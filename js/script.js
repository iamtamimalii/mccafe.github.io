
function loadTea() {
  var tea = new XMLHttpRequest();
  tea.onload = function () {
    document.getElementById("show").innerHTML = this.responseText;
  };
  tea.open("GET", "tea.php", true);
  tea.send();
}

function loadCold() {
  var cold = new XMLHttpRequest();
  cold.onload = function () {
    document.getElementById("show").innerHTML = this.responseText;
  };
  cold.open("GET", "coldcoffee.php", true);
  cold.send();
}

function loadHot() {
  var hot = new XMLHttpRequest();
  hot.onload = function () {
    document.getElementById("show").innerHTML = this.responseText;
  };
  hot.open("GET", "hotcoffee.php", true);
  hot.send();
}

function loadSweet() {
  var sweet = new XMLHttpRequest();
  sweet.onload = function () {
    document.getElementById("show").innerHTML = this.responseText;
  };
  sweet.open("GET", "sweets.php", true);
  sweet.send();
}
