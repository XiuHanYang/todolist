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
}
