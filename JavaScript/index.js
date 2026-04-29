//funcion GET consulta un producto por su ID
async function get() {
    const id = document.getElementById('idI').value;

    const res = await fetch(`../Php/Consulta.php?id=${id}`);
    const d = await res.json();

    // Operador ternario, si d.data existe muestra los detalles, sino muestra el mensaje de error
    document.getElementById('r1').innerText = d.data
        ? `${d.data.nombre}: $${d.data.precio}`
        : d.msj;
}

// Función POST envía datos de monto y categoría para calcular un descuento.
async function post() {
    const monto = document.getElementById('mI').value;
    const tipo = document.getElementById('tI').value;

    const res = await fetch('../Php/Calculo.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json' // Indica al servidor que se envía un JSON
        },
        body: JSON.stringify({ monto, tipo }) // Serializa los datos
    });

    const d = await res.json();

    // Validación de estado, Si el servidor responde con un error (ej: monto negativo)
    if (!res.ok) {
        document.getElementById('r2').innerText = d.error; //Error de validacion PHP
        document.getElementById('r2').style.color = "red";
        return;
    }

    // Si la respuesta es exitosa
    document.getElementById('r2').style.color = "green";
    document.getElementById('r2').innerText =
        `Aplicado ${d.descuento}. Total: $${d.total}`;
}

//Función GET: Búsqueda dinámica por nombre.
async function buscarNombre() {
    const nombre = document.getElementById('nombreI').value;

    const res = await fetch(`../Php/Buscar.php?nombre=${nombre}`);
    const d = await res.json();

    // Actualiza el DOM con el resultado o el mensaje de 'No encontrado'
    document.getElementById('r3').innerText =
        d.data ? `${d.data.nombre}: $${d.data.precio}` : d.msj;
}

//Función POST, Calcula el total incluyendo el impuesto ITBMS.
async function impuesto() {
    const monto = document.getElementById('impI').value;

    const res = await fetch('../Php/Impuesto.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ monto })
    });

    const d = await res.json();

    // Asegura que el resultado siempre tenga dos decimales para formato moneda
    document.getElementById('r4').innerText =
    `Total con ITBMS: $${Number(d.total).toFixed(2)}`;
}