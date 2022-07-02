<x-admin.layout>
    <div class="col s12 m12 l12">
        <div id="responsive-table" class="card card card-default scrollspy">
            <div class="card-content">
                <h4 class="card-title camel-case">  Edit Product </h4>
                <div class="row">
                    <div class="col s12">


<div>
    <div  role="document">
        <div >

            <div>

                <form method="post" enctype="multipart/form-data" action={{route('admin.product.update', $record->id)}}>
                    @csrf
                    @method('PUT')
                    <div class="row">

                        <div class="input-field col m6 s6">
                             <label for="name" class="active"> Name </label>
                            <input id="name" type="text" class = 'validate' value = "{{ $record->name }}" name = 'name'>

                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-field col m6 s6" >
                            <label
                                for="unit_id"
                                class="active">
                                Unit
                            </label>
                            <select
                                name="unit_id"

                            >
                                @foreach( $units as $vn => $vt)
                                    <option @if($record->unit_id == $vn) selected @endIf  value ="{{ $vn  }}">{{ $vt  }} </option>
                                @endforeach
                            </select>
                            @error('unit_id')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>


                    </div>

                    <div class="row">

                     <div class="input-field col m6 s6" >
                        <label
                            for="category_id"
                            class="active">
                            Category
                        </label>
                        <select
                            name="category_id"

                        >
                            @foreach( $categories as $vn => $vt)
                                <option  @if($record->category_id == $vn) selected @endIf value ="{{ $vn  }}">{{ $vt  }} </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>


                     {{-- <div class="input-field col m6 s6" >
                        <label
                            for="type_id"
                            class="active">
                            Type
                        </label>
                        <select
                            name="type_id"

                        >
                            @foreach( $types as $vn => $vt)
                                <option  @if($record->type_id == $vn) selected @endIf value ="{{ $vn  }}">{{ $vt  }} </option>
                            @endforeach
                        </select>
                        @error('type_id')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div> --}}


                    </div>

                       

                        <div class="row">
                             <div class="input-field col m6 s6">


                           <label for="quantity" class="active"> Quantity</label>
                              <input id = "quantity" value = "{{ $record->product_quantity }}" name = "quantity" id="quantity"/>

                            @error('quantity')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                             <div class="input-field col m6 s6">
                                 <label for="name" class="active"> Price </label>
                                <input id="price" type="text" class = 'validate' value = "{{ $record->price }}" name = 'price'>

                                @error('price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                             </div>

                        </div>

                        <div class="row">
                            <div class="input-field col m12 s12" >
                                <label for="description" class="active"> Description</label>
                              <textarea id = "description" name = "description" id="message5" class="materialize-textarea">{{$record->description}}</textarea>

                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                      
                      <div class="row">
                               <div class="col m6 s12 file-field input-field">
                                    @if($record->image && $record->image->url )
                                        <img  width ="200px" height = "100px" src ="/storage/{{$record->image->url}}"  />
                              
                                    @endif
                             </div>

                              <div class="col m6 s12 file-field input-field">
                                    <div class="btn float-right">
                                        <span>Upload Image</span>
                                        <input type="file" name="product_image">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                    </div>

                                @error('image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                             </div>

                        </div>

                        </div>

                        <div class="input-field col m4 s12" >
                            <div class="input-field col s12">
                                <button  class="btn cyan waves-effect waves-light" type="submit"
                                        name="action">Update</button>
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
