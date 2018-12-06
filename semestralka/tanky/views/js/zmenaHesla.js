
function testPassword() {
    if (document.getElementById('pass1').value == document.getElementById('pass2').value) {
        document.getElementById('submitBtn').disabled = false;
        document.getElementById('output').innerHTML = "";
    }
    else {
        document.getElementById('output').innerHTML = "Nestejná hesla";
        document.getElementById('submitBtn').disabled = true;
    }
}  
