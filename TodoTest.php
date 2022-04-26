<?php

require_once 'class.php';

use Hannah\TodoItem;
use Hannah\TodoList;
use PHPUnit\Framework\TestCase;

class TodoTest extends TestCase
{
    /**
     * @test
     * @testdox 當項目清單是空的時候，新增一個清單項目「買菜」，優先權「無」，類別「工作」，項目清單應該只有一個「買菜」項目
     */
    public function shouldShowOneItemWhenAddItemIntoEmptyList()
    {
        $expectedItem = array();
        $expectedItem[] = new TodoItem('買菜', 0, 0, 2);

        $target = new TodoList();
        $target->addItem($expectedItem[0]);

        $actual = $target->showList();

        $this->assertSame($expectedItem, $actual);
    }

    /**
     * @test
     * @testdox 當項目清單有「買菜」項目時，新增一個清單項目「看書」，優先權「低」，類別「無」，項目清單應該要有「買菜」「看書」兩個項目
     */
    public function shouldShowTwoItemWhenAddItemIntoList()
    {
        $expectedItem = array();
        $expectedItem[] = new TodoItem('買菜', 0, 0, 2);
        $expectedItem[] = new TodoItem('看書', 0, 1, 0);

        $target = new TodoList();
        $target->addItem($expectedItem[0]);
        $target->addItem($expectedItem[1]);

        $actual = $target->showList();

        $this->assertSame($expectedItem, $actual);
    }

    /**
     * @test
     * @testdox 當項目清單有「買菜」「看書」項目時，將「看書」更新為「看電視」，項目清單應該要有「買菜」「看電視」兩個項目
     */
    public function shouldShowUpdateItemWhenUpdateItem()
    {
        $oriItem = array();
        $oriItem[] = new TodoItem('買菜', 0, 0, 2);
        $oriItem[] = new TodoItem('看書', 0, 1, 0);

        $expectedItem = array();
        $expectedItem[] = new TodoItem('買菜', 0, 0, 2);
        $expectedItem[] = new TodoItem('看電視', 0, 1, 0);

        $target = new TodoList();
        $target->addItem($oriItem[0]);
        $target->addItem($oriItem[1]);

        $target->updateItem('看電視', 1);

        $actual = $target->showList();

        $this->assertSame($expectedItem[1]->name, $actual[1]->name);
    }

    /**
     * @test
     * @testdox 當項目清單有「買菜」「看電視」項目時，刪除「買菜」項目，項目清單應該只會出現「看電視」一個項目
     */
    public function shouldShowThreeItemWhenDelItem()
    {
        $oriItem = array();
        $oriItem[] = new TodoItem('買菜', 0, 0, 2);
        $oriItem[] = new TodoItem('看書', 0, 1, 0);

        $expectedItem = array();
        $expectedItem[] = new TodoItem('看電視', 0, 1, 0);

        $target = new TodoList();
        $target->addItem($oriItem[0]);
        $target->addItem($oriItem[1]);

        $target->updateItem('看電視', 1);

        $target->delItem(0);

        $actual = $target->showList();

        $this->assertSame($expectedItem[0]->name, $actual[0]->name);
    }

    /**
     * @test
     * @testdox 當項目清單有「看書」項目時，將「看書」更新為「」，應該要有「新item不得為空」的錯誤訊息
     */
    public function shouldShowUpdateEmptyItemWhenUpdateItem()
    {
        $this->expectException(Exception::class);

        $oriItem = array();
        $oriItem[] = new TodoItem('看書', 0, 1, 0);

        $target = new TodoList();
        $target->addItem($oriItem[0]);

        $target->updateItem('', 0);
    }

    /**
     * @test
     * @testdox 當項目清單有「看書」項目時，將「不存在的 key 」更新為「看電視」，應該要有「找不到 key 為 不存在的 key 的待辦事項」的錯誤訊息
     */
    public function shouldShowUpdateItemWhenUpdateErrorItem()
    {
        $this->expectException(Exception::class);

        $oriItem = array();
        $oriItem[] = new TodoItem('看書', 0, 1, 0);

        $target = new TodoList();
        $target->addItem($oriItem[0]);
        $target->updateItem('看電視', 1);
    }

