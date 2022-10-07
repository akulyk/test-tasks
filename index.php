<?php

$str = "agfsgDDDDsdddDDSSkkfdFFFDDaaaaaFDsfsddsfdsf";
//TODO print a string with the characters that occur the most times in a row
//we do not make any checks here - just algo how to
preg_match_all('/(.)\1{1,}/',$str,$matches);
$str_arr = $matches[0];
usort($str_arr,function ($a,$b){
   return mb_strlen($a) > mb_strlen($b) ? -1 : 1;
});
$longest = array_shift($str_arr);
var_dump($longest);//aaaaa


//Problem 1:

//Write a function that accepts a string as input and returns a boolean as output. The function should determine if all parenthetical characters in the string—(, ), [, ], {, }—are balanced, that is, for each opening parenthesis, there is a corresponding closing parenthesis of the same form, and in the reversed sequence as they were opened. Parentheses may be nested.

//This is balanced: mary (had a [little] lamb)
//This is unbalanced: mary (had a [little) lamb]

function hasCorrectBrackets(string $string): bool {
   $string = str_split($string);
   $stack = [];
   foreach($string as $key => $value){

       switch ($value) {
           case '(': array_push($stack, 0); 
            break;
           case ')': 
               if (array_pop($stack) !== 0){
                   return false;
               }
           break;

           case '[': array_push($stack, 1);
            break;
           case ']': 
               if (array_pop($stack) !== 1) {
                   return false;
               }
           break;
         
           case '{': array_push($stack, 2);
             break;
           case '}': 
               if (array_pop($stack) !== 2){
                   return false;
               }
           break;
           
           default: break;
       }
   }
   return empty($stack);
}
echo hasCorrectBrackets('mary (had a [lit sdp[] tle] lamb)');
echo hasCorrectBrackets('mary (had a [little) lamb]');

//Problem 2:

//Write a function that accepts two arguments, an array of numbers and a single integer, and returns an array similar to the first argument, but with all the values multiplied by the integer. The input array may be nested arbitrarily deeply. For example:

//input: [1, 2, [10, [100, 200], 20, 30], 3, [40, 50]], 2
//output: [2, 4, [20, [200, 400], 40, 60], 6, [80, 100]]

function arrayMuliplier(array $data, int $mult) {
	
	array_walk_recursive($data, function(&$value) use ($mult) {
		$value = $value * $mult;
	});
	return $data;
}

var_dump(arrayMuliplier( [1, 2, [10, [100, 200], 20, 30], 3, [40, 50]],2));