<?php
    class todoList extends Exception {

        // 待辦清單事項
        public $items;
        // 待辦清單事項狀態（0：未完成，1：已完成）
        public $itemsStat;
        // 待辦清單事項優先權（0：無，1：低，2：中，3：高）
        public $itemsPriority;
        // 待辦清單事項類別（0：無，1：私人，2：工作，3：家庭）
        public $itemsClass;
        // 錯誤訊息
        public $errorMsg;

        public function __construct() {
            $this->items = array();
            $this->itemsStat = array();
            $this->itemsPriority = array();
            $this->itemsClass = array();
            $this->errorMsg = '';
        }

        /**
         * @params string $item
         * @params int $priority
         * @params int $class
         * @return true, others
         */
        public function addItem($item, $priority = 0, $class = 0) {
            if($item !== '' && $priority <= 3 && $class <=3) {
                $this->items[] = $item;
                $this->itemsStat[] = 0;
                $this->itemsPriority[] = $priority;
                $this->itemsClass[] = $class;

                // echo 'addResult: '.PHP_EOL;

                // echo 'items: '.PHP_EOL;
                // print_r($this->items);

                // echo 'itemsStat: '.PHP_EOL;
                // print_r($this->itemsStat);

                // echo 'itemsPriority: '.PHP_EOL;
                // print_r($this->itemsPriority);

                // echo 'itemsClass: '.PHP_EOL;
                // print_r($this->itemsClass);
                return true;
            } else {
                if($item == '')     return '新增的item不得為空';
                // if($item == '')     $this->errorMsg = '新增的item不得為空'.PHP_EOL;
                if($priority > 3)   return '優先權錯誤';
                // if($priority > 3)   $this->errorMsg = '優先權錯誤'.PHP_EOL;
                if($class > 3)      $this->errorMsg = '類別錯誤'.PHP_EOL;
                throw new Exception($this->errorMsg);
            }
        }

        /**
         * @params string $newItem
         * @params string $oriItem
         * @return true, others
         */
        public function updateItem($newItem, $oriItem) {
            if(in_array($oriItem, $this->items) && $newItem !== '' && $oriItem !== '') {
                $key = array_search($oriItem, $this->items);
                $this->items[$key] = $newItem;

                // echo 'updateResult: '.PHP_EOL;

                // echo 'items: '.PHP_EOL;
                // print_r($this->items);

                // echo 'itemsStat: '.PHP_EOL;
                // print_r($this->itemsStat);

                // echo 'itemsPriority: '.PHP_EOL;
                // print_r($this->itemsPriority);

                // echo 'itemsClass: '.PHP_EOL;
                // print_r($this->itemsClass);
                return true;
            } else if($newItem == '') {
                // $this->errorMsg = '新item不得為空'.PHP_EOL;
                // throw new Exception($this->errorMsg);
                return '新item不得為空';
            } else if($oriItem == '') {
                // $this->errorMsg = '原item不得為空'.PHP_EOL;
                // throw new Exception($this->errorMsg);
                return '原item不得為空';
            } else {
                // $this->errorMsg = 'updateResult: '.PHP_EOL.'找不到名為'.$oriItem.'的待辦事項'.PHP_EOL;
                // throw new Exception($this->errorMsg);
                return '找不到名為'.$oriItem.'的待辦事項';
            }
        }

        /**
         * @params string $item
         * @return true, others
         */
        public function delItem($item) {
            if(in_array($item, $this->items) && $item !== '') {
                $key = array_search($item, $this->items);

                unset($this->items[$key]);
                $this->items = array_values($this->items);

                unset($this->itemsStat[$key]);
                $this->itemsStat = array_values($this->itemsStat);

                unset($this->itemsPriority[$key]);
                $this->itemsPriority = array_values($this->itemsPriority);

                unset($this->itemsClass[$key]);
                $this->itemsClass = array_values($this->itemsClass);

                // echo 'delResult: '.PHP_EOL;

                // echo 'items: '.PHP_EOL;
                // print_r($this->items);

                // echo 'itemsStat: '.PHP_EOL;
                // print_r($this->itemsStat);

                // echo 'itemsPriority: '.PHP_EOL;
                // print_r($this->itemsPriority);

                // echo 'itemsClass: '.PHP_EOL;
                // print_r($this->itemsClass);
                return true;
            } else if($item == '') {
                // $this->errorMsg = '刪除的item不得為空'.PHP_EOL;
                // throw new Exception($this->errorMsg);
                return '刪除的item不得為空';
            } else {
                // $this->errorMsg = 'delResult: '.PHP_EOL.'找不到名為'.$item.'的待辦事項'.PHP_EOL;
                // throw new Exception($this->errorMsg);
                return '找不到名為'.$item.'的待辦事項';
            }
        }

        /**
         * @return items
         */
        public function showList(){
            return $this->items;

            // echo 'showListResult: '.PHP_EOL;

            // echo 'items: '.PHP_EOL;
            // print_r($this->items);

            // echo 'itemsStat: '.PHP_EOL;
            // print_r($this->itemsStat);

            // echo 'itemsPriority: '.PHP_EOL;
            // print_r($this->itemsPriority);

            // echo 'itemsClass: '.PHP_EOL;
            // print_r($this->itemsClass);
        }

        /**
         * @params int $key
         * @params int $stat
         * @return true, others
         */
        public function updateItemStat($key, $stat = 0){
            if(array_key_exists($key, $this->items) && $stat <= 1) {
                $this->itemsStat[$key] = $stat;

                echo 'updateStatResult: '.PHP_EOL;

                echo 'items: '.PHP_EOL;
                print_r($this->items);

                echo 'itemsStat: '.PHP_EOL;
                print_r($this->itemsStat);

                echo 'itemsPriority: '.PHP_EOL;
                print_r($this->itemsPriority);

                echo 'itemsClass: '.PHP_EOL;
                print_r($this->itemsClass);
            } else if($stat > 1) {
                $this->errorMsg = '狀態錯誤'.PHP_EOL;
                throw new Exception($this->errorMsg);
            } else {
                $this->errorMsg = 'updateStatResult: '.PHP_EOL.'找不到key為'.$key.'的待辦事項'.PHP_EOL;
                throw new Exception($this->errorMsg);
            }
        }

        /**
         * @params int $key
         * @params int $priority
         * @return true, others
         */
        public function updateItemPriority($key, $priority = 0){
            if(array_key_exists($key, $this->items) && $priority <= 3) {
                $this->itemsPriority[$key] = $priority;

                echo 'updatePriorityResult: '.PHP_EOL;

                echo 'items: '.PHP_EOL;
                print_r($this->items);

                echo 'itemsStat: '.PHP_EOL;
                print_r($this->itemsStat);

                echo 'itemsPriority: '.PHP_EOL;
                print_r($this->itemsPriority);

                echo 'itemsClass: '.PHP_EOL;
                print_r($this->itemsClass);
            } else if($priority > 3) {
                $this->errorMsg = '優先權錯誤'.PHP_EOL;
                throw new Exception($this->errorMsg);
            } else {
                $this->errorMsg = 'updatePriorityResult: '.PHP_EOL.'找不到key為'.$key.'的待辦事項'.PHP_EOL;
                throw new Exception($this->errorMsg);
            }
        }

        /**
         * @params int $key
         * @params int $class
         * @return true, others
         */
        public function updateItemClass($key, $class = 0){
            if(array_key_exists($key, $this->items) && $class <= 3) {
                $this->itemsClass[$key] = $class;

                echo 'updateClassResult: '.PHP_EOL;

                echo 'items: '.PHP_EOL;
                print_r($this->items);

                echo 'itemsStat: '.PHP_EOL;
                print_r($this->itemsStat);

                echo 'itemsPriority: '.PHP_EOL;
                print_r($this->itemsPriority);

                echo 'itemsClass: '.PHP_EOL;
                print_r($this->itemsClass);
            } else if($class > 3) {
                $this->errorMsg = '類別錯誤'.PHP_EOL;
                throw new Exception($this->errorMsg);
            } else {
                $this->errorMsg = 'updateClassResult: '.PHP_EOL.'找不到key為'.$key.'的待辦事項'.PHP_EOL;
                throw new Exception($this->errorMsg);
            }
        }
    }

    // $todoList = new todoList();

    // try {
    //     $todoList->addItem('買菜', 0, 2);

    //     $todoList->addItem('看書', 1, 0);
    //     exit();
    //     $todoList->addItem('寫扣', 2, 1);
    //     $todoList->addItem('澆花', 1, 0);

    //     // $todoList->updateItem('', '看書');
    //     // $todoList->updateItem('看電視', '');
    //     // $todoList->updateItem('', '');
    //     // $todoList->updateItem('看電視', '書');
    //     $todoList->updateItem('看電視', '看書');

    //     // $todoList->delItem('');
    //     // $todoList->delItem('菜');
    //     $todoList->delItem('買菜');

    //     $todoList->showList();

    //     // $todoList->updateItemStat(0, 2);
    //     $todoList->updateItemStat(0, 1);

    //     // $todoList->updateItemPriority(0, 4);
    //     $todoList->updateItemPriority(0, 2);

    //     // $todoList->updateItemClass(2, 4);
    //     $todoList->updateItemClass(2, 2);
    // } catch (Exception $e) {
    //     echo $e->getMessage();
    // }