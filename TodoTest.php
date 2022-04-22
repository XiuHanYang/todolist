<?php

require_once 'class.php';

class TodoTest extends \PHPUnit\Framework\TestCase {

    /**
     * @test
     * @testdox 當項目清單是空的時候，新增一個清單項目「買菜」，優先權「無」，類別「工作」，項目清單應該只有一個「買菜」項目
     */
    public function shouldShowOneItemWhenAddItemIntoEmptyList() {
        $target = new todoList();
        $target->addItem('買菜');

        $actual = $target->showList();

        $this->assertSame(['買菜'], $actual);
    }

    /**
     * @test
     * @testdox 當項目清單有「買菜」項目時，新增一個清單項目「看書」，優先權「低」，類別「無」，項目清單應該要有「買菜」「看書」兩個項目
     */
    public function shouldShowTwoItemWhenAddItemIntoList() {
        $target = new todoList();
        $target->addItem('看書');

        $actual = $target->showList();

        $this->assertSame(['看書'], $actual);
    }

    /**
     * @test
     * @testdox 當項目清單有「買菜」「看書」「寫扣」「澆花」項目時，將「看書」更新為「看電視」，項目清單應該要有「買菜」「看電視」「寫扣」「澆花」四個項目
     */
    public function shouldShowUpdateItemWhenUpdateItem() {
        $target = new todoList();
        $target->addItem('買菜');
        $target->addItem('看書');
        $target->addItem('寫扣');
        $target->addItem('澆花');
        $target->updateItem('看電視', '看書');

        $actual = $target->showList();

        $this->assertSame(['買菜', '看電視', '寫扣', '澆花'], $actual);
    }

    /**
     * @test
     * @testdox 當項目清單有「買菜」「看電視」「寫扣」「澆花」項目時，刪除「買菜」項目，項目清單應該只會出現「看電視」「寫扣」「澆花」三個項目
     */
    public function shouldShowThreeItemWhenDelItem() {
        $target = new todoList();
        $target->addItem('買菜');
        $target->addItem('看書');
        $target->addItem('寫扣');
        $target->addItem('澆花');
        $target->updateItem('看電視', '看書');
        $target->delItem('買菜');

        $actual = $target->showList();

        $this->assertSame(['看電視', '寫扣', '澆花'], $actual);
    }

    /**
     * @test
     * @testdox 項目清單有「看電視」「寫扣」「澆花」項目時，更新「看電視」狀態「已完成」，「看電視」狀態應該會是「已完成」
     */
    // public function shouldShowItemStatWhenUpdateItemStat() {
    //     $target = new todoList();
    //     $target->addItem('買菜');
    //     $target->addItem('看書');
    //     $target->addItem('寫扣');
    //     $target->addItem('澆花');
    //     $target->updateItem('看電視', '看書');
    //     $target->delItem('買菜');
    //     $target->updateItemStat(0, 1);

    //     $actual = $target->showList();

    //     $this->assertSame(['看電視', '寫扣', '澆花'], $actual);
    // }

    /**
     * @test
     * @testdox 當項目清單有「買菜」「看書」「寫扣」「澆花」項目時，將「」更新為「看書」，應該要有「新item不得為空」的錯誤訊息
     */
    public function shouldShowUpdateEmptyItemWhenUpdateItem() {
        // $this->expectException(Exception::class);
        $target = new todoList();
        $target->addItem('買菜');
        $target->addItem('看書');
        $target->addItem('寫扣');
        $target->addItem('澆花');
        $actual = $target->updateItem('', '看書');

        // $actual = $target->showList();

        // $this->markTestIncomplete();
        $this->assertSame('新item不得為空', $actual);
    }
    
    /**
     * @test
     * @testdox 當項目清單有「買菜」「看書」「寫扣」「澆花」項目時，將「看電視」更新為「」，應該要有「原item不得為空」的錯誤訊息
     */
    public function shouldShowOriEmptyItemWhenUpdateItem() {
        // $this->expectException(Exception::class);
        $target = new todoList();
        $target->addItem('買菜');
        $target->addItem('看書');
        $target->addItem('寫扣');
        $target->addItem('澆花');
        $actual = $target->updateItem('看電視', '');

        // $actual = $target->showList();

        // $this->markTestIncomplete();
        $this->assertSame('原item不得為空', $actual);
    }

    /**
     * @test
     * @testdox 當項目清單有「買菜」「看書」「寫扣」「澆花」項目時，將「」更新為「」，應該要有「新item不得為空」的錯誤訊息
     */
    public function shouldShowEmptyItemWhenUpdateEmptytem() {
        // $this->expectException(Exception::class);
        $target = new todoList();
        $target->addItem('買菜');
        $target->addItem('看書');
        $target->addItem('寫扣');
        $target->addItem('澆花');
        $actual = $target->updateItem('', '');

        // $actual = $target->showList();

        // $this->markTestIncomplete();
        $this->assertSame('新item不得為空', $actual);
    }

    /**
     * @test
     * @testdox 當項目清單有「買菜」「看書」「寫扣」「澆花」項目時，將「書」更新為「看電視」，應該要有「找不到名為書的待辦事項」的錯誤訊息
     */
    public function shouldShowUpdateItemWhenUpdateErrorItem() {
        // $this->expectException(Exception::class);
        $target = new todoList();
        $target->addItem('買菜');
        $target->addItem('看書');
        $target->addItem('寫扣');
        $target->addItem('澆花');
        $actual = $target->updateItem('看電視', '書');

        // $actual = $target->showList();

        // $this->markTestIncomplete();
        $this->assertSame('找不到名為書的待辦事項', $actual);
    }

    /**
     * @test
     * @testdox 當項目清單有「買菜」「看電視」「寫扣」「澆花」項目時，刪除「」項目，應該會出現「刪除的item不得為空」的錯誤訊息
     */
    public function shouldShowEmptyItemWhenDelEmptyItem() {
        // $this->expectException(Exception::class);
        $target = new todoList();
        $target->addItem('買菜');
        $target->addItem('看書');
        $target->addItem('寫扣');
        $target->addItem('澆花');
        $actual = $target->delItem('');
        // $actual = $target->showList();

        // $this->markTestIncomplete();
        $this->assertSame('刪除的item不得為空', $actual);
    }

    /**
     * @test
     * @testdox 當項目清單有「買菜」「看電視」「寫扣」「澆花」項目時，刪除「菜」項目，應該會出現「找不到名為菜的待辦事項」的錯誤訊息
     */
    public function shouldShowDelItemWhenDelErrorItem() {
        // $this->expectException(Exception::class);
        $target = new todoList();
        $target->addItem('買菜');
        $target->addItem('看書');
        $target->addItem('寫扣');
        $target->addItem('澆花');
        $actual = $target->delItem('菜');
        // $actual = $target->showList();

        // $this->markTestIncomplete();
        $this->assertSame('找不到名為菜的待辦事項', $actual);
    }
}
