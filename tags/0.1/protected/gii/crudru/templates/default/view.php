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
	\$model->{$nameColumn},
);\n";
?>

$this->menu=array(
	array('label'=>'Обзор <?php echo $this->name_many_genitive; ?>', 'url'=>array('index')),
	array('label'=>'Добавить <?php echo $this->name_one_accusative; ?>', 'url'=>array('create')),
	array('label'=>'Обновить <?php echo $this->name_one_accusative; ?>', 'url'=>array('update', 'id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>)),
	array('label'=>'Удалить <?php echo $this->name_one_accusative; ?>', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>),'confirm'=>'Вы уверены что хотите удалить <?php echo $this->name_one_accusative; ?>?')),
	array('label'=>'Управление <?php echo $this->name_many_instrumentative; ?>', 'url'=>array('admin')),
);
?>

<h1>Подробнее о <?php echo $this->name_one_preposition." #<?php echo \$model->{$this->tableSchema->primaryKey}; ?>"; ?></h1>

<?php echo "<?php"; ?> $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
<?php
foreach($this->tableSchema->columns as $column)
	echo "\t\t'".$column->name."',\n";
?>
	),
)); ?>
