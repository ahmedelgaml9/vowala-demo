<div class="loading-sub" style="display: none;">
    <div class="progress">
        <div class="indeterminate"></div>
    </div>
</div>
<div class="card">
    <div class="card-content">
        <span class="card-title">Product Info</span>
        <div class="row">
            <div class="file-field col s6">
                <div class="btn teal lighten-1">
                    <span>Image</span>
                    {!!Form::file('photo', null,array('id'=>'photo'))!!}
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Product Image">
                </div>
                <label class="error">{{ $errors->first('photo') }}</label>
            </div>
            <div class="file-field col s6">
                <div class="btn teal lighten-1">
                    <span>Galary</span>
                    <input id="gallary" type="file" class="form-control" placeholder="Product Glary"  name='gallary[]' multiple/>
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Product Galary">
                </div>
                <label class="error">{{ $errors->first('photo') }}</label>
            </div>
            <div class="input-field col s6">
                {!!Form::text('name', null,array('class'=>'validate','id'=>'name'))!!}
                <label for="name">Product Name</label>
            </div>
            <div class="input-field col s6">
                {!!Form::text('ar_name', null,array('class'=>'validate','id'=>'ar_name'))!!}
                <label for="name">Product Arabic Name</label>
            </div>
            <div class="input-field col s6">
                {!!Form::select('cat_id', $cats,null,array('class'=>'validate','id'=>'cat_id'))!!}
                <label for="name">Category</label>
            </div>
             <div class="input-field col s6">
                {!!Form::select('brand_id', $brands,null,array('class'=>'validate','id'=>'brand_id'))!!}
                <label for="name">Brand</label>
            </div>
            <div class="input-field col s12">
                {!!Form::number('weight', null,array('class'=>'validate','id'=>'weight','steps'=>'any'))!!}
                <label for="weight">Product Weight in gs</label>
                <label class="error">{{ $errors->first('weight') }}</label>
            </div>

            <div class="input-field col s6">
                {!!Form::text('model', null,array('class'=>'validate','id'=>'model','steps'=>'any'))!!}
                <label for="model">Product Model</label>
                <label class="error">{{ $errors->first('model') }}</label>
            </div>
            <div class="input-field col s6">
                {!!Form::text('sku', null,array('class'=>'validate','id'=>'sku','steps'=>'any'))!!}
                <label for="sku">SKU</label>
                <label class="error">{{ $errors->first('sku') }}</label>
            </div>

            <div class="input-field col s12">
                {!!Form::textarea('shourtcut', null,array('class'=>'materialize-textarea','id'=>'shourtcut'))!!}
                <label for="shourtcut">Product Short Description</label>
            </div>
            <div class="input-field col s12">
                {!!Form::textarea('ar_shourtcut', null,array('class'=>'materialize-textarea','id'=>'ar_shourtcut'))!!}
                <label for="ar_shourtcut">Arabic Short Description</label>
            </div>
            <div class="input-field col s12">
                <label for="desc">Product Description</label>
                {!!Form::textarea('desc', null,array('class'=>'validate','id'=>'desc','placeholder'=>'Product Description','style'=>'padding-top:20px'))!!}
            </div>
            <div class="input-field col s12">
                <label for="ar_desc">Product Arabic Description</label>
                {!!Form::textarea('ar_desc', null,array('class'=>'validate','id'=>'ar_desc','placeholder'=>'Product Description','style'=>'padding-top:20px'))!!}
            </div>
            <div class="input-field col s12">
                <label for="desc">Product Return Policy</label>
                {!!Form::textarea('return_policy', null,array('class'=>'validate','id'=>'return_policy','placeholder'=>'Product Return Policy','style'=>'padding-top:20px'))!!}
            </div>
            <div class="input-field col s12">
                <label for="desc">Product Arabic  Return Policy </label>
                {!!Form::textarea('ar_return_policy', null,array('class'=>'validate','id'=>'ar_return_policy','placeholder'=>'Product Description','style'=>'padding-top:20px'))!!}
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-content">
        <span class="card-title">Product Meta Info</span>
        <div class="row">

            <div class="input-field col s6">
                {!!Form::text('photo_alt', null,array('class'=>'validate','id'=>'photo_alt'))!!}
                <label for="photo_alt">Photo alt</label>
            </div>
            <div class="input-field col s6">
                {!!Form::text('ar_photo_alt', null,array('class'=>'validate','id'=>'ar_photo_alt'))!!}
                <label for="ar_photo_alt">Arabic Photo alt</label>
            </div>

        </div>
    </div>
</div>
<div class="card">
    <div class="card-content">
        <span class="card-title">Product Specifications</span>
        <div class="row" id="other">
            <div id='oneline'>
                <div class="input-field col s3">
                    {!!Form::text('spec[]',null,array('class'=>'validate','steps'=>'any'))!!}
                    <label for="meta_keyword">Spec Key</label>
                </div>
                <div class="input-field col s3">
                    {!!Form::text('value[]',null,array('class'=>'validate','steps'=>'any'))!!}
                    <label >Value</label>
                </div>
                <div class="input-field col s3">
                    {!!Form::text('ar_spec[]',null,array('class'=>'validate','steps'=>'any'))!!}
                    <label for="meta_keyword">Spec Arabic Key</label>
                </div>
                <div class="input-field col s3">
                    {!!Form::text('ar_value[]', null,array('class'=>'validate','steps'=>'any'))!!}
                    <label>Arabic Value</label>
                </div>
            </div>
        </div>
        <a class="btn-floating btn-large waves-effect waves-light red add-other" ><i class="material-icons">add</i></a>
    </div>
</div>

<div class="loading-sub" style="display: none;">
    <div class="progress">
        <div class="indeterminate"></div>
    </div>
</div>
<br>
<br/>
{!! Form::submit($submitButton, array('class'=>'btn btn-primary text-center','id' => 'submit')) !!}
<script>
    CKEDITOR.replace('desc', {
        customConfig: '{{ asset("admin-assets/ckeditor/config.js") }}'
    });
    CKEDITOR.replace('ar_desc', {
        customConfig: '{{ asset("admin-assets/ckeditor/config.js") }}'
    });
    CKEDITOR.replace('return_policy', {
        customConfig: '{{ asset("admin-assets/ckeditor/config.js") }}'
    });
    CKEDITOR.replace('ar_return_policy', {
        customConfig: '{{ asset("admin-assets/ckeditor/config.js") }}'
    });
</script>
