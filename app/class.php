<?php
class Test {

    public readonly int|float $x;
    protected ?string $y ;
    static private ?string $z; //can be initialazed in class native example:= 'tst'


    public function __construct(int $x = 0, string $y = null, string $z = null) {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;

    }
}