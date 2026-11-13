<div class="grid grid-cols-2 gap-6 py-4 mt-6  border-t auto-rows-auto ">
  @include('admin.dashboard.low-stock-product', ['lowStockProduct' => $lowStockProduct])
  @include('admin.dashboard.new-register', ['newRegister' => $newRegister])
</div>