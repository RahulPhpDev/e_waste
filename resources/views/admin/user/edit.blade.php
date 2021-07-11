<x-admin.layout>
    <div class="col s12 m12 l12">
        <div id="responsive-table" class="card card card-default scrollspy">
            <div class="card-content">
                <h4 class="card-title camel-case">  User </h4>
                <div class="row">
                    <div class="col s12">


<div>
    <div  role="document">
        <div >

            <div x-data="{ open: $record->role_id == 2 ? true : false }">

                <form method="post" enctype="multipart/form-data" action={{route('admin.user.update', $record->id)}}>
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


                        <div class="input-field col m6 s6">
                             <label for="email" class="active"> Email </label>

                            <input id="email" type="text" class = 'validate' value = "{{$record->email}}" name = 'email'>
                            @error('email')
                             <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                    </div>

                    <div class="row">

                         <div class="input-field col m6 s6">
                             <label for="phone" class="active"> Phone </label>

                            <input id="phone" type="number" class = 'validate' value = "{{$record->phone}}" name = 'phone'>
                            @error('phone')
                             <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>



                        <div class="input-field col m6 s6" >
                        <label
                            for="role_id"
                            class="active">
                            Role
                        </label>
                        <select
                            name="role_id"
                            @change="$event.target.value == 2 ? open = true: open=false"
                        >
                            @foreach( $roles as $vn => $vt)
                                <option  @if($record->role_id == $vn) selected @endIf value ="{{ $vn  }}">{{ $vt  }} </option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                        </div>


                    </div>



                    <div class="row" >

                        <div class = "show_hide">

                         <div class="input-field col m6 s6" x-show="open" >
                                    <label
                                        for="zone_id"
                                        class="active">
                                        Select Zone
                                    </label>
                                    <select
                                        name="zone_id"
                                    >
                                        @foreach( $zones as $vn => $vt)
                                            <option  value ="{{ $vn  }}" @if($userZone == $vn) selected @endIf>{{ $vt  }} </option>
                                        @endforeach
                                    </select>
                                    @error('zone_id')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                            </div>
                        </div>

                        <div class="input-field col m4 s12" >
                            <div class="input-field col s12">
                                <button  class="btn cyan waves-effect waves-light" type="submit"
                                        name="action">Update</button>
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
