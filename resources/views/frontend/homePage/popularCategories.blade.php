{{-- s trending categories --}}
<div class="container popular-categories-section p-4">
    <div class="row">
        <div class="col-12">
            <h3 class="text-dark text-center">Popular Categories</h3>
            <hr class="mx-auto">
        </div>
        <?php
        $categories = App\Models\Category::where('language_id', $langg->id)
            ->where('status', 1)
            ->get();
        $categoriesChunks = $categories->chunk(4);
        $categoriesChunks->toArray();
        // $categories->unsetRelation('category');
        // $categories = $category->split(2);
        ?>
        <div class="col-lg-3 col-md-3 col-sm-6 text-center">
            <ul class="list-group border-0">
                @foreach ($categoriesChunks[0] as $category)
                    <li class="list-group-item"><a
                            href="{{ route('front.service_category', $category->slug) }}{{ !empty(request()->input('search')) ? '?search=' . request()->input('search') : '' }}"
                            class="text-dark">{{ $category->name }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 text-center">
            <ul class="list-group border-0">
                @foreach ($categoriesChunks[1] as $category)
                    <li class="list-group-item"><a
                            href="{{ route('front.service_category', $category->slug) }}{{ !empty(request()->input('search')) ? '?search=' . request()->input('search') : '' }}"
                            class="text-dark">{{ $category->name }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 text-center">
            <ul class="list-group border-0">
                @foreach ($categoriesChunks[2] as $category)
                    <li class="list-group-item"><a
                            href="{{ route('front.service_category', $category->slug) }}{{ !empty(request()->input('search')) ? '?search=' . request()->input('search') : '' }}"
                            class="text-dark">{{ $category->name }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 text-center">
            <ul class="list-group border-0">
                @foreach ($categoriesChunks[3] as $category)
                    <li class="list-group-item"><a
                            href="{{ route('front.service_category', $category->slug) }}{{ !empty(request()->input('search')) ? '?search=' . request()->input('search') : '' }}"
                            class="text-dark">{{ $category->name }}</a></li>
                @endforeach
            </ul>
        </div>


    </div>
</div>
{{-- e trending categories --}}
