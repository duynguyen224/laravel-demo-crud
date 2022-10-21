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
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <form action="/products/storeInManage" method="POST">
                    @csrf
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    Product name
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Price
                                </th>
                                <th scope="col" class="py-3 px-6">
                                </th>
                                <th scope="col" class="py-3 px-6">
                                </th>
                                <th scope="col" class="py-3 px-6">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row"
                                        class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $product->name }}
                                    </th>
                                    <td class="py-4 px-6">
                                        {{ $product->price }}
                                    </td>
                                    <td class="py-4 px-3">
                                    </td>
                                    <td class="py-4 px-3">
                                    </td>
                                    <td class="py-4 px-3 text-right">
                                        <a href="/products/{{ $product->id }}/edit"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                        |
                                        <a href="/products/{{ $product->id }}/destroy"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</a>
                                    </td>
                                </tr>
                            @endforeach

                            {{-- Row for insert product --}}
                            <tr id="rowInsertProduct" style="display: none;"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <input type="text" name="name" id="name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Product name">
                                </th>
                                <td class="py-4 px-6">
                                    <input type="number" name="price" id="price" min="0"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Product price">
                                </td>
                                <td class="py-4 px-3 text-right">
                                    <select name="category"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option selected disabled>Choose a category</option>
                                        @foreach ($categories as $cate)
                                            <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="py-4 px-3">
                                    <textarea name="description" id="description" placeholder="Description" cols="30" rows="2"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                                </td>
                                <td class="py-4 px-3">
                                    <button type="submit"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Save</button>
                                    |
                                    <a href="#" id="btnCancel"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Cancel</a>
                                </td>
                            </tr>
                            {{-- End of row insert --}}

                            {{-- Row display button plus --}}
                            <tr id="rowBtnPlus" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
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
