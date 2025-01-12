function verif() {
    let nom = document.getElementById("nom").value;
    let mp = document.getElementById("mp").value;
    if (nom == "") {
        document.getElementById("e3").innerHTML = "7ot ism";
        document.getElementById("e1").innerHTML = ""
        return false;
    } else if (!verif_nom(nom)) {
        document.getElementById("e3").innerHTML = "il ism 8alit a 5ouna";
        document.getElementById("e1").innerHTML = ""
        return false;
    } else if (mp == "") {
        document.getElementById("e3").innerHTML = "";
        document.getElementById("e1").innerHTML = "7ot passe"
        return false;
    } else if (!verif_mp1(mp)) {
        document.getElementById("e3").innerHTML = "";
        document.getElementById("e1").innerHTML = "passe 8alit a 5ouna"
        return false;
    }
    return true;

    function verif_nom(ch) {
        let i = 0;
        while (i < ch.length) {
            let char = ch.charAt(i).toUpperCase();
            if ((char >= 'A' && char <= 'Z') || (ch.charAt(i) >= "0" && ch.charAt(i) <= "9") || (ch.charAt(i) == ".") || (ch.charAt(i) == " ")) {
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
            if ((char >= 'A' && char <= 'Z') || (ch.charAt(i) >= "0" && ch.charAt(i) <= "9") || (ch.charAt(i) == ".")) {
                i++;
            } else {
                break;
            }
        }
        return i == ch.length && ch.length >= 8;
    }
}
function affiche_pass() {
    var mot_de_passe = document.getElementById("mp");
    var checkbox = document.getElementById("ch");
    if (checkbox.checked) {
        mot_de_passe.type = "text";
    } else {
        mot_de_passe.type = "password";
    }
}