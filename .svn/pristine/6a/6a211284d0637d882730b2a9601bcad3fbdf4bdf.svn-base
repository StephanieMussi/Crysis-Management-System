<?php
require('fpdf.php');
//require('connectdb.php');
include('../../classes/cmo/cmo_incidentController.php');

date_default_timezone_set("Singapore");
//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

//$pdf = new FPDF( 'P', 'mm', 'A4' );

class PDF extends FPDF
{
// Page header
    function Header()
    {
        // Logo
        $this->Image('ReportLogo.jpg',10,6,28);
        // Arial bold 15
        $this->SetFont('Arial','I',15);
        // Move to the right
        $this->Cell(50);
        // Title
        $this->Cell(0,15,'Crisis Management Incident Report Summary');
        // Line break
        $this->Ln(20);
    }

// Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        $this->Ln(5);
        $this->Cell(0,10,'Private and Confidential',0,0,'C');
    }

    function ChapterTitle($label,$NeedDate)
    {
        // Arial 12
        $this->SetFont('Arial','',12);
        // Background color
        $this->SetFillColor(200,220,255);
        // Title
        if ($NeedDate){
            $this->Cell(0,6,"$label".str_repeat(' ', 95).date("G:i  / d M Y"),0,1,'L',true);
        }
        else
            $this->Cell(0,6,"$label",0,1,'L',true);
        // Line break

    }

    function CreateTable($header,$reportdata)
    {
        // Header
        //$this->SetFillColor(100,100,100);
        //$this->SetTextColor(255);
        $this->SetLineWidth(.3);
        $this->SetFont('Arial','B',14);

        /*for($i = 0; $i < sizeof($headersize); $i++)
            $this->Cell($headersize[$i]+21,7,$header[$i],1,0,'C',true);
        //$pdfMC->Row($header);
        */
        $this->SetFillColor(224,235,255);
        //$this->SetTextColor(0);
        $this->SetFont('Arial','B',11);
        $this->setLineHeight(5);
        $this->setWidths(Array(10,30,50,40,20,40));
        $this->SetAligns("C");

        //$this->Row(array('No','Incident Type','Actions Taken','Agency Involved','Status','Remarks'));
        $this->Row(array('No','Location','Emergency Type','Assistance','Status'));
        //Content
        $this->SetFont('Arial','',9);

        foreach($reportdata as $row)
        {
            $this->Row(Array($row["incidentId"],$row["location"],$row["emergencyType"],$row["typeOfAssistance"],$row["status"]));
        }

    }

    /*function GetTableData($connection){

        $sql = "SELECT * FROM `incident report`";
        $result = mysqli_query($connection,$sql);
        $i=0;
        if (!$result)
            echo(mysqli_error($connection));

        if ($result->num_rows > 0) {
            //print($result->num_rows);
            return $result;

            while($row = $result->fetch_assoc())
            {
                    echo "<br>";
                    $data[$i][0] = $row["No"];
                    $data[$i][1] = $row["Incident Type"];
                    $data[$i][2] = $row["Actions Taken"];
                    $data[$i][3] = $row["Agency Involved"];
                    $data[$i][4] = $row["Status"];
                    $data[$i][5] = $row["Remarks"];
                    print($data[$i][0].$data[$i][1].$data[$i][2].$data[$i][3].$data[$i][4].$data[$i][5]);
                    echo "<br>";
                    $i += 1;
            }
         */
        // variable to store widths and aligns of cells, and line height
    var $widths;
    var $aligns;
    var $lineHeight;

//Set the array of column widths
    function SetWidths($w){
        $this->widths=$w;
    }

//Set the array of column alignments
    function SetAligns($a){
        $this->aligns=$a;
    }

//Set line height
    function SetLineHeight($h){
        $this->lineHeight=$h;
    }

//Calculate the height of the row
    function Row($data)
    {
        // number of line
        $nb=0;

        // loop each data to find out greatest line number in a row.
        for($i=0;$i<count($data);$i++){
            // NbLines will calculate how many lines needed to display text wrapped in specified width.
            // then max function will compare the result with current $nb. Returning the greatest one. And reassign the $nb.
            $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
        }

        //multiply number of line with line height. This will be the height of current row
        $h=$this->lineHeight * $nb;

        //Issue a page break first if needed
        $this->CheckPageBreak($h);

        //Draw the cells of current row
        for($i=0;$i<count($data);$i++)
        {
            // width of the current col
            $w=$this->widths[$i];
            // alignment of the current col. if unset, make it left.
            $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x=$this->GetX();
            $y=$this->GetY();
            //Draw the border
            $this->Rect($x,$y,$w,$h);
            //Print the text
            $this->MultiCell($w,5,$data[$i],0,$a);
            //Put the position to the right of the cell
            $this->SetXY($x+$w,$y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    function CheckPageBreak($h)
    {
        //If the height h would cause an overflow, add a new page immediately
        if($this->GetY()+$h>$this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w,$txt)
    {
        //calculate the number of lines a MultiCell of width w will take
        $cw=&$this->CurrentFont['cw'];
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
        $s=str_replace("\r",'',$txt);
        $nb=strlen($s);
        if($nb>0 and $s[$nb-1]=="\n")
            $nb--;
        $sep=-1;
        $i=0;
        $j=0;
        $l=0;
        $nl=1;
        while($i<$nb)
        {
            $c=$s[$i];
            if($c=="\n")
            {
                $i++;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
                continue;
            }
            if($c==' ')
                $sep=$i;
            $l+=$cw[$c];
            if($l>$wmax)
            {
                if($sep==-1)
                {
                    if($i==$j)
                        $i++;
                }
                else
                    $i=$sep+1;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
            }
            else
                $i++;
        }
        return $nl;
    }
}

$pdf = new PDF();

$pdf->AddPage();
$pdf->AliasNbPages();
$incidentcontroller = new cmo_incidentController();
$incidentsdata = Array();
$incidentsdata= $incidentcontroller->getAllIncidents();







//Set First Chapter
$pdf->ChapterTitle("Incidents Summary",true);
$pdf->Ln(4);

$header = array('No','Incident Type','Actions Taken','Agency Involved','Status','Remarks');
$headersize = [];
for ($x = 0; $x < sizeof($header); $x++)
{
    $headersize[$x] = strlen($header[$x]);
}

//Main Document Start
$pdf->Ln(2);
$pdf->SetFont('Arial','',11);
$pdf->Cell(0,7,'Total No. Of Incidents Reported : '); //insert no. of incidents here
$pdf->Ln(6);
$pdf->Cell(0,7,'Total No. Of Severe Incidents Reported : '); //insert value here
$pdf->Ln(6);
$pdf->Cell(0,7,'No. Of Cases Unresolved : ');
$pdf->Ln(6);
$pdf->Cell(0,7,'Average time taken to resolve cases : ');



//$pdf->Multicell(0,2,"This is a multi-line text string\nNew line\nNew line");
$pdf->Ln(20);
$pdf->ChapterTitle("Incidents Table",false);

$pdf->Ln(5);
$pdf->CreateTable($header,$incidentsdata);


$pdf->Output("F","test.pdf");
?>
