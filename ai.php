<?php
// echo $_POST["prompt"];                                                                 // check if form is working

// IMPORT FILES
require __DIR__.'/vendor/autoload.php';                                                   // fetch file from ventor folder installed using composer

use Orhanerday\OpenAi\OpenAi;                                                             // use the installed package


$open_ai_key = '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';                     // set OpenAI key as a variable
$open_ai = new OpenAi($open_ai_key);                                                      // recreate openai variable as new objectes from the key


$prompt = $_POST['post'];                                                                 // create a variable to get the data from the prompt input

// create a variable and set the ai modle version along with constraints (https://platform.openai.com/docs/models/continuous-model-upgrades)
$prompt_output = $open_ai->completion([
    'model' => 'gpt-3.5-turbo',                                                           // modle version
    'prompt' => 'Writing 3 marketing Facebook captions for' . $prompt,                    // the question which the model will answer/what you what the model to do
    'temperature' => 1.0,                                                                 // if you increase the value the more random the answer will be...i think
    'max_tokens' => 100,                                                                  // sets max output limit 
    'frequency_penalty' => 0,                                                             // word repetition
    'presence_penalty' => 0,                                                              // topic repetition
]);

// var_dump($prompt_output);                                                              // displays the output in details and how much tokens are used 
$response = json_decode($prompt_output, true);                                            // set output as json inorder to display only the answer to the prompt/question                                                                
$response = $response["choices"][0]["text"];                                              // you will see the following ...["choices"][0]["text"]... when you var_dump()                                              

?>

<!-- HTML output -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style scoped>
        .output-text{
            white-space: break-spaces;
        }
    </style>
</head>
<body>
    <h1>Output of 3 Facebook Market captions for <?=$prompt ?>!</h1>
<div class="output-text">
    <?= $response?>
</div>

</body>
</html>