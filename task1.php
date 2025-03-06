<?php

class Node {
    public $data;
    public $prev;
    public $next;

    public function __construct($data) {
        $this->data = $data;
        $this->prev = null;
        $this->next = null;
    }
}

class DoublyLinkedList {
    public $head;
    public $tail;

    public function __construct() {
        $this->head = null;
        $this->tail = null;
    }

    public function append($data) {
        $newNode = new Node($data);
        if ($this->head === null) {
            $this->head = $newNode;
            $this->tail = $newNode;
        } else {
            $newNode->prev = $this->tail;
            $this->tail->next = $newNode;
            $this->tail = $newNode;
        }
    }

    public function toString() {
        $current = $this->head;
        $result = "";
        while ($current !== null) {
            $result .= $current->data . " <-> ";
            $current = $current->next;
        }
        return rtrim($result, " <-> ");
    }
}

function integerToLinkedList($n) {
    $dll = new DoublyLinkedList();
    $isNegative = $n < 0;
    $n = abs($n);

    if ($n == 0) {
        $dll->append(0);
    } else {
        while ($n > 0) {
            $digit = $n % 10;
            $dll->append($digit);
            $n = intdiv($n, 10);
        }
    }

    if ($isNegative) {
        $dll->append('-');
    }

    return $dll;
}

function linkedListToInteger($dll) {
    $current = $dll->tail;
    $number = 0;
    $multiplier = 1;
    $isNegative = false;

    while ($current !== null) {
        if ($current->data === '-') {
            $isNegative = true;
        } else {
            $number += $current->data * $multiplier;
            $multiplier *= 10;
        }
        $current = $current->prev;
    }

    return $isNegative ? -$number : $number;
}

// Example usage:
$n = 25;
$dll = integerToLinkedList($n);
echo "First function: " . $dll->toString() . "\n";
echo "Second function: " . linkedListToInteger($dll) . "\n";

$n = -4;
$dll = integerToLinkedList($n);
echo "First function: " . $dll->toString() . "\n";
echo "Second function: " . linkedListToInteger($dll) . "\n";

?>