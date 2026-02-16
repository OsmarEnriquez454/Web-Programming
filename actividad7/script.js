const tabla = document.getElementById('miTabla');

tabla.onmouseover = e => {
  const td = e.target.closest('td');
  if (!td) return;

  const fila = td.parentNode;
  const col = td.cellIndex;

  for (let cell of fila.cells) cell.classList.add('resaltar');
  for (let i = 1; i < tabla.rows.length; i++) {
    const cell = tabla.rows[i].cells[col];
    if (cell) cell.classList.add('resaltar');
  }
};

tabla.onmouseout = () => {
  document.querySelectorAll('.resaltar').forEach(c => c.classList.remove('resaltar'));
};