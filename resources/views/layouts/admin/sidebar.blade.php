

<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
    <div class="brand-sidebar">
        <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="/">
                <span class="logo-text hide-on-med-and-down">{{ config('app.name', 'Laravel') }}</span></a><a class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a></h1>
    </div>


    <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">

                <x-admin.navigation
                    names='User'
                    link='admin.user.index'
                    icon="accessibility"
                />

                  <x-admin.navigation
                    names='District'
                    link='admin.district.index'
                    icon="add_location"
                />
                <x-admin.navigation
                    names='Category'
                    link='admin.category.index'
                    icon="category"
                />
                <x-admin.navigation
                    names='Sub Category'
                    link='admin.sub-category.index'
                    icon="category"
                />
                  <x-admin.navigation
                    names='Type'
                    link='admin.type.index'
                    icon="line_style"
                />

                  <x-admin.navigation
                    names='Zone'
                    link='admin.zone.index'
                    icon="store"
                />
                 <x-admin.navigation
                    names='Product'
                    link='admin.product.index'
                    icon="add_shopping_cart"
                />
                 <x-admin.navigation
                    names='WhyWe'
                    link='admin.why-we.index'
                    icon="add_shopping_cart"
                />

                 <x-admin.navigation
                    names='Article'
                    link='admin.article.index'
                    icon="add_shopping_cart"
                />
                 <x-admin.navigation
                    names='Video'
                    link='admin.video.index'
                    icon="video"
                />

             

    </ul>
</aside>
