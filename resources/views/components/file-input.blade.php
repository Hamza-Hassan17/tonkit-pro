@props(['disabled' => false])

<input type="file" @disabled($disabled) {{ $attributes->merge(['class' => 'block w-full text-sm text-gray-600 file:mr-3 file:py-1.5 file:px-3 file:rounded file:border-0 file:text-xs file:font-semibold file:uppercase file:tracking-wide file:bg-brand-orange file:text-brand-dark hover:file:bg-brand-orange-dark']) }}>
