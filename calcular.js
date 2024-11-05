function Calcular(Precio){
    var Entrada = document.getElementById("Cantidad");
    var Salida = document.getElementById("Total");
    var Salida1 = document.getElementById("Total1");

    Salida.innerHTML = "Total: $" + Entrada.value * Precio;
    Salida1.value = Entrada.value * Precio;

    document.getElementById('Comprar').addEventListener('click', function() {

        
        // Lógica para añadir al carrito
    });
}