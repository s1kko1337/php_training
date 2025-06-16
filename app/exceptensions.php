<?php


//// function outer()
//// {
////     echo 'in' . __METHOD__ . '<br />';
////     $inner = function () {
////         echo 'Вошли в функцию ' . __METHOD__ . '<br />';
////         throw new Exception('Hello!');
////         echo 'Вышли из функции ' . __METHOD__ . '<br />';
////     };
////     $inner();
////     echo 'out' . __METHOD__ . '<br />';
//// }
//
//
//// try {
////     echo 'Start try: ';
////     outer();
////     echo 'End try.';
//// } catch (\Throwable $th) {
////     echo $th->getMessage();
//// }
//
//// function test($n)
//// {
////     $e = new Exception("bang-bang #$n!");
////     echo '<pre>', $e, '</pre>';
//// }
//// function outer1()
//// {
////     test(101);
//// }
//// outer1();
//
//class User
//{
//    public function __construct(
//        private string  $email,
//        private string  $password,
//        private ?string $first_name,
//        private ?string $last_name
//    )
//    {
//    }
//
//
//    /**
//     * @throws AttributeException
//     * @throws PasswordException
//     */
//    public function __get($name)
//    {
//        if ($name === 'password') {
//            throw new PasswordException();
//        }
//        if (isset($this->$name)) {
//            return $this->$name;
//        }
//        throw new AttributeException($name);
//    }
//
//    /**
//     * @throws AttributeException
//     */
//
//    public function __set(string $index, string $value): void
//    {
//        if (isset($this->$index)) {
//            $this->$index = $value;
//        } else {
//            throw new AttributeException($index);
//        }
//    }
//
//    public function isPasswordCorrect($password): bool
//    {
//        return $this->password === $password;
//    }
//}
//
//class AttributeException extends Exception
//{
//    public function __construct($attribute, $message = 'Атрибут %s не определен')
//    {
//        $message = sprintf($message, $attribute);
//        parent::__construct($message, 1001);
//    }
//}
//
//class PasswordException extends Exception
//{
//    public function __construct(
//        $message = 'Не допускается прямое обращение к свойству password'
//    )
//    {
//        parent::__construct($message, 1002);
//    }
//}
//
//try {
//    $user = new User(
//        'igorsimdyanov@gmail.com',
//        'password',
//        'Игорь',
//        'Симдянов'
//    );
//    echo $user->email;
//    echo $user->password;
//} catch (AttributeException|PasswordException $exp) {
//    echo 'Пользовательские исключения<br />';
//    echo "Исключение: {$exp->getMessage()}<br />";
//    echo "в файле {$exp->getFile()}<br />";
//    echo "в строке {$exp->getLine()}<br />";
//} catch (Exception $exp) {
//    echo 'Прочие исключения<br />';
//    echo "Исключение: {$exp->getMessage()}<br />";
//    echo "в файле {$exp->getFile()}<br />";
//    echo "в строке {$exp->getLine()}<br />";
//}
//
//try {
//    try {
//        $user = new User('igorsimdyanov@gmail.com', 'password', 'Игорь', 'Симдянов');
//        echo $user->password;
//    } catch (Exception $exp) {
//        echo 'Exception-исключение ' . $exp::class . '<br />'; // Передача исключения далее по каскаду
//        throw $exp;
//    }
//} catch (AttributeException $exp) {
//    echo 'AttribueException-исключение';
//} catch (PasswordException $exp) {
//    echo 'PasswordException-исключение';
//} finally {
//    echo 'EXIT';
//}
//
//
//interface IException
//{
//}
//
//;
//
//interface IInternalException extends IException
//{
//}
//
//;
//
//interface IFileException extends IInternalException
//{
//}
//
//;
//
//interface INetException extends IInternalException
//{
//}
//
//;
//
//interface IUserException extends IException
//{
//}
//
//;
//
//class FileNotFoundException extends Exception implements IFileException
//{
//}
//
//;// Ошибка: ошибка доступа к сокету
//class SocketException extends Exception implements INetException
//{
//}
//
//; // Ошибка: неправильный пароль пользователя.
//class WrongPassException extends Exception implements IUserException
//{
//} // Ошибка: невозможно записать данные на сетевой принтер
//class NetPrinterWriteException extends Exception implements IFileException, INetException
//{
//}
//
//;// Ошибка: невозможно соединиться с SQL-сервером
//class SqlConnectException extends Exception implements IInternalException, IUserException
//{
//}
//
//;
//
//try {
//    printDocument();
//} catch (\IFileException $e) {
//    // Перехватываем только файловые исключения
//    echo "Файловая ошибка: {$e->getMessage()}.<br />";
//} catch (Exception $e) {
//    // Перехват всех остальных исключений
//    echo 'Неизвестное исключение: <pre>', $e, '</pre>';
//}
//function printDocument()
//{
//    $printer = '//./printer';
//    // Генерируем исключение типов IFileException и INetException
//    if (!file_exists($printer)) {
//        throw new NetPrinterWriteException($printer);
//    }
//}
//

try {
    $str = 'Hello world!';
    $str[] = 4;
} catch (\Throwable $err) {
    print_r($err->getMessage());
}
function myErrorHandler($errno, $msg, $file, $line): void
{
    $code = E_ERROR | E_CORE_ERROR | E_COMPILE_ERROR | E_USER_ERROR | E_RECOVERABLE_ERROR | E_PARSE;

    if (error_reporting() === $code) {
        return;
    }

    echo '<div style="border-style:inset; border-width:2px">';
    echo "Произошла ошибка с кодом <b>$errno</b>!<br />";
    echo "Файл: <code>$file</code>, строка $line.<br />";
    echo "Текст ошибки: <i>$msg</i>";
    echo '</div>';
}

set_error_handler('myErrorHandler', E_ALL);

filemtime('spoon');
