{{-- @php
        $topSales = $this->getStat();
    @endphp
    <h3>TOP SALES TODAY:</h3>
    @foreach ($topSales as $item)
        <x-filament-widgets::widget class="mt-3 ">
            <x-filament::section>
                {{ $item }}
            </x-filament::section>
        </x-filament-widgets::widget>
    @endforeach --}}

<x-filament-widgets::widget>
    @php
        $topSales = $this->getStat();
    @endphp
    <x-filament::section>
        <h3>TOP SALES TODAY</h3>
        @foreach ($topSales as $item)
            <x-filament-widgets::widget class="mt-3">
                <x-filament::section>
                    {{ $item }}
                </x-filament::section>
            </x-filament-widgets::widget>
        @endforeach
    </x-filament::section>
</x-filament-widgets::widget>
