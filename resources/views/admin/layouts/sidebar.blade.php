<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">ESHOP</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">ES</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown active">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>

            </li>
            <li class="menu-header">Starter</li>

            <li class="dropdown {{ setActive(['admin.category.*', 'admin.subcategory.*', 'admin.childcategory.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Manage Categories</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.category.*']) }}"><a class="nav-link"
                            href="{{ route('admin.category.index') }}">Category</a></li>
                    <li class="{{ setActive(['admin.subcategory.*']) }}"><a class="nav-link"
                            href="{{ route('admin.subcategory.index') }}">Sub Category</a></li>
                    <li class="{{ setActive(['admin.childcategory.*']) }}"><a class="nav-link"
                            href="{{ route('admin.childcategory.index') }}">Child Category</a></li>

                </ul>
            </li>

            <li
                class="dropdown {{ setActive(['admin.brand.*','admin.product.*','admin.product-image-gallery.*','admin.product-variant.*','admin.products-variant-item.*','admin.seller-products','admin.seller-pending-products']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-cart-plus"></i>
                    <span>Manage Products</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.brand.*']) }}">
                        <a class="nav-link" href="{{ route('admin.brand.index') }}">All Brands</a>
                    </li>
                    <li class="{{ setActive(['admin.product.*']) }}">
                        <a class="nav-link" href="{{ route('admin.product.index') }}">All Products</a>
                    </li>
                    <li class="{{ setActive(['admin.seller-products',]) }}">
                        <a class="nav-link" href="{{ route('admin.seller-products') }}">Seller Products</a>
                    </li>
                    <li class="{{ setActive(['admin.seller-pending-products',]) }}">
                        <a class="nav-link" href="{{ route('admin.seller-pending-products') }}">Seller Pending
                            Products</a>
                    </li>

                </ul>
            </li>

            <li class="dropdown {{ setActive(['admin.vendor-profile.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-store"></i>
                    <span>Ecommerce</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.vendor-profile.*']) }}">
                        <a class="nav-link" href="{{ route('admin.vendor-profile.index') }}">Vendor Profile</a>
                    </li>

                </ul>
            </li>


            <li class="dropdown {{ setActive(['admin.slider.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-globe"></i>
                    <span>Manage Website</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.slider.*']) }}">
                        <a class="nav-link" href="{{ route('admin.slider.index') }}">Home Slider</a>
                    </li>

                </ul>
            </li>



            {{--
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Layout</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
                    <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
                    <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
                </ul>
            </li>
            --}}


            <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank Page</span></a></li>

        </ul>

    </aside>
</div>