@props(['headers' => []])
<div class="table-responsive text-nowrap">
    <table class="table table-hover table-borderless">
        <thead class="table-light">
            <tr>
                @foreach($headers as $header)
                    <th class="text-uppercase text-secondary fw-bold" style="font-size: 0.85rem; letter-spacing: 0.5px;">{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            {{ $slot }}
        </tbody>
    </table>
</div>
