<?php require_once("php/partials/head-utils.php"); ?>
<body class="sfooter">
	<div class="sfooter-content">

		<!-------------BEGIN HEADER----------------->
		<?php require_once("php/partials/header.php") ?>


		<!---------------BEGIN MAIN CONTENT----------------->
		<main>

			<!-------INSERT MAIN CONTENT------------>
			<div ng-view></div>


		</main>
	</div>

	<!--------------------BEGIN FOOTER-------------------------->
	<?php require_once("php/partials/footer.php"); ?>
	</body>
</html>


