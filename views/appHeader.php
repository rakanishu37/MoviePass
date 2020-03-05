<?php
include(VIEWS . '/materialComponents.php');
$userLoggedIn = false;
$userIsAdmin = false;

if (isset($_SESSION['loggedUser'])) {
	$userLoggedIn = true;
	$userIsAdmin = $_SESSION['loggedUser']->getStatus();
}
?><header class=" mdc-top-app-bar">
	<div class="mdc-top-app-bar__row">
		<section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
			<a class="mdc-top-app-bar__title" href="<?php echo FRONT_ROOT ?>/"><img src="<?php echo IMG_PATH; ?>/MoviePass.svg" alt="Movie Pass"></a>
		</section>
		<section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end">
			<?php echo ($MaterialIconButton([
				"label" => "Inicio",
				"icon" => "home",
				"target" => FRONT_ROOT . "/"
			])); ?>
			<?php if (!$userLoggedIn) : ?>
				<?php echo ($MaterialIconButton([
					"label" => "Registrarse",
					"icon" => "account_circle",
					"target" => FRONT_ROOT . "/user/signup"
				])); ?>
			<?php else : ?>
				<?php if ($userIsAdmin) : ?>
					<?php echo (join(array_map($MaterialIconButton, [
						[
							"label" => "Finanzas",
							"icon" => "attach_money",
							"target" => FRONT_ROOT . "/show" . "/money"
						],
						[
							"label" => "Cines",
							"icon" => "event_seat",
							"target" => FRONT_ROOT . "/cinema"
						],
						[
							"label" => "Peliculas",
							"icon" => "local_movies",
							"target" => FRONT_ROOT . "/movie" . "/"
						],
						[
							"label" => "Funciones",
							"icon" => "event",
							"target" => FRONT_ROOT . "/show" . "/"
						]
					]))); ?>
				<?php else : ?>
					<?php echo (join(array_map($MaterialIconButton, [
						[
							"label" => "Funciones",
							"icon" => "movies",
							"target" => FRONT_ROOT . "/show/menu"
						],
						[
							"label" => "Peliculas",
							"icon" => "local_movies",
							"target" => FRONT_ROOT . "/movie/showMovies"
						]
						]))); ?>
				<?php endif; ?>
				<?php echo ($MaterialIconButton([
					"label" => "Historial de compras",
					"icon" => "info",
					"target" => FRONT_ROOT . "/purchase/purchaseRecord"
				])); ?>
				<?php echo ($MaterialIconButton([
					"label" => "Cerrar Sesión",
					"icon" => "exit_to_app",
					"target" => FRONT_ROOT . "/user/logout"
				])); ?>
			<?php endif; ?>
		</section>
	</div>
</header>


