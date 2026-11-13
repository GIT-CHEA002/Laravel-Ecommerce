{{-- table and title --}}
<div class="border rounded-md shadow-md dark:bg-slate-800 h-fit pb-4">
  {{-- title section --}}
  <div class="flex items-center justify-between default-padding">
    <span class="text-xl font-bold">Recent Orders</span>
    <a href="{{ route('admin.orders.index') }}"
      class="text-sm font-bold tracking-wide text-indigo-700 capitalize dark:text-indigo-500">
      view all
    </a>
  </div>
  {{-- table section --}}
  <table class="w-full text-sm text-left dark:text-white">
    <thead class="text-xs tracking-wide uppercase bg-indigo-100 dark:bg-slate-700 border-y border-slate-400">
      <tr class="font-light">
        @foreach (['Order Number', 'Customer', 'Amount', 'Payment', 'Status', 'Action'] as $heading)
          <th class="px-3 py-2">{{$heading}}</th>
        @endforeach
      </tr>
    </thead>
    {{-- display the real data of some order --}}
    <tbody class="divide-y">
      @foreach ($recentOrder as $order)
        <tr>
          <td class="px-3 py-2">{{ $order->order_number }}</td>
          <td class="px-3 py-2">{{ $order->user->first_name }}</td>
          <td class="px-3 py-2">$ {{ number_format($order->total_amount, 2) }}</td>
          <td class="px-3 py-2 text-xs tracking-wide capitalize text-indigo-700 dark:text-indigo-500">
            {{ $order->payment_status }}
          </td>
          <td class="px-3 py-2">
            @php
              $badge = match ($order->status) {
                'pending' => ['bg-red-100', 'text-red-600'],
                'processing' => ['bg-blue-100', 'text-blue-600'],
                'shipping' => ['bg-amber-100', 'text-amber-600'],
                'delivered' => ['bg-green-100', 'text-green-600'],
                'cancelled' => ['bg-gray-100', 'text-gray-600'],
                'refuned' => ['bg-purple-100', 'text-purple-600'],
                default => ['bg-gray-100', 'text-gray-500'],
              };
            @endphp
            <x-shared.badge-tag :bgColor="$badge[0]" :textColor="$badge[1]">
              {{ ucfirst($order->status ?? 'unknown') }}
            </x-shared.badge-tag>
          </td>
          <td class="px-3 py-2 flex justify-center">
            <a href="{{ route('admin.orders.show', $order) }}"
              class=" text-xs font-semibold tracking-wider text-indigo-700 dark:text-indigo-500 hover:underline underline-offset-2">
              <x-heroicon-o-eye class="w-4 h-5 text-indigo-700 dark:text-indigo-500" />
            </a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>