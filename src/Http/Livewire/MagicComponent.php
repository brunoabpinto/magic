<?php

namespace Brunoabpinto\Magic\Http\Livewire;

use Brunoabpinto\Magic\Models\Magic;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Prop;
use Livewire\Component;

class MagicComponent extends Component
{
    #[Prop]
    public string $originalValue = '';

    public string $value = '';

    #[Computed]
    public function key(): string
    {
        return md5($this->originalValue);
    }

    public function mount(): void
    {
        $storedValue = Cache::rememberForever("magic.{$this->key}", function () {
            $v = Magic::where('key', $this->key)->first();

            return $v ? $v->value : $this->originalValue;
        });

        $this->value = $storedValue;
    }

    public function _update(string $value): void
    {
        $this->value = $value;
        Magic::updateOrCreate(['key' => $this->key], ['value' => $value]);
        Cache::forever("magic.{$this->key}", $value);
    }

    public function resetrr(): void
    {
        dd('dsads');
        $this->value = $this->originalValue;
        Cache::forget("magic.{$this->key}");
        Magic::where('key', $this->key)->delete();
    }

    public function render()
    {
        return view('magic::magic');
    }
}
