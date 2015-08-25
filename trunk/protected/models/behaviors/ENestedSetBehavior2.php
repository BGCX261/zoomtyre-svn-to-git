<?php
/**
 * NestedSetBehavior2
 *
 * @version 0.01
 * @author tigo <tigokr@gmail.com>
 */
class ENestedSetBehavior2 extends ENestedSetBehavior
{
	public $aliasAttribute='alias';
	/**
	 * Преобразует плоское дерево в иерархическое, дерево должно быть отсортировано по левому ключу
	 * @param array $tree
	 */
	
	public function hierarchical($tree = array()) {
		/*
# Получает дерево, с полем parent_id
SELECT
    a.title,
    a.id,
    a.level,
    COALESCE(b.id, 0) AS parent_id,
    ( SELECT MAX(level) FROM parts ) AS qnt,
    ( SELECT COUNT(*) FROM parts AS c WHERE c.id = a.id ) AS itemsqnt
FROM parts AS a
INNER JOIN parts AS b
    ON b.lft = (
        SELECT MAX(c.lft)
        FROM parts AS c
        WHERE
            c.lft < a.lft AND
            c.rgt > a.rgt
    )
ORDER BY a.lft; 
		 */
		
		if(empty($tree))
			return false;

		// массив с результатами
		$tmp = array();
		// указатель на родителей искомого узла
		$parents = array();
		// начинаем
		foreach($tree as $k=>$node){
			if($node->level == 1) {	// первый узел в ветви, первый родитель
				// суем текущий узел в массив с результатами
				$tmp[$k] = $node;
				// на случай если следующий узел будет потомком кладём ссылку на первого родителя в массив родителей 
				// с ключём уровня родителя
				$parents[$node->level] = & $tmp[$k]->childs;
			} else { // если текущий узел являеться потомком
				// проходим по массиву с родителями, что бы получить ссылку на последний добавленный узел
				for($i = 1; $i < $node->level; $i++)
					$parent = & $parents[$i];

				// суем текущий узел в массив с результатами
				$parent[$k] = $node;	
				// в качестве нового родителя с большем уровнем, добавляем в массив родителей текущий узел
				$parents[$node->level] = & $parent[$k]->childs;
			}
		}
		return $tmp;
	}
	
	/**
	 * Именованая группа условий. Получает всех потомков конкретного узла
	 * @param int depth
	 * @param boolean $self 
	 * @return CActiveRecord the owner.
	 */
	public function descendants($depth=null, $self = false)
	{
		$owner=$this->getOwner();
		$db=$owner->getDbConnection();
		$criteria=$owner->getDbCriteria();
		$alias=$db->quoteColumnName($owner->getTableAlias());

		$soft = '';
		if($self)
			$soft = '=';
		$criteria->mergeWith(array(
			'condition'=>$alias.'.'.$db->quoteColumnName($this->leftAttribute).'>'.$soft.$owner->{$this->leftAttribute}.
				' AND '.$alias.'.'.$db->quoteColumnName($this->rightAttribute).'<'.$soft.$owner->{$this->rightAttribute},
			'order'=>$alias.'.'.$db->quoteColumnName($this->leftAttribute),
		));

		if($depth!==null)
			$criteria->addCondition($alias.'.'.$db->quoteColumnName($this->levelAttribute).'<='.($owner->{$this->levelAttribute}+$depth));

		if($this->hasManyRoots)
			$criteria->addCondition($alias.'.'.$db->quoteColumnName($this->rootAttribute).'='.$owner->{$this->rootAttribute});

		return $owner;
	}
	
	/**
	 * Именованая группа условий. Получает всю ветвь c потомками искомого узла
	 * @return CActiveRecord the owner.
	 */
	public function branch()
	{
		$owner=$this->getOwner();
		$db=$owner->getDbConnection();
		$criteria=$owner->getDbCriteria();
		$alias=$db->quoteColumnName($owner->getTableAlias());

		#SELECT id,lft, rgt, title, level FROM carclub.parts WHERE (rgt >= 76 AND lft <= 89 and level < 5) or (parent_id = (SELECT parent_id FROM carclub.parts WHERE (rgt >= 76 AND lft <= 89 and level = 2)))
		
		$criteria->mergeWith(array(
			'condition'=>$alias.'.'.$db->quoteColumnName($this->leftAttribute).'<='.$owner->{$this->rightAttribute}.
				' AND '.$alias.'.'.$db->quoteColumnName($this->rightAttribute).'>='.$owner->{$this->leftAttribute},
			'order'=>$alias.'.'.$db->quoteColumnName($this->leftAttribute),
		));

		if($this->hasManyRoots)
			$criteria->addCondition($alias.'.'.$db->quoteColumnName($this->rootAttribute).'='.$owner->{$this->rootAttribute});

		return $owner;
	}
}