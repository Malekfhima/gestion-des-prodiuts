function aff(){
    var nom=document.getElementById("nom").value;
    var q=document.getElementById("q").value;
    if(q==0){
        document.getElementById("msg").innerHTML="Quantité insuffisante pour le produit :"+nom+". Quantité disponible :"+q;
        document.getElementById("m1").innerHTML="";
        document.getElementById("m2").innerHTML="";
        return false;
    }else if(q>$q){
        document.getElementById("msg").innerHTML="Quantité insuffisante pour le produit :"+nom+". Quantité disponible :"+q;
        document.getElementById("m1").innerHTML="";
        document.getElementById("m2").innerHTML="";
        return false;
    }else{
        document.getElementById("msg").innerHTML="Les produits ont été enregistrés avec succès!"
        let s=q*prix;
        document.getElementById("m1").innerHTML=nom+":"+q+"×"+prix+"="+s;
        document.getElementById("m2").innerHTML="Montant total :"+s;
        return false;
    }
    return true;
}