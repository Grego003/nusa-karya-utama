@extends('layouts.main')

@section('content')
    @include('layouts.partials.page-header', ['page' => 'Catalog'])
    <div class="categories container-fluid justify-content-center">
        <div>
            <div class="mt-5 d-flex flex-column justify-content-center">
                <div class="nav-categories d-flex justify-content-between align-items-center border">
                    <div class="d-flex justfiy-content-evenly align-items-center">
                        <h1 class="text-end mt-2 me-3">Kategori</h1>
                    </div>
                    <hr />
                    <ul class="d-flex justify-content-center">
                        @foreach ($categories as $category)
                            <li class="text-center category-list list-unstyled me-3 mt-4">
                                <a href={{ url('products') . '/' . $category->id }}>
                                    <p>{{ $category->category_name }}</p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <h2 class="text-center my-2 mx-auto mb-5 mt-5">
                    @if (!$categoryID && $subCategoryID)
                        {{ $subCategories->find($subCategoryID)->sub_category }}
                    @else
                        {{ $categories->find($categoryID)->category_name }}
                    @endif
                </h2>
                @if ($categoryID == 1 || $categoryID == 4 || !$subCategoryID == '')
                    <div class="d-flex justify-content-center">
                        <li class="text-center categories list-unstyled">
                            <h4>Produk / Sub-Kategori</h4>
                            <hr>
                            <ul class="d-flex flex-wrap justify-content-center">
                                @if (!$categoryID == '')
                                    @foreach ($subCategories->where('category_id', $categoryID) as $subCategory)
                                        <li class="text-center sub-category-list list-unstyled me-4">
                                            <a href={{ url('products/sub') . '/' . $subCategory->id }}>
                                                <p>{{ $subCategory->sub_category }}</p>
                                            </a>
                                        </li>
                                    @endforeach
                                @else
                                    @foreach ($subCategories->where('category_id', $subCategoryID) as $subCategory)
                                        <li class="text-center sub-category-list list-unstyled me-4">
                                            <a href={{ url('products/sub') . '/' . $subCategory->id }}>
                                                <p>{{ $subCategory->sub_category }}</p>
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </li>
                    </div>
                @endif
            </div>
        </div>

        <div class="catalog">
            <div class="container">
                @if ($products->isEmpty())
                    <h2 class="text-center">Barang Sedang Kosong!</h2>
                @endif
                <div class="row catalog-page">
                    @foreach ($products as $product)
                        @if ($categoryID == 2)
                            @include('cards.kacaCard')
                        @else
                            @include('cards.mainCard')
                        @endif
                    @endforeach
                </div>

                <div class="d-flex">
                    {{ $products->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
        <!-- Blog End -->
    @endsection
