<?php 
session_start();
// 1. Validación estricta: Solo Gerente
if(!isset($_SESSION['usuario']) || $_SESSION['tipo'] != 'gerente' ){
    header('Location: login.php'); 
    exit();
}
include("php/conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Directorio de Clientes - para pedidos</title>
    
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/ger_menu.css">
</head>
<body>

      <div class="d-flex" id="wrapper">

        <?php include 'php/ger_menu.php'; ?>

        <div id="page-content-wrapper">

            <div class="container-fluid px-4 py-4">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-dark mb-0">Cartera de Clientes</h2>
                    <button class="btn btn-outline-primary btn-sm" onclick="window.print()">
                        <i class="bi bi-printer"></i> Imprimir Lista
                    </button>
                </div>

                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-people me-2"></i>Clientes Registrados</h5>
                    </div>
                    <div class="card-body">
                        
                        <div class="row mb-3">
                            <div class="col-md-4 ms-auto">
                                <input type="text" id="buscador" class="form-control form-control-sm" placeholder="Buscar cliente...">
                            </div>
                        </div>

                        <?php
                        // CONSULTA FILTRADA: Solo mostramos 'cliente'
                        // Asegúrate de que en tu BD la columna se llame 'tipo' o 'usu_tipo'
                        $result = select_where("usuarios", "tipo = 'cliente'"); 
                        ?>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle" id="tablaClientes">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nombre Completo</th>
                                        <th>Correo Electrónico</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($result && mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_object($result)) {
                                        $nombre_completo = $row->usu_nombre . " " . $row->usu_ap_pat . " " . $row->usu_ap_mat;
                                ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-light rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 40px; height: 40px;">
                                                    <i class="bi bi-person text-secondary"></i>
                                                </div>
                                                <span class="fw-bold"><?php echo $nombre_completo; ?></span>
                                            </div>
                                        </td>
                                        
                                        <td><?php echo $row->usu_correo; ?></td>
                                        
                                        

                                    </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='5' class='text-center py-5 text-muted'>No hay clientes registrados.</td></tr>";
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.getElementById('buscador').addEventListener('keyup', function() {
            let filtro = this.value.toLowerCase();
            let filas = document.querySelectorAll('#tablaClientes tbody tr');
            
            filas.forEach(fila => {
                let texto = fila.innerText.toLowerCase();
                fila.style.display = texto.includes(filtro) ? '' : 'none';
            });
        });
    </script>

    <script>
        const links = document.querySelectorAll('#sidebar-wrapper .list-group-item');
        links.forEach(link => {
            if(link.href.includes("ger_usuarios")) {
                links.forEach(l => l.classList.remove('active'));
                link.classList.add('active');
            }
        });
    </script>
</body>
</html>