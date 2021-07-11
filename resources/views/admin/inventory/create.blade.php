<x-admin.layout>
    <div class="col s12 m12 l12">
        <div id="responsive-table" class="card card card-default scrollspy">
            <div class="card-content">
                <h4 class="card-title camel-case"> Add {{$product->name}} Inventory </h4>
                <div class="row">
                    <div class="col s12">


<div>
    <div  role="document">
        <div >

            <div >

                <form method="post" enctype="multipart/form-data" action={{route('admin.product.inventories.store', $product->id)}}>
                    @csrf


                    <div class="row">

                    <div class="input-field col m6 s6" >
                        <label
                            for="type_id"
                            class="active">
                            Type
                        </label>
                        <select
                            name="type_id"

                        >
                            @foreach( $types as $vn => $vt)
                                <option value ="{{ $vn  }}">{{ $vt  }} </option>
                            @endforeach
                        </select>
                        @error('type_id')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                      <div class="input-field col m6 s6">


                           <label for="quantity" class="active"> Quantity</label>
                              <input id = "quantity" name = "quantity" id="quantity"/>

                            @error('quantity')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class = "row">

                        <div class="input-field col m6 s6">

                           <label for="price" class="active"> Price(total) </label>
                              <input id = "price" name = "price" id="price"/>

                            @error('price')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col m6 s12 file-field input-field">
                        <div class="btn float-right">
                            <span>File</span>
                            <input type="file" name="product_image">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                    </div>


                    </div>

                    <div class="row" >

                        <div class="input-field col m4 s12" >
                            <div class="input-field col s12">
                                <button  class="btn cyan waves-effect waves-light" type="submit"
                                        name="action">Save</button>
                            </div>
                        </div>
                    </div>



                </form>
            </div>
        </div>
    </div>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin.layout>
