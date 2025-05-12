const { default: Swal } = require("sweetalert2");
function verif() {
    let pass = document.getElementById("pass").value;
    const isNumeric = /^\d+$/.test(pass);
    const isLowerCase = pass.split('').every(char => char === char.toLowerCase() && char !== char.toUpperCase());
    const isUpperCase = pass.split('').every(char => char === char.toUpperCase() && char !== char.toLowerCase());
    const hasLowerCase = /[a-z]/.test(pass);
    const hasUpperCase = /[A-Z]/.test(pass);
    const hasNumbers = /\d/.test(pass);
    const hasSymbols = /[!@#\$%\^\&*\)\(+=._-]/.test(pass);
    if (hasLowerCase && hasUpperCase && hasNumbers && hasSymbols) {
        if (pass.length >= 4 && pass.length <= 6) {
            Swal.fire("Instantly");
        } else if (pass.length == 7) {
            Swal.fire("31 seconds");
        } else if (pass.length == 8) {
            Swal.fire("39 minutes");
        } else if (pass.length == 9) {
            Swal.fire("2 days");
        } else if (pass.length == 10) {
            Swal.fire("5 months");
        } else if (pass.length == 11) {
            Swal.fire("34 years");
        } else if (pass.length == 12) {
            Swal.fire("34K years");
        } else if (pass.length == 13) {
            Swal.fire("202K years");
        } else if (pass.length == 14) {
            Swal.fire("16m years");
        } else if (pass.length == 15) {
            Swal.fire("1bn years");
        } else if (pass.length == 16) {
            Swal.fire("92bn years");
        } else if (pass.length == 17) {
            Swal.fire("7tn years");
        } else if (pass.length >= 18) {
            Swal.fire("438tn years");
        }
        return false;
    }
    if (hasLowerCase && hasUpperCase && hasNumbers) {
        if (pass.length >= 4 && pass.length <= 6) {
            Swal.fire("Instantly");
        } else if (pass.length == 7) {
            Swal.fire("7 seconds");
        } else if (pass.length == 8) {
            Swal.fire("7 minutes");
        } else if (pass.length == 9) {
            Swal.fire("7 hour");
        } else if (pass.length == 10) {
            Swal.fire("3 weeks");
        } else if (pass.length == 11) {
            Swal.fire("3 years");
        } else if (pass.length == 12) {
            Swal.fire("200 years");
        } else if (pass.length == 13) {
            Swal.fire("12K years");
        } else if (pass.length == 14) {
            Swal.fire("750K years");
        } else if (pass.length == 15) {
            Swal.fire("45M years");
        } else if (pass.length == 16) {
            Swal.fire("3BN years");
        } else if (pass.length == 17) {
            Swal.fire("179BN years");
        } else if (pass.length >= 18) {
            Swal.fire("11TN years");
        }
        return false;
    }
    if (isUpperCase && hasUpperCase) {
        if (pass.length >= 4 && pass.length <= 6) {
            Swal.fire("Instantly");
        } else if (pass.length == 7) {
            Swal.fire("2 seconds");
        } else if (pass.length == 8) {
            Swal.fire("2 minutes");
        } else if (pass.length == 9) {
            Swal.fire("1 hour");
        } else if (pass.length == 10) {
            Swal.fire("3 days");
        } else if (pass.length == 11) {
            Swal.fire("5 months");
        } else if (pass.length == 12) {
            Swal.fire("24 years");
        } else if (pass.length == 13) {
            
            Swal.fire( "1K years");
        } else if (pass.length == 14) {
            Swal.fire( "64K years");
        } else if (pass.length == 15) {
            Swal.fire( "3m years");
        } else if (pass.length == 16) {
            Swal.fire( "173m years");
        } else if (pass.length == 17) {
            Swal.fire( "9bn years");
        } else if (pass.length >= 18) {
            Swal.fire( "467bn years");
        }
        return false;
    }
    if (isLowerCase) {
        if (pass.length >= 4 && pass.length <= 8) {
            Swal.fire( "Instantly");
        } else if (pass.length == 9) {
            Swal.fire( "10 seconds");
        } else if (pass.length == 10) {
            Swal.fire( "4 minutes");
        } else if (pass.length == 11) {
            Swal.fire( "2 hours");
        } else if (pass.length == 12) {
            Swal.fire( "2 days");
        } else if (pass.length == 13) {
            Swal.fire( "2 months");
        } else if (pass.length == 14) {
            Swal.fire( "4 years");
        } else if (pass.length == 15) {
            Swal.fire( "100 years");
        } else if (pass.length == 16) {
            Swal.fire( "3K years");
        } else if (pass.length == 17) {
            Swal.fire( "69K years");
        } else if (pass.length >= 18) {
            Swal.fire( "2m years");
        }
        return false;
    }
    if (isNumeric) {
        if (pass.length >= 4 && pass.length <= 11) {
            Swal.fire( "Instantly");
        } else if (pass.length == 12) {
            Swal.fire( "2 seconds");
        } else if (pass.length == 13) {
            Swal.fire( "19 seconds");
        } else if (pass.length == 14) {
            Swal.fire( "3 minutes");
        } else if (pass.length == 15) {
            Swal.fire( "32 minutes");
        } else if (pass.length == 16) {
            Swal.fire( "5 hours");
        } else if (pass.length == 17) {
            Swal.fire( "2 days");
        } else if (pass.length >= 18) {
            Swal.fire( "3 weeks");
        }
        return false;
    }
    return true;
}