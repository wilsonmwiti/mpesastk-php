<?php
/**
 * Created by IntelliJ IDEA.
 * User: Admin
 * Date: 2018-01-06
 * Time: 12:56 PM
 */

//
//$data = array(
//    'ResultCode' => 0,
//    'ResultDesc' => 'Success'
//);
//$freddy = "{
//    \"Body\": {
//        \"stkCallback\": {
//            \"MerchantRequestID\": \"4558-468965-1\",
//            \"CheckoutRequestID\": \"ws_CO_06012018130059318\",
//            \"ResultCode\": 0,
//            \"ResultDesc\": \"The service request is processed successfully.\",
//            \"CallbackMetadata\": {
//                \"Item\": [
//                    {
//                        \"Name\": \"Amount\",
//                        \"Value\": 10
//                    },
//                    {
//                        \"Name\": \"MpesaReceiptNumber\",
//                        \"Value\": \"MA6439W4WY\"
//                    },
//                    {
//                        \"Name\": \"Balance\"
//                    },
//                    {
//                        \"Name\": \"TransactionDate\",
//                        \"Value\": 20180106130157
//                    },
//                    {
//                        \"Name\": \"PhoneNumber\",
//                        \"Value\": 254720106420
//                    }
//                ]
//            }
//        }
//    }
//}";

echo json_encode($data);



// Convert JSON string to Array
echo $someArray = json_encode($data);
print_r($someArray);        // Dump all data of the Array


$fred = json_decode($data, true);

print_r($fred);
echo "###################### response ###############################".PHP_EOL;
//$x = 4; // Amount of digits
//$min = pow(10,$x);
//$max = pow(10,$x+1)-1;
//$value = rand($min, $max);
$one = $fred["Body"]["stkCallback"]["MerchantRequestID"];
$two = $fred["Body"]["stkCallback"]["CheckoutRequestID"];
$three = $fred["Body"]["stkCallback"]["ResultCode"];
$four = $fred["Body"]["stkCallback"]["ResultDesc"];
$five = $fred["Body"]["stkCallback"]["CallbackMetadata"]["Item"][0]["Value"];
$six = $fred["Body"]["stkCallback"]["CallbackMetadata"]["Item"][1]["Value"];
$seven = $fred["Body"]["stkCallback"]["CallbackMetadata"]["Item"][2]["Name"];
$eight = $fred["Body"]["stkCallback"]["CallbackMetadata"]["Item"][3]["Value"];
$nine = $fred["Body"]["stkCallback"]["CallbackMetadata"]["Item"][4]["Value"];



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mpesabridge";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO callback (merchantreqid, checkoutreqid, resultcode, ResultDesc, amount, mpesareceiptnumber, transtype ,transactiondate,phonenumber)
    VALUES ( 
                                              '$one',
                                              '$two',
                                              '$three',
                                              '$four',
                                              '$five',
                                              '$six',
                                              '$seven',
                                              '$eight',
                                              '$nine')";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "New record created successfully";
}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}




////$value = rand($min, $max);
//$fone = pg_escape_string(utf8_encode($one));
//$ftwo = pg_escape_string(utf8_encode($two));
//$fthree = pg_escape_string(utf8_encode($three));
//$ffour = pg_escape_string(utf8_encode($four));
//$ffive = pg_escape_string(utf8_encode($five));
//$fsix = pg_escape_string(utf8_encode($six));
//$fseven = pg_escape_string(utf8_encode($seven));
//$feight = pg_escape_string(utf8_encode($eight));
//$fnine = pg_escape_string(utf8_encode($nine));

////print_r($jsonData) ;
//$escaped = pg_escape_string($data);
//
//$db = pg_connect("host=localhost port=5432 dbname=mpesabridge user=postgres password=postgres");
////$query = "INSERT INTO sender_details VALUES ('$_POST[bookid]','$_POST[book_name]','$_POST[price]','$_POST[dop]')";
//$query = "INSERT INTO callback VALUES ('$fone' ,
//                                             '{$ftwo}' ,
//                                            '$fthree'  ,
//                                             '$ffour' ,
//                                             '$ffive' ,
//                                             '$fsix' ,
//                                             '$fseven' ,
//                                             '$feight' ,
//                                             '$fnine' )";
//
//
//$result = pg_query($query);

//echo $one.PHP_EOL;
//echo $two.PHP_EOL;
//echo $three.PHP_EOL;
//echo $four.PHP_EOL;
//echo $five.PHP_EOL;
//echo $six.PHP_EOL;
//echo $seven.PHP_EOL;
//echo $eight.PHP_EOL;
//echo $nine.PHP_EOL;
//function recursiveEcho($kak){
//if (is_array($kak)) {
//    foreach ($kak as $key => $value) {
//        if (is_array($value)) {
//            recursiveEcho($value);
//        } else {
//            //echo "Input name Correct: {$key} Value: {$value}";
//           // echo $key . " " . " " . $value;
//            echo $kak;
//        }
//    }
//} else {
//    // This is a string, there is no key to show
//    echo "Input value no Key: {$kak}";
//}}
//
//echo recursiveEcho($fred);
//$list = array( 'var1' => 'value1', 'var2' => 'value2' );
//foreach ( $fred as $key => $value ) { $$key = $value; }
//echo $value; //prints 'value1'

// print_r($fred);






$file = 'log.txt';
$fh = fopen($file, 'a');
fwrite($fh, "\n====".date("d-m-Y H:i:s")."====\n");
fwrite($fh, file_get_contents("php://input")."\n");
fclose($fh);
