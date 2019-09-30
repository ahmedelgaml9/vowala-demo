<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
 class Faqs extends Model {

    protected $table = 'faqs';
    protected $fillable = array('question','ar_question', 'answer','ar_answer');
      public $timestamps = false;
  

}
