<?php

namespace Hannah;

use Exception;

class TodoItem
{
    // 待辦清單事項
    public $name;
    // // 待辦清單事項狀態（0：未完成，1：已完成）
    // public $status;
    // // 待辦清單事項優先權（0：無，1：低，2：中，3：高）
    // public $priority;
    // // 待辦清單事項類別（0：無，1：私人，2：工作，3：家庭）
    // public $class;

    public function __construct($name/*, $status, $priority, $class*/)
    {
        $this->name = $name;
        // $this->status = $status;
        // $this->priority = $priority;
        // $this->class = $class;
    }

}

class TodoList
{
    // 待辦清單事項
    public $items;
    // 待辦清單事項狀態（0：未完成，1：已完成）
    public $itemsStat;
    // 待辦清單事項優先權（0：無，1：低，2：中，3：高）
    public $itemsPriority;
    // 待辦清單事項類別（0：無，1：私人，2：工作，3：家庭）
    public $itemsClass;

    public function __construct()
    {
        $this->items = array();
        $this->itemsStat = array();
        $this->itemsPriority = array();
        $this->itemsClass = array();
    }

    /**
     * @params string $item
     * @params int $priority
     * @params int $class
     * @return true, others
     */
    public function addItem(TodoItem $item, $priority = 0, $class = 0)
    {
        if ($item === '') {
            throw new Exception('新增的item不得為空');
        }

        if ($priority > 3) {
            throw new \RangeException('優先權錯誤');
        }

        if ($class > 3) {
            throw new \RangeException('類別錯誤');
        }

        $this->items[] = $item;
        $this->itemsStat[] = 0;
        $this->itemsPriority[] = $priority;
        $this->itemsClass[] = $class;

        return true;
    }

    /**
     * @params string $newItem
     * @params string $oriItem
     * @return true, others
     */
    public function updateItem($newItem, $oriItem)
    {
        if ($newItem === '') {
            throw new Exception('新item不得為空');
        }

        if ($oriItem === '') {
            throw new Exception('原item不得為空');
        }

        if (!in_array($oriItem, $this->items[0]->name)) {
            throw new \OutOfBoundsException('找不到名為' . $oriItem . '的待辦事項');
        }

        $key = array_search($oriItem, $this->items[0]->name);
        $this->items[0]->name[$key] = $newItem;

        return true;
    }

    /**
     * @params string $item
     * @return true, others
     */
    public function delItem($item)
    {
        if ($item == '') {
            throw new Exception('刪除的item不得為空');
        }

        if (!in_array($item, $this->items[0]->name)) {
            throw new \OutOfBoundsException('找不到名為' . $item . '的待辦事項');
        }

        $key = array_search($item, $this->items[0]->name);

        unset($this->items[0]->name[$key]);
        $this->items[0]->name = array_values($this->items[0]->name);

        unset($this->itemsStat[$key]);
        $this->itemsStat = array_values($this->itemsStat);

        unset($this->itemsPriority[$key]);
        $this->itemsPriority = array_values($this->itemsPriority);

        unset($this->itemsClass[$key]);
        $this->itemsClass = array_values($this->itemsClass);

        return true;
    }

    /**
     * @return items
     */
    public function showList()
    {
        return $this->items;
    }

    /**
     * @param
     * return
     */
    public function getItem($key) {

        return $this->items[$key];
    }

    /**
     * @param
     * return
     */
    public function getItemByKey($key) {

        return $this->items[0]->name[$key];
    }

    /**
     * @param
     * return
     */
    public function getItemList() {

        return $this->items[0];
    }

    /**
     * @params int $key
     * @params int $stat
     * @return true, others
     */
    public function updateItemStat($key, $stat = 0)
    {
        if ($stat > 1) {
            throw new Exception('狀態錯誤');
        }

        if (!array_key_exists($key, $this->items)) {
            throw new Exception('找不到key為' . $key . '的待辦事項');
        }
        $this->itemsStat[$key] = $stat;
    }

    /**
     * @params int $key
     * @params int $priority
     * @return true, others
     */
    public function updateItemPriority($key, $priority = 0)
    {
        if ($priority > 3) {
            throw new Exception('優先權錯誤');
        }

        if (!array_key_exists($key, $this->items)) {
            throw new Exception('找不到key為' . $key . '的待辦事項');
        }

        $this->itemsPriority[$key] = $priority;
    }

    /**
     * @params int $key
     * @params int $class
     * @return true, others
     */
    public function updateItemClass($key, $class = 0)
    {
        if ($class > 3) {
            throw new Exception('類別錯誤');
        }

        if (!array_key_exists($key, $this->items)) {
            throw new Exception('找不到key為' . $key . '的待辦事項');
        }

        $this->itemsClass[$key] = $class;
    }
}
