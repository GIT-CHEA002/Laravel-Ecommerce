@props(['summaryInfo'])
<div class="grid grid-cols-4 auto-rows-auto gap-4 py-4 ">
  {{-- card --}}
  @if ($summaryInfo)
    @foreach ($summaryInfo as $info)
      @include('admin.dashboard.summary-card', ['info' => $info])
    @endforeach
  @endif

</div>