<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php
echo "<?php\n";
$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
$label=$this->name_many_nominative;
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	\$model->{$nameColumn}=>array('view','id'=>\$model->{$this->tableSchema->primaryKey}),
	'Обновить $this->name_one_accusative',
);\n";
?>

$this->menu=array(
	array('label'=>'Обзор <?php echo $this->name_many_genitive; ?>', 'url'=>array('index')),
	array('label'=>'Добавить <?php echo $this->name_one_accusative; ?>', 'url'=>array('create')),
	array('label'=>'Подробнее о <?php echo $this->name_one_preposition; ?>', 'url'=>array('view', 'id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>)),
	array('label'=>'Управление <?php echo $this->name_many_instrumentative; ?>', 'url'=>array('admin')),
);
?>

<h1>Обновить <?php echo $this->name_one_accusative." - <?php echo \$model->{$this->tableSchema->primaryKey}; ?>"; ?></h1>

<?php echo "<?php echo \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>