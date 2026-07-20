{{-- resources/views/pemberi-kerja/dashboard/index.blade.php --}}
<h1>Dashboard Pemberi Kerja</h1>
<p>Halo, {{ auth()->user()->nama }}. Role: {{ auth()->user()->role }}</p>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>