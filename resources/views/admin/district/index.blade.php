<x-admin.layout>
    <div class="col s12 m12 l12">
        <div id="responsive-table" class="card card card-default scrollspy">
            <div class="card-content">
                <h4 class="card-title camel-case">
                    District
                </h4>
                <div class="row">
                    <div class="col s12">
                          <a
                           class="modal-trigger
                       waves-effect pull-right waves-light btn gradient-45deg-light-blue-cyan z-depth-3 mb-2"
                           href="{{route('admin.district.create')}}"
                           >

                           Add District
                       </a>
                        <table class="responsive-table bordered striped Highlight">
                            <thead class="text-warning">
                            @component('partials.th',
                                        [
                                            'tableHeads' =>
                                                ['ID', 'Name','Code', 'Action']
                                        ])
                            @endcomponent

                            </thead>
                            <tbody>
                                  @each('admin.district.td-records', $records, 'record', 'partials.table.empty')
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>


@push('scripts')
        <script>
            async function fetchHindiRecord(id, name)
            {
                let response = await fetch(
                    "{{ route('admin.district.bilingual') }}" + '/' + id+'/'+name,
                    )
                .then( response =>  response.text())
                .then((html) => {
                    $("#modal-content").html(html);
                })
// console.log(response.html())
// $("#modal-content").html(response.text());

            }
        </script>
    @endpush
</x-admin.layout>


