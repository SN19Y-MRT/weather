<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="utf-8">
      <title>週間天気予報</title>
      <!-- Fonts -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    </head>
  
    <body>
      
      <table class="table">
        <thead>
          <tr>
            <th>
              {{ $cityname }}
            </th>
            <th scope="col">日付</th>
            <th scope="col">天気</th>
            <th scope="col">最高気温</th>
            <th scope="col">最低気温</th>
          </tr>
        </thead>
        <tbody>
        @foreach($weathers as $weather)
            <tr>
              <td></td>
              <td>{{ $weather['time'] }}{{ $weather['week'] }}</td>
              <td>{{ $weather['weathername'] }}</td>
              <td>{{ $weather['temperature_2m_max'] }}{{ $units['temperature_2m_max_'] }}</td>
              <td>{{ $weather['temperature_2m_min'] }}{{ $units['temperature_2m_min_'] }}</td>
            </tr>
        @endforeach
        </tbody>
      </table>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    </body>
</html>
