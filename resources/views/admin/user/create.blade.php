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

            <div x-data="{ open: false }">

                <form method="post" enctype="multipart/form-data" action={{route('admin.user.store')}}>
                    @csrf
                    <div class="row">





                        <div class="input-field col m6 s6">
                             <label for="name" class="active"> Name </label>
                            <input id="name" type="text" class = 'validate' name = 'name'>

                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="input-field col m6 s6">
                             <label for="email" class="active"> Email </label>

                            <input id="email" type="text" class = 'validate' name = 'email'>
                            @error('email')
                             <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                    </div>

                    <div class="row">

                         <div class="input-field col m6 s6">
                             <label for="phone" class="active"> Phone </label>

                            <input id="phone" type="number" class = 'validate' name = 'phone'>
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
                                <option value ="{{ $vn  }}">{{ $vt  }} </option>
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
                                        Select Collection Center
                                    </label>
                                    <select
                                        name="zone_id"
                                    >
                                        @foreach( $zones as $vn => $vt)
                                            <option value ="{{ $vn  }}">{{ $vt  }} </option>
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
