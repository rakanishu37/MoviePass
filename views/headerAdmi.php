<header>
    <div class="contenedor">

        <!--
        <div class="logo">
         <img src="../img/logo.JPEG">
        </div>
        -->

        <div class="menu-fixed">
            <ul class="nav">

                <li><a href="<?php echo FRONT_ROOT ?>">| Inicio |</a></li>

                <li><a href="<?php echo FRONT_ROOT ?>user/logout">| Salir de la sesion |</a></li>
                
                <li><a href="<?php echo FRONT_ROOT ?>">| Finanzas |</a>
                    <ul>
                        <li>
                            <a href='<?php echo FRONT_ROOT ?>show/quantitiesAndRemnants'>Cantidades y Remanentes</a>
                        </li>
                        <li>
                            <a href='<?php echo FRONT_ROOT ?>show/moneyCollectionCinema'>Ventas segun Cine</a>
                        </li>
                        <li>
                            <a href='<?php echo FRONT_ROOT ?>show/moneyCollectionMovie'>Ventas segun Pelicula</a>
                        </li>
                    </ul>
                </li>

                <li><a href="<?php echo FRONT_ROOT ?>">| Cines |</a>
                    <ul>
                        <li>
                            <a href='<?php echo FRONT_ROOT ?>cinema/createCinema'>Dar de alta</a>
                        </li>
                        <li>
                            <a href='<?php echo FRONT_ROOT ?>cinema/selectCinemaToClose'>Cerrar</a>
                        </li>
                        <li>
                            <a href='<?php echo FRONT_ROOT ?>cinema/selectCinemaToModify'>Modifcar</a>
                        </li>
                        <li>
                            <a href='<?php echo FRONT_ROOT ?>cinema/showCinemas'>Ver todos</a>
                        </li>
                    </ul>
                </li>

                <li><a href="<?php echo FRONT_ROOT ?>">| Funciones |</a>
                    <ul>
                        <li><a href="<?php echo FRONT_ROOT . "show/" ?>">Vista Principal</a></li>
                        <li><a href="<?php echo FRONT_ROOT . "show/filterByDate" ?>">Filtrar por fecha</a></li>
                        <li><a href="<?php echo FRONT_ROOT . "show/filterByGenre" ?>">Filtrar por genero</a></li>
                        <li><a href="<?php echo FRONT_ROOT . "show/showClient" ?>">Listado de Funciones</a></li>

                    </ul>
                </li>

                <li><a href="<?php echo FRONT_ROOT ?>">| Peliculas |</a>
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