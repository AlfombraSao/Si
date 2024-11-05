<header>
    <div class="header-content">
        <h1 class="store-title">FOOTYPOINT</h1>
        <nav class="navigation">
            <ul class="section_nav">
                <?php if (!isset($_SESSION['usuario'])): ?>
                    <li><a href="Registrarse.php">Registrarse</a></li>
                    <li><a href="IniciarSesion.php">Iniciar sesión</a></li>
                <?php else: ?>
                    <li>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?></li>
                    <li><a href="#" onclick="confirmarCerrarSesion()">Cerrar Sesión</a></li>
                <?php endif; ?>
            </ul>
            <ul>
                <li><a href="../index.php">Inicio</a></li>
                <li><a href="catalogo.php">Catálogo</a></li>
                <li><a href="carrito.php">Carrito</a></li>
            </ul>
        </nav>
    </div>
</header>

<style>
  * {
    font-family: "Mulish", sans-serif;
  }
    header {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px; 
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    body {
      margin: 0px !important;
    }
    .store-title {
        margin: 0;
    }
    .header-content {
      width: 100%;
    }
    .section_nav {
      display: flex;
      justify-content: flex-end;
    }
    .navigation {
      width: 100%;
    }
    .navigation ul {
      width: 100%;
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
    }
    .navigation li {
        margin-left: 20px;
    }
    .navigation li:first-child {
      margin-left: 0 !important;
    }
    .navigation a {
        color: white;
        text-decoration: none;
    }
    .navigation a:hover {
        text-decoration: underline;
    }
</style>

<script>
function confirmarCerrarSesion() {
    // Mostrar alerta de confirmación
    var confirmacion = confirm("Al cerrar sesión, los productos del carrito se eliminarán. ¿Deseas continuar?");
    if (confirmacion) {
        // Redirigir al archivo de cierre de sesión
        window.location.href = 'CerrarSesion.php';
    }
}
</script>