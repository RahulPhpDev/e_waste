<x-admin.layout>
    <div class="col s12 m12 l12">
        <div id="responsive-table" class="card card card-default scrollspy">
            <div class="card-content">
                <h4 class="card-title camel-case">
                    Products -  Attribute
                </h4>
                <div class="row">
                    <div class="col s12">
                        <table class="responsive-table bordered striped Highlight">
                            <thead class="text-warning">
                            @component('partials.th',
                                        [
                                            'tableHeads' =>
                                                ['ID', 'Name', 'Brand', 'Buying Price' ,'Selling Price','Quantity','Action']
                                        ])
                            @endcomponent

                            </thead>
                            <tbody>


                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>

</x-admin.layout>
