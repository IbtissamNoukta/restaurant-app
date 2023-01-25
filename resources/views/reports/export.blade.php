<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Menus</th>
            <th>Quantity</th>
            <th>Tables</th>
            <th>Servers</th>
            <th>Total</th>
            <th>Payment type</th>
            <th>Payment status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sales as $sale)
        <tr>
            <td>
                {{ $sale->id }}
            </td>
            <td>
                @foreach ($sale->menus()->where("sale_id",$sale->id)->get() as $menu)
                                    <h5>{{ $menu->title }}</h5>
                                    <h5>{{ $menu->price }} DH</h5>
                @endforeach
            </td>
            <td >
                @foreach ($sale->menus()->where("sale_id",$sale->id)->get() as $menu)
                    <h5>{{ $menu->pivot->quantity }}</h5>
                @endforeach
            </td>
            <td>
                @foreach ($sale->tables()->where("sale_id", $sale->id)->get() as $table)
                            <span>{{ $table->name }}</span>
                @endforeach
            </td>
            <td>
                {{ $sale->servant->name }}
            </td>
            <td>
                {{ $sale->total_price }}
            </td>
            <td>
                {{  $sale->payment_type === "cash"? "Cash" : "Credit Card"  }}
            </td>
            <td>
                {{  $sale->payment_status }}
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="5">
                Report from {{ Str::substr($startDate, 0, 10) }} to {{ Str::substr($endDate, 0, 10) }}
            </td>
        </tr>
        <tr>
            <td colspan="5">
                Total : {{ $total }} DH            </td>
        </tr>
    </tbody>
</table>
