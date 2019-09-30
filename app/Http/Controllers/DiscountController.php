<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DiscountRequest;
use App\Http\Requests;
use App\Discount;
use App\Product;
use App\Block;
use App\Catalog;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(DiscountRequest $request, Discount $model) {
        $this->request = $request;
        $this->model = $model;
        $this->view = 'admin/discounts/';
    }
    
    public function index()
    {
        if (is_null($this->request->value)) {
            $discounts = Product::whereIn('id' , $this->model->get()->lists('product_id'))->paginate(25);
        } else {
            $this->request->flash();
             $discounts = Product::whereIn('id' ,$this->model->get()->lists('product_id'))->where('title', 'like', "%{$this->request->value}%")
                    ->paginate(25);
        }
        $discounts->setPath('discounts');
        if ($this->request->ajax()) {
            return response()->json(view($this->view . 'loop', compact('discounts'))->render());
        }
        $discounts_ids = $this->model->all()->toArray();
        
        return View($this->view . 'index', compact('discounts', 'discounts_ids'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blocks = Block::all()->lists('title', 'id');
        $ob = new Block();
        $ob->title = "No Block";
        $ob->id = 0;
        $blocks = array_add($blocks, $ob->id, $ob->title);
        $blocks = $blocks->sortBy('id');
        $products = Product::get()->lists('title', 'id');
        return View($this->view . 'create', compact('products', 'shipments', 'blocks', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $input=$this->request->all();
        $insert = $this->model->create($input);
        if ($insert) {
            $add_offer_to_product = Product::find($insert->product_id)->update(['offer' => $insert->discount_percentage ]);
            if ($this->request->ajax())
                return response()->json(array('status' => 'true', 'message' => "Add Offer Done Sucessfully"));
            return redirect()->back()->with('success', "Add Offer Done Sucessfully");
        }
        else {
            if ($this->request->ajax())
                return response()->json(array('status' => 'false', 'message' => trans('Error')));
            return redirect()->back()->with('failed', trans('lang.Error'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $discounts = $this->model->where('product_id',$id)->first();
        $discount = $this->model->where('product_id',$id)->first();
        $products = Product::get()->lists('title', 'id');

        if ($discounts) {
            return View($this->view . 'edit', compact('discounts', 'products'));
        } else {
            abort(404);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {   
        $input = $this->request->all();
        $discount = $this->model->find($id);
        //if  the  offer product  changed set  the  old  pordect  offer to  null 
        if($input['product_id'] != $discount->product_id){
            Product::find($discount->product_id)->update(['offer' => 0 ]);
        }

        $update = $discount->update($input);

        Product::find($discount->product_id)->update(['offer' => $discount->discount_percentage ]);

        if ($update) {
            if ($this->request->ajax())
                return response()->json(array('status' => 'true', 'message' => 'Update Section Done'));
            return redirect()->back()->with('success', 'Update Section Done');
        }else {
            if ($this->request->ajax())
                return response()->json(array('status' => 'false', 'message' => 'Update Faild'));
            return redirect()->back()->with('failed', 'Update Faild');
        }
    }
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $discount = $this->model->where('product_id', $id)->get()->first();
        if ($discount) {
            $delete = $discount->destroy($discount->id);
            $add_offer_to_product = Product::find($id)->update(['offer' => null ]);

            if ($this->request->ajax())
                return response()->json(array('status' => 'true', 'message' => trans('lang.deletedsuccessfully')));

            return redirect()->back()->with('failed', trans('lang.deletedsuccessfully'));
        }
        else {
            if ($this->request->ajax())
                return response()->json(array('status' => 'false', trans('lang.deletedfailed')));
            return redirect()->back()->with('failed', trans('lang.deletedfailed'));
        }
    }

}
