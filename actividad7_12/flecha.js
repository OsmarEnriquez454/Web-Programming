const ultimaFila = document.querySelector("#Tabla tr:last-child");
document.querySelectorAll("#Tabla td").forEach(celda => {
  celda.onmouseover = () => !ultimaFila.contains(celda) && celda.classList.add("resaltado");
  celda.onmouseout  = () => celda.classList.remove("resaltado");
});