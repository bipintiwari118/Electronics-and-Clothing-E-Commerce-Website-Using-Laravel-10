@extends('admin-panel.layouts.app')
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Products</h3>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Products <small>create</small></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name="title" type="text" id="title" required="required"
                                            class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Category <span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                       <select name="category_id" id="category" class="form-control" required >
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach

                                       </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sub_category">Sub_Category <span
                                            class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                       <select name="sub_category_id" id="sub_category" class="form-control"  required>
                                        <option value="">Select SubCategory</option>
                                        @foreach ($sub_categories as $subcategory)
                                        <option class="sub_cat_options" value="{{ $subcategory->id }}" data-category_id="{{ $subcategory->category_id }}" style="display: none;">{{ $subcategory->name }}</option>
                                        @endforeach
                                       </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="price" class="control-label col-md-3 col-sm-3 col-xs-12">Price</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="price" class="form-control col-md-7 col-xs-12" type="text"
                                            name="price"  required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="discount_price" class="control-label col-md-3 col-sm-3 col-xs-12">Discount_Price</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="discount_price" class="form-control col-md-7 col-xs-12" type="text"
                                            name="discount_price"  required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Image</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="image" class="form-control col-md-7 col-xs-12" type="file"
                                            name="image"  required>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                       <textarea name="description" id="description" cols="30" rows="10" class="form-control"  required></textarea>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button class="btn btn-primary" type="button">Cancel</button>
                                        <button class="btn btn-primary" type="reset">Reset</button>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection

@push('scripts')
<script>
    $('select[name="category_id"]').change(function(){

        var category_id=$(this).val();
        $('.sub_cat_options').hide();
        $('.sub_cat_options[data-category_id= '+ category_id +']').show();
    });
</script>
@endpush
