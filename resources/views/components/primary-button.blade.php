<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-yellowAccent rounded-md font-bold text-md text-primary hover:text-bone focus:text-bone tracking-widest hover:bg-redMain focus:bg-redMain active:bg-redMain focus:outline-none transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
