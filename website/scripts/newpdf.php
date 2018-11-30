<?php

// Create Header and Footer

// Include the main TCPDF library (search for installation path).
require_once('../tcpdf/tcpdf_import.php');

class MYPDF extends TCPDF {

    public function drawPdf($lhsLang, $type, $words){

        if (!isset($max_width)){
            $max_width = 0;
        }

        if (!isset($max_height)){
            $max_height = 0;
        }

        $connection = new mysqli('127.0.0.1','root','newpassword','mydb');
        $this->SetCellPadding(0);

        $wordIdArr = explode(',',$words);

        $wordArrEng = array();
        $wordArrJap = array();
    
        // get the maximum width of the words in the array
        for ($h = 0; $h < count($wordIdArr); $h++){

            $ii = $wordIdArr[$h];
            $getEngWordQuery = "SELECT eng FROM mytable WHERE id = $ii";
                
            $engWord = $connection->query($getEngWordQuery)->fetch_object()->eng;
            
            array_push($wordArrEng, $engWord);

            $getJapWordQuery = "SELECT kana FROM mytable WHERE id = $ii";
            $japWord = $connection->query($getJapWordQuery)->fetch_object()->kana;
            
            array_push($wordArrJap, $japWord);

            if ($lhsLang === "eng"){
                
                $text_width = $this->GetStringWidth("$wordArrEng[$h]",'cid0jp','',20,false);
            }else{
                
                $text_width = $this->GetStringWidth("$wordArrJap[$h]",'cid0jp','',20,false);

            }
        
            if ($text_width > $max_width){
                $max_width = $text_width;
            }
        }
    
        if ($type == 'que'){

            $this->SetFont('cid0jp', '', 30);
            $this->Write(0, "Questions:", '', 0, 'L', true, 0, false, false, 0);
            // print the lines english -> blank
            if ($lhsLang === 'eng'){

                for ($i = 0; $i < count($wordArrEng); $i++){
                    $this->SetFont('cid0jp', '', 20);
                    $this->cell($max_width, $max_height, $wordArrEng[$i],0,0,'L');
        
                    for ($j = 0; $j < 3; $j++){
                        $this->Write($max_height,'');
                    }
        
                    $this->SetFont('times', '', 20);
                    $this->Write($max_height, " --> _______", '', 0, 'L', true, 0, false, false, 0);
                }
            }else{
                for ($i = 0; $i < count($wordArrJap); $i++){
                    $this->SetFont('cid0jp', '', 20);
                    $this->cell($max_width, $max_height, $wordArrJap[$i],0,0,'L');
        
                    for ($j = 0; $j < 3; $j++){
                        $this->Write($max_height,'');
                    }
        
                    $this->SetFont('times', '', 20);
                    $this->Write($max_height, " --> _______", '', 0, 'L', true, 0, false, false, 0);
                }
            }
    
        }else{
    
            $this->SetFont('cid0jp', '', 30);
            $this->Write(0, "Answers:", '', 0, 'L', true, 0, false, false, 0);
            
            if ($lhsLang === 'eng'){
                // print the lines english -> japanese
                for ($k = 0; $k < count($wordArrEng); $k++){
                    $this->SetFont('cid0jp', '', 20);
                    $this->cell($max_width, $max_height, $wordArrEng[$k],0,0,'L');
                
                    for ($l = 0; $l < 3; $l++){
                        $this->Write($max_height,'');
                    }
                
                    $this->Write($max_height, " -->", '', 0, 'L', false, 0, false, false, 0);
                    
                    $this->SetFont('cid0jp', 'U', 20);
                    $this->write($max_height, $wordArrJap[$k], '', 0, 'L', true, 0, false, false, 0);
                }

            }else{
                for ($k = 0; $k < count($wordArrJap); $k++){
                    $this->SetFont('cid0jp', '', 20);
                    $this->cell($max_width, $max_height, $wordArrJap[$k],0,0,'L');
                
                    for ($l = 0; $l < 3; $l++){
                        $this->Write($max_height,'');
                    }
                
                    $this->Write($max_height, " -->", '', 0, 'L', false, 0, false, false, 0);
                    
                    $this->SetFont('cid0jp', 'U', 20);
                    $this->write($max_height, $wordArrEng[$k], '', 0, 'L', true, 0, false, false, 0);
                }

            }
            
        }
    
    }

}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

//echo $engWord;

$lhsLang = $_GET['lang'];
$type = $_GET['type'];
$words = $_GET['words'];

// add a page
$pdf->AddPage();

$max_height = 15;
$max_width = 0;

// draws questions answers depending on url parameter

$pdf->drawPdf($lhsLang, $type, $words);

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_002.pdf', 'I');

?>