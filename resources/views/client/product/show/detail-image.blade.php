<div class="flex flex-col">
  <div
    class="bg-indigo-50 dark:bg-slate-900 flex-1 flex items-center overflow-hidden shadow-sm border-indigo-700 dark:border-indigo-500 md:px-4 rounded-md border">
    <template x-for="image in images" :key="image.image_id">
      <img x-show="selectedImage == image.image_id" :src="image.image_url"
        class="w-full h-3/4 object-cover rounded-md hover:scale-[1.01] transition-transform duration-300 cursor-pointer">
    </template>
  </div>
  <div class="flex justify-start items-center gap-3 py-3">
    {{-- template work similar to for directive of the blade template engine --}}
    <template x-for="image in images" :key="image.image_id">
      <div @click="selectedImage = image.image_id" :class="selectedImage === image.image_id
              ? 'border-2 border-indigo-700 dark:border-indigo-500'
              : 'border-slate-800 hover:border-indigo-700 dark:hover:border-indigo-500'"
        class="bg-indigo-50 dark:bg-slate-900 h-[100px] w-[100px] overflow-hidden shadow-sm p-1 rounded-md border">
        <img :src="image.image_url"
          class="w-full h-full object-cover rounded-md hover:scale-[1.01] transition-transform duration-300 cursor-pointer">
      </div>
    </template>
  </div>
</div>