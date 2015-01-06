<?php

class PDF_MC_Table extends FPDF
{
var $widths;
var $aligns = [];
var $bordes = true;
var $global_alight = 'L';


var $margen_izquierdo = 0;

/**
 * @param int $margen_izquierdo
 */
public function setMargenIzquierdo($margen_izquierdo)
{
    $this->margen_izquierdo = $margen_izquierdo;

}

var $r = 255;
var $g = 255;
var $b = 255;

var $pagina = 1;

var $next_page = false;

//public function  event($event){$event();}


    function SetWidths($w)
{
    //Set the array of column widths
    $this->widths=$w;

}

function SetAligns($a,$index)
{
    //Set the array of column alignments

    $this->aligns[$index]=$a;

}

function Row($data)
{

    //Calculate the height of the row
    $nb=0;

    for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=5*$nb;
    //Issue a page break first if needed
    $this->CheckPageBreak($h);
    //Draw the cells of the row

    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i] ;

        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : $this->global_alight;
        //Save the current position
        $x=$this->GetX();
        $y=$this->GetY();
        //Draw the border


        if($this->bordes){

                         $this->SetXY($x+$this->margen_izquierdo,$y);
            $this->SetFillColor(0,0,0);
            $this->Rect($x+$this->margen_izquierdo,$y,$w+.4,$h+.4,true);

            $this->SetFillColor($this->r,$this->g,$this->b);
            $this->Rect($x+$this->margen_izquierdo,$y,$w,$h,true);


        }else{
            $this->SetXY($x+$this->margen_izquierdo,$y);

        }


        //Print the text
        $this->MultiCell($w,5,$data[$i],0,$a,false);
        //Put the position to the right of the cell
        $this->SetXY($x+$w,$y);
    }
    //Go to the next line
    $this->Ln($h);
}

function CheckPageBreak($h)
{


    //If the height h would cause an overflow, add a new page immediately
    if($this->GetY()+$h>$this->PageBreakTrigger){



        $this->AddPage($this->CurOrientation);


    }

    if($this->GetY()+($h*2)>$this->PageBreakTrigger){

        $this->next_page = true;$this->pagina += 1;
    }else{

        $this->next_page = false;
    }



}

function NbLines($w,$txt)
{
    //Computes the number of lines a MultiCell of width w will take
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



    /**
     * @param boolean $bordes
     * creado pro mi leonel
     */
    public function setBordes($bordes)
    {
        $this->bordes = $bordes;
    }

    /**
     * @param string $global_alight
     */
    public function setGlobalAlight($global_alight)
    {
        $this->global_alight = $global_alight;
    }

    public function set_my_color($r,$g,$b){
        $this->r = $r;
        $this->b = $b;
        $this->g = $g;
    }



}

