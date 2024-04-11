<?php 

// class CashRegister {
//   private $cash = [
//       500 => 0,
//       200 => 0,
//        100 => 0, 
//        50  => 0,
//        20  => 0,
//        10  => 0,
//        5   => 0,
//        2   => 0,
//        1   => 0,
//        0.5 => 0,
//        0.2 => 0,
//        0.1 => 0
//    ];
//    public function __construct() {
//        // Инициализация кассы
//    }
//    public function addCash($amount, $quantity) {
//        if (isset($this->cash[$amount])) {
//            $this->cash[$amount] += $quantity;
//            return true;
//        } else {
//            return false; // Некорректный номинал
//        }
//    }
//    public function removeCash($amount, $quantity) {
//        if (isset($this->cash[$amount]) && $this->cash[$amount] >= $quantity) {
//            $this->cash[$amount] -= $quantity;
//            return true;
//        } else {
//            return false; // Недостаточно купюр/монет
//        }
//    }
//    public function getChange($amount) {
//        $change = [];
//        foreach ($this->cash as $bill => $quantity) {
//            while ($amount >= $bill && $quantity > 0) {
//                $change[] = $bill;
//                $amount -= $bill;
//                $quantity--;
//            }
//        }
//        return $change;
//    }
//    public function getTotal() {
//        $total = 0;
//        foreach ($this->cash as $amount => $quantity) {
//            $total += $amount * $quantity;
//        }
//        return $total;
//    }
// }
// $cashRegister = new CashRegister();
// // Добавляем некоторое количество каждой купюры/монеты в кассу (пример)
// $cashRegister->addCash(500, 5);
// $cashRegister->addCash(200, 10);
// $cashRegister->addCash(100, 20);
// $cashRegister->addCash(50, 30);
// $cashRegister->addCash(20, 40);
// $cashRegister->addCash(10, 50);
// $cashRegister->addCash(5, 60);
// $cashRegister->addCash(2, 70);
// $cashRegister->addCash(1, 80);
// $cashRegister->addCash(0.5, 90);
// $cashRegister->addCash(0.2, 100);
// $cashRegister->addCash(0.1, 110);
// // Получаем сумму покупки от пользователя
// echo "Введите сумму покупки: ";
// $purchaseAmount = (float) readline();
// // Получаем сдачу
// $change = $cashRegister->getChange($purchaseAmount);
// echo "<br>Сдача: $purchaseAmount <br>";
// foreach ($change as $bill) {
//    if ($bill > 0) {
//        echo $bill . " ";
//    }  
// }

// $data_raw = file('kasa.txt');
// $arr = array_map(fn($txt)=>str_replace(',', '.', trim($txt)), $data_raw);
// print_r( $arr);

// $new_arr = [];


////////////////////////////////////////



// class CashRegister {
//     // Класс остается без изменений...
// }

// // Инициализация и добавление денег в кассу, как и раньше...
// $cashRegister = new CashRegister();
// $cashRegister->addCash(500, 5);
// // Продолжайте добавлять остальные номиналы...

// function getOptimalPayment($cashRegister, $purchaseAmount) {
//     $totalCash = $cashRegister->getTotal();
//     if ($purchaseAmount > $totalCash) {
//         return ["error" => "Недостаточно средств в кассе для выполнения покупки."];
//     }
    
//     $changeNeeded = true;
//     $payment = [];
//     $attempt = $purchaseAmount;
    
//     // Пытаемся найти оптимальный набор купюр, чтобы покрыть сумму покупки
//     // с небольшим превышением для возможности выдачи сдачи
//     while ($changeNeeded && $attempt <= $totalCash) {
//         $paymentAttempt = $cashRegister->getChange($attempt);
//         $totalPayment = array_sum($paymentAttempt);
        
//         if ($totalPayment >= $purchaseAmount) {
//             $payment = $paymentAttempt;
//             $changeNeeded = false;
//         } else {
//             $attempt += 0.1; // Постепенно увеличиваем сумму, пытаясь найти подходящий набор купюр
//         }
//     }
    
//     return $payment;
// }

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $purchaseAmount = (float)$_POST['purchaseAmount'];
//     $payment = getOptimalPayment($cashRegister, $purchaseAmount);
    
//     if (isset($payment['error'])) {
//         echo "<h2>Ошибка:</h2><p>" . htmlspecialchars($payment['error']) . "</p>";
//     } else {
//         // Вывод оптимальных купюр для покупки
//         echo "<h2>Купюры для покупки:</h2>";
//         foreach ($payment as $bill) {
//             echo htmlspecialchars($bill) . " ";
//         }
//     }
// } else {
//     header("Location: form.html");
//     exit;
// }













//////////////////////////////////////////////////////////





class CashRegister {
    private $cash = [
        500 => 0,
        200 => 0,
        100 => 0, 
        50  => 0,
        20  => 0,
        10  => 0,
        5   => 0,
        2   => 0,
        1   => 0,
        0.5 => 0,
        0.2 => 0,
        0.1 => 0,
        0.05 => 0,
        0.01 => 0,
    ];

    public function __construct() {
        // Загрузка начального состояния кассы, если требуется
    }

    public function addCash($amount, $quantity) {
        if (isset($this->cash[$amount])) {
            $this->cash[$amount] += $quantity;
        } else {
            return false; // Некорректный номинал
        }
    }

    public function getChange($amount) {
        $change = [];
        foreach ($this->cash as $bill => $quantity) {
            while ($amount >= $bill && $quantity > 0) {
                $change[] = $bill;
                $amount -= $bill;
                $quantity--;
                $this->cash[$bill]--; // Уменьшаем количество доступных купюр
            }
        }
        return $change;
    }
}

// Создание экземпляра кассы
$cashRegister = new CashRegister();
// Добавление купюр и монет в кассу
$cashRegister->addCash(500, 5);
$cashRegister->addCash(200, 10);
$cashRegister->addCash(100, 20);
$cashRegister->addCash(50, 30);
$cashRegister->addCash(20, 40);
$cashRegister->addCash(10, 50);
$cashRegister->addCash(5, 60);
$cashRegister->addCash(2, 70);
$cashRegister->addCash(1, 80);
$cashRegister->addCash(0.5, 90);
$cashRegister->addCash(0.2, 100);
$cashRegister->addCash(0.1, 110);
$cashRegister->addCash(0.05, 120);
$cashRegister->addCash(0.01, 130);

// Добавьте остальные купюры по аналогии

// Обработка данных формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $purchaseAmount = floatval($_POST['purchaseAmount']);
    $receivedAmount = floatval($_POST['receivedAmount']);
    $changeAmount = $receivedAmount - $purchaseAmount;

    $change = $cashRegister->getChange($changeAmount);
    
    echo "<h2>Сдача:</h2>";
    // foreach ($change as $bill) {
    //     echo $bill . " ";
    // }
    foreach ($change as $bill) {
        if ($bill > 0) {
            echo $bill . " ";
        }  
     }
}

?>
