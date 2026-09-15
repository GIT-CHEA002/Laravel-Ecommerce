<div class="flex items-center justify-start gap-3 pb-8 overflow-x-auto flex-nowrap">
  <x-shared.pilltab href="{{ route('category.index') }}" :active="is_null($categoryId)">
    All Departments
  </x-shared.pilltab>
  @foreach ($categories as $category)
    <x-shared.pilltab href="{{ route('category.index', ['category' => $category->categories_id]) }}" :active="(string) $categoryId === (string) $category->categories_id" class="shrink-0">{{$category->name}}</x-shared.pilltab>
  @endforeach
</div>