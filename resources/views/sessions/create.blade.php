<x-layout>
    <section class="px-6 py-8">
        <x-panel>
        <main class="max-w-lg mx-auto mt-10">

            <h1 class="text-center font-bold text-xl">Log In</h1>

            
                <form method="POST" action="/login" class="mt-10">
                
                @csrf
                
                <x-form.input name="email" type="email" autocomplete="username" />
                
                <x-form.input name="password" type="password" autocomplete="new-password"/>    
                
                <x-form.button>Log In</x-form.button>


            </form>
        </main>
        </x-panel>
    </section>
</x-layout>