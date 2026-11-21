<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios — Editable</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        body {
            background-color: #fdf8f0;
            padding: 25px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .instruccion {
            color: #666;
            font-size: 0.95em;
            margin-bottom: 12px;
            line-height: 1.5;
        }
        .ruta {
            background: #fff;
            border: 1px solid #ccc;
            border-bottom: none;
            padding: 8px 15px;
            border-radius: 8px 8px 0 0;
            font-family: monospace;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 0 0 8px 8px;
            margin-bottom: 20px;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f9f6f0;
            font-weight: bold;
            color: #333;
        }
        tr:last-child td {
            border-bottom: none;
        }
        .editar {
            color: #e67e22;
            font-size: 18px;
            cursor: pointer;
            border: none;
            background: none;
            margin-right: 10px;
        }
        .editar:hover {
            color: #d35400;
        }
        .eliminar {
            color: #e74c3c;
            font-size: 18px;
            cursor: pointer;
            border: none;
            background: none;
        }
        .eliminar:hover {
            color: #c0392b;
        }
        input {
            width: 100%;
            padding: 6px 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 0.95em;
        }
        button {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.95em;
        }
        .btn-guardar {
            background-color: #27ae60;
            color: white;
            margin-right: 6px;
        }
        .btn-guardar:hover {
            background-color: #219653;
        }
        .btn-cancelar {
            background-color: #95a5a6;
            color: white;
            margin-right: 6px;
        }
        .btn-cancelar:hover {
            background-color: #7f8c8d;
        }
        .btn-agregar {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            font-size: 1em;
        }
        .btn-agregar:hover {
            background-color: #2980b9;
        }
        .acciones {
            white-space: nowrap;
        }
        .mensaje {
            margin-top: 10px;
            padding: 10px;
            border-radius: 5px;
            display: none;
        }
        .mensaje.exito {
            background-color: #d4edda;
            color: #155724;
            display: block;
        }
        .mensaje.error {
            background-color: #f8d7da;
            color: #721c24;
            display: block;
        }
    </style>
</head>
<body>

    <h2 style="margin-bottom: 8px;">📋 Demo: así debe quedar</h2>
    <p class="instruccion">
        Es una simulación (no toca ninguna base de datos). Haz clic en el lápiz ✏️ para editar, en la papelera 🗑️ para eliminar, o en "Agregar nuevo usuario" para crear registros nuevos.
    </p>

    <div class="ruta">localhost/combox/src/list_users.php</div>

    <table id="tablaUsuarios">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Celular</th>
                <th>photo_url</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="cuerpoTabla">
            <!-- Los usuarios se cargan aquí con JavaScript -->
        </tbody>
    </table>

    <button class="btn-agregar" onclick="agregarFila()">➕ Agregar nuevo usuario</button>

    <div id="mensaje" class="mensaje"></div>

<script>
// Datos iniciales
let usuarios = [
    { foto: 'Sin foto', nombre: 'Laura Gómez', correo: 'laura@correo.com', celular: '3001234567', photo_url: 'NULL' },
    { foto: 'Sin foto', nombre: 'Carlos Pérez', correo: 'carlos@correo.com', celular: '3109876543', photo_url: 'NULL' },
    { foto: 'Sin foto', nombre: 'Ana Rojas', correo: 'ana@correo.com', celular: '3205551122', photo_url: 'NULL' }
];

let filaEditando = null;
let indiceEditando = null;

// Cargar datos al iniciar
cargarTabla();

function cargarTabla() {
    const tbody = document.getElementById('cuerpoTabla');
    tbody.innerHTML = '';
    
    usuarios.forEach((usuario, indice) => {
        const fila = document.createElement('tr');
        fila.innerHTML = `
            <td>${usuario.foto}</td>
            <td>${usuario.nombre}</td>
            <td>${usuario.correo}</td>
            <td>${usuario.celular}</td>
            <td>${usuario.photo_url}</td>
            <td class="acciones">
                <button class="editar" onclick="editarFila(${indice}, this)" title="Editar">✏️</button>
                <button class="eliminar" onclick="eliminarFila(${indice})" title="Eliminar">🗑️</button>
            </td>
        `;
        tbody.appendChild(fila);
    });
}

function editarFila(indice, boton) {
    if (filaEditando !== null && filaEditando !== boton.closest('tr')) {
        cancelarEdicion();
    }

    filaEditando = boton.closest('tr');
    indiceEditando = indice;
    const u = usuarios[indice];
    
    filaEditando.innerHTML = `
        <td><input type="text" id="edit-foto" value="${u.foto}"></td>
        <td><input type="text" id="edit-nombre" value="${u.nombre}"></td>
        <td><input type="email" id="edit-correo" value="${u.correo}"></td>
        <td><input type="text" id="edit-celular" value="${u.celular}"></td>
        <td><input type="text" id="edit-photo_url" value="${u.photo_url}"></td>
        <td class="acciones">
            <button class="btn-guardar" onclick="guardarEdicion()">✅ Guardar</button>
            <button class="btn-cancelar" onclick="cancelarEdicion()">❌ Cancelar</button>
        </td>
    `;
}

function guardarEdicion() {
    usuarios[indiceEditando] = {
        foto: document.getElementById('edit-foto').value,
        nombre: document.getElementById('edit-nombre').value,
        correo: document.getElementById('edit-correo').value,
        celular: document.getElementById('edit-celular').value,
        photo_url: document.getElementById('edit-photo_url').value
    };
    
    filaEditando = null;
    indiceEditando = null;
    cargarTabla();
    mostrarMensaje('✅ Cambios guardados correctamente', 'exito');
}

function cancelarEdicion() {
    filaEditando = null;
    indiceEditando = null;
    cargarTabla();
}

function agregarFila() {
    const nuevaFila = { foto: 'Sin foto', nombre: '', correo: '', celular: '', photo_url: 'NULL' };
    usuarios.push(nuevaFila);
    const indiceNuevo = usuarios.length - 1;
    cargarTabla();
    
    const filas = document.getElementById('cuerpoTabla').children;
    editarFila(indiceNuevo, filas[indiceNuevo].querySelector('.editar'));
    mostrarMensaje('➕ Nuevo usuario agregado — completa los datos y guarda', 'exito');
}

function eliminarFila(indice) {
    if (confirm('⚠️ ¿Estás seguro de eliminar este usuario? Esta acción no se puede deshacer.')) {
        usuarios.splice(indice, 1);
        cargarTabla();
        mostrarMensaje('🗑️ Usuario eliminado correctamente', 'exito');
    }
}

function mostrarMensaje(texto, tipo) {
    const mensaje = document.getElementById('mensaje');
    mensaje.textContent = texto;
    mensaje.className = `mensaje ${tipo}`;
    setTimeout(() => {
        mensaje.style.display = 'none';
    }, 4000);
}
</script>

</body>
</html>
