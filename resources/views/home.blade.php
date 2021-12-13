{{ auth()->user() }}

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button>Logout</button>
</form>
