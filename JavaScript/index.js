async function get() {
    const id = document.getElementById('idI').value;

    const res = await fetch(`../Php/Consulta.php?id=${id}`);
    const d = await res.json();

    document.getElementById('r1').innerText = d.data
        ? `${d.data.nombre}: $${d.data.precio}`
        : d.msj;
}

async function post() {
    const monto = document.getElementById('mI').value;
    const tipo = document.getElementById('tI').value;

    const res = await fetch('../Php/Calculo.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ monto, tipo })
    });

    const d = await res.json();

    if (!res.ok) {
        document.getElementById('r2').innerText = d.error;
        document.getElementById('r2').style.color = "red";
        return;
    }

    document.getElementById('r2').style.color = "green";
    document.getElementById('r2').innerText =
        `Aplicado ${d.descuento}. Total: $${d.total}`;
}

async function buscarNombre() {
    const nombre = document.getElementById('nombreI').value;

    const res = await fetch(`../Php/Buscar.php?nombre=${nombre}`);
    const d = await res.json();

    document.getElementById('r3').innerText =
        d.data ? `${d.data.nombre}: $${d.data.precio}` : d.msj;
}

async function impuesto() {
    const monto = document.getElementById('impI').value;

    const res = await fetch('../Php/Impuesto.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ monto })
    });

    const d = await res.json();

    document.getElementById('r4').innerText =
    `Total con ITBMS: $${Number(d.total).toFixed(2)}`;
}