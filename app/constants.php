<?php
// class Solution {
//     /**
//      * @param Integer[] $nums
//      * @param Integer $target
//      * @return Integer[]
//      */
//     function twoSum($nums, $target) {
//         $arr = [];
//         for($i = 0; $i < count($nums) - 1; $i++){
//             for($x = 1; $x <= count($nums) - 1; $x++){
//                 if((int)$nums[$i] + (int)$nums[$x] == $target){
//                     $arr[] = $i;
//                     $arr[] = $x;
//                     break;
//                 }
//             }
//         }
//         return $arr;
//     }
// }
// try {
//     $arr = [1,2,3,4];
//     echo count($arr);
//     $sot = new Solution();
//     print_r($sot->twoSum([3,3], 6));
// } catch (\Throwable $th) {
//     echo $th;
// }


//   class ListNode {
//       public $val = 0;
//       public $next = null;
//       function __construct($val = 0, $next = null) {
//           $this->val = $val;
//           $this->next = $next;
//       }
//     }

//     class Solution {
//         /**
//          * @param ListNode $l1
//          * @param ListNode $l2
//          * @return ListNode
//          */
//         function addTwoNumbers($l1, $l2) {
//             $tmp1= '';
//             $tmp2 = '';

//             $currentNode = $l1;
//             while ($currentNode !== null) {
//                 $tmp1 .= (string)$currentNode->val;
//                 $currentNode = $currentNode->next;
//             }

//             $currentNode = $l2;
//             while ($currentNode !== null) {
//                 $tmp2 .= (string)$currentNode->val;
//                 $currentNode = $currentNode->next;
//             }

//             $tmp1r = strrev($tmp1);
//             $tmp2r = strrev($tmp2);
//             $tmp3 = intval($tmp1r) + intval($tmp2r);
//             $res = strrev(strval($tmp3));


//             $tmp = new ListNode();
//             $current = $tmp;
//             for( $i = 0; $i <strlen($res); $i++){
//                 $current->next = new ListNode(intval($res[$i]));
//                 $current = $current->next;
//             }
//             return $tmp->next;
//         }
//     }

//     $node3 = new ListNode(3);
//     $node4 = new ListNode(4);
//     $node2 = new ListNode(2);
//     $node3->next = $node4;
//     $node4->next = $node2;
//     $hue = $node3;
//     $node6 = new ListNode(3);
//     $node7 = new ListNode(4);
//     $node8 = new ListNode(2);
//     $node6->next = $node7;
//     $node7->next = $node8;
//     $hue2 = $node6;

//     $hue2 = $node3;
//     $sol  = new Solution();
//     $res = $sol->addTwoNumbers($hue,$hue2);
//     echo'<pre>';
//     print_r($res);
//     echo'</pre>';
    
?>