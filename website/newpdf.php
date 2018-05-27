<?php

// Create Header and Footer

// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf_import.php');

class MYPDF extends TCPDF {

    public function drawPdf($questionArr, $answerArr, $words){
    
        $this->SetCellPadding(0);

        $wordArr = str_split($words);
    
        // get the maximum width of the words in the array
        for ($h = 0; $h < count($wordArr); $h++){

            $ii = $wordArr[$h];
            $text_width = $this->GetStringWidth("$questionArr[$ii]",'cid0jp','',20,false);
        
            if ($text_width > $max_width){
                $max_width = $text_width;
            }
        }
    
        if ($answerArr == NULL){

            $this->SetFont('cid0jp', '', 30);
            $this->Write(0, "Questions:", '', 0, 'L', true, 0, false, false, 0);
            // print the lines english -> blank
            for ($i = 0; $i < count($wordArr); $i++){
                $ii = $wordArr[$i];
                $this->SetFont('cid0jp', '', 20);
                $this->cell($max_width, $max_height, $questionArr[$ii],0,0,'L');
    
                for ($j = 0; $j < 3; $j++){
                    $this->Write($max_height,'');
                }
    
                $this->SetFont('times', '', 20);
                $this->Write($max_height, " --> _______", '', 0, 'L', true, 0, false, false, 0);
            }
    
        }else{
    
            $this->SetFont('cid0jp', '', 30);
            $this->Write(0, "Answers:", '', 0, 'L', true, 0, false, false, 0);
            
            // print the lines english -> japanese
            for ($k = 0; $k < count($wordArr); $k++){
                $ii = $wordArr[$k];
                $this->SetFont('cid0jp', '', 20);
                $this->cell($max_width, $max_height, $questionArr[$ii],0,0,'L');
            
                for ($l = 0; $l < 3; $l++){
                    $this->Write($max_height,'');
                }
            
                $this->Write($max_height, " -->", '', 0, 'L', false, 0, false, false, 0);
                
                $this->SetFont('cid0jp', 'U', 20);
                $this->write($max_height, $answerArr[$ii], '', 0, 'L', true, 0, false, false, 0);
            }
            
        }
    
    }

}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$lhsLang = $_GET['lang'];
$type = $_GET['type'];
$words = $_GET['words'];

// temperory arrays with vocab
$english = array("Pencil", "Umbrella", "Bag", "Shoes");
$jap = array("えんぴつ", "かさ", "かばん", "くつ");

// add a page
$pdf->AddPage();

$max_height = 15;
$max_width = 0;

// draws questions answers depending on url parameter
if ($lhsLang == "eng"){// english lhs

    if ($type == "que"){

        $pdf->drawPdf($english, NULL, $words);
    
    }else if($type == "ans"){
    
        $pdf->drawPdf($english, $jap, $words);
    
    }

}else if ($lhsLang == "jap"){

    if ($type == "que"){

        $pdf->drawPdf($jap, NULL, $words);
    
    }else if($type == "ans"){
    
        $pdf->drawPdf($jap, $english, $words);
    
    }
}

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_002.pdf', 'I');

?>