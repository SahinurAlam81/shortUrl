<h1>
   <a href="{{url('dashboard')}}"> Dashboard</a></br> 
</h1>
<x-guest-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 flex justify-center bg-white border-b border-gray-200">
                
                <section>
                    <h1>Short your link</h1>
                    @if(session('success_message'))
                        <a href='{{session("success_message")}}'> Link - {{session("success_message")}} </a>
                    @endif

                    <form method="POST" action="{{ route('short.url') }}">
                        @csrf
                        <input type="text" name="original_url">
                        @error("original_url")
                            <span> {{ $message }}</span>
                        @enderror
                        <button type="submit"> Submit </button>
                    </form>
                </section>
            </div>
        </div>
    </div>
</x-guest-layout>