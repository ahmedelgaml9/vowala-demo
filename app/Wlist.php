<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Wlist extends Model
{
    public $timestamps=false;
    protected $table="wishlist";

    
    public function product($id)
    {
        return Product::find($id);
    }
}
