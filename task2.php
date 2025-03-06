<?php

class ListNode {
    public $val;
    public $next;

    public function __construct($val = 0, $next = null) {
        $this->val = $val;
        $this->next = $next;
    }
}

function createLinkedList($arr) {
    if (empty($arr)) {
        return null;
    }

    $head = new ListNode($arr[0]);
    $current = $head;

    for ($i = 1; $i < count($arr); $i++) {
        $current->next = new ListNode($arr[$i]);
        $current = $current->next;
    }

    return $head;
}

function printLinkedList($head) {
    $current = $head;
    $result = [];
    while ($current !== null) {
        $result[] = $current->val;
        $current = $current->next;
    }
    echo "[" . implode(",", $result) . "]\n";
}

function removeElements($head, $array) {
    $dummy = new ListNode(0);
    $dummy->next = $head;
    $prev = $dummy;
    $current = $head;

    while ($current !== null) {
        if (in_array($current->val, $array)) {
            $prev->next = $current->next;
        } else {
            $prev = $current;
        }
        $current = $current->next;
    }

    return $dummy->next;
}

// Example usage:
$array = [1, 2, 3];
$linkedListElements = [1, 2, 3, 4, 5];
$head = createLinkedList($linkedListElements);
echo "Original Linked List: ";
printLinkedList($head);

$modifiedHead = removeElements($head, $array);
echo "Modified Linked List: ";
printLinkedList($modifiedHead);

$array = [5];
$linkedListElements = [1, 2, 3, 4];
$head = createLinkedList($linkedListElements);
echo "Original Linked List: ";
printLinkedList($head);

$modifiedHead = removeElements($head, $array);
echo "Modified Linked List: ";
printLinkedList($modifiedHead);

?>