@extends('admin_master')

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                         <h3>Filter(Product title,category,subcategory)</h3>
                         <div class="row">
                            {{-- category wise --}}
                         <div class="col-lg-3"  >
                            <label>Category Wise</label>
                            <select class="category_filter form-control" >
                                <option value="" readonly> Select Category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->title }}</option>
                        @endforeach
                            </select>
                            </div>
                            {{-- sub category wise --}}
                         <div class="col-lg-3"  >
                            <label>SubCategory Wise</label>
                            <select class="subcategory_filter form-control" >
                                <option value="" readonly> Select Subcategory</option>
                            @foreach ($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}">
                                {{ $subcategory->title }}</option>
                        @endforeach
                            </select>
                            </div>
                            {{-- product title wise --}}
                            <div class="col-lg-3"  >
                                <label>Product Wise</label>
                                <select class="product_filter form-control" >
                                    <option value="" readonly> Select Product Title</option>
                                @foreach ($products as $product)
                                <option value="{{ $product->id }}">
                                    {{ $product->title }}</option>
                            @endforeach
                                </select>
                                </div>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- Button trigger modal -->
                    <div class="card p-5 mt-3">
                        <div class="row ">
                            <h3 class="text-center">Product View</h3>
                            <div class="col-lg-4 float-end">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">
                                    Add Product
                                </button>
                            </div>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Sub Category</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">price</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table_data">
                                @foreach ($products as $product)
                                    <tr>
                                        <td scope="row"> <img src="{{ asset($product->thumbnail) }}" alt="..."
                                                height="100" width="100"></td>
                                        <td>{{ $product->subcategory->title }}</td>
                                        <td>{{ $product->title }}</td>
                                        <td>{!! $product->description !!} </td>
                                        <td>{{ $product->price }}</td>
                                        <td>
                                            <button type="button" value="{{ $product->id }}"
                                                class="btn btn-danger deleteBtn btn-sm">
                                                Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tbody class="filter_table_data">
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Product Add</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form id="add_product_form" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="modal-body">

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group mb-3">
                                                <label for="simpleinput">Subcategory Name</label>
                                                <select class="form-control set" id="example-select"
                                                    name="subcategory_id">
                                                    <option value=""> Select Subcategory</option>
                                                    @foreach ($subcategories as $subcategory)
                                                        <option value="{{ $subcategory->id }}"
                                                            {{ old('subcategory_id') == $subcategory->id ? 'selected' : '' }}>
                                                            {{ $subcategory->title }}</option>
                                                    @endforeach
                                                </select>
                                                <span id="error_subcategory_id" class="text-danger"></span>
                                            </div>

                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group mb-3">
                                                <label for="simpleinput">Title</label>

                                                <input type="text" id="simpleinput" class="form-control"
                                                    name="title" value="{{ old('title') }}">
                                                <span id="error_title" class="text-danger"></span>
                                            </div>

                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group mb-3">
                                                <label for="simpleinput">Price</label>

                                                <input type="number" id="simpleinput" class="form-control"
                                                    name="price" value="{{ old('price') }}">
                                                <span id="error_price" class="text-danger"></span>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Description</label>
                                                    <textarea class="ckeditor form-control" name="description">{{ old('description') }}</textarea>

                                                    <span id="error_description" class="text-danger"></span>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-lg-4">
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Thumbnail</label>

                                                    <input type="file" id="simpleinput" class="form-control"
                                                        name="thumbnail" value="{{ old('thumbnail') }}">
                                                    <span id="error_thumbnail" class="text-danger"></span>
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save Product</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- modal end --}}
            </div>
        </div>
    </section>
