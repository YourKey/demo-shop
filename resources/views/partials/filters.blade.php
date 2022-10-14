<div class="card-title">Фильтры</div>
    @foreach($filters as $filter)
        {{ $filter->render() }}
    @endforeach
<div class="mt-3 mb-6"><button type="submit" class="btn btn-active">Применить</button></div>
<a class="btn btn-sm btn-ghost" href="/">сбросить все</a>
