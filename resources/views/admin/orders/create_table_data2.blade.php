        <tr>
            <td><img src="/uploads/custom-images2/{{$variation->thumb_image}}" height="50" width="50"/></td>
            <td>{{ $variation->name }}</td>
            <input type="hidden" value="{{ $variation->name }}" name="product_name[]">
            <td>
            <select class="form-control color_data" name="variation_color">
            @foreach($color_array as $color_data)
                <option value="{{ $color_data->size_id }}">{{ $color_data->size->title }}</option>
            @endforeach
            </select>
            <input type="hidden" class="variation_color_id" name="variation_color_id" />
            <input type="hidden" class="pro_id" value="{{$pr_id}}">
            </td>
            <td>
            <select class="form-control" name="variation">
            @foreach($size_array as $size_data)
                <option value="{{ $size_data->color->name }}" data-color="{{ $size_data->color->name }}">{{ $size_data->color->name }}</option>
            @endforeach
            </select>
            </td>
            <td>
                <input class="form-control price" name="price[]" type="number" value="{{ $variation->price }}" required/>
            </td>
            <td>
                <input class="form-control offer_price" name="offer_price[]" type="number" value="{{ $variation->offer_price }}" required/>
            </td>
            <td>
                <input class="form-control qty quantity" name="quantity[]" type="number" value="1" required min="1"/>
                <input type="hidden" class="form-control" name="product_id[]" value="{{$pr_id}}" required/>
            </td>
            <td class="row_total"> {{$variation->price}}</td>
            <td>
                <a href="#" class="remove btn btn-sm btn-danger"> Delete </a>
            </td>
        </tr>