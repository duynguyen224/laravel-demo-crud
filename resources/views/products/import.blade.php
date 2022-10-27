<x-layout>
    <!-- Start block -->
    <section class="bg-purple-200 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Import products
                    </h1>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <li style="color: red;">{{ $error }}</li>
                        @endforeach
                        {{-- <h4>{{ $errors->first() }}</h4> --}}
                    @endif
                    <form method="POST" action="/products/import" class="space-y-4 md:space-y-6"
                        enctype="multipart/form-data">
                        @csrf
                        {{-- <input type="button" id="get_file" value="Grab file"> --}}
                        {{-- <input type="file" id="my_file"> --}}
                        <div>
                            <label for="product_xlsx_file"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose file
                            </label>
                            <input type="file" name="product_xlsx_file"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <button type="submit"
                            class="w-full text-white text-lg font-extrabold bg-purple-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Import
                            product
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- End block -->
</x-layout>
