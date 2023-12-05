@props([
    'theme' => '',
    'enabledFilters' => [],
    'column' => null,
    'inline' => null,
    'filter' => null,
])
<div>
    @php
        $field = strval(data_get($filter, 'field'));
        $title = strval(data_get($filter, 'title'));
        $operators = (array) data_get($filter, 'operators', []);
        $placeholder = strval(data_get($filter, 'placeholder'));
        $componentAttributes = (array) data_get($filter, 'attributes', []);
        
        $inputTextOptions = \PowerComponents\LivewirePowerGrid\Components\Filters\FilterInputText::getInputTextOperators();
        $inputTextOptions = count($operators) > 0 ? $operators : $inputTextOptions;
        $showSelectOptions = !(count($inputTextOptions) === 1 && in_array('contains', $inputTextOptions));
        
        $defaultPlaceholder = $column->placeholder ?: $column?->title;
        $overridePlaceholder = $placeholder ?: $defaultPlaceholder;
        
        unset($filter['placeholder']);
        
        $defaultAttributes = \PowerComponents\LivewirePowerGrid\Components\Filters\FilterInputText::getWireAttributes($field, $title);
        
        $selectClasses = \Illuminate\Support\Arr::toCssClasses(['power_grid', $theme->selectClass, data_get($column, 'headerClass')]);
        $inputClasses = \Illuminate\Support\Arr::toCssClasses(['power_grid', $theme->inputClass]);
        
        $params = array_merge(
            [
                'showSelectOptions' => $showSelectOptions,
                'placeholder' => ($placeholder = $componentAttributes['placeholder'] ?? $overridePlaceholder),
                ...data_get($filter, 'attributes'),
                ...$defaultAttributes,
            ],
            $filter,
        );
    @endphp

    @if ($params['component'])
        @unset($params['operators'], $params['attributes'])

        <x-dynamic-component
            :component="$params['component']"
            :attributes="new \Illuminate\View\ComponentAttributeBag($params)"
        />
    @else
        <div
            class="{{ $theme->baseClass }}"
            style="{{ $theme->baseStyle }}"
        >
           
            <div class="mt-1" >
                <input
                    wire:key="input-{{ $field }}"
                    data-id="{{ $field }}"
                    @if (isset($enabledFilters[$field]['disabled']) && boolval($enabledFilters[$field]['disabled']) === true) disabled
                        @else
                            {{ $defaultAttributes['inputAttributes'] }} @endif
                    type="text"
                    class="{{ $inputClasses }} input"
                    placeholder="{{ $placeholder }}"
                />
            </div>
        </div>
    @endif
</div>
<script>
  
</script>

