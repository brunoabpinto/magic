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
    public string $expression = '';

    #[Prop]
    public ?string $id = null;

    public string $value = '';

    #[Computed]
    public function key(): string
    {
        return $this->id ? md5($this->id) : md5($this->expression);
    }

    public function mount(): void
    {
        $storedValue = Cache::rememberForever("magic.{$this->key}", function () {
            $v = Magic::where('key', $this->key)->first();

            return $v ? $v->value : $this->expression;
        });

        $this->value = $storedValue;
    }

    public function _update(string $value): void
    {
        $this->value = $value;
        Magic::updateOrCreate(['key' => $this->key], ['value' => $value]);
        Cache::forever("magic.{$this->key}", $value);
        $this->skipRender();
    }

    public function _reset(): void
    {
        $this->value = $this->expression;
        Cache::forget("magic.{$this->key}");
        Magic::where('key', $this->key)->delete();
    }

    public function render()
    {
        return view('magic::magic');
    }
}
