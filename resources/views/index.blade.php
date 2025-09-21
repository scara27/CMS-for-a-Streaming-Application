<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Dodavanje filma</h1>

    <form method="post" action="{{route('movie.create')}}">
        @csrf
        @method('post')

        <table>
            <tr>
                <td>Naziv</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <td>Godina</td>
                <td><input type="text" name="year"></td>
            </tr>
            <tr>
                <td>Reziser</td>
                <td><input type="text" name="director"></td>
            </tr>
            <tr>
                <td><input type="submit" value="Sacuvaj"></td>
            </tr>
        </table>
    </form>
</body>
</html>