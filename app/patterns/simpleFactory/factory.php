<?php

namespace simpleFactory;

abstract class Creator 
{
    abstract public function factoryMethod() : Product;

    public function someOperation() : string
    {
        $product = $this->factoryMethod();

        $result = "Creator: same creators work with:" .
            $product->operation();
        
        return $result;
    }
}


class ConcreteCreator1 extends Creator 
{
    public function factoryMethod(): Product
    {
        return new ConcreteProduct1();

    }
}

class ConcreteCreator2 extends Creator 
{
    public function factoryMethod(): Product
    {
        return new ConcreteProduct2();

    }
}


interface Product 
{
    public function operation() : string;
}

class ConcreteProduct1 implements Product
{
    public function  operation(): string
    {
        return "{result of ConcreteProduct1}";
    }
};
class ConcreteProduct2 implements Product
{
    public function  operation(): string
    {
        return "{result of ConcreteProduct2}";
    }
};

function clientCode(Creator $creator){
    echo "Client: I'am not aware about creator's class, but its works. \n"
    . $creator->someOperation();

}
//call
echo "<pre>";

echo "App: Launched with the ConcreteCreator1.\n";
clientCode(new ConcreteCreator1());
echo "\n\n";

echo "App: Launched with the ConcreteCreator2.\n";
clientCode(new ConcreteCreator2());

echo "</pre>";