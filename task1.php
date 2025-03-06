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

    public function prepend($data) {
        $newNode = new Node($data);
        if ($this->head === null) {
            $this->head = $newNode;
            $this->tail = $newNode;
        } else {
            $newNode->next = $this->head;
            $this->head->prev = $newNode;
            $this->head = $newNode;
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
        $dll->prepend(0);
    } else {
        // Extract digits and store them in an array
        $digits = [];
        while ($n > 0) {
            $digits[] = $n % 10;
            $n = intdiv($n, 10);
        }
        // Prepend digits in reverse order (most significant digit first)
        for ($i = count($digits) - 1; $i >= 0; $i--) {
            $dll->prepend($digits[$i]);
        }
    }

    if ($isNegative) {
        $dll->prepend('-');
    }

    return $dll;
}

function linkedListToInteger($dll) {
    $current = $dll->head;
    $number = 0;
    $isNegative = false;

    // Handle negative sign
    if ($current->data === '-') {
        $isNegative = true;
        $current = $current->next;
    }

    // Construct the number
    while ($current !== null) {
        $number = $number * 10 + $current->data;
        $current = $current->next;
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