<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Category;
use App\Product;
use App\Slider;
use App\Section;
use App\Main;
use App\Block;
use App\Galary;
use App\Client;
use App\Order;
use App\Subcat;
use Session;
use App\Brand;
use App;
use App\Blog;
use App\BlogCat;
use App\Shipmentaddress;


use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    public function __construct()
    {
        
        $data= Main::find(1);
        $lang =$data->setlang;
        if ($lang == 1) {

            App::setLocale('en');
        }

        else{

            App::setLocale('ar');
        }
    }

      public function blogs()
       {
           
        $main = Main::find(1);
        $cats = Subcat::all(array('id', 'name', 'custom_url'));
        $blogs= Blog::where('active',1)->paginate(6);
        $blogcats = BlogCat::all();
        $recent_blogs = Blog::select('title', 'id', 'desc', 'photo', 'photo_alt', 'custom_url', 'created_at')->where('active',1)->orderBy('created_at', 'desc')->get()->take(3);
        $blocks = Block::all();
        $brands = Brand::where('active',1)->get();
          return view('site.blogs', compact('brands', 'main', 'cats', 'popular', 'blogs', 'blogcats', 'recent_blogs', 'blocks'));
       }
      
    public function blogcat($id)
      {
        $popular = Product::select('id', 'name', 'photo', 'offer', 'price', 'custom_url')->orderBy('viewers', 'desc')->get()->take(3);
        $main = Main::find(1);
        $cats = Category::all(array('id', 'name', 'custom_url'));
        $blogs = Blog::where('blog_cat_id', $id)->orderBy('created_at', 'desc')->paginate(6);
        $blogcats = BlogCat::all();
        $recent_blogs = Blog::select('title', 'id', 'desc', 'photo', 'photo_alt', 'custom_url', 'created_at')->orderBy('created_at', 'desc')->get()->take(3);
        $blocks = Block::all();
        $brands = Brand::where('active',1)->get();

        return view('site.blogs', compact('brands', 'main', 'cats', 'popular', 'blogs', 'blogcats', 'recent_blogs', 'blocks'));
     }

    public function blog($id)
     {
        $popular = Product::select('id', 'name', 'offer', 'price', 'custom_url')->orderBy('viewers', 'desc')->get()->take(3);
        $main = Main::find(1);
        $cats = Subcat::all(array('id', 'name', 'custom_url'));
        $blog = Blog::Where('custom_url', '=', $id)->first();
        $blogcats = BlogCat::all();
        $recent_blogs = Blog::select('title', 'id', 'desc', 'photo', 'photo_alt', 'custom_url', 'created_at')->orderBy('created_at', 'desc')->get()->take(3);
        $blocks = Block::all();
        $brands = Brand::where('active',1)->get();
        $related = Blog::where('cat_id', $blog->cat_id)->where('id', '<>', $blog->id)->get()->take('5');
            return view('site.blog', compact('brands', 'main', 'cats', 'popular','related', 'blog', 'blogcats','recent_blogs', 'blocks'));
    }

    public function index()
    {
        $main = Main::find(1);
        $brands = Brand::where('active',1)->get();
        // $photo = Galary::take(1)->get()->first();
        $slider = Slider::where('status', 1)->get();
        $adds= App\Add::all();
      
        $blocks = Block::all();
        $sections = Section::all();
        $blogs= Blog::where('active',1)->paginate(2);
       // $recent_viewed = Product::select('name', 'ar_name', 'offer', 'id', 'photo', 'price', 'custom_url', 'ar_custom_url')->orderBy('last_view', 'desc')->get()->take(3);
        $newest = Product::select('name', 'name_ar', 'offer', 'id', 'price', 'custom_url','type', 'custom_url_ar','status','catalog_id')->where('active',1)->orderBy('created_at', 'desc')->get()->take(5);
        $popular = Product::select('id', 'name', 'name_ar', 'offer', 'price', 'custom_url','type', 'custom_url_ar', 'catalog_id','status')->where('active',1)->get()->take(5);
        return view('site.index', compact('main', 'recent_new', 'homecats', 'photo', 'slider', 'blocks', 'recent_viewed','blogs', 'sections', 'cats', 'popular', 'brands', 'recent_blogs', 'newest', 'adds'));
    }

    public function getlogin()
    {
        $main = Main::find(1);
        $brands = Brand::all();
        $blocks = Block::all();
        $popular = Product::select('id', 'name', 'name_ar', 'offer', 'price', 'custom_url', 'custom_url_ar')->orderBy('viewers', 'desc')->get()->take(3);
        return view('site.login', compact('main', 'recent_new', 'recent_viewed', 'cats', 'brands', 'popular', 'blocks'));
    }

    public function getregister()
    {
        $main = Main::find(1);
        $brands = Brand::all();
        $blocks = Block::all();

        // $cats = Category::all(array('id', 'name', "ar_name", 'custom_url', 'ar_custom_url'));
        $popular = Product::select('id', 'name', 'name_ar', 'offer', 'price', 'custom_url', 'custom_url_ar')->orderBy('viewers', 'desc')->get()->take(3);
        return view('site.register', compact('main', 'recent_new', 'recent_viewed', 'cats', 'brands', 'popular', 'blocks'));
    }

    public function getcart()
    {
        $main = Main::find(1);
        $brands = Brand::all();
        $blocks = Block::all();
        $cats =  Subcat::all(array('id', 'name', 'name_ar', 'custom_url', 'custom_url_ar'));
        $popular = Product::select('id', 'name', 'name_ar', 'offer', 'price', 'custom_url', 'custom_url_ar')->orderBy('viewers', 'desc')->get()->take(3);
        $card = $_SESSION['cart'];
        return view('site.cart', compact('main', 'cats', 'brands', 'popular', 'card', 'blocks'));
    }

    public function Product($id)
     {
        $popular = Product::select('id', 'name', 'offer', 'price', 'custom_url','type','status')->orderBy('viewers', 'desc')->get()->take(6);
        $main = Main::find(1);
        $blocks = Block::all();
        $brands = Brand::where('active',1)->get();
        $product = Product::Where('custom_url', '=', $id)->orwhere('custom_url_ar', $id)->first();
        $cats = Subcat::all(array('id', 'name', 'name_ar', 'custom_url','custom_url_ar'));
        $related = Product::where('cat_id', $product->cat_id)->where('id', '<>', $product->id)->where('active',1)->get()->take('5');

        if (!empty($product)) {
            $product->viewers+=1;
            $product->save();
            if (Session::get('local') == 'ar') {
                $meta = array('meta_description' => $product->ar_meta_description, 'meta_keyword' => $product->ar_meta_keyword, 'meta_auther' => $product->ar_meta_auther, 'title' => $product->ar_name);
            } else {
                $meta = array('meta_description' => $product->meta_description, 'meta_keyword' => $product->meta_keyword, 'meta_auther' => $product->meta_auther, 'title' => $product->name);
            }
            return view('site.product', compact('main', 'product', 'cats', 'recent_viewed', 'popular', 'meta', 'blocks', 'brands', 'related', 'projectgallary'));
          } else {
            abort(404);
          }
         }
      public function categories($id)
      {
        $main = Main::find(1);
        $section= Section::Where('custom_url', '=', $id)->first();
        $oursection= Subcat::Where('section_id', '=', $section->id)->get();
        $brands = Brand::where('active',1)->get();
        $blocks = Block::all();
        $sections = Section::all();
        return view('site.categories', compact('main', 'meta','oursection','sections', 'brands', 'blocks','products','section'));
    }
    
    public function Category($id)
     {
        $products= Product::where('custom_url', $id)->where('active',1)->get();
        $main = Main::find(1);
        $cats = Subcat::all(array('id', 'name', 'name_ar', 'custom_url', 'custom_url_ar'));
        $cat = Subcat::Where('custom_url', '=', $id)->orWhere('custom_url_ar', $id)->first();
        $brands = Brand::where('active',1)->get();
        $blocks = Block::all();
        $sections = Section::all();
        if (empty($cat)) {
            abort(404);
        }
        if (Session::get('local') == 'ar') {
            $meta = array('meta_description' => $cat->ar_meta_description, 'meta_keyword' => $cat->ar_meta_keyword, 'meta_auther' => $cat->ar_meta_auther, 'title' => $cat->ar_name);
        } else {
            $meta = array('meta_description' => $cat->meta_description, 'meta_keyword' => $cat->meta_keyword, 'meta_auther' => $cat->meta_auther, 'title' => $cat->name);
        }

           return view('site.category', compact('main', 'meta', 'cat', 'cats', 'recent_viewed', 'popular', 'sections', 'brands', 'blocks', 'sections', 'products'));
       }
       
       
    public function categorylist($id)
       {
        $products= Product::where('custom_url', $id)->where('active',1)->get();
        $main = Main::find(1);
        $cats = Subcat::all(array('id', 'name', 'name_ar', 'custom_url', 'custom_url_ar'));
        $cat = Subcat::Where('custom_url', '=', $id)->orWhere('custom_url_ar', $id)->first();
        $brands = Brand::where('active',1)->get();
        $blocks = Block::all();
        $sections = Section::all();
        if (empty($cat)) {
            abort(404);
        }
        if (Session::get('local') == 'ar') {
            $meta = array('meta_description' => $cat->ar_meta_description, 'meta_keyword' => $cat->ar_meta_keyword, 'meta_auther' => $cat->ar_meta_auther, 'title' => $cat->ar_name);
        } else {
            $meta = array('meta_description' => $cat->meta_description, 'meta_keyword' => $cat->meta_keyword, 'meta_auther' => $cat->meta_auther, 'title' => $cat->name);
        }
              return view('site.categorylist',compact('main', 'meta', 'cat', 'cats', 'recent_viewed', 'popular', 'sections', 'brands', 'blocks', 'sections', 'products'));
        }
    
     public function section($id)
      {
        $main = Main::find(1);
        $cats = Subcat::all(array('id', 'name', 'name_ar'));
        $cat = Section::Where('custom_url', '=', $id)->first();
        $oursection= Subcat::Where('id', '=', $cat->id)->get();
        $brands = Brand::where('active',1)->get();
        $blocks = Block::all();
        $sections = Section::all();
        if (empty($cat)) {
            abort(404);
        }
        if (Session::get('local') == 'ar') {
            $meta = array('meta_description' => $cat->ar_meta_description, 'meta_keyword' => $cat->ar_meta_keyword, 'meta_auther' => $cat->ar_meta_auther, 'title' => $cat->ar_name);
        } else {
            $meta = array('meta_description' => $cat->meta_description, 'meta_keyword' => $cat->meta_keyword, 'meta_auther' => $cat->meta_auther, 'title' => $cat->name);
        }
          return view('site.section', compact('main', 'meta', 'cat', 'cats', 'recent_viewed','oursection', 'popular', 'sections', 'brands', 'blocks', 'sections', 'products'));
    }

       public function brand($id)
        {
          $main = Main::find(1);
          $cats = Subcat::all(array('id', 'name', 'name_ar' ,'custom_url', 'custom_url_ar'));
          $brand = Brand::Where('custom_url', '=', $id)->first();
          $products= Product::where('brand_id', $brand->id)->where('active',1)->get();
          $brands = Brand::all();

        if (empty($brand)) {
            abort(404);
        }
        if (Session::get('local') == 'ar') {
            $meta = array('meta_description' => $main->ar_meta_description, 'meta_keyword' => $main->ar_meta_keyword, 'meta_auther' => $main->ar_meta_auther, 'title' =>$brand->name_ar);
          } else {
            $meta = array('meta_description' => $main->meta_description, 'meta_keyword' => $main->meta_keyword, 'meta_auther' => $main->meta_auther, 'title' => $brand->name);
          }
             return view('site.brand', compact('main', 'meta', 'cats','brand', 'brands','products'));
       }
      
       public function brandlist($id)
        {
          $main = Main::find(1);
          $cats = Subcat::all(array('id', 'name', 'name_ar' ,'custom_url', 'custom_url_ar'));
          $brand = Brand::Where('custom_url', '=', $id)->first();
          $products= Product::where('brand_id', $brand->id)->where('active',1)->get();
          $brands = Brand::all();

        if (empty($brand)) {
            abort(404);
           }
               if (Session::get('local') == 'ar') {
            $meta = array('meta_description' => $main->ar_meta_description, 'meta_keyword' => $main->ar_meta_keyword, 'meta_auther' => $main->ar_meta_auther, 'title' =>$brand->name_ar);
          } else {
            $meta = array('meta_description' => $main->meta_description, 'meta_keyword' => $main->meta_keyword, 'meta_auther' => $main->meta_auther, 'title' => $brand->name);
          }
             return view('site.brandlist', compact('main', 'meta', 'cats','brand', 'brands','products'));
       }
       

        public function offers()
        {
        $popular = Product::select('id', 'name', 'offer', 'price', 'custom_url', 'ar_name')->orderBy('viewers', 'desc')->get()->take(3);
        $main = Main::find(1);
        $cats = Category::all(array('id', 'name', 'ar_name', 'custom_url', 'ar_custom_url'));
        $brands = Brand::all();
        $blocks = Block::all();
        $sections = Section::all();
        $products = Product::where('offer', '>', 0)->paginate(9);
        return view('site.offers', compact('main', 'products', 'cats', 'recent_viewed', 'popular', 'popular', 'sections', 'brands', 'blocks'));
    }

    public function brands()
    {
        $popular = Product::select('id', 'name', 'photo', 'offer', 'price', 'custom_url')->orderBy('viewers', 'desc')->get()->take(3);
        $main = Main::find(1);
        $cats = Category::all(array('id', 'name', 'ar_name', 'custom_url', 'ar_custom_url'));
        $brands = Brand::all();
        $blocks = Block::all();
        return view('site.brands', compact('main', 'meta', 'cat', 'cats', 'recent_viewed', 'popular', 'popular', 'sections', 'brands', 'blocks'));
    }

    public function AboutUs()
    {
        //$gal = Galary::all();
        $popular = Product::select('id', 'name', 'offer', 'price', 'custom_url', 'name_ar', 'custom_url_ar')->orderBy('viewers', 'desc')->get()->take(3);
        $main = Main::find(1);
        $cats = Subcat::all(array('id', 'name', 'name_ar', 'custom_url', 'custom_url_ar'));
        $brands = Brand::all();
        $blocks = Block::all();
        return view('site.aboutus', compact('cats', 'main', 'gal', 'brands', 'blocks', 'popular', 'clients'));
    }

    public function search(Request $data)
    {
        $main = Main::find(1);
        $brands = Brand::all();
        $cats =  Subcat::all(array('id', 'name', "name_ar", 'custom_url', 'custom_url_ar'));
        $popular = Product::select('id', 'name', 'name_ar', 'offer', 'price', 'custom_url', 'custom_url_ar')->orderBy('viewers', 'desc')->get()->take(3);
        $blocks = Block::all();
        $sections = Section::all();
        if (isset($data['q']) && !empty($data['q'])) {
            $products = Product::where('name', 'like', '%' . $data['q'] . '%')->orwhere('name_ar', 'like', '%' . $data['q'] . '%')->paginate(9);
        } else {
            $products = null;
        }
           return view('site.searchresult', compact('main', 'products', 'cats', 'recent_viewed', 'popular', 'brands', 'blocks', 'sections'));
    }

    public function sortprice(Request $request)
     {
        $main = Main::find(1);
        $cats =  Subcat::all(array('id', 'name', "name_ar", 'custom_url', 'custom_url_ar'));
        $brands = Brand::where('active',1)->get();
        $popular = Product::select('id', 'name', 'name_ar', 'offer', 'price', 'custom_url', 'custom_url_ar')->orderBy('viewers', 'desc')->get()->take(3);
        $blocks = Block::all();
        $sections = Section::all();
           if ($request->pricefrom  ||  $request->priceto) {
              $minprice = $request->pricefrom;
              $maxprice = $request->priceto;
               $products= Product::whereBetween('price', [$minprice, $maxprice])->paginate(9);
             } else {
                $products = null;
            }
             return view('site.sortprice', compact('main', 'brands', 'blocks', 'sections','products'));
     }

     public function sortpricelist(Request $request)
       {
        $main = Main::find(1);
        $cats =  Subcat::all(array('id', 'name', "name_ar", 'custom_url', 'custom_url_ar'));
        $brands = Brand::where('active',1)->get();
        $popular = Product::select('id', 'name', 'name_ar', 'offer', 'price', 'custom_url', 'custom_url_ar')->orderBy('viewers', 'desc')->get()->take(3);
        $blocks = Block::all();
        $sections = Section::all();
           if ($request->pricefrom  ||  $request->priceto) {
              $minprice = $request->pricefrom;
              $maxprice = $request->priceto;
               $products= Product::whereBetween('price', [$minprice, $maxprice])->paginate(9);
             } else {
                $products = null;
            }
             return view('site.sortpricelist', compact('main', 'brands', 'blocks', 'sections','products'));
     }

     public function searchblog(Request $data)
      {
        $main = Main::find(1);
        $brands = Brand::all();
        $cats =  Subcat::all(array('id', 'name', "name_ar", 'custom_url', 'custom_url_ar'));
        $popular = Product::select('id', 'name', 'name_ar', 'offer', 'price', 'custom_url', 'custom_url_ar')->orderBy('viewers', 'desc')->get()->take(3);
        $blocks = Block::all();
        $sections = Section::all();
        if (isset($data['q']) && !empty($data['q'])) {
            $blogs = Blog::where('title', 'like', '%' . $data['q'] . '%')->orwhere('title_ar', 'like', '%' . $data['q'] . '%')->paginate(9);
        } else {
            $blogs = null;
        }
            return view('site.searchblog', compact('main','blogs', 'brands', 'blocks', 'sections'));
    }


    public function sort(Request $request)
     {
        $main = Main::find(1);
        $brands = Brand::all();
        $cats = Subcat::all(array('id', 'name', "name_ar", 'custom_url', 'custom_url_ar'));
        $products = Product::select('id', 'name', 'name_ar',  'offer', 'price', 'custom_url', 'custom_url_ar','catalog_id')->orderBy($request->orderby, 'desc')->get()->take(6);
        $blocks = Block::all();
           return view('site.sort', compact('main', 'products', 'cats', 'recent_viewed', 'popular', 'brands', 'blocks', 'sections'));
     }
     
     
   
     public function sortlist(Request $request)
     {
        $main = Main::find(1);
        $brands = Brand::all();
        $cats = Subcat::all(array('id', 'name', "name_ar", 'custom_url', 'custom_url_ar'));
        $products = Product::select('id', 'name', 'name_ar',  'offer', 'price', 'custom_url', 'custom_url_ar','catalog_id')->orderBy($request->orderby, 'desc')->get()->take(6);
        $blocks = Block::all();
           return view('site.sortlist',compact('main', 'products', 'cats', 'recent_viewed', 'popular', 'brands', 'blocks', 'sections'));
     }
     
     
     
         public function contacts() {
             $main = Main::find(1);
             $rows = App\Contact::paginate(10);
             return view('admin.contacts', compact('rows','cat', 'main', 'cats', 'slider', 'meta'));
         }
          
        public function submitcontactus(Request $request) {
            
            $insert = new App\Contact();
            $insert->name= $request->name;
            $insert->email = $request->email;
            $insert->subject= $request->subject;
            $insert->message = $request->message;
            $insert->save();
              if ($insert) {
             \Session::flash('message','message successfully added.'); 
                return back();   
              }
        }
    
      public function checkout()
       {
        if (Auth::check()) {
            $card = $_SESSION['cart'];
            if (count($card) < 1) {
                return Redirect::to('Cart');
            }
            $main = Main::find(1);
            $cats = Subcat::all(array('id', 'name', 'name_ar', 'custom_url', 'custom_url_ar'));
            return view('site.checkout', compact('cats', 'main', 'card'));
           } else {
               return Redirect::to('Cart');
           }
       }

    public function contactus()
     {
        $main = Main::find(1);
        $brands = Brand::all();
        $cats = Subcat::all(array('id', 'name', "name_ar", 'custom_url', 'custom_url_ar'));
        $popular = Product::select('id', 'name', 'name_ar', 'offer', 'price', 'custom_url', 'custom_url_ar')->orderBy('viewers', 'desc')->get()->take(3);
        $blocks = Block::all();
        return view('site.contactus', compact('main', 'cats', 'brands', 'blocks', 'popular'));
}

    public function showbankmasrpage ($id , Request $request){
        
            $main = Main::find(1);
            $order = Order::find($id);
            
           return view('site.bankmasrpage', compact('main','order','brands', 'blocks', 'popular'));
       }

    public function mywishlist()
       {
        $main = Main::find(1);
        $brands = Brand::all();
        $cats = Subcat::all(array('id', 'name', "name_ar", 'custom_url', 'custom_url_ar'));
        $popular = Product::select('id', 'name', 'name_ar', 'offer', 'price', 'custom_url', 'custom_url_ar')->orderBy('viewers', 'desc')->get()->take(3);
        $blocks = Block::all();
          return view('profile.wlist', compact('main', 'cats', 'main', 'blocks', 'popular', 'brands'));
    }

    public function profile()
    {
        $main = Main::find(1);
        $cats =  Subcat::all();
        return view('profile.me', compact('main', 'cats'));
    }
    
   public function cancelpayment()
    {
        $main = Main::find(1);
        $cats =  Subcat::all();
        return view('site.completepayment', compact('main', 'cats'));
    }

    public function errorpayment()
     {
        $main = Main::find(1);
        $cats =  Subcat::all();
         return view('site.paymenterror', compact('main', 'cats'));
     }
    
    
   public function timeoutpayment()
     {
        $main = Main::find(1);
        $cats =  Subcat::all();
         return view('site.timeoutpayment', compact('main', 'cats'));
     }
       public function subscribers() {
             $main = Main::find(1);
             $rows =  App\Subscribe::paginate(10);
             return view('admin.subscribers', compact('rows','cat', 'main', 'cats', 'slider', 'meta'));
       }

       public function checkoutshipment()
        {
            $main = Main::find(1);
            $brands = Brand::all();
            $cats = Subcat::all(array('id', 'name', "name_ar", 'custom_url', 'custom_url_ar'));
            $popular = Product::select('id', 'name', 'name_ar', 'offer', 'price', 'custom_url', 'custom_url_ar')->orderBy('viewers', 'desc')->get()->take(3);
            $blocks = Block::all();
            $card = $_SESSION['cart'];

             return view('site.checkoutproducts',compact('main', 'cats', 'main', 'blocks', 'popular', 'brands','card'));
        }
        
        public function checkoutourorders()
        {    
            $main = Main::find(1);
            $brands = Brand::all();
            $cats = Subcat::all(array('id', 'name', "name_ar", 'custom_url', 'custom_url_ar'));
            $popular = Product::select('id', 'name', 'name_ar', 'offer', 'price', 'custom_url', 'custom_url_ar')->orderBy('viewers', 'desc')->get()->take(3);
            $blocks = Block::all();
            $card = $_SESSION['cart'];

           return view('site.checkout',compact('main', 'cats', 'main', 'blocks', 'popular', 'brands','card'));
        }

    public function subscribe(Request $request)
     {
        $insert = new App\Subscribe();
        $insert->email=$request->email;
        $insert->save();
        if ($insert) {
            \Session::flash('flash_message', 'message successfully added.');
            return back();
        }
    }
 
    public function editprofile(Request $request)
      {
        $update = Auth::user()->update($request->all());
        if ($update) {
            \Session::flash('done', 'Edit Account Process done successful '); 
                
            return redirect()->back();
           }else{
            \Session::flash('done', 'Edit Account Process done successful'); 
            return redirect()->back();
           }
        }

    public function autocomplete(Request $request)
     {
        $data = Product::select("name")
                ->where("name","LIKE","%{$request->input('query')}%")
                ->get();
           return response()->json($data);
     }



    public function myorder()
    {
        $main = Main::find(1);
        $cats = Subcat::all();
        if (Auth::check()) {
            $orders = Order::where('user_id', '=', Auth::user()->id)->orderby('id','desc')->get();
        }
          return view('profile.myorder', compact('main', 'cats', 'orders'));
    }


    public function order($id)
     {
        $main = Main::find(1);
        $cats = Category::all();
        $o = Order::find($id);
          return view('profile.order', compact('main', 'cats', 'o'));
     }
    
    
     public function destroycontacts($id)
       {
        $delete =  App\Contact::destroy($id);
        if ($delete) {
            \Session::flash('flash_message','Packet destroy successfully '); //<--FLASH MESSAGE
            return redirect()->back();
        } else {
            \Session::flash('flash_message','Packet Not destroy, Try again '); //<--FLASH MESSAGE
            return redirect()->back();
        }
    }
    
        public function destroysubscribtion($id)
        {
          $delete =  App\Subscribe::destroy($id);
         if ($delete) {
            \Session::flash('flash_message','Packet destroy successfully '); //<--FLASH MESSAGE
            return redirect()->back();
        } else {
            \Session::flash('flash_message','Packet Not destroy, Try again '); //<--FLASH MESSAGE
            return redirect()->back();
        }
    } 
    

     public function myaddresses()
      {
          
        $main = Main::find(1);
        return view('site.Addressbook', compact('main', 'cats', 'orders'));
      }
    
    
     public function editmyaddress($id)
     {
        $main = Main::find(1);
        $address= App\Shipmentaddress::where('id',$id)->first();
        return view('site.editaddress', compact('address', 'main'));
     }
     
   
     
    
      public function submitaddress(Request $request) {
          
            $insert = new Shipmentaddress();
            $insert->title= $request->title;
            $insert->country= $request->country;
            $insert->city = $request->city;
            $insert->street_name= $request->street_name;
            $insert->floor_number = $request->floor_number;
            $insert->address= $request->address;
            $insert->building_number = $request->building_number;
            $insert->flat_num = $request->flat_num;
            $insert->user_id =auth()->user()->id;
            $insert->save();
              if ($insert) {
                return back();   
              }}





        public function editaddress($id ,Request $request) {
            $insert =  Shipmentaddress::find($id);
            $insert->title= $request->title;
            $insert->country= $request->country;
            $insert->city = $request->city;
            $insert->street_name= $request->street_name;
            $insert->floor_number = $request->floor_number;
            $insert->building_number = $request->building_number;
            $insert->flat_num = $request->flat_num;
            $insert->user_id =auth()->user()->id;
            $insert->save();
              if ($insert) {
                  \Session::flash('message','address successfully added.'); 
                  return back();
              }
        }

 
        public function editfinalorder($id ,Request $request) {
            $main = Main::find(1);
            $order = Order::find($id);
            $order->active_order = 1;
            $order->save();
              if ($order) {
                \Session::flash('message','orders checkout  successfully '); 
                  $_SESSION['cart']=null;
                  return view('site.checkout_purchase',compact('order','main'));
              } else {
                 \Session::flash('message','orders not  checkedout  successfully '); 
              }}
       
           public function edit($id ,Request $request) {
              $insert = Order::find($id)->update($request->all());
              if ($insert) {
                 \Session::flash('message','address successfully added.'); 
                return back();   
              }}
        
          public function submitshipment(Request $request) {
           
               if($request->check_address ){
                 $sh= App\Shipmentaddress::where('id',$request->check_address)->first();
                 Session::put('country',$sh->country);
                 Session::put('city',$sh->city);
                 Session::put('street_name',$sh->street_name);
                 Session::put('floornumber',$sh->floor_number);
                 Session::put('flat_number',$sh->flat_number);
                 Session::put('shipment_company',$request->shipment_id);
                 Session::put('area',$sh->area);
                 Session::put('building_number',$sh->building_number);

                 
                  return redirect('checkoutorder');   
             }
                else{
                    \Session::flash('message',''); 
                     return back();  
                }}
}

