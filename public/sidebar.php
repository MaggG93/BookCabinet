 <!-- Sidebar de navegación -->
 <aside class="sidebar">
     <div class="logo-container">
         <img src="./images/magpie-bird-logo-design-simple-animal-in-circle-frame-vector-removebg-preview" alt="Logo" class="logo">
         <h2 class="site-name">BookCabinet</h2>
     </div>

     <!-- Redes sociales -->
     <div class="social-media">
         <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
         <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
         <a href="#" target="_blank"><i class="fab fa-youtube"></i></a>
     </div>

     <!-- Mensaje de bienvenida con enlace -->
     <div class="welcome-message">
         <p><strong>Bienvenid@,</strong> <a href="#" pointer-events: none><?php echo htmlspecialchars($_SESSION['username']); ?></a>!</p>
     </div>

     <nav>
         <ul>
             <li>
                 <a href="dashboard.php" class="<?= $paginaActual == 'dashboard.php' ? 'active' : '' ?>">
                     <i class="fas fa-book-open"></i> Biblioteca
                 </a>
             </li>
             <li>
                 <a href="add-collections.php" class="<?= $paginaActual == 'add-collections.php' ? 'active' : '' ?>">
                     <i class="fas fa-folder-plus"></i> Agregar Colección
                 </a>
             </li>
             <li>
                 <a href="add-books.php" class="<?= ($paginaActual == 'add-books.php' || $paginaActual == 'add-books-manual.php') ? 'active' : '' ?>">
                     <i class="fas fa-plus"></i> Agregar Libros
                 </a>
             </li>
             <li>
                 <a href="settings.php" class="<?= $paginaActual == 'settings.php' ? 'active' : '' ?>">
                     <i class="fas fa-cog"></i> Configuración
                 </a>
             </li>
             <li>
                 <a href="logout.php">
                     <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                 </a>
             </li>
         </ul>
     </nav>

 </aside>