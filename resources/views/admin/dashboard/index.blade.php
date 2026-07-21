{{-- resources/views/admin/dashboard/index.blade.php --}}
<h1>Dashboard Admin</h1>
<p>Halo, {{ auth()->user()->nama }}. Role: {{ auth()->user()->role }}</p>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>