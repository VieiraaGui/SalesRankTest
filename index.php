<?php



function registerSales(){
    $saleDate = date('d/m/YY');

    $getSaler = getSalersNames();

    echo "Hello, please register the sale data below";

    echo "\n SallerName: " ; 
    $sallerName = rtrim(fgets(STDIN));
    echo "\n Client Name: " ;
    $clientName = rtrim(fgets(STDIN));
    echo "\n Item: " ; 
    $itemName = rtrim(fgets(STDIN));
    echo "\n Item Price ";
    $priceItem = rtrim(fgets(STDIN));

    if(strpos($getSaler, $clientName) == false){
                echo "This Saller does not exist, please write his name again";
                echo "\n This are the sallers available: " . getSalersNames();
                echo "\n Please, write the name of the saller again: "; 
                $sallerName = rtrim(fgets(STDIN));
            }

            
    $salesCompleted [] = array('Saller'=> $sallerName,'Item Name'=> $itemName, 'Price Item' => $priceItem, 'ClientName'=> $clientName, 'Sales date' => $saleDate );
    $fp = fopen('./jsonFiles/sales.json', 'w');
    fwrite($fp, json_encode($salesCompleted));
    fclose($fp);
    return $salesCompleted;
    

}

function getSalersNames(){
    $sallersNames = file_get_contents('./jsonFiles/sallersList.json');
    return $sallersNames;
    
}

function createRanking(){
    $dataSales = registerSales();
    usort($dataSales, function($saleValue, $saleValue2) { 
        return $saleValue->priceItem > $saleValue2->priceItem ? -1 : 1; 
    });  
}
// Running php Script

echo "Code running ";

createRanking();

echo "\n Finished Code";
   






?>