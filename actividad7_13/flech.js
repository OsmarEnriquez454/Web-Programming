document.querySelectorAll("#latabla td").forEach(celda => {
  celda.onmouseover = () => !celda.classList.contains("verde") && celda.classList.add("resaltado");
  celda.onmouseout  = () => celda.classList.remove("resaltado");
});
