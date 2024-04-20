<x-layout>
    <h1 class="flex justify-center text-3xl font-bold text-[#274C46] mb-[50px]">
        Find the perfect recipe for your dog!
    </h1>

    @if ($errors->any())
        <ul class="flex flex-col items-center mb-[10px]">
            @foreach($errors->all() as $error)
                <li class="text-red-600">
                    {{$error}}
                </li>
            @endforeach
        </ul>
    @endif

    <form method="GET" action="/create/recipes" class="flex flex-col gap-10 sm:max-w-[300px] m-auto">
        <div>
            <label for="email" class="text-lg flex justify-center font-bold leading-6 text-[#274C46]">Name</label>
            <div class="mt-2">
                <input type="text" name="name" id="name" required class="block w-full rounded-md border-0 py-1.5 px-[10px] text-[#274C46] shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#274C46] sm:text-md font-bold sm:leading-6 outline-none" placeholder="Ralph">
            </div>
        </div>

        <div>
            <label for="age" class="text-lg flex justify-center font-bold leading-6 text-[#274C46]">Age</label>
            <div class="mt-2 flex gap-2 justify-center">
                <input type="text" name="years" id="years" required class="block w-[80px] rounded-md border-0 py-1.5 px-[10px] text-[#274C46] shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#274C46] sm:text-md font-bold sm:leading-6 outline-none" placeholder="Years">
                <input type="text" name="months" id="months" required class="block w-[80px] rounded-md border-0 py-1.5 px-[10px] text-[#274C46] shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#274C46] sm:text-md font-bold sm:leading-6 outline-none" placeholder="Months">
            </div>
        </div>

        <div>
            <label for="breed" class="text-lg flex justify-center font-bold leading-6 text-[#274C46]">Breed</label>
            <div class="mt-2">
                <select name="breed" id="breed" class="block w-full rounded-md border-0 py-1.5 px-[10px] text-[#274C46] bg-[white] shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#274C46] sm:text-md font-bold sm:leading-6 outline-none">
                    @foreach($breeds as $breed)
                        <option value={{$breed}}>{{ucfirst($breed)}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <label class="text-lg flex justify-center font-bold leading-6 text-[#274C46] mb-[-30px]">Is your dog allergic to any of the below ingredients?</label>
        <fieldset>
            <input type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-[#274C46] focus:ring-[#274C46]" id="allergenNone" name="allergies[]" value="none">
            <label for="allergenNone">None</label><br>
            @foreach($allergens as $allergen)
                <input type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-[#274C46] focus:ring-[#274C46]" id={{"allergen" . ucfirst($allergen)}} name="allergies[]" value={{$allergen}}>
                <label for={{"allergen".ucfirst($allergen)}}>{{ucfirst($allergen)}}</label><br>
            @endforeach
        </fieldset>

        <button type="submit" class="bg-[#F8AD1D]  px-[10px] font-bold text-[#274C46] py-[7px] rounded-lg m-auto">
            Find Your Perfect Recipes
        </button>
    </form>

    <script>
        function handleCheckboxClick() {
            let noneCheckbox = document.getElementById('allergenNone');
            if (noneCheckbox.checked) {
                let checkboxes = document.querySelectorAll('input[type="checkbox"]:not(#allergenNone)');
                checkboxes.forEach(function(checkbox) {
                    checkbox.checked = false;
                });
            }
        }

        let noneCheckbox = document.getElementById('allergenNone');
        noneCheckbox.addEventListener('click', handleCheckboxClick);

        let checkboxes = document.querySelectorAll('input[type="checkbox"]:not(#allergenNone)');
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('click', handleCheckboxClick);
        });
    </script>
</x-layout>