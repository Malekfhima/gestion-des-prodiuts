function verif(){
    let nom = document.getElementById("nom").value;
    let prix = document.getElementById("prix").value;
    let q=document.getElementById("q").value;
 if(vf(nom) == false || nom.length == 0 ){
        document.getElementById("e2").innerHTML = "le nom de produit est faux.";
        document.getElementById("e3").innerHTML = "";
        document.getElementById("e4").innerHTML ="";
        return false;
    }else if(isNaN(prix)==true || prix == "0" || prix ==""){
        document.getElementById("e3").innerHTML = "le prix de produit est faux.";
        document.getElementById("e2").innerHTML = "";
        document.getElementById("e4").innerHTML ="";
        return false;
    }else if(Number(q)<=0){
        document.getElementById("e3").innerHTML = "";
        document.getElementById("e2").innerHTML = "";
        document.getElementById("e4").innerHTML ="enti b mo5k tw !!!!!!!!";
        return false;
    }else{
        document.getElementById("e3").innerHTML = "";
        document.getElementById("e2").innerHTML = "";
        document.getElementById("e4").innerHTML ="";
        document.getElementById("msg").innerHTML = "il produit tsajal jwou behi"
    }

}
function vf(a){
    let nb = 0 
    let i = 0
    let vr = a.toUpperCase()
    for( i = 0 ; i<vr.length ; i++){
        if(("A"<=vr.charAt(i)&&vr.charAt(i)<="Z")||("0"<=vr.charAt(i)&&vr.charAt(i)<="9")){
            nb = nb+1
        }
    }
    return nb == vr.length 
}