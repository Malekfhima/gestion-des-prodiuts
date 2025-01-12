function verif(){
    let code = document.getElementById("code").value;
    let nom = document.getElementById("nom").value;
    let prix = document.getElementById("prix").value;
    if (code.length==0){
        alert("Donner le code De produit!!");
        return false
    }else if (nom.length==0){
        alert("Donner le nom De produit!!");
        return false
    }else if (prix.length==0){
        alert("Donner le Prix De produit!!");
        return false
    }else{
        if (code(code)==false || code.length<8) {
            alert("Verifer le code De produit");
            return false
        }else if (nom(nom)==false || nom.length<8){
            alert("Verifer le nom De produit");
            return false
        }else if (prix(prix)==false){
            alert("Verifer le prix De produit");
            return false
        }
    }
}
/*Verification le champs  */
function code(ch){
    let i=0;
    while(i<ch.length-1) {
        if (("A"<=ch.charAt(i).toUpperCase() || ch.charAt(i).toUpperCase()<="Z")||("0"<=ch.charAt(i) || ch.charAt(i)>="9")){
            i++;
        }
    }
    return i==ch.length
}
/*Verification le champs nom */
function nom(ch){
    let i=0;
    while(i<ch.length-1) {
        if (("A"<=ch.charAt(i).toUpperCase() || ch.charAt(i).toUpperCase()<="Z" )){
            i++;
        }
    }
    return i==ch.length
}
/*Verification le champs Prix */
function prix(x){
   if (isNaN(x) || x <= 0){
        return false;
   }else{
    return true;
   }
}