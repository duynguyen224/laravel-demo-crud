<x-layout>
    <!-- Start block -->
    <section class="bg-purple-200 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Create selling product
                    </h1>
                    <form method="POST" action="" class="space-y-4 md:space-y-6">
                        @csrf
                        <div>
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product name</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Laptop DELL XPS">
                        </div>
                        <div>
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                                price</label>
                            <input type="text" name="name" id="price"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="$100.00">
                        </div>
                        <div>
                            <label for="image"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image
                            </label>
                            <input type="file" name="image" id="image"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div>
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description
                            </label>
                            <textarea name="description" id="description" cols="30" rows="10"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                        </div>
                        <button type="submit"
                            class="w-full text-white text-lg font-extrabold bg-purple-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Upload
                            product
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- End block -->
</x-layout>
