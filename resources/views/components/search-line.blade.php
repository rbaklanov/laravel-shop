<form method="GET">
    <div class="flex sm:justify-start gap-4">
        <div class="flex flex-col">
            <label for="select-city">Select a cities:</label>
            <select multiple name="city[]" id="select-city">
                @foreach($cities as $value)
                    <option @if(isset($city) && in_array($value, $city)) selected @endif>{{ $value }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex flex-col justify-between">
            <label for="select-category">Select a category:</label>
            <select name="category" id="select-category">
                <option value="none">Select a category</option>
                @foreach($categories as $value)
                    <option @if($category == $value) selected @endif>{{ $value }}</option>
                @endforeach
            </select>
            <x-button type="submit">Search</x-button>
        </div>
    </div>
</form>
<br>
