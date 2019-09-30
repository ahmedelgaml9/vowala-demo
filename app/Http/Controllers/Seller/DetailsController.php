<?php

namespace App\Http\Controllers\Seller;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//======== add by me ============//
use App\Http\Requests\BookRequest;
use App\Specific;
use App\ProductSize;
use App\ProductGalary;

//use Auth;

class DetailsController extends Controller {

//=======  request and model and view file =============//
    public function __construct(BookRequest $request) {
        $this->request = $request;
    }

    public function show($id) {
        $update = ProductGalary::find($id)->update($this->request->all());
        if ($update) {
            if ($this->request->ajax()) {
                return response()->json(array('status' => 'true', 'message' => 'Update Item Done'));
                return redirect()->back()->with('success', 'Update Section Done');
            } else {
                if ($this->request->ajax())
                    return response()->json(array('status' => 'false', 'message' => 'Update Faild'));

                return redirect()->back()->with('failed', 'Update Faild');
            }
        }
    }
    public function edit($id) {
        $update = ProductSize::find($id)->update($this->request->all());
        if ($update) {
            if ($this->request->ajax()) {
                return response()->json(array('status' => 'true', 'message' => 'Update Item Done'));
                return redirect()->back()->with('success', 'Update Section Done');
            } else {
                if ($this->request->ajax())
                    return response()->json(array('status' => 'false', 'message' => 'Update Faild'));

                return redirect()->back()->with('failed', 'Update Faild');
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $update = Specific::find($id)->update($this->request->all());
        if ($update) {
            if ($this->request->ajax()) {
                return response()->json(array('status' => 'true', 'message' => 'Update Item Done'));
                return redirect()->back()->with('success', 'Update Section Done');
            } else {
                if ($this->request->ajax())
                    return response()->json(array('status' => 'false', 'message' => 'Update Faild'));

                return redirect()->back()->with('failed', 'Update Faild');
            }
        }
    }

    public function updateitem($id) {
        $update = Item::find($id)->update($this->request->all());
        if ($update) {
            if ($this->request->ajax())
                return response()->json(array('status' => 'true', 'message' => 'Update Item Done'));
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
     * @return Response
     */
    public function destroy($id) {
        $model = new Item();
        $delete = $model->destroy($id);
        if ($delete) {
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
