const colorSwitch = document.querySelector('#switch input[type="checkbox"]');
function cambiaTema(ev) {
  if (ev.target.checked) {
    document.documentElement.setAttribute("class", "dark");
  } else {
    document.documentElement.removeAttribute("class");
  }
}
colorSwitch.addEventListener("change", cambiaTema);