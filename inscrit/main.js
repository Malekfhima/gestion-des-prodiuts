function verif() {
  let nom = document.getElementById("nom").value;
  let mp1 = document.getElementById("mp1").value;
  let mp2 = document.getElementById("mp2").value;
  let mail = document.getElementById("mail").value;
  let flous = document.getElementById("flous").value;
  if (nom == "") {
    document.getElementById("e3").innerHTML = "";
    document.getElementById("e1").innerHTML = "la case du nom est vide";
    document.getElementById("e2").innerHTML = "";
    document.getElementById("e4").innerHTML = "";
    document.getElementById("e5").innerHTML = "";
    return false;
  } else if (verif_nom(nom) == false) {
    document.getElementById("e3").innerHTML = "";
    document.getElementById("e1").innerHTML = "le nom n'est pas correcte";
    document.getElementById("e2").innerHTML = "";
    document.getElementById("e4").innerHTML = "";
    document.getElementById("e5").innerHTML = "";
    return false;
  } else if (mp1 == "") {
    document.getElementById("e3").innerHTML = "";
    document.getElementById("e1").innerHTML = "";
    document.getElementById("e2").innerHTML = "la case du mot de passe est vide ";
    document.getElementById("e4").innerHTML = "";
    document.getElementById("e5").innerHTML = "";
    return false;
  } else if (verif_mp1(mp1) == false) {
    document.getElementById("e3").innerHTML = "";
    document.getElementById("e1").innerHTML = "";
    document.getElementById("e2").innerHTML = "le mdp n'est pas correcte";
    document.getElementById("e4").innerHTML = "";
    document.getElementById("e5").innerHTML = "";
    return false;
  } else if (mp2 == "") {
    document.getElementById("e3").innerHTML = "écriver le mdp une autre fois ici";
    document.getElementById("e1").innerHTML = "";
    document.getElementById("e2").innerHTML = "";
    document.getElementById("e4").innerHTML = "";
    document.getElementById("e5").innerHTML = "";
    return false;
  } else if (verif_mp2(mp2, mp1) == false) {
    document.getElementById("e3").innerHTML = "écrivez le mdp correctement";
    document.getElementById("e1").innerHTML = "";
    document.getElementById("e2").innerHTML = "";
    document.getElementById("e4").innerHTML = "";
    document.getElementById("e5").innerHTML = "";
    return false;
  } else if (mail == "") {
    document.getElementById("e3").innerHTML = "";
    document.getElementById("e1").innerHTML = "";
    document.getElementById("e2").innerHTML = "";
    document.getElementById("e4").innerHTML = "l'email est vide";
    document.getElementById("e5").innerHTML = "";
    return false;
  } else if (verif_mail(mail) == false) {
    document.getElementById("e3").innerHTML = "";
    document.getElementById("e1").innerHTML = "";
    document.getElementById("e2").innerHTML = "";
    document.getElementById("e4").innerHTML = "l'email n'est pas correcte";
    document.getElementById("e5").innerHTML = "";
    return false;
  } else if (flous == "") {
    document.getElementById("e3").innerHTML = "";
    document.getElementById("e1").innerHTML = "";
    document.getElementById("e2").innerHTML = "";
    document.getElementById("e4").innerHTML = "";
    document.getElementById("e5").innerHTML = "choisissez une chose";
    return false;
  } else {
    document.getElementById("msg").innerHTML = "bienvenue";
    document.getElementById("e3").innerHTML = "";
    document.getElementById("e1").innerHTML = "";
    document.getElementById("e2").innerHTML = "";
    document.getElementById("e4").innerHTML = "";
    document.getElementById("e5").innerHTML = "";
  }
}
function verif_nom(ch) {
  let i = 0;
  while (i < ch.length) {
    let char = ch.charAt(i).toUpperCase();
    if (
      (char >= "A" && char <= "Z") ||
      (ch.charAt(i) >= "0" && ch.charAt(i) <= "9") ||
      ch.charAt(i) == "." ||
      ch.charAt(i) == " "
    ) {
      i++;
    } else {
      break;
    }
  }
  return i == ch.length && ch.length >= 8;
}
function verif_mp1(ch) {
  let i = 0;
  while (i < ch.length) {
    let char = ch.charAt(i).toUpperCase();
    if (
      (char >= "A" && char <= "Z") ||
      (ch.charAt(i) >= "0" && ch.charAt(i) <= "9") ||
      ch.charAt(i) == "."
    ) {
      i++;
    } else {
      break;
    }
  }
  return i == ch.length && ch.length >= 8;
}
function verif_mp2(ch, mp1) {
  return verif_mp1(ch) && ch == mp1;
}
function verif_mail(ch) {
  const domainesAcceptes = [
    "@gmail.com",
    "@outlook.com",
    "@yahoo.com",
    "@hotmail.com",
    "@icloud.com",
    "@protonmail.com",
  ];
  let pos = ch.indexOf("@");
  if (pos === -1) {
    return false;
  }
  let domaine = ch.substring(pos);
  return domainesAcceptes.includes(domaine);
}
function affiche_pass() {
  var mot_de_passe = document.getElementById("mp1");
  var mot_de_passe2 = document.getElementById("mp2");
  var checked = document.getElementById("ch").checked;
  if (checked) {
    mot_de_passe.type = "text";
    mot_de_passe2.type = "text";
  } else {
    mot_de_passe.type = "password";
    mot_de_passe2.type = "password";
  }
}
