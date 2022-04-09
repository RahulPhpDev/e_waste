<x-admin.layout>
@push('css')



    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush
    <div class="col s12 m12 l12">
        <div id="responsive-table" class="card card card-default scrollspy">
            <div class="card-content">
            <form mehtod = "get" > 
                <div class="row" style = "display:inline">
                      <div class="col s4" >
                        <?php
{{-- dd(request()->daterange); --}}
                    ?>
                          <label> Select Range</label>  
                        <input type="text" name="daterange" value="{{request()->daterange}}" />
                    </div>

                    <div class="col s4" >
                        <label> Select Status</label>   
                       
                        <select name ="status">
                                <option value = ""> All </option>
                                <option @if ($status == 'approved') selected @endif value = "approved"> Approved </option>
                            <option @if ($status == 'un-approved') selected @endif value = "un-approved"> Discard </option>
                            <option @if ($status == 'pending') selected @endif value = "pending"> Pending </option>
                        </select>
                       

                    </div>

                    <div class="col s4" >
                          <label> Select Zone</label> 
                           <select name ="zone">
                                <option value = ""> All </option>
                                @foreach($zones as $key => $value)
                                         <option @if ($selectzone == $key) selected @endif value = {{$key}}> {{$value}} </option>
                                @endforeach
                           </select>     


                    </div>


                </div>
                 <button type ="submit" class="modal-trigger
                        waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-3 mb-2"> Fliter </button>
            </form>
             {{-- action={{route('admin.district.store')}} --}}
<form method="post" action = "{{route('admin.report.scrap', $searchParams)}}" > 
   @csrf

            <button type ="submit"  class="modal-trigger
                        waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-3 mb-2"> Download Excel </button>
</form>
                <div class="row">
                    <div class="col s12">
                   
                        <table class="responsive-table bordered striped Highlight">
                            <thead class="text-warning">
                            @component('partials.th',
                                        [
                                            'tableHeads' =>
                                                ['ID', 'Scrap Num','User','Category', 'Phone', 'Status','Created At']
                                        ])
                            @endcomponent

                            </thead>
                            <tbody>
                                  @each('admin.report.td', $records, 'record')
                            </tbody>
                        </table>

                        {{$records->links() }}

                    </div>
                </div>
            </div>

        </div>
    </div>
@push('scripts')
<script type="text/javascript">
    $('input[name="daterange"]').daterangepicker( {
         minYear: 2022,
         locale: {
      format: 'DD-MM-YYYY'
    }
}, function(start, end, label) {
  console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
});

</script>
@endpush
</x-admin.layout>
