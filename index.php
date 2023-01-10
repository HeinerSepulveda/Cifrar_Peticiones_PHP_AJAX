
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cifrar peticiones</title>
</head>

<body>
	<h1>Cifrar peticiones</h1>
	<br>
    <input placeholder="Cifrar frase" type="text" name="Plato" id="Plato">
    <button id="Buscar">Cifrar</button>
</body>
<script src="js/jquery-v3.3.1.js"></script>
<script src="js/aes.js"></script>
</html>


<script>
var CryptoJSAesJson = {
    stringify: function (cipherParams) {
        var j = {ct: cipherParams.ciphertext.toString(CryptoJS.enc.Base64)};
        if (cipherParams.iv) j.iv = cipherParams.iv.toString();
        if (cipherParams.salt) j.s = cipherParams.salt.toString();
        return JSON.stringify(j).replace(/\s/g, '');
    },
    parse: function (jsonStr) {
        var j = JSON.parse(jsonStr);
        var cipherParams = CryptoJS.lib.CipherParams.create({ciphertext: CryptoJS.enc.Base64.parse(j.ct)});
        if (j.iv) cipherParams.iv = CryptoJS.enc.Hex.parse(j.iv);
        if (j.s) cipherParams.salt = CryptoJS.enc.Hex.parse(j.s);
        return cipherParams;
    }
}

$("#Buscar").on("click", function() {

    var encrypt = CryptoJS.AES.encrypt(JSON.stringify($('#Plato').val()), "12345", {format: CryptoJSAesJson}).toString()
    let parametros = {
        'buscar': encrypt
    };
    
    $.ajax({
        url:'php/peticion.php',
        data: parametros,
        type:'post',
        success: function (response) {
            $("#container").html(response);
        },
    });
});


var encrypt = CryptoJS.AES.encrypt('hola', "12345");
console.log(encrypt);

var decrypt = CryptoJS.AES.decrypt(encrypt, "12345");
console.log(decrypt.toString(CryptoJS.enc.Utf8));

</script>
