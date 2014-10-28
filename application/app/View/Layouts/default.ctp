<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'BoostAdopt : booster pour AdopteUnMec.com');
?>
<!DOCTYPE html>
<html ng-app="myApp">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('bootstrap-theme.min');
		echo $this->Html->css('boostadopt');
		
		echo $this->Html->script('angular.min');
		echo $this->Html->script('ui-bootstrap-custom-0.10.0.min');
		echo $this->Html->script('ui-bootstrap-custom-tpls-0.10.0.min');
		echo $this->Html->script('ZeroClipboard.min');
		echo $this->Html->script('ngPlugin/alert');
		echo $this->Html->script('ngPlugin/accordion');
		echo $this->Html->script('ngPlugin/angular-cookies.min');
		echo $this->Html->script('ngPlugin/angular-ui-router.min');
		echo $this->Html->script('boostadopt');
		echo $this->Html->script('js-angular');
		echo $this->Html->script('angular-slider.min');
		echo $this->Html->script('l10n');
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		
	?>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.14/angular-touch.min.js"></script>
	 <link rel="prefetch" type="application/l10n" href="js/l10n/locales.ini" />
	  <link rel="prefetch" type="application/l10n" href="js/data.ini" />
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
		
<?php echo $this->element('google-analytics'); ?>
<meta property="og:description"
content="boostAdopt booster pour AdopteUnMec" />
<meta property="og:image"
content="http://boostadopt.com/img/boostTitlewhiteandRed.png" />
</head>
<body id="appContainer" ng-controller="AppCtrl">
	<?php echo $this->element('navigation'); ?>	
	<div class="container" >
	 <?php echo $this->Session->flash(); ?>
	<?php echo $this->fetch('content'); ?>
	
	  <hr>
	 <?php echo $this->element('footer'); ?>	
	<div>Icon made by SimpleIcon from <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a></div>

       
      <?php echo $this->element('sql_dump'); ?>
	</div>
	
	<?php echo $this->element('modal-payment'); ?>
	<?php echo $this->element('modal-login'); ?>
	<?php echo $this->element('modal-booster'); ?>
	<?php echo $this->element('modal-save-search'); ?>	
	<?php echo $this->element('modal-evo'); ?>	
	<?php echo $this->element('modal-faq'); ?>	
</body>
</html>
