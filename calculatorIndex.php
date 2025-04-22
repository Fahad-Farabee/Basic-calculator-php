<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Calculator</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <!-- It will keep me to the same page. For this project
        I do not want to submit my inputs to any other php file.
        also i have used htmlspecialchars() to prevent the 
        security issues. -->

        <input type="number" name="num1" placeholder="First Number">
        <input type="number" name="num2" placeholder="Second Number">
        <select name="operator" >
            <option value="add">+</option>
            <option value="substract">-</option>
            <option value="multiply">*</option>
            <option value="divide">/</option>
        </select>
        <button>Calculate</button>
    </form>

    <!-- php code -->
     <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){//checking for the request method.
            //Getting data from the inputs and sanitizing and storing them them
            $num1 = filter_input(INPUT_POST,"num1",FILTER_SANITIZE_NUMBER_FLOAT);
            $num2 = filter_input(INPUT_POST, "num2", FILTER_SANITIZE_NUMBER_FLOAT);
            $operator = htmlspecialchars($_POST["operator"]);

            //error checking.
            $errors = false;
            //checking if the fields are empty..
            if(empty($num1)||empty($num2)||empty($operator)){
                echo "<p class ='calc-error'> Fill in all fields!</p>";
                $errors = true;
            }
            //checking if the num1 and num2 are numbers or not.
            else if(!is_numeric($num1)||!is_numeric($num2)){
                echo "<p class ='calc-error'> Only Write numbers please!</p>";
                $errors = true;
            }

            //if there is no error then calculate.
            if(!$errors){
                $value = 0;
                switch($operator){
                    case "add":
                        $value = $num1+$num2;
                        break;
                    case "substract":
                        $value = $num1-$num2;
                        break;
                    case "multiply":
                        $value = $num1*$num2;
                        break;
                    case "divide":
                        $value = $num1/$num2;
                        break;
                    default:
                        echo "<p class='calc-error'> Something went wrong!!</p>";
                }
            }

            echo "<p class = 'calc-result'>Result = " . $value . "</p>";

        }
     ?>
</body>
</html>