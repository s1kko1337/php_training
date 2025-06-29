<?php 
class FileLogger
{
    public $f;
    public $name;
    public $lines = [];
    public $t;
    public function __construct($name, $fname)
    {
        $this->name = $name;
        $this->f = fopen($fname, 'a+');
    }
    public function __destruct()
    {
        fputs($this->f, join('', $this->lines));
        fclose($this->f);
    }
    public function log($str)
    {
        $prefix = '[' . date('Y-m-d h:i:s ') . "{$this->name}] ";
        $str = preg_replace('/^/m', $prefix, rtrim($str));
        $this->lines[] = $str . PHP_EOL;
    }
}
