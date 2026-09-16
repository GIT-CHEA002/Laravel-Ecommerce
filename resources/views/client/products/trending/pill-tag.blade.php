<div class=" py-4 flex items-center gap-4 justify-start overflow-x-auto flex-nowrap">
  <x-shared.pilltab :active="true">All Departments</x-shared.pilltab>
  @foreach ($categories as $category)
    <x-shared.pilltab :active="false">{{ $category->name }}</x-shared.pilltab>
  @endforeach
</div>