    /**
     * @test
     * @testdox 當項目清單有「看書」項目時，刪除「不存在的 key 」項目，應該會出現「找不到 key 為 不存在的 key 的待辦事項」的錯誤訊息
     */
    public function shouldShowDelItemWhenDelErrorItem()
    {
        $this->expectException(Exception::class);

        $oriItem = array();
        $oriItem[] = new TodoItem('看書', 0, 1, 0);

        $target = new TodoList();
        $target->addItem($oriItem[0]);
        $target->delItem(1);
    }

    /**
     * @test
     * @testdox 當項目清單有「買菜」項目時，新增一個清單項目「」，應該會出現「新增的item不得為空」的錯誤訊息
     */
    public function shouldShowAddEmptyItemWhenAddItem()
    {
        $this->expectException(Exception::class);

        $oriItem = array();
        $oriItem[] = new TodoItem('買菜', 0, 1, 0);
        $oriItem[] = new TodoItem('');

        $target = new TodoList();
        $target->addItem($oriItem[0]);
        $target->addItem($oriItem[1]);
    }

    /**
     * @test
     * @testdox 當項目清單有「買菜」項目時，新增一個清單項目「寫扣」，優先權「未定義」，應該會出現「優先權錯誤」的錯誤訊息
     */
    public function shouldShowAddErrorPriorityItemWhenAddItem()
    {
        $this->expectException(Exception::class);

        $oriItem = array();
        $oriItem[] = new TodoItem('買菜', 0, 0, 2);
        $oriItem[] = new TodoItem('寫扣', 0, 4, 0);

        $target = new TodoList();
        $target->addItem($oriItem[0]);
        $target->addItem($oriItem[1]);
    }

    /**
     * @test
     * @testdox 當項目清單有「買菜」項目時，新增一個清單項目「寫扣」，優先權「中」，類別「不存在」，應該會出現「類別錯誤」的錯誤訊息
     */
    public function shouldShowAddErrorClassItemWhenAddItem()
    {
        $this->expectException(Exception::class);

        $oriItem = array();
        $oriItem[] = new TodoItem('買菜', 0, 0, 2);
        $oriItem[] = new TodoItem('寫扣', 0, 2, 4);

        $target = new TodoList();
        $target->addItem($oriItem[0]);
        $target->addItem($oriItem[1]);
    }

    /**
     * @test
     * @testdox 項目清單有「看電視」項目時，更新「看電視」狀態「已完成」，「看電視」狀態應該會是「已完成」
     */
    public function shouldShowItemStatWhenUpdateItemStat()
    {

        $oriItem = array();
        $oriItem[] = new TodoItem('看電視', 0, 1, 0);

        $expectedItem = array();
        $expectedItem[] = new TodoItem('看電視', 1, 1, 0);

        $target = new TodoList();
        $target->addItem($oriItem[0]);

        $target->updateItemStat(0, 1);

        $actual = $target->showList();

        $this->assertSame($expectedItem[0]->status, $actual[0]->status);
    }

    /**
     * @test
     * @testdox 項目清單有「看電視」項目時，更新「看電視」狀態「未定義」，應該會出現「狀態錯誤」的錯誤訊息
     */
    public function shouldShowUpdateErrorStatusItemWhenUpdateStatus()
    {
        $this->expectException(Exception::class);

        $oriItem = array();
        $oriItem[] = new TodoItem('看電視', 0, 1, 0);

        $target = new TodoList();
        $target->addItem($oriItem[0]);
        $target->updateItemStat(0, 2);
    }

    /**
     * @test
     * @testdox 項目清單有「看電視」項目時，更新「不存在的 key 」狀態「已完成」，應該會出現「找不到 key 為不存在的 key 的待辦事項」的錯誤訊息
     */
    public function shouldShowUpdateErrorKeyItemWhenUpdateStatus()
    {
        $this->expectException(Exception::class);

        $oriItem = array();
        $oriItem[] = new TodoItem('看電視', 0, 1, 0);

        $target = new TodoList();
        $target->addItem($oriItem[0]);
        $target->updateItemStat(1, 1);
    }

    /**
     * @test
     * @testdox 項目清單有「看電視」項目時，更新「看電視」優先權「高」，「看電視」優先權應該會是「高」
     */
    public function shouldShowItemPriorityWhenUpdateItemPriority()
    {

        $oriItem = array();
        $oriItem[] = new TodoItem('看電視', 0, 1, 0);

        $expectedItem = array();
        $expectedItem[] = new TodoItem('看電視', 0, 3, 0);

        $target = new TodoList();
        $target->addItem($oriItem[0]);

        $target->updateItemPriority(0, 3);

        $actual = $target->showList();

        $this->assertSame($expectedItem[0]->priority, $actual[0]->priority);
    }

