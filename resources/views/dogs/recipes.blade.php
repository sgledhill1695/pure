<x-layout>
    @if ($errors->any())
        <ul class="flex flex-col items-center mb-[10px]">
            @foreach($errors->all() as $error)
                <li class="text-red-600">
                    {{$error}}
                </li>
            @endforeach
        </ul>
    @endif

    @if($recipes->isEmpty())
        <h1 class="flex justify-center text-3xl font-bold text-[#274C46] mb-[50px]">
            We couldn't match {{$dog['name']}} with any recipes.
        </h1>

        <a href="/">
            <button type="button" class="bg-[#F8AD1D] hover:bg-[#f8ab1dd2] px-[10px] flex justify-center font-bold text-[#274C46] py-[7px] rounded-lg m-auto">
                Return
            </button>
        </a>
    @else
        <h1 class="flex justify-center text-3xl font-bold text-[#274C46] mb-[50px]">
            We've matched {{$dog['name']}} with the following recipes.
        </h1>

        <form method="POST" action="/"  class="flex flex-col justify-center items-center gap-5">
            @csrf
            <input type="hidden" name="name" value="{{$dog['name']}}">
            <input type="hidden" name="breed" value="{{$dog['breed']}}">
            <input type="hidden" name="years" value="{{$dog['years']}}">
            <input type="hidden" name="months" value="{{$dog['months']}}">
            @foreach($dog['allergies'] as $allergy)
                <input type="hidden" name="allergies[]" value="{{$allergy}}">
            @endforeach

            <div>
                <label for="subscription" class="text-lg flex justify-center font-bold leading-6 text-[#274C46]">Subscription</label>
                <div class="mt-2">
                    <select required name="subscription_id" id="subscription" class="block w-[400px] rounded-md border-0 py-1.5 px-[10px] text-[#274C46] bg-[white] shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#274C46] sm:text-md font-bold sm:leading-6 outline-none">       
                            @foreach($recipes as $recipe)
                                <option value={{$recipe->id}}>{{$recipe->name}}</option>
                            @endforeach
                    </select>
                </div>
            </div>

            <button type="submit" class="bg-[#F2A900] hover:bg-[#f2a900c9] px-[10px] py-[6px] rounded-md max-w-[120px]">
                Subscribe
            <button>
        </form>
    @endif
</x-layout>