<div class="card shadow-sm w-100 mb-3">
    <div class="card-header">
     <mt-icon icon="local_fire_department" styleName="me-1"></mt-icon> Popular Items
    </div>
    <div class="card-body">
        <div class=" table-responsive border">
            <table class="table table-striped table-hover table-bordered w-100">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Total Ordered</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($popular_items as $item)
                        <tr>
                            <td>
                                <img src="{{ $item->item->image_url }}" class="rounded-circle me-1" alt="image" width="50"
                                    height="50">
                                <a href="{{ $item->item->url }}" class="link-primary">{{ $item->item->name }}</a>
                            </td>
                            <td>{{ $item->qty }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
