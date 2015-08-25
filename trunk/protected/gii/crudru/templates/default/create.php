<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php
echo "<?php\n";
$label=$this->name_many_nominative;
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	'Добавить $this->name_one_accusative',
);\n";
?>

$this->menu=array(
	array('label'=>'Обзор <?php echo $this->name_many_genitive; ?>', 'url'=>array('index')),
	array('label'=>'Управление <?php echo $this->name_many_instrumentative; ?>', 'url'=>array('admin')),
);
?>

<h1>Добавить <?php echo $this->name_one_accusative; ?></h1>

<?php echo "<?php echo \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>
