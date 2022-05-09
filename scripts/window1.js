var btnCrearQR = document.getElementById("crearQR");

var modal = document.getElementsByClassName("modal")[0];

var cerrar = document.getElementsByClassName("cerrar")[0];

btnCrearQR.onclick = function()
{
    modal.style.display = "block";
}

cerrar.onclick = function()
{
    modal.style.display = "none";
}

window.onclick = function(event)
{
    if(event.target == modal)
    {
        modal.style.display = "none";
    }
}

//Función que se ejecuta una vez que se haya lanzado el evento de click sobre el elemento HTML.
function generarQR()
{
    var texto = document.getElementById("texto").value;
    var qr = new QRCode(document.getElementById("qr"), {
        text: texto,
        width: 256,
        height: 256,
        colorDark : "#000000",
        colorLight : "#ffffff",
        correctLevel : QRCode.CorrectLevel.H
    });
}
