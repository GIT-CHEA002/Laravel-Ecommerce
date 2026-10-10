<div class="py-4 grid grid-cols-3 gap-4 mt-3">
  <div class="col-span-2 rounded-md border shadow-sm">
    {{-- title sections --}}
    <div class="default-padding  flex justify-between items-center">
      <span class="text-xl font-bold">Recent Orders</span>
      <a href=""
        class="capitalize text-sm text-indigo-700 dark:text-indigo-500 font-bold tracking-wide hover:underline underline-offset-2">
        view all
      </a>
    </div>
    {{-- table section --}}
    <table class="w-full text-sm text-left">
      <thead class="uppercase text-xs tracking-wide bg-indigo-100 border-y border-slate-400">
        <tr class="font-light">
          <th class="px-3 py-2">Order</th>
          <th class="px-3 py-2">Customer</th>
          <th class="px-3 py-2">Amount</th>
          <th class="px-3 py-2">Payment</th>
          <th class="px-3 py-2">Status</th>
          <th class="px-3 py-2">Action</th>
        </tr>
      </thead>
      <tbody class="divide-y">
        @foreach ([1, 2, 3, 4, 5] as $num)
          <tr>
            <td class="px-3 py-2">#1002</td>
            <td class="px-3 py-2">Dara Phan</td>
            <td class="px-3 py-2">$85.50</td>
            <td class="px-3 py-2">Pending</td>
            <td class="px-3 py-2">
              <x-shared.badge-tag bgColor="bg-amber-100" textColor="text-amber-700">Processing</x-shared.badge-tag>
            </td>
            <td class="px-3 py-2">
              <a href="#"
                class="text-indigo-700 dark:text-indigo-500 font-semibold tracking-widen hover:underline underline-offset-2">View</a>
            </td>
          </tr>
        @endforeach
        <tr>
          <td class="px-3 py-2">#1002</td>
          <td class="px-3 py-2">Sokchea Chhun</td>
          <td class="px-3 py-2">$859.50</td>
          <td class="px-3 py-2">Pending</td>
          <td class="px-3 py-2">
            <x-shared.badge-tag bgColor="bg-green-100" textColor="text-green-700">Shipping</x-shared.badge-tag>
          </td>
          <td class="px-3 py-2">
            <a href="#"
              class="text-indigo-700 dark:text-indigo-500 font-semibold  tracking-widen hover:underline underline-offset-2">View</a>
          </td>
        </tr>

      </tbody>
    </table>

  </div>
  {{-- Stock and user alerts --}}
  <div class="col-span-1">
    Alert
  </div>
</div>