<?php
//任务类声明
class Task
{
    public $tel;
    public $content;

    public function __construct($tel, $content)
    {
        $this->tel = $tel;
        $this->content = $content;
    }
}
