 <form method="post" enctype="multipart/form-data" action="{{$update_route}}">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="input-field col m6 s6">
                     <label for="icon_prefix2" class="active text-capitalize"> {{$text}} </label>
                    <input id="icon_prefix2" type="text"
                     class = 'validate'
                     name = "{{$field}}"
                     value = "{{$field_value}}">

                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>


                        <div class="input-field col m4 s12">
                            <div class="input-field col s12">
                                <button  class="btn cyan waves-effect waves-light" type="submit"
                                        name="action">Submit</button>
                            </div>
                        </div>
        </div>



</form>