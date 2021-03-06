<?php
/**
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

$cakeDescription = __d('cake_dev', 'GeekHouz');
$cakeVersion = __d('cake_dev', 'GeekHouz')
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		
		echo $this->Html->script('jquery-1.11.3.min');

		echo $this->Html->css('bootstrap/css/bootstrap.min');
		echo $this->Html->script('../css/bootstrap/js/bootstrap.min');
		echo $this->Html->css('sanitize');
		echo $this->Html->css('jquery.fullPage');
		echo $this->Html->css('style');
		echo $this->Html->css('tooltip');


		
		echo $this->Html->script('jquery.fullPage.min');
		echo $this->Html->script('jMonthCalendar');
		echo $this->Html->script('tooltip');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<?php echo $this->Flash->render(); ?>
	<?php echo $this->fetch('content'); ?>
</body>
</html>
