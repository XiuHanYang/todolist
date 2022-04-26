<?php

namespace Hannah;

use Exception;

class TodoItem
{
    // 待辦清單事項
    public string $name;
    // 待辦清單事項狀態（0：未完成，1：已完成）
    public int $status;
    // 待辦清單事項優先權（0：無，1：低，2：中，3：高）
    public int $priority;
    // 待辦清單事項類別（0：無，1：私人，2：工作，3：家庭）
    public int $class;

    public function __construct(string $name, int $status = 0, int $priority = 0, int $class = 0)
    {
        $this->name = $name;
        $this->status = $status;
        $this->priority = $priority;
        $this->class = $class;
    }
}

class TodoList
{
    // 待辦清單事項
    public array $items;

    public function __construct()
    {
        $this->items = array();
    }

    /**
     * @params string $item
     * @return true, others
     */
    public function addItem(TodoItem $item)
    {
        if ($item->name === '') {
            throw new Exception('新增的item不得為空');
        }

        if ($item->priority > 3) {
            throw new \RangeException('優先權錯誤');
        }

        if ($item->class > 3) {
            throw new \RangeException('類別錯誤');
        }

        $this->items[] = $item;

        return true;
    }

    /**
     * @params string $newItem
     * @params string $oriItem
     * @params int $key
     * @return true, others
     */
    public function updateItem(string $newItem, string $oriItem, int $key)
    {
        if ($newItem === '') {
            throw new Exception('新item不得為空');
        }

        if ($oriItem === '') {
            throw new Exception('原item不得為空');
        }

        if ($oriItem !== $this->items[$key]->name) {
            throw new \OutOfBoundsException('找不到名為' . $oriItem . '的待辦事項');
        }

        $this->items[$key]->name = $newItem;

        return true;
    }

    /**
     * @params string $item
     * @params int $key
     * @return true, others
     */
    public function delItem(string $item, $key)
    {
        if ($item == '') {
            throw new Exception('刪除的item不得為空');
        }

        if ($item !== $this->items[$key]->name) {
            throw new \OutOfBoundsException('找不到名為' . $item . '的待辦事項');
        }

        unset($this->items[$key]);
        $this->items = array_values($this->items);

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
    public function getItem(int $key)
    {

        return $this->items[$key];
    }

    /**
     * @params int $key
     * @params int $status
     * @return true, others
     */
    public function updateItemStat(int $key, int $status = 0)
    {
        if ($status > 1) {
            throw new Exception('狀態錯誤');
        }

        if (!array_key_exists($key, $this->items)) {
            throw new Exception('找不到key為' . $key . '的待辦事項');
        }
        $this->items[$key]->status = $status;
    }

    /**
     * @params int $key
     * @params int $priority
     * @return true, others
     */
    public function updateItemPriority(int $key, int $priority = 0)
    {
        if ($priority > 3) {
            throw new Exception('優先權錯誤');
        }

        if (!array_key_exists($key, $this->items)) {
            throw new Exception('找不到key為' . $key . '的待辦事項');
        }

        $this->items[$key]->priority = $priority;
    }

    /**
     * @params int $key
     * @params int $class
     * @return true, others
     */
    public function updateItemClass(int $key, int $class = 0)
    {
        if ($class > 3) {
            throw new Exception('類別錯誤');
        }

        if (!array_key_exists($key, $this->items)) {
            throw new Exception('找不到key為' . $key . '的待辦事項');
        }

        $this->items[$key]->class = $class;
    }
}