    /**
     * @test
     * @testdox 項目清單有「看電視」項目時，更新「看電視」優先權「未定義」，應該會出現「優先權錯誤」的錯誤訊息
     */
    public function shouldShowUpdateErrorPriorityItemWhenUpdatePriority()
    {
        $this->expectException(Exception::class);

        $oriItem = array();
        $oriItem[] = new TodoItem('看電視', 0, 1, 0);

        $target = new TodoList();
        $target->addItem($oriItem[0]);
        $target->updateItemPriority(0, 4);
    }

    /**
     * @test
     * @testdox 項目清單有「看電視」項目時，更新「不存在的 key 」優先權「高」，應該會出現「找不到 key 為不存在的 key 的待辦事項」的錯誤訊息
     */
    public function shouldShowUpdateErrorKeyItemWhenUpdatePriority()
    {
        $this->expectException(Exception::class);

        $oriItem = array();
        $oriItem[] = new TodoItem('看電視', 0, 1, 0);

        $target = new TodoList();
        $target->addItem($oriItem[0]);
        $target->updateItemPriority(1, 3);
    }

    /**
     * @test
     * @testdox 項目清單有「看電視」項目時，更新「看電視」類別「家庭」，「看電視」類別應該會是「家庭」
     */
    public function shouldShowItemClassWhenUpdateItemClass()
    {

        $oriItem = array();
        $oriItem[] = new TodoItem('看書', 0, 1, 0);

        $expectedItem = array();
        $expectedItem[] = new TodoItem('看電視', 0, 1, 3);

        $target = new TodoList();
        $target->addItem($oriItem[0]);

        $target->updateItem('看電視', 0);

        $target->updateItemClass(0, 3);

        $actual = $target->showList();

        $this->assertSame($expectedItem[0]->class, $actual[0]->class);
    }

    /**
     * @test
     * @testdox 項目清單有「看電視」項目時，更新「看電視」類別「未定義」，應該會出現「類別錯誤」的錯誤訊息
     */
    public function shouldShowUpdateErrorClassItemWhenUpdateClass()
    {
        $this->expectException(Exception::class);

        $oriItem = array();
        $oriItem[] = new TodoItem('看電視', 0, 1, 0);

        $target = new TodoList();
        $target->addItem($oriItem[0]);
        $target->updateItemClass(0, 4);
    }

    /**
     * @test
     * @testdox 項目清單有「看電視」項目時，更新「不存在的 key 」類別「家庭」，應該會出現「找不到 key 為不存在的 key 的待辦事項」的錯誤訊息
     */
    public function shouldShowUpdateErrorKeyItemWhenUpdateClass()
    {
        $this->expectException(Exception::class);

        $oriItem = array();
        $oriItem[] = new TodoItem('看電視', 0, 1, 0);

        $target = new TodoList();
        $target->addItem($oriItem[0]);
        $target->updateItemClass(1, 3);
    }

    /**
     * @test
     * @testdox 當項目清單有「買菜」項目時，新增一個清單項目「買菜」，優先權「低」，類別「無」，應該會出現「新增的item不得重複」的錯誤訊息
     */
    public function shouldShowErrorItemWhenAddItemIntoList()
    {
        $this->expectException(Exception::class);

        $expectedItem = array();
        $expectedItem[] = new TodoItem('買菜', 0, 0, 2);
        $expectedItem[] = new TodoItem('買菜', 0, 1, 0);

        $target = new TodoList();
        $target->addItem($expectedItem[0]);
        $target->addItem($expectedItem[1]);
    }

    /**
     * @test
     * @testdox 當項目清單有「買菜」「看書」項目時，將「看書」更新為「買菜」，應該會出現「更新的item不得重複」的錯誤訊息
     */
    public function shouldShowErrorItemWhenUpdateItem()
    {
        $this->expectException(Exception::class);

        $oriItem = array();
        $oriItem[] = new TodoItem('買菜', 0, 0, 2);
        $oriItem[] = new TodoItem('看書', 0, 1, 0);

        $target = new TodoList();
        $target->addItem($oriItem[0]);
        $target->addItem($oriItem[1]);
        
        $target->updateItem('買菜', 1);

    }
}
