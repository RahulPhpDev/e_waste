<x-admin.layout>
    <div class="col s12 m12 l12">
        <div id="responsive-table" class="card card card-default scrollspy">
            <div class="card-content">
                <h4 class="card-title camel-case">
                    Sub Category
                </h4>
                <div class="row">
                    <div class="col s12">
                          <a
                           class="modal-trigger
                       waves-effect waves-light btn gradient-45deg-light-blue-cyan z-depth-3 mb-2"
                           href="{{route('admin.sub-category.create')}}"
                           >

                           Add Sub Category
                       </a>
                        <table class="responsive-table bordered striped Highlight">
                            <thead class="text-warning">
                            @component('partials.th',
                                        [
                                            'tableHeads' =>
                                                ['ID','Category', 'Name','Description','Image', 'Action']
                                        ])
                            @endcomponent

                            </thead>
                            <tbody>
                                  @each('admin.sub-category.td-records', $records, 'record', 'partials.table.empty')
                            </tbody>
                        </table>

                         {{ $records->links() }}

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
                    "{{ route('admin.sub-category.bilingual') }}" + '/' + id+'/'+name,
                    )
                .then( response =>  response.text())
                .then((html) => {
                    $("#modal-content").html(html);
                })
            }
        </script>
    @endpush

</x-admin.layout>
