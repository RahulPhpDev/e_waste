<x-admin.layout>
    <div class="col s12 m12 l12">
        <div id="responsive-table" class="card card card-default scrollspy">
            <div class="card-content">
            <form mehtod = "get" > 
                <div class="row" style = "display:inline">
                    <div class="col s6" >
                        <label> Select Status</label>   
                       
                        <select name ="status">
                                <option value = ""> All </option>
                                <option @if ($_REQUEST['status'] == 'approved') selected @endif value = "approved"> Approved </option>
                            <option @if ($_REQUEST['status'] == 'un-approved') selected @endif value = "un-approved"> UnApproved </option>
                            <option @if ($_REQUEST['status'] == 'pending') selected @endif value = "pending"> Pending </option>
                        </select>
                    </div>

                    <div class="col s6" >
                    <button type ="submit" class="modal-trigger
                        waves-effect pull-right waves-light btn gradient-45deg-light-blue-cyan z-depth-3 mb-2"> Fliter </button>
                    </div>


                </div>
            </form>
                <div class="row">
                    <div class="col s12">
                   
                        <table class="responsive-table bordered striped Highlight">
                            <thead class="text-warning">
                            @component('partials.th',
                                        [
                                            'tableHeads' =>
                                                ['ID', 'User','Category', 'Phone', 'Status','Created At','Change Status','Comment']
                                        ])
                            @endcomponent

                            </thead>
                            <tbody>
                                  @each('admin.scrap.td-records', $records, 'record', 'partials.table.empty')
                            </tbody>
                        </table>

                        {{$records->links() }}

                    </div>
                </div>
            </div>

        </div>
    </div>

</x-admin.layout>
