<div id="header">
	<div class="wrapper">
		<?php 
			$this->widget('zii.widgets.CBreadcrumbs', array(
				'links'=>$this->breadcrumbs,
				'separator'=>' <span>/</span> ',
				'homeLink'=>CHtml::link(CHtml::encode(Yii::app()->name), Yii::app()->request->hostInfo),
				'tagName'=>'p',
				'htmlOptions'=>array('class'=>'left', 'id'=>'breadcrumbs'),
				'encodeLabel'=>false,
			));
			Yii::app()
			->getClientScript()
			->registerCoreScript('jqeruy')
			->registerScriptFile('/themes/23000/js/main.js')
			->registerScript('breadcumbs', 'breadcumbsWidth();', CClientScript::POS_READY);
		?>
		<?php
		$this->widget('widgets.registrationWidget', array(
			'options'=>array(
	    		'items' => array(
	    			array('title'=>'Регистрация', 'url'=>array('users/registration'), 'visible'=>Yii::app()->user->isGuest),
	    			array('title'=>'Напомнить пароль', 'url'=>array('users/password_recovery'), 'visible'=>Yii::app()->user->isGuest),
	    			array('title'=>'Кабинет <i>'.Yii::app()->user->name.'</i>', 'url'=>array('users/view','username'=>Yii::app()->user->name), 'visible'=>!Yii::app()->user->isGuest),
	    			array('title'=>'<strong>Админка</strong>', 'url'=>array('/admin'), 'visible'=>Yii::app()->user->checkAccess( 'accessAdmin' )),
	    			array('title'=>'Вход', 'url'=>array('index/login'), 'visible'=>Yii::app()->user->isGuest),
					array('title'=>'Выход', 'url'=>array('index/logout'), 'visible'=>!Yii::app()->user->isGuest),
	    			array('title'=>$this->widget('widgets.shopping.cart', array(), true), 'url'=>array('basket/index'))
	    		),
			),
		));
		?>

	</div>
	<div class="wrapper">
		<div class="logo left">
			<h1><?php echo Yii::app()->name; ?></h1>
			<a href="<?php echo Yii::app()->request->hostInfo; ?>">
				<div class='png1'><img alt="<?php echo Yii::app()->name; ?>" src='/themes/23000/images/logo4.png' width="210" height="90"/></div>
			</a>
		</div>
		<div class="banner right"><a href="#"><img alt="" src='/themes/23000/images/banner.jpg' /></a></div>
	</div>
	<div id="menu" class='align_center'>
		<div class='align_center_to_left'>
			<?php 
			$this->widget('widgets.menuWidget', array(
				'activeCssClass'=>'act',
				'htmlOptions' => array('class'=>'align_center_to_right'),
				'items'=>array(
					array('label'=>'Каталог', 'url'=>array('catalog/index'), 'itemOptions'=>array('class'=>'extra')),
					array('label'=>'Шины', 'url'=>array('catalog/tyres')),
					array('label'=>'Диски', 'url'=>array('catalog/disks')),
					array('label'=>'Подбор', 'url'=>array('selection/index'), 'active'=>$this->id=='selection'),
					array('label'=>'Новости', 'url'=>array('articles/index')),
					#array('label'=>'Акции', 'url'=>array('actions/index')),
					array('label'=>'Доставка', 'url'=>array('delivery/index'), 'active'=>$this->id=='delivery'),
					array('label'=>'Шиномонтаж', 'url'=>array('installation/index')),
					#array('label'=>'Партнёры', 'url'=>array('partners/index')),
					array('label'=>'Контакты', 'url'=>array('index/contact')),
					array('label'=>'Корзина', 'url'=>array('basket/index'), 'itemOptions'=>array('class'=>'basket')),
				),
			));
			?>
		</div>
	</div>
</div>