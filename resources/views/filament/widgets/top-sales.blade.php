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
    @vite('resources/css/app.css')
    @php
        $topSales = $this->getStat();
    @endphp
    <x-filament::section>
        <h1 class="text-2xl font-semibold font-serif">TOP SALES TODAY</h1>
        <div class="md:grid grid-cols-4 xl:grid-cols-6  gap-3">
            @foreach ($topSales as $index => $item)
                <x-filament-widgets::widget class="mt-3">
                    <x-filament::section>
                        <div class="">
                            {{ $index + 1 }}. {{ $item }}
                        </div>
                    </x-filament::section>
                </x-filament-widgets::widget>
            @endforeach
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
