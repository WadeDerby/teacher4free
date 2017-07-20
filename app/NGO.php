<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wade\Converter\FiguresConverter;

class NGO extends Model
{
  

   public function testConv($value){
   	 $conv =  new FiguresConverter();
   	return $conv->convertToWords($value);
   } 

   public function intMax(){
   	$conv =  new FiguresToTextConverter();
   	return $conv->intMaxValue();
   }
}
