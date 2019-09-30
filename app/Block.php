<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class  Block extends Model {

    /**
     * The dataFbase table used by the model.
     *
     * @var string
     */
     protected $table = 'block';
    protected $fillable = array('title','title_ar','photo','icon','active');
    public $timestamps = false;
    
    
    public function products ()
    {
       return $this->hasMany('App\Product','block_id');
    }

//    public function products($cat_id) {
//        if (isset($_GET['sort'])) {
//            if ($_GET['sort'] == 'name') {
//                $products = Product::where('block_id', '=', $cat_id)->orderBy('name', 'asc')->paginate(9);
//            } else if ($_GET['sort'] == 'date') {
//                $products = Product::where('block_id', '=', $cat_id)->orderBy('created_at', 'desc')->paginate(9);
//            } else if ($_GET['sort'] == 'popularity') {
//                $products = Product::where('block_id', '=', $cat_id)->orderBy('viewers', 'desc')->paginate(9);
//            } 
//             else if ($_GET['sort'] == 'offer') {
//                $products = Product::where('block_id', '=', $cat_id)->orderBy('offer', 'desc')->paginate(9);
//            } 
//
//              
//             else {
//                $products = Product::where('block_id', '=', $cat_id)->orderBy('created_at', 'desc')->paginate(9);
//            }
//        } else {
//            $products = Product::where('block_id', '=', $cat_id)->orderBy('created_at', 'desc')->paginate(9);
//        }
//        return $products;
//    }


         public function setPhotoAttribute($photo) {
             if ($photo) {
                 $dest = 'admin-assets/images/blocks/';
                 $name = str_random(6) . '_' . $photo->getClientOriginalName();
                 $photo->move($dest, $name);
                  $this->attributes['photo'] = $name;
                }
            }


 }
