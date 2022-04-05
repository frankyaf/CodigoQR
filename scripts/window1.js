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