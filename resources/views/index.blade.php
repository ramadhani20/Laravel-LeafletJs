<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Delivery Fee</th>

            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{$numb++}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->delivery_fee}}</td>
                <td>
                    <form action="{{ route('zona.destroy', $item->id) }}" method="post">
                     @csrf
                     @method('delete')
                     <a href="{{route('zona.show', $item->id)}}" class="btn btn-primary">
                         Edit
                       </a>
                     <input type="submit" value="Delete" class="btn btn-danger">
                   </form>

                 </td>
              </tr>
            @endforeach
        </tbody>
      </table>

      <a href="{{ route('zona.create') }}" class="btn btn-primary">Go to Route</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
