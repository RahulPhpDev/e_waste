<x-admin.layout>
    <div class="col s12 m12 l12">
        <div id="responsive-table" class="card card card-default scrollspy">
            <div class="card-content">
                <h4 class="card-title camel-case">  Zone </h4>
                <div class="row">
                    <div class="col s12">


<div>
    <div  role="document">
        <div >

            <div >

                <form method="post" enctype="multipart/form-data" action={{route('admin.zone.update', $record->id)}}>
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="input-field col m6 s6">
                             <label for="name" class="active"> Name </label>
                            <input id="name" type="text"  value="{{ $record->name }}"  class = 'validate' name = 'name'>

                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="input-field col m6 s6">
                             <label for="icon_prefix2" class="active"> Code </label>

                            <input id="icon_prefix2"  value="{{ $record->zip_code }}"  type="text" class = 'validate' name = 'zip_code'>
                            @error('zip_code')
                             <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                    </div>

                    <div class="row">

                         <div class="input-field col m6 s6">
                             <label for="lattitude" class="active"> Lattitude </label>

                            <input id="lattitude"  value="{{ $record->lattitude }}"  type="text" class = 'validate' name = 'lattitude'>
                            @error('lattitude')
                             <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>



                         <div class="input-field col m6 s6">
                             <label for="longitute" class="active"> Longitute </label>

                            <input id="longitute" value="{{ $record->longitute }}"  type="text" class = 'validate' name = 'longitute'>
                            @error('longitute')
                             <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="input-field col m6 s6">
                        <label
                            for="district"
                            class="active">
                            District
                        </label>
                        <select
                            name="district_id"
                        >
                            @foreach( $districts as $vn => $vt)
                                <option value ="{{ $vn  }}"
                                @if($record->district_id == $vn) selected @endIf
                                >{{ $vt  }} </option>
                            @endforeach
                        </select>
                        @error('district_id')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                        </div>




                        <div class="input-field col m6 s6">


                               <label for="landmark" class="active"> Landmark</label>
                              <textarea id = "landmark" name = "landmark" id="message5" class="materialize-textarea">{{ $record->landmark }} </textarea>

                            @error('landmark')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">



                        <div class="input-field col m4 s12">
                            <div class="input-field col s12">
                                <button  class="btn cyan waves-effect waves-light" type="submit"
                                        name="action">Submit</button>
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
