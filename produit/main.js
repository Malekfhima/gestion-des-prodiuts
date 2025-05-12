function verif() {
  let nom = document.getElementById("nom").value;
  let prix = document.getElementById("prix").value;
  let q = document.getElementById("q").value;
  if (nom.length == 0) {
    document.getElementById("e2").innerHTML = "le nom de produit est faux.";
    document.getElementById("e3").innerHTML = "";
    document.getElementById("e4").innerHTML = "";
    return false;
  } else if (isNaN(prix) == true || prix == "0" || prix == "") {
    document.getElementById("e3").innerHTML = "le prix de produit est faux.";
    document.getElementById("e2").innerHTML = "";
    document.getElementById("e4").innerHTML = "";
    return false;
  } else if (Number(q) <= 0) {
    document.getElementById("e3").innerHTML = "";
    document.getElementById("e2").innerHTML = "";
    document.getElementById("e4").innerHTML = "valeur incorrecte!";
    return false;
  } else {
    document.getElementById("e3").innerHTML = "";
    document.getElementById("e2").innerHTML = "";
    document.getElementById("e4").innerHTML = "";
    document.getElementById("msg").innerHTML = "le produit est enregistré avec succés";
  }
}