</div>
@section('scripts')

    {{-- ---------------------Add Product AJax-------------------------- --}}
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //Add Submit
            $(document).on('submit', '#add_product_form', function(e) {
                e.preventDefault();
                console.log('sssssssssss');
                $('#error_thumbnail').text("");
                $('#error_description').text("");
                $('#error_price').text("");
                $('#error_title').text("");
                $('#error_subcategory_id').text("");
                let formData = new FormData($('#add_product_form')[0]);
                $.ajax({
                    type: "POST",
                    url: `/admin/product/store`,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        if (response.status == 400) {
                            $('#error_subcategory_id').text(response.errors.subcategory_id);
                            $('#error_title').text(response.errors.title);
                            $('#error_price').text(response.errors.price);
                            $('#error_description').text(response.errors.description);
                            $('#error_thumbnail').text(response.errors.thumbnail);

                        } else {
                            console.log(response);
                            location.reload();
                            $('#staticBackdrop').modal('hide');
                        }
                    }
                });
            });
            // {{-- ---------------------Delete Product AJax-------------------------- --}}
            $(document).on('click', '.deleteBtn', function() {
                var product_id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: `/admin/product/delete/${product_id}`,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log('product deleted!!!');
                        location.reload();

                    }
                });
            });
        });
    </script>
    {{---------------------- for filtering---------------------- --}}
    <script>
         $(document).ready(function() {

            $("select.subcategory_filter").change(function(){
                $('.table_data').html("");
            $('.filter_table_data').html("");
        var subcat_id = $(this).children("option:selected").val();
        $.ajax({
                    type: "GET",
                    url: `/admin/subcat/filter/${subcat_id}`,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response.sub_product);
                        $('.table_data').addClass('d-none');
                        $.each(response.sub_product, function(key, value) {
                            var filtered_table=`
                            <tr>
                                <td><img src="http://127.0.0.1:8000/${value.thumbnail}"/ height="100" width="100"></td>
                                <td>${value.subcategory.title}</td>
                                <td>${value.title}</td>
                                <td>${value.description}</td>
                                <td>${value.price}</td>
                                <td><button type="button" value="${value.id}"
                                                class="btn btn-danger deleteBtn btn-sm">
                                                Delete</button></td>

                                </tr>
                            `;
                            $('.filter_table_data').append(filtered_table);
                            });



                    }
                });
      });
      ////////////////////////////for category filter///////////////////////
      $("select.category_filter").change(function(){
                $('.table_data').html("");
            $('.filter_table_data').html("");
        var cat_id = $(this).children("option:selected").val();
        $.ajax({
                    type: "GET",
                    url: `/admin/cat/filter/${cat_id}`,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        $('.table_data').addClass('d-none');
                        // location.reload();
                        $.each(response.cat_product, function(key, value) {
                            console.log('cvbnm'+value.id);
                            $.each(value.product, function(key, value) {
                               var filtered_table=`
                            <tr>
                                <td><img src="http://127.0.0.1:8000/${value.thumbnail}"/ height="100" width="100"></td>
                                <td>${value.subcategory.title}</td>
                                <td>${value.title}</td>
                                <td>${value.description}</td>
                                <td>${value.price}</td>
                                <td><button type="button" value="${value.id}"
                                                class="btn btn-danger deleteBtn btn-sm">
                                                Delete</button></td>

                                </tr>
                            `;
                            $('.filter_table_data').append(filtered_table);
                            });

                            });



                    }
                });
      });
      ////////////////////////////////product title wise filter/////////////////////////////////
      $("select.product_filter").change(function(){
                $('.table_data').html("");
            $('.filter_table_data').html("");
        var product_id = $(this).children("option:selected").val();
        $.ajax({
                    type: "GET",
                    url: `/admin/product/filter/${product_id}`,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        $('.table_data').addClass('d-none');
                        $.each(response.product, function(key, value) {
                               var filtered_table=`
                            <tr>
                                <td><img src="http://127.0.0.1:8000/${value.thumbnail}"/ height="100" width="100"></td>
                                <td>${value.subcategory.title}</td>
                                <td>${value.title}</td>
                                <td>${value.description}</td>
                                <td>${value.price}</td>
                                <td><button type="button" value="${value.id}"
                                                class="btn btn-danger deleteBtn btn-sm">
                                                Delete</button></td>

                                </tr>
                            `;
                            $('.filter_table_data').append(filtered_table);


                            });
                    }
                });
      });
    });
    </script>

@endsection
