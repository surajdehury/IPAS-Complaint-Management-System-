

function showTable1() {
  document.getElementById("table1").style.display = "block";
  document.getElementById("table2").style.display = "none";
}

function showTable2() {
  document.getElementById("table1").style.display = "none";
  document.getElementById("table2").style.display = "block";
}

function goBack() {
  document.getElementById("table1").style.display = "none";
  document.getElementById("table2").style.display = "none";
}
