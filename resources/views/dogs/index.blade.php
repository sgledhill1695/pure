<x-layout>
    <main>

        <div class="flex gap-5 mb-[30px]">
            <h1 class="flex text-3xl font-bold text-[#274C46] mb-[30px]">
                Dog Records
            </h1>

            <a href="/create">
                <button type="button" class="bg-[#F8AD1D] hover:bg-[#f8ab1dd2] px-[10px] font-bold text-[#274C46] py-[7px] rounded-lg m-auto">
                    Add New Dog
                </button>
            </a>


        </div>


        <ul class="flex flex-col gap-[20px] justify-center">
            @foreach ($dogs as $dog)
                <li class="border-b-[3px] last:border-b-[0px] border-b-[#c8c5bf] pb-[30px]">
                    <div class="flex gap-[20px]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-[50px] fill-[#4B2A1E]" viewBox="0 0 512 512"><path d="M226.5 92.9c14.3 42.9-.3 86.2-32.6 96.8s-70.1-15.6-84.4-58.5s.3-86.2 32.6-96.8s70.1 15.6 84.4 58.5zM100.4 198.6c18.9 32.4 14.3 70.1-10.2 84.1s-59.7-.9-78.5-33.3S-2.7 179.3 21.8 165.3s59.7 .9 78.5 33.3zM69.2 401.2C121.6 259.9 214.7 224 256 224s134.4 35.9 186.8 177.2c3.6 9.7 5.2 20.1 5.2 30.5v1.6c0 25.8-20.9 46.7-46.7 46.7c-11.5 0-22.9-1.4-34-4.2l-88-22c-15.3-3.8-31.3-3.8-46.6 0l-88 22c-11.1 2.8-22.5 4.2-34 4.2C84.9 480 64 459.1 64 433.3v-1.6c0-10.4 1.6-20.8 5.2-30.5zM421.8 282.7c-24.5-14-29.1-51.7-10.2-84.1s54-47.3 78.5-33.3s29.1 51.7 10.2 84.1s-54 47.3-78.5 33.3zM310.1 189.7c-32.3-10.6-46.9-53.9-32.6-96.8s52.1-69.1 84.4-58.5s46.9 53.9 32.6 96.8s-52.1 69.1-84.4 58.5z"/></svg>

                        <h2 class="text-3xl text-[#274C46] font-bold">
                            {{$dog->name}} - <span class="text-xl text-[#92601E]">{{ucfirst($dog->breed)}}</span>
                        </h2>
                    </div>

                    <ul class="mt-5">

                        <li>
                            <span class="text-[#274C46] font-bold text-xl">
                                Age:
                            </span>
                            <span class="text-[#92601E] text-lg font-bold">
                                {{$dog->formatted_age}}
                            </span>
                        </li>

                        <li>
                            <span class="text-[#274C46] font-bold text-xl">
                                Allergies:
                            </span>
                            <span class="text-[#92601E] text-lg font-bold">
                                @if(count($dog->allergies) < 1)
                                    None
                                @else
                                    @foreach ($dog->allergies as $allergy)
                                        {{ucfirst($allergy)}}@if (!$loop->last),@endif
                                    @endforeach
                                @endif
                            </span>
                        </li>

                        <li>
                            <span class="text-[#274C46] font-bold text-xl">
                                Suitable Recipes:
                            </span>
                            <span class="text-[#92601E] text-lg font-bold">
                                @if(count($dog->suitable_recipes) < 1)
                                    None
                                @else
                                    @foreach($dog->suitable_recipes as $sr)
                                        {{$sr->name}}@if(!$loop->last),@endif
                                    @endforeach
                                @endif
                            </span>
                        </li>

                        <li>
                            <span class="text-[#274C46] font-bold text-xl">
                                Current Subscription:
                            </span>
                            <span class="text-[#92601E] text-lg font-bold">
                                @if(isset($dog->subscription->recipe->name))
                                    {{$dog->subscription->recipe->name}}
                                @else
                                    None
                                @endif
                            </span>
                        </li>






                    </ul>
                <li>

            @endforeach
        <ul>

    </main>
</x-layout>