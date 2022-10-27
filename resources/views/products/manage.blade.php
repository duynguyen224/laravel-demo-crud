<x-layout>
    <!-- Start block -->
    <section class="bg-white dark:bg-gray-900">
        <div class="max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:pt-28">
            <h3 class="text-xl font-bold">Your products</h3>
            <div class="mt-6 mb-6">
                <a href="/products/import"
                    class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 sm:mr-2 lg:mr-0 dark:bg-purple-600 dark:hover:bg-purple-700 focus:outline-none dark:focus:ring-purple-800">Import</a>
                <a href="/products/export"
                    class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 sm:mr-2 lg:mr-0 dark:bg-purple-600 dark:hover:bg-purple-700 focus:outline-none dark:focus:ring-purple-800">Export
                    excel</a>
            </div>
            <div class="grid max-w-screen-xl mb-2 mx-auto lg:gap-8 xl:gap-0 lg:grid-cols-3">
                <form method="GET" action="/products/manage" class="flex items-center gap-1">
                    <input type="text" name="q"
                        class="w-52 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search ..." value="{{ $keyword }}">
                    <select name="category" id="category"
                        class="w-48 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        {{-- select2 --}}
                        <option selected disabled>Choose a category</option>
                        <option value="0">All categories</option>
                        @foreach ($categories as $cat)
                            @if ($cat->id == $selectedCategory)
                                {
                                <option value="{{ $cat->id }}" selected>{{ $cat->name }}</option>
                                }
                            @else
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <button type="submit"
                        class="p-2.5 text-white text-sm font-extrabold bg-purple-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Search
                    </button>
                </form>
            </div>
            <div class="relative shadow-md sm:rounded-lg">
                <div class="flex flex-row">
                    <div class="flex-initial w-full">
                        <form action="/products/storeInManage" method="POST">
                            @csrf
                            <table class="text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="py-3 px-6">
                                            <div class="flex flex-row items-center">
                                                <div class="pr-2">Id</div>
                                                <div class="flex flex-column">
                                                    <a
                                                        href="{{ request()->fullUrlWithQuery(['sortDir' => 'asc', 'sortBy' => 'id']) }}"><i
                                                            class="sort-dir-up-id text-gray-300 fa-solid fa-sort-up"></i></a>
                                                    <a
                                                        href="{{ request()->fullUrlWithQuery(['sortDir' => 'desc', 'sortBy' => 'id']) }}"><i
                                                            class="sort-dir-down-id text-gray-300 fa-solid fa-sort-down"></i></a>
                                                </div>
                                            </div>
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            <div class="flex flex-row items-center">
                                                <div class="pr-2">Product name</div>
                                                <div class="flex flex-column">
                                                    <a
                                                        href="{{ request()->fullUrlWithQuery(['sortDir' => 'asc', 'sortBy' => 'name']) }}"><i
                                                            class="sort-dir-up-name text-gray-300 fa-solid fa-sort-up"></i></a>
                                                    <a
                                                        href="{{ request()->fullUrlWithQuery(['sortDir' => 'desc', 'sortBy' => 'name']) }}"><i
                                                            class="sort-dir-down-name text-gray-300 fa-solid fa-sort-down"></i></a>
                                                </div>
                                            </div>
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            <div class="flex flex-row items-center">
                                                <div class="pr-2">Price</div>
                                                <div class="flex flex-column">
                                                    <a
                                                        href="{{ request()->fullUrlWithQuery(['sortDir' => 'asc', 'sortBy' => 'price']) }}"><i
                                                            class="sort-dir-up-price text-gray-300 fa-solid fa-sort-up"></i></a>
                                                    <a
                                                        href="{{ request()->fullUrlWithQuery(['sortDir' => 'desc', 'sortBy' => 'price']) }}"><i
                                                            class="sort-dir-down-price text-gray-300 fa-solid fa-sort-down"></i></a>
                                                </div>
                                            </div>
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            <div class="flex flex-row items-center">
                                                <div class="pr-2">Category</div>
                                                <div class="flex flex-column">
                                                    <a
                                                        href="{{ request()->fullUrlWithQuery(['sortDir' => 'asc', 'sortBy' => 'category']) }}"><i
                                                            class="sort-dir-up-category text-gray-300 fa-solid fa-sort-up"></i></a>
                                                    <a
                                                        href="{{ request()->fullUrlWithQuery(['sortDir' => 'desc', 'sortBy' => 'category']) }}"><i
                                                            class="sort-dir-down-category text-gray-300 fa-solid fa-sort-down"></i></a>
                                                </div>
                                            </div>
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="sortable1" class="connectedSortable">
                                    @if (count($products) > 0)
                                        @foreach ($products as $product)
                                            <tr
                                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                <td class="py-4 px-6">
                                                    {{ $product->id }}
                                                </td>
                                                <th scope="row"
                                                    class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{ $product->name }}
                                                </th>
                                                <td class="py-4 px-6">
                                                    {{ $product->price }}
                                                </td>
                                                <td class="py-4 px-6">
                                                    {{ $product->category_name }}
                                                </td>
                                                <td class="flex flex-row py-4 px-3 text-right">
                                                    <a href="/products/{{ $product->id }}/edit"
                                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                                    <span class="ml-1 mr-1">|</span>
                                                    <a href="/products/{{ $product->id }}/destroy"
                                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <td class="px-2 py-2 text-red-500">No product available</td>
                                    @endif
                                    {{-- Row for insert product --}}
                                    {{-- style="display: none;" --}}
                                    <tr id="flex flex-row items-center rowInsertProduct"
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <input type="text" name="name" id="name"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Product name">
                                            @error('name')
                                                <div class="bg-red-500 p-1 text-white">{{ $message }}</div>
                                            @enderror
                                        </th>
                                        <td class="py-4 px-6">
                                            <input type="number" name="price" id="price" min="0"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Product price">
                                            @error('price')
                                                <div class="bg-red-500 p-1 text-white">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td class="py-4 px-3 text-right">
                                            <select name="category"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option selected disabled>Choose a category</option>
                                                @foreach ($categories as $cate)
                                                    <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category')
                                                <div class="bg-red-500 p-1 text-white">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td class="py-4 px-3">
                                            <textarea name="description" id="description" placeholder="Description" cols="30" rows="2"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                                            @error('description')
                                                <div class="bg-red-500 p-1 text-white">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td class="flex py-4 px-3">
                                            <button type="submit"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Save</button>
                                            <span class="ml-1 mr-1">|</span>
                                            <a href="#" id="btnCancel"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Cancel</a>
                                        </td>
                                    </tr>
                                    {{-- End of row insert --}}

                                    {{-- Row display button plus --}}
                                    <tr id="rowBtnPlus"
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <button type="button" id="btnPlus"
                                                class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-3 py-2 sm:mr-2 lg:mr-0 dark:bg-purple-600 dark:hover:bg-purple-700 focus:outline-none dark:focus:ring-purple-800">+
                                            </button>
                                        </th>
                                    </tr>
                                    {{-- End of row contain button plus --}}
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="ml-4">
                        <table class="text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        Id
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Product name
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Price
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="sortable2" class="connectedSortable">
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th></th>
                                    <th></th>
                                    <th scope="row"
                                        class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <button type="button" id="btnDeleteSortableList"
                                            class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-3 py-2 sm:mr-2 lg:mr-0">Delete
                                        </button>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="grid max-w-screen-xl px-4 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-4 lg:grid-cols-2 lg:pt-20">
                {{ $products->links() }}
            </div>
        </div>
    </section>
    <!-- End block -->

    {{-- Page script --}}
    @section('scripts')
        <script type="text/javascript" src="{{ URL::asset('js/product/manage.js') }}"></script>
    @show

</x-layout>
