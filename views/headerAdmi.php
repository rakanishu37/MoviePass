<header>
    <div class="contenedor">

        <!--
        <div class="logo">
         <img src="../img/logo.JPEG">
        </div>
        -->

        <div class="menu-fixed">
            <ul class="nav">

                <li><a href="<?php echo FRONT_ROOT ?>">| Inicio |</a><li>

                <li><a href="">| Cines |</a>
                    <ul>
                        <li>
                             <a  href='<?php echo FRONT_ROOT ?>cinema/createCinema'>Dar de alta</a>
                        </li>
                        <li>
                            <a  href='<?php echo FRONT_ROOT ?>cinema/selectCinemaToClose'>Cerrar</a>
                        </li>
                        <li>
                            <a href='<?php echo FRONT_ROOT ?>cinema/selectCinemaToModify'>Modifcar</a>
                        </li>
                        <li>
                            <a  href='<?php echo FRONT_ROOT ?>cinema/showCinemas'>Ver todos</a>
                        </li>
                     </ul>
                 </li>

                <li><a href="">| Funciones |</a>
                    <ul>
                        <li><a href="">Alta</a></li>
                        <li><a href="">Baja</a></li>
                        <li><a href="">Modificar</a></li>
                    </ul>
                </li>

                <li><a href="">| Peliculas |</a>
                    <ul>
                        <li>
                            <a href='<?php echo FRONT_ROOT ?>movie/showMovies'>Ver peliculas</a>
                        </li>
                    </ul>
                </li>
                   
             
            </ul>
        </div>
    </div>
  </header>