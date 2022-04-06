<x-admin.layout>
    <div class="col s12 m12 l12">
        <div id="responsive-table" class="card card card-default scrollspy">
            <div class="card-content">
                <h4 class="card-title camel-case">
                    Add Collection Center
                </h4>
                <div class="row">
                    <div class="col s12">
                          <a
                           class="modal-trigger
                       waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-3 mb-2"
                           href="{{route('admin.zone.create')}}"
                           >

                           Add Collection Center
                       </a>
                        <table class="responsive-table bordered striped Highlight">
                            <thead class="text-warning">
                            @component('admin.zone.th',
                                        [
                                            'tableHeads' =>
                                                ['ID', 'Name','Zip Code','Latitute', 'Longitute' ,'District','Landmark', 'Action']
                                        ])
                            @endcomponent

                            </thead>
                            <tbody id ="table_record">
                                  @each('admin.zone.td-records', $records, 'record', 'partials.table.empty')
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>


    <script type="text/javascript">
        
        window.addEventListener("load", function(){
            var elem = document.getElementsByClassName('district_column');

       var district = Array.prototype.slice
                             .call(document.querySelectorAll('td.district_column'))
                             .map((a)=>  a.innerHTML.trim()  );
        const uniqueDistrict = [ ...new Set(district) ];
///put dynamic select option 
 let opt ="<option value = 'all'> Show All </option>";
 
  for (var item of uniqueDistrict) {
    opt += `<option value =  ${item}>  ${item} </option>`;
  }
  document.getElementById("district_filter").innerHTML = opt;
  document.getElementById("district_filter").addEventListener("change", addActivityItem, false);

});

        const addActivityItem = (e) => {
            let selectedValue = e.target.value;
            console.log(selectedValue, 'selectedValue')
                $(".record_tr").show();
                if (selectedValue == 'all') return ;
                Array.prototype.slice.call(document.getElementById('table_record').getElementsByTagName('tr')).map(function(node, key) {

                    if (node.getAttribute('data-district') != selectedValue) {
                       $(`#table_record tr:nth-child(${++key})`).hide();
                    }
                });
        }
    </script>

</x-admin.layout>
