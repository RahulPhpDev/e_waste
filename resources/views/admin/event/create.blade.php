<x-admin.layout>
    <div class="col s12 m12 l12">
        <div id="responsive-table" class="card card card-default scrollspy">
            <div class="card-content">
                <h4 class="card-title camel-case">  Add event </h4>
                <div class="row">
                    <div class="col s12">


<div>
    <div  role="document">
        <div >

            <div >

                <form method="post" enctype="multipart/form-data" action={{route('admin.event.store')}}>
                    @csrf
                    <div class="row">
                        <div class="input-field col m6 s6">
                             <label for="icon_prefix2" class="active"> Title </label>
                            <input id="icon_prefix2" type="text" class = 'validate' name = 'title'>

                            @error('title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class = "row">

                        <div class="input-field col m12 s12">

                            Description
                              <textarea id = "description" name = "description" id="message5" class="materialize-textarea"></textarea>

                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class = "row">
                        <div class="input-field col m12 s12">
                        <label for="icon_prefix2" class="active"> Schedule </label>
                            <input type="text" class="datepicker" name ="schedule_at">
                            @error('datepicker')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                  

                         <div class = "row">
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
    @push('scripts')
    <script>
    $('.datepicker').pickadate({
        format: 'yyyy-mm-dd',
        selectMonths: true, // Enable Month Selection
        selectYears: 1 // Creates a dropdown of 10 years to control year
    });
        </script>
    @endpush
</x-admin.layout>
