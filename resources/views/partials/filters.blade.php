<form method="GET" class="mb-3">
    <div class="row g-2">
        <div class="col-auto">
            <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari nama...">
        </div>
        <div class="col-auto">
            <button class="btn btn-primary">Cari</button>
            <a href="{{ url()->current() }}" class="btn btn-secondary">Reset</a>
        </div>
    </div>
</form>
