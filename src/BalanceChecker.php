<?php

namespace Alexm;

class BalanceChecker
{
    public function checkBalance($line, $justCount = null): bool
    {
        $symbolsOpened = ["(","{","[","<"];
        $symbolsClosed = [")","}","]",">"];
        $pair = ["()","{}","[]","<>"];
        $res = [];
        $resClosed = [];

        if (strlen($line) < 2) {
            return false;
        }

        for ($i = 0; $i < strlen($line); $i++) {
            $currentSymbol = $line[$i];
            if (in_array($currentSymbol, $symbolsOpened)) {
                array_push($res, $currentSymbol);
            }

            if (in_array($currentSymbol, $symbolsClosed)) {
                if ($justCount) { // режим только подсчет
                    array_push($resClosed, $currentSymbol);
                } else { // режим нормальные - баланс
                    $currentPair = array_pop($res) . $currentSymbol;
                    if (!in_array($currentPair, $pair)) {
                        //можно выводить символ непарный или его номер
                        return false;
                    }
                }
            }
        }
        if ($justCount) { // режим только подсчет
            print_r(array_count_values($res));
            print_r(array_count_values($resClosed));
        }
        if (!empty($res)) { // для кейса когда последний символ это открывающая
            return false;
        }
        return true;
    }
}
