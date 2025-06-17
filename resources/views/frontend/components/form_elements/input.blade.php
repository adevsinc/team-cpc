<div class="flex flex-col gap-1 {{ $pclass ?? '' }}">
    @if (isset($label))
        <label class="kt-form-label font-normal text-mono  {{ $lclass ?? '' }}" for="{{ $id }}">
            {{ $label }}
        </label>
    @endif
    <input class="kt-input {{ $iclass ?? '' }}"
           id="{{ $id }}"
           placeholder="{{ $placeholder }}"
           name="{{ $id }}"
           type="{{ $type }}"
           value="{{ isset($value) ? $value : old($id) }}"
           {!! isset($iclass) ? $iclass : '' !!} />
</div>
