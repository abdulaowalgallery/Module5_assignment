<?php
// Function to count vowels in a string
function countVowels($string) {
    $string = strtolower($string); // Convert the string to lowercase for case-insensitivity
    $vowels = ['a', 'e', 'i', 'o', 'u']; // Array of vowels
    $vowelCount = 0; // Initialize vowel count

    // Loop through each character of the string
    for ($i = 0; $i < strlen($string); $i++) {
        if (in_array($string[$i], $vowels)) { // Check if the character is a vowel
            $vowelCount++;
        }
    }

    return $vowelCount;
}

// Function to remove vowels from a string
function removeVowels($string) {
    return preg_replace('/[aeiouAEIOU]/', '', $string); // Remove all vowels (both lowercase and uppercase)
}

// Array of strings
$strings = ["Hello", "World", "PHP", "Programming"];

// Loop through each string in the array
foreach ($strings as $string) {
    // Count vowels in the original string
    $originalVowelCount = countVowels($string);
    
    // Remove vowels from the original string
    
    $modifiedString = strrev($string);
    
    // Count vowels in the modified string (which should be 0)
    $modifiedVowelCount = countVowels($modifiedString);

    // Print the results
    echo "Original String: $string, ";
    echo "Vowel Count: $originalVowelCount, ";
    echo "Reversed String: $modifiedString \n";
    
}
?>
