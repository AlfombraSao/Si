<header>
    <div class="header-content">
        <h1 class="store-title">FOOTYPOINT</h1>
        <nav class="navigation">
          <ul class="section_nav">
            <?php if (!isset($_SESSION['usuario'])): ?>


         
            <?php else: ?>
              <li>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?></li>
                
                
            <?php endif; ?>
            
            <li><a href="CerrarSesion.php">Cerrar Sesión</a></li>
          </ul>
          <ul>
              <li><a href="../indexadmin.php">Inicio</a></li>
              <li><a href="Registrarseadmin.php">Registrar administradores</a></li>
              <li><a href="RegistroProducto.php">Registrar productos</a></li>
              <li><a href="CategoriasRegistro.php">Registrar categorias</a></li>
              <li><a href="HistorialCompras.php">Historial de Compras</a></li>
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
        margin-bottom: 0px;
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
