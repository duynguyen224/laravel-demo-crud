<x-layout>
    <!-- Start block -->
    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-4 lg:pt-28">
            @foreach ($products as $product)
                <x-card-item :product="$product" />
            @endforeach
        </div>
        <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-3 lg:pt-28">
            {{ $products->links() }}
        </div>
    </section>
    <!-- End block -->
</x-layout>