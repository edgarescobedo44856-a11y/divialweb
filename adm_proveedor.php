<?php 
session_start();
// Validamos sesión y tipo de usuario (Asegúrate que solo el 'admin' o 'gerente' acceda)
if(!isset($_SESSION['usuario']) || !isset($_SESSION['tipo']) || ($_SESSION['tipo'] != 'admin' && $_SESSION['tipo'] != 'gerente') ){
    header('Location: login.php'); 
    exit();
}

include("php/conexion.php"); // Incluye la conexión y las funciones de DB 
global $conexion; // Necesario para mysqli_real_escape_string si se usa aquí

// --- Lógica de la Consulta y Búsqueda ---
$busqueda = '';
$condicion_where = '';

// Si existe un término de búsqueda, construimos el WHERE
if (isset($_GET['busqueda']) && !empty($_GET['busqueda'])) {
    // Sanitizamos el término de búsqueda
    $busqueda = mysqli_real_escape_string($conexion, $_GET['busqueda']);
    
    // Condición para buscar en varios campos del proveedor
    $condicion_where = " WHERE 
        P.pro_nombre_empresa LIKE '%$busqueda%' OR 
        P.pro_contacto_principal LIKE '%$busqueda%' OR 
        P.pro_email LIKE '%$busqueda%'";
        // Ya no necesitas la coma aquí si no hay más condiciones
} // <--- ¡Faltaba esta llave de cierre del IF!

// Consulta principal: JOIN entre proveedores y domicilios
// Utilizamos db_query() ya que select() no permite JOINs ni WHERE complejos.
$sql = "SELECT 
             P.pro_email, 
             P.pro_nombre_empresa, 
             P.pro_contacto_principal, 
             P.pro_telefono,
             D.dom_calle, D.dom_numero, D.dom_colonia, D.dom_ciudad, D.dom_estado, D.dom_cp 
            FROM proveedores P 
            LEFT JOIN domicilio D ON P.pro_email = D.usu_correo 
            " . $condicion_where . "
            ORDER BY P.pro_nombre_empresa ASC";

// CORRECCIÓN: Ejecutar la variable $sql, no $query
$result = db_query($sql);
// -----------------------------------------
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedores - DIVIAL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/menu_admin.css"> 
</head>

<body>

    <div class="d-flex" id="wrapper">

        <?php include('php/admin_menu.php'); ?>

        <div id="page-content-wrapper">
            
           <div class="container-fluid px-4 py-4">
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-dark mb-0">Gestión de Proveedores</h2>
                    <a href="adm_proveedor_registrar.php" class="btn btn-success">
                        <i class="bi bi-person-plus-fill"></i> 
                        <span class="lang-es">Nuevo Proveedor</span><span class="lang-en d-none">New Proviers</span>
                    </a>
                </div>

                <div class="card shadow-lg border-0">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0"><span class="lang-es">Lista de Proveedores Registrados</span><span class="lang-en d-none">User List</span></h5>
                    </div>

                    <div class="card-body">
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <form action="" method="GET"> 
                                    <div class="input-group">
                                        <input type="text" name="busqueda" class="form-control" placeholder="Buscar por nombre, email o contacto..." value="<?php echo htmlspecialchars($_GET['busqueda'] ?? ''); ?>">
                                        <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> <span class="lang-es">Buscar</span><span class="lang-en d-none">Search</span></button>
                                        <?php if (!empty($busqueda)): ?>
                                        <a href="adm_proveedor.php" class="btn btn-outline-secondary" title="Limpiar Búsqueda"><i class="bi bi-x-lg"></i></a>
                                        <?php endif; ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Email (ID)</th>
                                        <th><span class="lang-es">Empresa</span><span class="lang-en d-none">Company</span></th>
                                        <th><span class="lang-es">Contacto Principal</span><span class="lang-en d-none">Main Contact</span></th> 
                                        <th><span class="lang-es">Teléfono</span><span class="lang-en d-none">Phone</span></th>
                                        
                                        <th><span class="lang-es">Domicilio</span><span class="lang-en d-none">Address</span></th>
                                        <th class="text-center"><span class="lang-es">Acciones</span><span class="lang-en d-none">Actions</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                <?php
                                if ($result && mysqli_num_rows($result) > 0) { // Aseguramos que $result no sea false
                                    while ($row = mysqli_fetch_object($result)) {
                                        // Concatenar el domicilio para mostrarlo en una sola columna
                                        $domicilio_completo = trim($row->dom_calle . " #" . $row->dom_numero . ", Col. " . $row->dom_colonia . ", " . $row->dom_ciudad . ", " . $row->dom_estado . " C.P. " . $row->dom_cp);
                                        // Si el domicilio no existe (LEFT JOIN), mostrar un mensaje
                                        if (empty(trim($row->dom_calle))) {
                                            $domicilio_completo = "<span class='text-muted'>Sin domicilio registrado</span>";
                                        }

                                        // El identificador para Modificar/Eliminar es el email (pro_email)
                                        $proveedor_id = $row->pro_email; 
                                    ?>
                                        <tr>
                                            <td class="text-muted"><small><?php echo htmlspecialchars($row->pro_email); ?></small></td>
                                            <td class="fw-bold"><?php echo htmlspecialchars($row->pro_nombre_empresa); ?></td>
                                            <td><?php echo htmlspecialchars($row->pro_contacto_principal); ?></td>
                                            <td><?php echo htmlspecialchars($row->pro_telefono); ?></td>
                                            
                                            <td style="max-width: 300px; font-size: 0.9rem;"><?php echo $domicilio_completo; ?></td>
                                            
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="adm_proveedor_modificar.php?id=<?php echo urlencode($proveedor_id); ?>" class="btn btn-warning btn-sm text-dark" title="Editar">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <a href="adm_proveedor_eliminar.php?id=<?php echo urlencode($proveedor_id); ?>" onclick="return confirmarEliminacion()" class="btn btn-danger btn-sm" title="Eliminar">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                        } 
                                    } else {
                                        echo "<tr><td colspan='7' class='text-center py-4'>No se encontraron proveedores registrados con el criterio de búsqueda.</td></tr>";
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
      function confirmarEliminacion() {
        // NOTA: Para producción, se recomienda usar un modal en lugar de confirm().
        // He dejado el confirm() solo para asegurar que el código Javascript se mantenga funcional,
        // pero recuerda que en un entorno de iFrame (como el de Canvas), no funcionará.
        return confirm("¿Realmente desea eliminar este registro? Esta acción eliminará el proveedor y su domicilio asociado y no se puede deshacer.");
      }
    </script>
</body>
</html>