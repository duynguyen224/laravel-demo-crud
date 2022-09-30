<x-layout>
    <!-- Start block -->
    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 pt-20 mx-auto lg:gap-8 xl:gap-0 lg:grid-cols-3 lg:pt-28">
            <form method="GET" action="/" class="flex items-center gap-1">
                <input type="text" name="q"
                    class="w-52 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search ..." value="{{ $keyword }}">
                <select name="category" id="category"
                    class="w-48 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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
        <div class="grid max-w-screen-xl px-4 pt-10 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-4 lg:grid-cols-4 lg:pt-20">
            @if (count($products) > 0)
                @foreach ($products as $product)
                    <x-card-item :product="$product" />
                @endforeach
            @else
                <div>No product available</div>
            @endif
        </div>
        <div class="grid max-w-screen-xl px-4 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-4 lg:grid-cols-2 lg:pt-20">
            {{ $products->links() }}
        </div>
    </section>
    <!-- End block -->
</x-layout>
